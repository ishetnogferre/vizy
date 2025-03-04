# Changelog

## 2.1.13 - 2023-11-25

### Added
- Add console log for fatal Vizy block renders to assist with debugging.

### Fixed
- Fix fatal Vue errors when inline `<style>` tags were included in Vizy block field rendering.
- Fix error state for invalid Vizy blocks.
- Fix and improve click and mouse events inside a Vizy block, due to drag-handling from Tiptap.
- Fix an issue where fields in a Vizy block couldn’t be focused, due to a Craft 4.5.7 change.
- Fix an error with code block nodes escaping code content.

## 2.1.12 - 2023-10-25

### Added
- Add exception message to console when failing to render a Vizy block.

### Fixed
- Fix an error when outputting iframe content, in some cases.

## 2.1.11 - 2023-10-03

### Fixed
- Fix `HardBreak` (`<br>`) nodes being rendered twice.
- Fix an issue where some fields (Hyper) in Vizy blocks weren’t being serialized properly.

## 2.1.10 - 2023-09-25

### Added
- Add better handling for fatal errors when rendering Vizy blocks.

### Fixed
- Fix Table node inner node styles (links, lists, etc).
- Fix when using the Image Editor on an Image node, transforms not being generated.

## 2.1.9 - 2023-09-08

### Added
- Add normalization fix for incorrect `ListItem` schema format.
- Add `title` setting to Link nodes.

### Fixed
- Fix an issue with project config and other new fields.
- Fix using Hyper and Icon Picker fields in Vizy blocks.
- Fix `ListItem` normalization.
- Fix an error with node normalization.
- Switch `htmlEncode` for `AntiXSS` for better special character handling.
- Fix Table nodes’ rendering.
- Fix node normalization not completing correctly for nested nodes.
- Fix field not initializing correctly in Super Table or Matrix field settings.
- Fix `rel` output for links.
- Fix overlapping marks not producing the correct HTML output.

## 2.1.8 - 2023-08-10

### Fixed
- Fix rendering nested JS for Vizy fields.
- Revamp Vue component initialization for input and settings. Improves performance and edge-cases with Vizy fields nested in Matrix/Neo/Super Table and nested Vizy fields.
- Fix an issue where nested Vizy fields trigger an unload warning.
- Fix GQL schema for Nodes to generating correctly.
- Fix Super Table/Matrix/Neo nested combinations not rendering Vizy fields correctly.
- Fix an issue for neste Vizy fields, and `isNew` checks.
- Fix an issue where deeply-nested Vizy fields within Matrix or Super Table fields weren’t having their content set correctly.
- Fix lightswitch UI for Vizy blocks on Craft 4.4.16+.
- Fix “fresh” check for blocks, affecting some defaults for some fields (Button Box) saving over content.
- Fix the media embed node not displaying correctly when toggling the code editor.
- Fix `ListItem` nodes throwing an error when their content was `null`.

## 2.1.7 - 2023-07-11

### Added
- Add error class to Vizy Block tabs, when one of their fields has an error.

### Fixed
- Fix an error parsing empty table field nodes.
- Fix an error when Vizy Blocks contain a dismissable UI element tip.
- Fix Matrix-nested fields and spacing.

## 2.1.6 - 2023-05-27

### Fixed
- Fix new Vizy blocks not having their `isFresh` set for new fields.

## 2.1.5 - 2023-05-17

### Added
- Add `recursiveFieldCount` plugin setting.

### Fixed
- Fix an error when no blocktypes are defined for a blocktype group.
- Fix an issue when new nested Vizy fields would wipe out other fields’ unsaved draft content.
- Fix incorrectly hijacking click events inside Vizy blocks.
- Fix an error for Media Embed nodes when containing special characters in embed data HTML.

## 2.1.4 - 2023-05-03

### Changed
- Improve gap cursor between Vizy blocks.

### Fixed
- Fix an error when editing nested Vizy fields in element slide-outs.
- Fix an issue where nested Vizy fields (Vizy > Matrix > Vizy) weren’t working correctly.
- Fix iframe nodes not rendering correctly.

## 2.1.3 - 2023-04-24

### Changed
- Lower the font size of preview text for Vizy Blocks.
- Update all JS dependencies.

### Fixed
- Fix Vizy block preview text not using correct values for some field types.
- Fix an error when re-ordering certain Vizy blocks, containing nested Vizy fields.
- Fix collapse transition with nested Vizy fields and the editor toolbar.
- Fix dropdown fields used in Vizy blocks rendering incorrectly when moving.
- Fix incorrect Table handling for Feed Me.
- Fix Redactor fields in nested Vizy fields getting reset (removed) when they shouldn’t.

