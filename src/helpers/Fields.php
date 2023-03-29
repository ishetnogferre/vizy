<?php
namespace verbb\vizy\helpers;

use Craft;
use craft\models\FieldLayout;
use craft\models\FieldLayoutTab;
use craft\helpers\Cp;
use craft\helpers\Html;
use craft\helpers\Json;
use craft\helpers\StringHelper;
use craft\base\FieldLayoutElement;
use craft\helpers\ArrayHelper;
use craft\fieldlayoutelements\BaseField;

class Fields
{
    // Static Methods
    // =========================================================================

    public static function fieldLayoutDesignerHtml(FieldLayout $fieldLayout, array $config = []): string
    {
        $config += [
            // CHANGED
            // 'id' => 'fld' . mt_rand(),
            'customizableTabs' => true,
            'customizableUi' => true,
        ];

        $tabs = array_filter($fieldLayout->getTabs(), fn(FieldLayoutTab $tab) => !empty($tab->getElements()));

        if (!$config['customizableTabs']) {
            $tab = array_shift($tabs) ?? new FieldLayoutTab([
                    'uid' => StringHelper::UUID(),
                    'layout' => $fieldLayout,
                ]);
            $tab->name = $config['pretendTabName'] ?? Craft::t('app', 'Content');

            // Any extra tabs?
            if (!empty($tabs)) {
                $elements = $tab->getElements();
                foreach ($tabs as $extraTab) {
                    array_push($elements, ...$extraTab->getElements());
                }
                $tab->setElements($elements);
            }

            $tabs = [$tab];
        }

        // Make sure all tabs and their elements have UUIDs
        // (We do this here instead of from FieldLayoutComponent::init() because we don't want field layout forms to
        // get the impression that tabs/elements have persisting UUIDs if they don't.)
        foreach ($tabs as $tab) {
            if (!isset($tab->uid)) {
                $tab->uid = StringHelper::UUID();
            }

            foreach ($tab->getElements() as $layoutElement) {
                if (!isset($layoutElement->uid)) {
                    $layoutElement->uid = StringHelper::UUID();
                }
            }
        }

        $view = Craft::$app->getView();
        $jsSettings = Json::encode([
            'customizableTabs' => $config['customizableTabs'],
            'customizableUi' => $config['customizableUi'],
        ]);
        $namespacedId = $view->namespaceInputId($config['id']);

        $js = <<<JS
new Craft.FieldLayoutDesigner("#$namespacedId", $jsSettings);
JS;
        $view->registerJs($js);

        // CHANGED
        $availableCustomFields = $config['availableCustomFields'] ?? $fieldLayout->getAvailableCustomFields();
        $availableNativeFields = $config['availableNativeFields'] ?? $fieldLayout->getAvailableNativeFields();
        $availableUiElements = $config['availableUiElements'] ?? $fieldLayout->getAvailableUiElements();

        // Make sure everything has the field layout set properly
        foreach ($availableCustomFields as $groupFields) {
            self::_setLayoutOnElements($groupFields, $fieldLayout);
        }
        self::_setLayoutOnElements($availableNativeFields, $fieldLayout);
        self::_setLayoutOnElements($availableUiElements, $fieldLayout);

        // Don't call FieldLayout::getConfig() here because we want to include *all* tabs, not just non-empty ones
        $fieldLayoutConfig = [
            'uid' => $fieldLayout->uid,
            'tabs' => array_map(fn(FieldLayoutTab $tab) => $tab->getConfig(), $tabs),
        ];

        if ($fieldLayout->id) {
            $fieldLayoutConfig['id'] = $fieldLayout->id;
        }

        $newTabSettingsData = self::_fldTabSettingsData(new FieldLayoutTab([
            'uid' => 'TAB_UID',
            'name' => 'TAB_NAME',
            'layout' => $fieldLayout,
        ]));

        return
            Html::beginTag('div', [
                'id' => $config['id'],
                'class' => 'layoutdesigner',
                'data' => [
                    'new-tab-settings-namespace' => $newTabSettingsData['settings-namespace'],
                    'new-tab-settings-html' => $newTabSettingsData['settings-html'],
                    'new-tab-settings-js' => $newTabSettingsData['settings-js'],
                ],
            ]) .
            Html::hiddenInput('fieldLayout', Json::encode($fieldLayoutConfig), [
                'data' => ['config-input' => true],
            ]) .
            Html::beginTag('div', ['class' => 'fld-workspace']) .
            Html::beginTag('div', ['class' => 'fld-tabs']) .
            implode('', array_map(fn(FieldLayoutTab $tab) => self::_fldTabHtml($tab, $config['customizableTabs']), $tabs)) .
            Html::endTag('div') . // .fld-tabs
            ($config['customizableTabs']
                ? Html::button(Craft::t('app', 'New Tab'), [
                    'type' => 'button',
                    'class' => ['fld-new-tab-btn', 'btn', 'add', 'icon'],
                ])
                : '') .
            Html::endTag('div') . // .fld-workspace
            Html::beginTag('div', ['class' => 'fld-sidebar']) .
            ($config['customizableTabs']
                ? Html::beginTag('div', [
                    'role' => 'listbox',
                    'class' => ['btngroup', 'small', 'fullwidth'],
                    'aria' => ['label' => Craft::t('app', 'Layout element types')],
                    'tabindex' => '0',
                ]) .
                Html::button(Craft::t('app', 'Fields'), [
                    'role' => 'option',
                    'type' => 'button',
                    'class' => ['btn', 'small', 'active'],
                    'aria' => ['selected' => 'true'],
                    'data' => ['library' => 'field'],
                    'tabindex' => '-1',
                ]) .
                Html::button(Craft::t('app', 'UI Elements'), [
                    'role' => 'option',
                    'type' => 'button',
                    'class' => ['btn', 'small'],
                    'aria' => ['selected' => 'false'],
                    'data' => ['library' => 'ui'],
                    'tabindex' => '-1',
                ]) .
                Html::endTag('div') // .btngroup
                : '') .
            Html::beginTag('div', ['class' => 'fld-field-library']) .
            Html::beginTag('div', ['class' => ['texticon', 'search', 'icon', 'clearable']]) .
            Cp::textHtml([
                'class' => 'fullwidth',
                'inputmode' => 'search',
                'placeholder' => Craft::t('app', 'Search'),
            ]) .
            Html::tag('div', '', [
                'class' => ['clear', 'hidden'],
                'title' => Craft::t('app', 'Clear'),
                'aria' => ['label' => Craft::t('app', 'Clear')],
            ]) .
            Html::endTag('div') . // .texticon
            self::_fldFieldSelectorsHtml(Craft::t('app', 'Native Fields'), $availableNativeFields, $fieldLayout) .
            implode('', array_map(fn(string $groupName) => self::_fldFieldSelectorsHtml($groupName, $availableCustomFields[$groupName], $fieldLayout), array_keys($availableCustomFields))) .
            Html::endTag('div') . // .fld-field-library
            ($config['customizableUi']
                ? Html::beginTag('div', ['class' => ['fld-ui-library', 'hidden']]) .
                implode('', array_map(fn(FieldLayoutElement $element) => self::_fldElementSelectorHtml($element, true), $availableUiElements)) .
                Html::endTag('div') // .fld-ui-library
                : '') .
            Html::endTag('div') . // .fld-sidebar
            Html::endTag('div'); // .layoutdesigner
    }

