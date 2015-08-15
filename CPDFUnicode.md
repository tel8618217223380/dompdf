# A guide to enabling Unicode support in DOMPDF (when using the CPDF backend) #

_Note: This document was written with DOMPDF 0.6.0 beta 2 in mind. An update that takes into account new features in 0.6.0 beta 3 will be released in the future._

## What you need to do: ##

  * [Install DOMPDF 0.6.0 or greater](CPDFUnicode#Install_DOMPDF_0.6.0_or_greater.md)
  * [Enable the MBString PHP extension](CPDFUnicode#Enable_the_MBString_PHP_extension.md)
  * [Load a font supporting your characters into DOMPDF](CPDFUnicode#Load_a_font_supporting_your_characters_into_DOMPDF.md)
  * [Configure DOMPDF for Unicode support](CPDFUnicode#Configure_DOMPDF_for_Unicode_support.md)
  * [Create a compatible HTML document](CPDFUnicode#Create_a_compatible_HTML_document.md)

To ensure maximum compatibility you should follow all of the above steps. You can check some of the requirements from the Setup/Configuration page included with the sample site (found in the DOMPDF installation directory at dompdf/www/setup.php).

## Detailed Instructions: ##

### Install DOMPDF 0.6.0 or greater ###

Find the [latest release of DOMPDF](http://code.google.com/p/dompdf/downloads/list) on Google Code, or [download a nightly](http://eclecticgeek.com/dompdf) (code that has not been fully tested). You will need DOMPDF 0.6.0 (currently in beta) or greater because earlier releases do not support character encodings other than Windows ANSI.

### Enable the MBString PHP extension ###

This extension is necessary for dompdf to parse your text correctly. Without it characters may be corrupted, words split randomly, and lines wrapped in the wrong place. Installation instructions can be found in the [PHP documentation](http://www.php.net/manual/en/mbstring.installation.php).

### Load a font supporting your characters into DOMPDF ###

In order to display your text correctly the PDF needs access to a font that supports the characters used in the document. The next release of DOMPDF will include the [DejaVu fonts](http://dejavu-fonts.org/wiki/Main_Page), which support a wide range of characters (this font pack is now included in the nightly release). You can find some language-specific fonts at the following locations:

  * [Firefly](http://www.study-area.org/apt/firefly-font/) (Simplified and Traditional Chinese)

Please leave a comment if you know of any good-looking, free fonts not listed here and we will add them to the list. If you don’t see a font that supports your character set, [Google is your friend](http://www.google.com/search?q=unicode+fonts).

Now that you have a font you need to load it into DOMPDF. There are currently two methods available for loading a font:

  * use the load\_font.php script included with DOMPDF
  * use the web-based font prep tool

#### Use the load\_font.php script included with DOMPDF ####

load\_font.php relies on the ttf2ufm application to extract the information necessary to use a font. ttf2ufm is based on ttf2pt1 and produces both standard font metrics files and Unicode font metrics files. While ttf2pt1 is available on many systems, ttf2ufm is not. You will need to compile this application from the source code to ensure it runs correctly on your system.

load\_font.php is a command-line script (it can not be run through your web server) that takes as it’s parameters the name of a font followed by the location of the normal, bold, italic, and bold-italic font variant files. Run load\_font.php without any parameters to see the help text.

```
> php load_font.php

Usage: load_font.php font_family [n_file [b_file] [i_file] [bi_file]]

...
```

All you need to successfully install a font is a base variant. As an example, say we have the Chinese-character font Firefly located in the directory /home/dompdf/fonts. Go into your dompdf installation directory and enter the following command:

```
> php load_font.php Firefly /home/dompdf/fonts/firefly.ttf

Unable to find bold face file.
Unable to find italic face file.
Unable to find bold_italic face file.
Copying /home/dompdf/fonts/firefly.ttf to /home/dompdf/dompdf/lib/fonts/firefly.ttf...
Generating .afm for /home/dompdf/fonts/firefly.ttf...
…
Finished - font files created
```

#### Use the web-based font prep tool ####

This option is provided for users who are unable to set up the ttf2ufm application. This tool produces an archive containing the necessary font metrics file(s), the original font file(s), and a sample dompdf\_font\_family\_cache that you should be able to use with your DOMPDF installation. Simply provide a font name and the TTF file(s) (at a minimum you must provide a font file for the base variant); select the font parser (the PHP-based parser is recommended for larger fonts); and choose the version of DOMPDF you are using. After you submit the form the tool should return an archive containing the necessary files. Extract the contents of this archive into your DOMPDF font directory (typically dompdf/lib/fonts). If you have not previously installed other fonts you can rename dompdf\_font\_family\_cache.sample to dompdf\_font\_family\_cache. If you have already installed other fonts you will need to manually add the entries for your font to the dompdf\_font\_family\_cache.

Find the web-based font prep tool at http://eclecticgeek.com/dompdf/load_font.php.

### Configure DOMPDF for Unicode support ###

For DOMPDF to handle your characters correctly you must enable Unicode support in your configuration. Edit dompdf\_config.inc.php or dompdf\_config.custom.inc.php so that `DOMPDF_UNICODE_ENABLED` is `true`. Without enabling this setting your text will be re-encoded to Windows ANSI when inserted into the PDF and any characters that fall outside this encoding will be converted to question marks.

### Create a compatible HTML document ###

For DOMPDF to correctly parse your document you must let it know what encoding is used. To do this place a meta tag in the head of your document that specifies the encoding. We recommend encoding documents using UTF-8 for greatest compatibility. However, you should be able to use other encodings so long as the computer where DOMPDF is installed supports the specified encoding.

```
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
```

You should also ensure that your html editor is using the encoding you have specified. If, for example, you specify that your document is using UTF-8 but your editor is actually encoding your document in iso-8859-5, then there is a chance that the text of the document will be mangled. An exception to this rule is that entity-encoded characters should be accurately parsed regardless of the document encoding.

In an earlier example we loaded the Firefly font into our DOMPDF installation. Here is a sample document that uses that font:

```
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    <p style="font-family: firefly, verdana, sans-serif;">献给母亲的爱</p>
</body>
</html>
```

When you style a block of text to display using a specific font that font **must** support all the characters in that block. Any character not supported will typically show up as an unfilled square. DOMPDF does not attempt to find a replacement font for unsupported characters.