## 2.1.2 - 2023-04-20

### Fixed
- Fix being unable to select an image when no default transform was set for the field.

## 2.1.1 - 2023-04-19

### Added
- Add Table support for Feed Me.
- Command Palette commands can now be part of the Editor Config.

### Changed
- Command Palette commands now filter out any extensions that are included, but don't have a button enabled.

### Fixed
- Fix ul/ol items being invalid in the editor and saved incorrectly. May require any items added after `2.1.0` to be re-input.
- Fix some users not being able to link to assets.

## 2.1.0 - 2023-04-13

### Added
- Add the ability to provide your own buttons, commands and extensions.
- Add support for Editor Config custom buttons.
- Vizy fields can now be included recursively (up to 10 levels of the same field).
- Add Media Embed node.
- Add Table node.
- Add iFrame node.
- Add `TextStyle` mark for creating span elements related to text styles.
- Add “Editor Mode” field setting to control whether block-only, rich-text-only or combined.
- Add “Commands Palette” to make creating content super-speedy. Just start typing “/“ anywhere.
- Add “Block Type Picker Behaviour” field setting to control whether having the block-picker shown on click or hover.
- Add “Expand All” and “Collapse All” option to Vizy blocks.
- Add `data-block` and `data-type` attributes to Vizy blocks.
- Add `Ctrl/Cmd` + `K` as a keyboard shortcut to add new links.
- Add “Plain Text Paste” field setting.
- Add “Classes” setting to Link nodes.
- Add “Min Blocks” and “Max Blocks” settings to field.
- Add “Min Blocks” and “Max Blocks” settings to each Vizy block type.
- Add `LinkMarkInterface` for Link Marks for GraphQL queries.
- Add proper support for Marks in GraphQL queries.
- Add `Link::getLinkElement()`.
- Add the ability to set a default source for images uploaded to the field.
- Add keyboard accessibility to menu button dropdowns.
- Add the ability to set render variables on the node with `node.renderHtml(config)` or `node.renderNode(config)`.
- Add keyboard support to block type picker.
- Add better ghost image when dragging Vizy blocks.
- Add support for disabling max picked blocks from the block-picker.
- Double-clicking a Vizy block now toggles its collapsed state.
- Add `Node::normalizeNode` to allow nodes to be normalized from the database.
- Add `values` to `VizyBlockInterface` for GraphQL.

### Changed
- Now requires Craft 4.4+.
- Update all JS dependancies.
- Update Tiptap to 2.0.
- Remove Vizy block focus state (for now).
- Refactor nested Vizy fields to correctly render with Vue 3 compilation, fixing lots of pesky issues.
- Formatting buttons (headings, blockquote, etc) can now be included outside of the formatting dropdown.
- Ordered/Unordered Lists nodes now longer wrap content with Paragraph nodes.
- Refine heading styles in the editor.
- Update `NodeInterface::text` to return a textual representation (plain text) of any content for GraphQL.
- Modifying other Craft fields included in Vizy fields now correctly updates content when fields’ handles are changed.
- Improve visibility of dropcursor when dragging Vizy blocks.
- Speed up tippy overlays for snappier feedback.
- Change top-level Paragraph node button icon.
- Move asset-related field settings to hidden “advanced” area for brevity.
- Update text align buttons to show `isActive` state.
- Provide better handling of invalid Vizy blocks if they occur.

### Fixed
- Fix modified field status badge for Vizy block fields.
- Fix field triggering a changed value behaviour (saving a new draft) when no content has changed.
- Fix edit image modal alignment and overflow scrolling issues.
- Fix settings cog color for Vizy blocks.
- Fix tab overflow issue for Vizy blocks.
- Fix missing translations for block settings.
- Fix toolbar button alignment issue for icons.
- Fix Paragraph node button not working correctly.
- Fix node selection when hovering.
- Fix empty blocktype picker UI when no block types are available.
- Fix being able to copy/paste Vizy blocks into other fields (in a nested setup) that don’t support the same block types.
- Fix a JS error when trying to drag blocks between nested Vizy fields.
- Fix copying field handles when editing field content not working.
- Fix an issue where field layout fields may not be saved when adding quickly.
- Fix some HTML characters being stripped incorrectly due to LitEmoji processing.
- Fix node attributes like classes not always merging correctly with template-defined and config-defined.
- Fix nodes saving attributes with `null` values.
- Fix Paragraph empty checks when containing nested nodes/marks.
- Fix node serialization not working for nested nodes.
- Fix an error when invalid nodes were used (crashes editor).
- Fix some special HTML characters being stripped out of content.
- Fix accessibility for button modals.
- Fix menu bar items in dropdowns not showing their active state.
- Fix dropcursor glitches between Vizy blocks, and improve style.
- Fix an issue where saving Vizy fields inside Vizy Block field type settings weren’t always saved.
- Fix Redactor changes in Vizy blocks not having their content serialized correctly.
- Fix Table fields used in Vizy Blocks not saving correctly when rows in the table are deleted.
- Fix height of menu button options and scrollable container.

