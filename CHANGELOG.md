# Changelog
All notable changes to this template will be documented in this file.

The changelog format uses the [Keep a Changelog](http://keepachangelog.com/en/1.0.0/) format. (Added/Changed/Deprecated/Removed/Fixed/Security)

The version number of changelogs uses the [Semantic Versioning](https://semver.org/) format.

## [2.0.0] 2023-02-24
## Changed
- Function core warning.
- PHP Code warning on Funcitons tempalte.
- Banner h1 for figcaption update.
- Jala client and Core files.
- Removing functions-template after merging and renaming to functions-jala
- Disable Gutenberg Duotone Filter.
- Using buttons intead of A tags.
- Removing ACF Cog function already on Core, moving SVG filter to Core.
- Function get_page_title to also return the page title.
- Prefxing functions with jdf.
- Commenting out bg-colors button combination.
- JDF prefixes in not functions code.
- Blocks tempalte to have heading formating

## Fix
- Tile block anchor issue breaking content layout.

## Added
- Archive description on archive template

## [1.2.0] 2023-01-05

## Added
- Block Anchor functionality to all blocks.

## [1.1.1] 2022-12-20

## Added
- Function to add default alt and title to Woocommerce product images.

## [1.1.0] 2022-11-02

## Added
- Generic content shortcode.

## [1.0.3] 2022-10-26

## Changed
- Moved version number from functions.php & style.scss to theme style.css.

## Fixed
- Text domain defined as "whitepearl" for ACF Options pages.

## [1.0.3] 2022-10-26

## Fixed
- Sidebar wrapper missing .entry class.

## [1.0.2] 2022-10-26

## Fixed
- Social buttons social name encased in spans, breaking layout.

## [1.0.1] 2022-10-26

## Fixed
- Sidebar template rendering sidebar evaluation & outside of container.

## [1.0.0] 2022-10-21

## Added
- Merged WhitePearl with Static Framework.

## [0.0.11] 2022-10-19

## Fixed
- Restore .site-main class to main elements.

## [0.0.10] 2022-10-19

## Fixed
- Top spacing for blocks template when on front page.

## [0.0.9] 2022-10-19

## Fixed
- Restore fixed background colour to header.

## [0.0.8] 2022-10-19

## Fixed
- Accordion .entry class was put inside of itemprop attribute, not class.

## [0.0.7] 2022-10-18

## Fixed
- var_dump_pre label not rendering if content evaluates to false.

## [0.0.7] 2022-10-18

## Fixed
- Wrappers for password forms on password protected pages.

## [0.0.6] 2022-10-18

## Fixed
- Wrappers on page templates to allow for blocks to exceed containers.

## [0.0.5] 2022-10-18

## Fixed
- Post single missing .entry class on parent container.

## [0.0.4] 2022-10-18

## Fixed
- Blocks with WYSIWYG fields missing .entry class on parent containers.

## [0.0.3] 2022-10-18

## Changed
- Gallery block images to be in a 2 item column on smallest screen width, unless there is only 1 item.

## [0.0.2] 2022-10-13

## Fixed
- "jd_media_query_activation" using hyphens instead of underscores in class name. This broke Tab blocks when using responsive mobile format.

## [0.0.1] 2022-10-13

## Fixed
- Column and Tile block not applying appropriate cols classes when there are only two items.
- Tile block missing "list-item" class on parent element.

## [0.0.0] 2022-04-28

Changelog will be minimal while WhitePearl NG is being developed, only pointing out key additions and changes.

## Added
- Initial base theme requirements.