    private static function _fldTabHtml(FieldLayoutTab $tab, bool $customizable): string
    {
        return
            Html::beginTag('div', [
                'class' => 'fld-tab',
                'data' => array_merge([
                    'uid' => $tab->uid,
                ], self::_fldTabSettingsData($tab)),
            ]) .
            Html::beginTag('div', ['class' => 'tabs']) .
            Html::beginTag('div', [
                'class' => array_filter([
                    'tab',
                    'sel',
                    $customizable ? 'draggable' : null,
                ]),
            ]) .
            Html::tag('span', $tab->name) .
            ($customizable
                ? Html::a('', null, [
                    'role' => 'button',
                    'class' => ['settings', 'icon'],
                    'title' => Craft::t('app', 'Edit'),
                    'aria' => ['label' => Craft::t('app', 'Edit')],
                ]) :
                '') .
            Html::endTag('div') . // .tab
            Html::endTag('div') . // .tabs
            Html::beginTag('div', ['class' => 'fld-tabcontent']) .
            implode('', array_map(fn(FieldLayoutElement $element) => self::_fldElementSelectorHtml($element, false), $tab->getElements())) .
            Html::endTag('div') . // .fld-tabcontent
            Html::endTag('div'); // .fld-tab
    }

    private static function _fldFieldSelectorsHtml(string $groupName, array $groupFields, FieldLayout $fieldLayout): string
    {
        $showGroup = ArrayHelper::contains($groupFields, fn(BaseField $field) => !$fieldLayout->isFieldIncluded($field->attribute()));

        return
            Html::beginTag('div', [
                'class' => array_filter([
                    'fld-field-group',
                    $showGroup ? null : 'hidden',
                ]),
                'data' => ['name' => mb_strtolower($groupName)],
            ]) .
            Html::tag('h6', $groupName) .
            implode('', array_map(fn(BaseField $field) => self::_fldElementSelectorHtml($field, true, [
                'class' => array_filter([
                    $fieldLayout->isFieldIncluded($field->attribute()) ? 'hidden' : null,
                ]),
            ]), $groupFields)) .
            Html::endTag('div'); // .fld-field-group
    }