## 2.0.12 - 2023-02-27

### Fixed
- Fix an error when querying Vizy blocks with GraphQL.

## 2.0.11 - 2023-02-21

### Added
- Add support for Preparse plugin.
- Add content service to handle updating Vizy field content (mostly for [Hyper](https://github.com/verbb/hyper).
- Add `$_type` and `$_field` to Block. (thanks @leevigraham).
- Add the ability to set the initial number of rows for a field, to control its initial height.

### Changed
- Change Vizy field data to be stored in `vizyData` to prevent collisions with inner fields (which are not needed but can override Vizy serialized content).
- Only admins are now allowed to access plugin settings.
- `text` for nodes is now automatically run through the `raw` Twig filter to decode HTML special characters.

### Fixed
- Fix a GraphQL type error for VizyBlocks.
- Fix node types not appearing in the Explorer or Introspection for GraphQL.

## 2.0.10 - 2022-12-25

### Changed
- Link marks now automatically parse for reference tags in their `href`.

### Fixed
- Fix GraphQL queries throwing an error when fields aren’t initialized fully.
- Fix heading styles in editor.
- Fix an error importing via Feed Me, in some cases.

## 2.0.9 - 2022-11-09

### Fixed
- Fix Feed Me importing not supporting all node types (just plain text).
- Fix an error where field settings for a block’s field layout can be corrupted.

## 2.0.8 - 2022-10-23

### Fixed
- Fix handling of Vizy fields inside element slideouts, instead of block relationship fields when being edited.

## 2.0.7 - 2022-09-25

### Added
- Add support for entries conditions for Vizy fields.

### Changed
- Switch deprecated `ueberdosis/html-to-prosemirror` package to `ueberdosis/tiptap-php`.

### Fixed
- Fix Vizy blocks not being site-aware.
- Fix “Open link in new tab” not saving correctly for link nodes.
- Fix asset fields within Matrix/Super Table fields not moving from the temporary upload directory.
- Fix an error when propagating element fields’s content for un-translated Vizy/SuperTable/Inner fields.
- Fix an error when propagating Super Table rows for un-translated Vizy/SuperTable/Inner fields.
- Fix an error when propagating Matrix blocks for un-translated Vizy/Matrix/Inner fields.
- Fix importing nodes via Feed Me not working for some node types.

## 2.0.6 - 2022-08-11

### Fixed
- Fix Vizy node content being reset when inserting other nodes directly before it.
- Fix a field alignment issue in nested Vizy fields.
- Fix Vizy fields not initializing when switching entry types.
- Fix fields not working correctly in element slideouts, in some instances.

## 2.0.5 - 2022-08-09

### Fixed
- Fix GraphQL queries throwing an error when fields aren’t initialized fully.
- Fix blocktype picker not appearing in Live Preview.
- Fix potential error for blocktypes.
- Update Vizy loading for input to handle proper loading using Vite.

## 2.0.4 - 2022-07-06

### Fixed
- Fix an error when making GraphQL queries.

## 2.0.3 - 2022-07-02

### Added
- Add `vite-plugin-compression` to generate gzipped JS/CSS assets.
- Add better handling for JS scripts on-load, to prevent against missing JS execution in some cases. (thanks @khalwat).

### Changed
- Update CP template `content` block.

### Fixed
- Fix a GQL deprecation notice.
- Fix HMR not working when making changes to `vizy.js`.
- Fix updating Block Type template not working correctly.
- Fix en error when trying to limit “Available Volumes” or “Available Transforms”.
- Fix an error when rendering an entry revision for nested Vizy fields.

## 2.0.2 - 2022-06-04

### Fixed
- Fix an error with JS translations.
- Fix return types for `node.renderHtml()`.

## 2.0.1 - 2022-05-28

### Added
- Add changes/improvements from `1.0.14`.

### Fixed
- Fix `renderHtml()` not rendering HTML correctly.
- Fix JS initialization for input and settings.
- Fix field settings not initializing in some cases.

## 2.0.0 - 2022-05-05

### Added
- Add checks for registering events for performance.

### Changed
- Now requires PHP `8.0.2+`.
- Now requires Craft `4.0.0+`.
- Merge updates with version 1.0.13.
- Migrate to Vite and Vue 3 for performance.
- Rename base plugin methods.
- Replace deprecated `Craft.postActionRequest()` for JS.
- Improve field performance when editing in the control panel.

### Fixed
- Fix Craft `4.0.0` compatibilities.
- Fix link sources having duplicate sources.
- Fix a type error when trying to render empty HTML.
- Fix Vizy field settings not picking up field layout changes when edited.

### Removed
- Remove `cleanDeltas()`, which is no longer needed in Craft 4.

## 1.0.22 - 2022-12-25

### Fixed
- Fix GraphQL queries throwing an error when fields aren’t initialized fully.

## 1.0.21 - 2022-10-23

### Fixed
- Fix handling of Vizy fields inside element slideouts, instead of block relationship fields when being edited.

## 1.0.20 - 2022-09-25

### Fixed
- Fix an issue where nested Vizy fields in Matrix/Super Table/etc fields weren’t having their content serialized correctly.

## 1.0.19 - 2022-09-23

### Fixed
- Fix display issues with Vizy fields in Live Preview.
- Fix an overflow issue for small screens for the block picker.
- Fix a legacy error where in some cases blocks were missing their block type.
- Fix toggling field tabs not working correctly for nested Vizy fields.
- Fix legacy handling of `HtmlToProseMirror` package when importing content via Feed Me.

## 1.0.18 - 2022-08-11

### Changed
- Update all tiptap dependancies to latest beta versions.

### Fixed
- Fix Vizy node content being reset when inserting other nodes directly before it.

## 1.0.17 - 2022-08-09

### Fixed
- Fix blocktype picker not appearing in Live Preview.

## 1.0.16 - 2022-07-02

### Added
- Add `isRoot` for Vue component top-level fields.

### Changed
- Update all tiptap dependancies to latest beta versions.
- Exclude any falsey attributes for a node when rendering.
- Lower debounce time for watched Vizy Block field changes.
- Only clicking on the header of Vizy Blocks selects a block.

### Fixed
- Fix link nodes always including `target` and `rel` attributes.
- Fix newly created Vizy blocks not having the correct namespace in some instances.
- Fix JS not initializing correctly for complex Vizy fields and in combination with Neo/SuperTable/Matrix.
- Fix an error where delta values for other fields was being stripped out when including a Vizy field.
- Fix an error when saving nested Vizy fields with validation errors and blocks losing their content.
- Fix unload warning when no content has been changed.
- Fix Vizy Block field alignment of fields.
- Fix selected state issues on nested Vizy fields and Vizy blocks, and add support for “Escape” key to remove selected Vizy Block.
- Fix being unable to click properly between Vizy blocks to add a new node, and fix gap cursor alignment.
- Fix an overlay issue for nested Vizy fields when picking Vizy blocks.
- Fix multiple Redactor fields in a single Vizy block not working correctly.

## 1.0.15 - 2022-06-04

### Fixed
- Fix incorrectly encoding quotes for Vizy field content.

## 1.0.14 - 2022-05-28

### Added
- Add `VizyImageNodeInterface` and the ability to query `asset` on image nodes.
- Add `Image::getAsset()` for image nodes.
- Add caching for block type definitions for each field, to speed up rendering of large Vizy fields.
- Improve field performance when editing in the control panel.

### Fixed
- Fix being unable to remove the template path for a Vizy blocktype when editing the field settings.
- Remove HTMLPurifier due to performance issues, as we can rely on proper HTML encoding via `StringHelper::htmlEncode`.
- Fix double-encoding of HTML strings.
- Fix volumes not working for selecting images.

## 1.0.13 - 2022-04-13

### Added
- Add support for `limit`, `orderBy` and `where` arguments for GraphQL queries, when querying `nodes`.
- Add descriptions for all attributes for GraphQL.
- Add `vizyBlock.getCollapsed()`.
- Add `vizyBlock.id`.
- Add `Node::isEmpty()`.

### Changed
- Change field layout instruction text for Vizy field settings.
- GraphQL queries using `nodes` now only return enabled nodes.

### Fixed
- Fix `NodeCollection::isEmpty` not working correctly.

## 1.0.12 - 2022-03-17

### Fixed
- Fix nested node content being incorrectly stripped out due to HTML purifier.

## 1.0.11 - 2022-03-13

### Changed
- Improve node collection performance.
- Minor Vizy block performance improvements.

### Fixed
- Fix serializing nested Vizy fields not being arrays.
- Fix a potential XSS vulnerability, where HTML wasn’t correctly encoded.
- Fix an error when serializing nested Vizy fields, when generating search keywords.
- Fix rendering node collections in the control panel automatically when not needed.
- Fix Vizy Block nodes not rendering correctly for GraphQL queries.
- Fix an error when querying `nodes` or `rawNodes` for GraphQL queries.

## 1.0.10 - 2022-02-28

### Added
- Add support for emoji’s in Vizy field content.

### Fixed
- Fix field content not updating when editing raw HTML.
- Fix non-translatable Vizy field with inner translatable fields not having their content propagated correctly.
- Fix Matrix field sanitizing not working correctly for Vizy Blocks containing Matrix fields where their sub-field handles have changed.
- Fix related elements in Vizy block fields not having their appropriate site (inherited from the owner element) applied to the field.
- Fix Matrix field sanitizing not working correctly for Vizy Blocks containing Matrix fields where their sub-field handles have changed.
- Fix a compatibility issue with Redactor, showing extra line breaks incorrectly.
- Fix rendering content not reporting back correctly for `length` Twig filter, and no longer require the use of `raw` Twig filter.
- Fix displaying encoded html characters in some cases (pasting from Word).

## 1.0.9 - 2022-01-17

### Added
- Add support for Feed Me.

### Changed
- Bump axios from 0.21.1 to 0.21.2.

### Fixed
- Fix "Remove Empty Paragraphs" not working correctly when content has been pasted from Word, or contained `&nbsp;` characters.
- Fix Firefox text selection issue, when trying to select text within a Vizy block (input, textarea fields).
- Fix `gapcursor` tiptap utility not working correctly.
- Fix when fields only containing images, the field is considered empty.

## 1.0.8 - 2021-10-23

### Changed
- Update all tiptap dependancies to latest beta versions.

### Fixed
- Fix Redactor fields not working correct in a Vizy block.
- Fix editor losing focus when pressing toolbar buttons.
- Fix z-index overflow issue when showing the block type selector.
- Fix block type selector not allowing scrollable area when a lot of blocks are available.
- Fix Image nodes not having ref tags parsed correctly for transforms.
- Fix ref parsing logic for Link nodes.
- Fix an error thrown during search indexing, when a Vizy block contained an element select field (assets, entries, etc).

## 1.0.7 - 2021-09-09

### Fixed
- Fix content not saving correctly when editing via the element slideout.
- Fix editor toolbar not behaving as fixed when opening the element editor slideout.
- Fix links containing ref tags not being parsed properly.
- Fix including incorrect attributes (`id`, `uid`) when querying Vizy field nodes via GraphQL.

## 1.0.6 - 2021-08-29

### Added
- Add `subscript` and `superscript` buttons.

### Changed
- Update all tiptap dependancies to latest beta versions.

### Fixed
- Ensure each field's content is serialized properly when saving Vizy blocks.
- Fix Vizy blocks using `isolating`, causing issues with backspacing some other nodes (blockquote).
- Fix an error when trying to add a link with only numbers.
- Remove field modification indicator (from Craft) for Vizy block inner fields.
- Fix lack of `enabled` attribute for all nodes.
- Fix disabled Vizy blocks returned in `query()` when using `all()` to query nodes.
- Fix text align buttons not working, due to `@tiptap/core@2.0.0-beta.85` change.
- Fix numerous errors when creating multiple Vizy fields in Matrix and Super Table fields.

## 1.0.5 - 2021-08-02

### Changed
- Update all tiptap dependancies to latest beta versions.

### Fixed
- Fix nested Vizy fields not rendering when used inside a Matrix block (also inside a Vizy field).
- Fix focus styling when selecting a Vizy Block.
- Fix Vizy Block inner field validation (including Matrix).
- Fix brand-new static Super Table blocks in a Vizy block having their rows duplicated when moving the block.
- Fix when moving a Vizy block containing a Redactor field, it Redactor would be initialized multiple times.
- Fix field layout changed in a Super Table-nested Vizy field not applying when running `project-config/apply`.
- Fix field layout changed in a Matrix-nested Vizy field not applying when running `project-config/apply`.
- Fix multiple Vizy fields in Matrix/Super Table parent fields not saving correctly.

## 1.0.4 - 2021-07-21

### Added
- Add `text` and `rawNode` to NodeInterface for GraphQL.

### Fixed
- Fix an error when saving Vizy blocks containing Matrix fields with no blocks defined.
- Fix Vizy fields failing to validate Vizy blocks, when only Vizy blocks are present in the field.
- Fix `content`, `attrs`, `marks` and `text` GraphQL node properties not having the correct values.
- Fix image node, and other self-closing nodes not displaying correctly.
- Fix required Vizy fields not validating when no content is set for the field.

## 1.0.3 - 2021-06-22

### Added
- Add `defaultTransform` field setting.
- Add `defaultTransform` field setting.
- Add `availableTransforms` field setting.
- Add `availableVolumes` field setting.
- Add `showUnpermittedFiles` field setting.
- Add `showUnpermittedVolumes` field setting.
- Add `trimEmptyParagraphs` field setting to automatically trim any empty paragraphs in content.
- Add `serializeValue()` to all nodes, to control the values saved to the database.

### Changed
- Update all tiptap dependancies to latest beta versions.
- Update Vizy Node GraphQL interface name.

### Fixed
- Fix multiple nested marks (bold + underline, etc) rendering text twice.
- Fix Matrix blocks throwing an error if a block type field was deleted. (thanks @dyerc).
- Fix Vizy block type fields not saving when nested in a Super Table/Matrix field.
- Fix nested Vizy fields’ image nodes not working correctly.
- Fix GQL Vizy Block field aliases not working.
- Fix fixed toolbar buttons overlapping for nested Vizy fields.
- Fix nested list elements `ul`, `ol` not appearing correctly in the control panel editor.
- Fix Vizy Block fields not validating when saving an element.
- Fix `getMarkAttributes` tiptap deprecation.
- Fix asset fields in Vizy blocks not resolving to the correct volume/paths.
- Fix incorrectly parsing Twig template code in block fields.
- Fix Vizy fields not showing as empty for empty content.

## 1.0.2 - 2021-05-30

### Added
- Allow marks to use `merge` when using template-based config.
- Add `getOwner()` to Vizy Block element, to allow use of `owner` for block field settings.

### Changed
- Update all tiptap dependancies to latest beta versions.
- Remove duplicate Vue dependancy, causing some conflicts with other plugins using Vue.

### Fixed
- Fix incompatibility issues with [Inventory](https://github.com/doublesecretagency/craft-inventory) plugin.
- Fix an error when a block type’s tab contained only numbers.
- Fix orphaned layouts for deleted block types, or deleted Vizy fields.
- Fix field layout setting updates not being stored to project config (adding or removing field).
- Ensure general block type errors are show when saving a field fails.
- Fix multiple field layouts being created if a block type fails validation when saving the field settings.
- Fix unload warnings when no content has changed, when a field has nested Vizy fields.
- Fix nested Vizy fields and their toolbars not sticking when using `toolbarFixed`.
- Fix “add block” button not always appearing on a new line, depending on formatted text.
- Fix incomplete field data being saved when a Matrix (or similar) field contained a nested Matrix, when the owner element has unchanged block content.

## 1.0.1 - 2021-05-09

### Changed
- Allow Icons Path setting to use auto-suggest field.
- Refactor block inner field change detection to use `MutationObserver`. Should prove more reliable for variety of edge-cases.

### Fixed
- Fix search indexing not factoring in Vizy block inner fields, and nested Vizy fields.
- Fix documentation link for editor config in field settings.
- Fix an error when trying to populate block content for a block field that has been changed or removed.
- Fix Vizy block elements not having inner field normalisation occur with owner element.
- Fix an error when adding new block types to the field.
- Fix WYSIWYG styles being applied to nested block elements.
- Fix changes from Redactor not serializing when saving Vizy field content.
- Fix changes from Position and Colour Swatches plugins not serializing when saving Vizy field content.
- Fix a potential error when a field that was included in a block type was deleted.
- Fix changes from Tag fields not serializing when saving Vizy field content.
- Fix extensions not always getting initialized properly, when being contained in the formatting menu.

## 1.0.0 - 2021-04-30

- Initial release.
