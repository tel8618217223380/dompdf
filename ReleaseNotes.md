> # DOMPDF 0.6.0 beta 3 #

> ## New Features ##

> ### HTML/CSS/Images support ###

  * Limited support for CSS float (disabled by default). See [DOMPDF\_ENABLE\_CSS\_FLOAT](http://code.google.com/p/dompdf/source/browse/tags/dompdf_0-6-0_beta3/dompdf/dompdf_config.inc.php#301) ([r407](https://code.google.com/p/dompdf/source/detail?r=407), [r408](https://code.google.com/p/dompdf/source/detail?r=408), [r415](https://code.google.com/p/dompdf/source/detail?r=415), [r438](https://code.google.com/p/dompdf/source/detail?r=438), [r457](https://code.google.com/p/dompdf/source/detail?r=457), [r459](https://code.google.com/p/dompdf/source/detail?r=459), [r471](https://code.google.com/p/dompdf/source/detail?r=471))
  * Support for nth-child selectors ([r407](https://code.google.com/p/dompdf/source/detail?r=407), [r419](https://code.google.com/p/dompdf/source/detail?r=419))
  * Support for @font-face ([r407](https://code.google.com/p/dompdf/source/detail?r=407), [r413](https://code.google.com/p/dompdf/source/detail?r=413))
  * Font sub-setting now available (disabled by default). See [DOMPDF\_ENABLE\_FONTSUBSETTING](http://code.google.com/p/dompdf/source/browse/tags/dompdf_0-6-0_beta3/dompdf/dompdf_config.inc.php#134) ([r466](https://code.google.com/p/dompdf/source/detail?r=466), [r468](https://code.google.com/p/dompdf/source/detail?r=468), [r469](https://code.google.com/p/dompdf/source/detail?r=469))
  * Added an HTML5 Parser to enable improved document parsing/correction (disabled by default). See [DOMPDF\_ENABLE\_HTML5PARSER](http://code.google.com/p/dompdf/source/browse/tags/dompdf_0-6-0_beta3/dompdf/dompdf_config.inc.php#316) ([r429](https://code.google.com/p/dompdf/source/detail?r=429), [r430](https://code.google.com/p/dompdf/source/detail?r=430), [r431](https://code.google.com/p/dompdf/source/detail?r=431), [r441](https://code.google.com/p/dompdf/source/detail?r=441))
  * Added support for ID in anchors tags ([r373](https://code.google.com/p/dompdf/source/detail?r=373))
  * Added a message for broken images and updated the broken\_image.png file to something less aggressive ([r377](https://code.google.com/p/dompdf/source/detail?r=377))
  * Added support for transparent PNG in background-image and improved background-image handling ([r380](https://code.google.com/p/dompdf/source/detail?r=380), [r404](https://code.google.com/p/dompdf/source/detail?r=404), [r450](https://code.google.com/p/dompdf/source/detail?r=450), [r453](https://code.google.com/p/dompdf/source/detail?r=453))
  * Improved absolute positioning ([r387](https://code.google.com/p/dompdf/source/detail?r=387), [r409](https://code.google.com/p/dompdf/source/detail?r=409), [r459](https://code.google.com/p/dompdf/source/detail?r=459), [r460](https://code.google.com/p/dompdf/source/detail?r=460))
  * Added support for the "rem" CSS unit ([r389](https://code.google.com/p/dompdf/source/detail?r=389))
  * Improved support for the "ex" CSS unit ([r390](https://code.google.com/p/dompdf/source/detail?r=390))
  * When parsing tables, TR elements not contained by TBODY, TFOOT, or THEAD are automatically encapsulated by TBODY ([r390](https://code.google.com/p/dompdf/source/detail?r=390))
  * Added support for the CSS declaration word-wrap: break-word ([r391](https://code.google.com/p/dompdf/source/detail?r=391))
  * Added support for @page :left, :right, :first, :odd, and :even ([r393](https://code.google.com/p/dompdf/source/detail?r=393))
  * Added support for CSS visibility and empty-cells properties ([r393](https://code.google.com/p/dompdf/source/detail?r=393))
  * Type selectors (e.g. h1) are now case insensitive ([r417](https://code.google.com/p/dompdf/source/detail?r=417))
  * Image type detection is now based on file header instead of filename extension ([r422](https://code.google.com/p/dompdf/source/detail?r=422))
  * Added support for HTML5-style charset metatag (`<meta charset=”utf-8”>`) ([r430](https://code.google.com/p/dompdf/source/detail?r=430))
  * Added support for nested CSS counters ([r438](https://code.google.com/p/dompdf/source/detail?r=438))
  * Replaced TTF2UFM with php-font-lib and remove all dependencies on TTF2UFM ([r447](https://code.google.com/p/dompdf/source/detail?r=447))
  * Table columns widths are now consistent across pages ([r462](https://code.google.com/p/dompdf/source/detail?r=462))
  * Added limited support for table captions ([r456](https://code.google.com/p/dompdf/source/detail?r=456))
  * Reduced rendering time by using caches ([r469](https://code.google.com/p/dompdf/source/detail?r=469))

> ### Installation / configuration / debugging ###

  * Added frame (i.e. discreet document element) count to the sample website debugger output ([r399](https://code.google.com/p/dompdf/source/detail?r=399))
  * DOMPDF\_ENABLE\_REMOTE is no longer needed for stylesheet references that use a URL with domain component ([r407](https://code.google.com/p/dompdf/source/detail?r=407))
  * Added a ready-to-use web-based font installer to the sample website (www/fonts.php) ([r417](https://code.google.com/p/dompdf/source/detail?r=417), [r418](https://code.google.com/p/dompdf/source/detail?r=418))
  * Added the Unicode-compatible [DejaVu Fonts](http://dejavu-fonts.org) as part of the base installation ([r388](https://code.google.com/p/dompdf/source/detail?r=388))

> ### Major bug fixes ###

  * Fixes compatibility with the Symfony framework autoloader (disabled by default). See [DOMPDF\_AUTOLOAD\_PREPEND](http://code.google.com/p/dompdf/source/browse/tags/dompdf_0-6-0_beta3/dompdf/dompdf_config.inc.php#310) ([r374](https://code.google.com/p/dompdf/source/detail?r=374))
  * Fixes errors in how margins were collapsed between siblings ([r375](https://code.google.com/p/dompdf/source/detail?r=375))
  * Improves the way lines are aligned vertically (see the css\_baseline example) ([r375](https://code.google.com/p/dompdf/source/detail?r=375))
  * Corrects the bounding box used for drawing backgrounds ([r377](https://code.google.com/p/dompdf/source/detail?r=377))
  * Fixes the z-index rendering process ([r377](https://code.google.com/p/dompdf/source/detail?r=377), [r378](https://code.google.com/p/dompdf/source/detail?r=378), [r379](https://code.google.com/p/dompdf/source/detail?r=379), [r393](https://code.google.com/p/dompdf/source/detail?r=393))
  * Adds support for color styling inheritance ([r390](https://code.google.com/p/dompdf/source/detail?r=390))
  * Fixes bugs with nested tables and HTML attributes ([r393](https://code.google.com/p/dompdf/source/detail?r=393))
  * Fixes handling of URLs with non-ascii chars in the CPDF adapter ([r394](https://code.google.com/p/dompdf/source/detail?r=394))
  * Fixes a rgb()-style color parsing bug ([r402](https://code.google.com/p/dompdf/source/detail?r=402))
  * Fixes RLE4 compressed bitmap image support ([r405](https://code.google.com/p/dompdf/source/detail?r=405))
  * Fixes bug that caused generated content to occasionally display multiple times ([r406](https://code.google.com/p/dompdf/source/detail?r=406))
  * Improves background image clipping ([r417](https://code.google.com/p/dompdf/source/detail?r=417))
  * Fixes table layout bug caused by zero-height rows ([r464](https://code.google.com/p/dompdf/source/detail?r=464))
  * Fixes layout bug caused by 100% width tables centered with margin auto ([r465](https://code.google.com/p/dompdf/source/detail?r=465))

For a full list of modifications since DOMPDF 0.6.0 beta 2 see the changes listed on this page of the [repository changelog](http://code.google.com/p/dompdf/source/list?num=88&start=472&path=/trunk).

> ### Known Issues ###

  * Table cells cannot be split over multiple pages
  * CSS float support is not yet perfected

For a full list of known issues, see the [issue tracker](http://code.google.com/p/dompdf/issues/list).

> ### Installation Notes ###

  * Starting with DOMPDF 0.6.0 the dompdf.php script will no longer allow conversion of HTML document on the local file system that are located outside of the path specified by [DOMPDF\_CHROOT](http://code.google.com/p/dompdf/source/browse/tags/dompdf_0-6-0_beta3/dompdf/dompdf_config.inc.php#109)
  * If you are installing DOMPDF on top of an existing installation you should remove any existing font metrics. This can be done manually or through the sample website (www/fonts.php).
  * When upgrading to a new version of DOMPDF you must replace dompdf\_config.inc.php with the new one. To simplify the upgrade process you can store your configuration settings in dompdf\_config.custom.inc.php (which does not need to be overwritten).

> ### DOMPDF 0.6 Roadmap ###

  * Improve Unicode support
  * Improve page breaks inside or outside tables
  * Improve support for CSS float
  * Reduce memory usage


---


> # DOMPDF 0.6.0 beta 2 #

> ## New Features ##

> ### HTML/CSS/Images support ###

  * CSS3: opacity, 2D transforms
  * CSS2: outline, letter-spacing, z-index, position: relative, overflow: hidden
  * CSS Pseudo elements :before and :after with generated content
  * CSS2 pseudo-selectors (last-child, disabled, checked, enabled)
  * CSS3 attribute selectors (ends-width, starts-width, contains)
  * Improves absolute positioning
  * Adds fixed positioning
  * CMYK colors and CMYK Jpeg images
  * 32bit PNG with alpha channel (Cpdf backend)
  * BMP images (8, 24 and 32 bit)
  * Adds support for image embedding via “data” URI
  * Adds support for ordered list
  * Adds support for embedding PDF JavaScript
  * Uses the HTML document title element and certain meta tags to populate the PDF’s meta information (title, author, keywords and subject)
  * Uses the “alt” attribute of an image when the image is inaccessible
  * Supports loading system fonts

> ### Installation / configuration ###

  * The demo page now shows the HTML file and the PDF document in an iframe
  * Adds a setup/configuration tool that provides information about the server configuration, dompdf parameters, and installed fonts.
  * The font metrics cache files can now be cleared using the setup/config tool
  * Adds a debug tool that shows side-by-side the HTML file, the rendered PDF, and a console showing memory consumption, rendering time, warning, and debug messages
  * Adds examples showing new features
  * Moves ttf2ufm out of the DOMPDF code repository and into an [external project](http://code.google.com/p/ttf2ufm/)
  * Disables inline PHP support by default
  * Disables direct input in the examples page for non-localhost access
  * Adds configuration option to help debugging (see DEBUG\_LAYOUT) which draws rectangles around the different types of blocks and frames

> ## Major bug fixes ##

  * Addresses memory leaks from running eval() on the font metrics cache
  * Reduces memory consumption caused by the font metrics (when using the Cpdf backend)
  * Updates text wrapping to prevent splitting text into more lines than needed ([issue 198](http://code.google.com/p/dompdf/issues/detail?id=198))
  * Implements a check against an infinite loop caused by table cells larger than a page
  * Improves text height and width calculations as well as placement (improves, for example, justified text rendering for text that is not iso-8859-1)
  * Updates the fallback MBString functions
  * Supports PHP 5.3 and includes improved compatibility with older versions of PHP 5
  * Improves image placement
  * Addresses problems with table flow caused by empty table cells
  * Addresses warning/errors caused by unrecognized CSS rules or selectors


For a full list of modifications since DOMPDF 0.6.0 beta 1 see the [repository changelog](http://code.google.com/p/dompdf/source/list?path=/tags/dompdf_0-6-0_beta2&num=104)

> ## Known Issues ##

  * Table cells cannot be split over multiple pages
  * Column widths of tables that span more than one page may not be consistent across pages

> ## Installation Notes ##

  * Starting with dompdf 0.6.0 dompdf.php will no longer allow conversion of HTML document on the local file system that are located outside of the path specified by DOMPDF\_CHROOT
  * The format of the font metrics cache has changed as of this release. You should manually remove any existing font metrics prior to upgrading or use the setup/configuration tool to do so immediately after.
  * Inline PHP is **disabled** by default now (see DOMPDF\_ENABLE\_PHP)
  * Because additional configuration options have been added you will need to replace your dompdf\_config.inc.php file with the new one. You may modify this file or copy your configuration settings to dompdf\_config.custom.inc.php.