    private static function _fldElementSelectorHtml(FieldLayoutElement $element, bool $forLibrary, array $attr = []): string
    {
        if ($element instanceof BaseField) {
            $attr = ArrayHelper::merge($attr, [
                'class' => !$forLibrary && $element->required ? ['fld-required'] : [],
                'data' => [
                    'keywords' => $forLibrary ? implode(' ', array_map('mb_strtolower', $element->keywords())) : false,
                ],
            ]);
        }

        $settingsNamespace = 'element-' . ($forLibrary ? 'ELEMENT_UID' : $element->uid);
        $view = Craft::$app->getView();
        $view->startJsBuffer();
        $settingsHtml = $view->namespaceInputs(fn() => $element->getSettingsHtml(), $settingsNamespace);
        $settingsJs = $view->clearJsBuffer(false);

        $attr = ArrayHelper::merge($attr, [
            'class' => array_filter([
                'fld-element',
                $forLibrary ? 'unused' : null,
                !$forLibrary && $element->hasConditions() ? 'has-conditions' : null,
            ]),
            'data' => [
                'uid' => !$forLibrary ? $element->uid : false,
                'config' => $forLibrary ? ['type' => get_class($element)] + $element->toArray() : false,
                'has-custom-width' => $element->hasCustomWidth(),
                'settings-namespace' => $settingsNamespace,
                'settings-html' => $settingsHtml ?: false,
                'settings-js' => $settingsJs ?: false,
            ],
        ]);

        return Html::modifyTagAttributes($element->selectorHtml(), $attr);
    }

    private static function _fldTabSettingsData(FieldLayoutTab $tab): array
    {
        $namespace = "tab-$tab->uid";
        $view = Craft::$app->getView();
        $view->startJsBuffer();
        $settingsHtml = $view->namespaceInputs(fn() => $tab->getSettingsHtml(), $namespace);
        $settingsJs = $view->clearJsBuffer(false);

        return [
            'settings-namespace' => $namespace,
            'settings-html' => $settingsHtml,
            'settings-js' => $settingsJs,
        ];
    }

    private static function _setLayoutOnElements(array $elements, FieldLayout $fieldLayout): void
    {
        foreach ($elements as $element) {
            $element->setLayout($fieldLayout);
        }
    }

}
