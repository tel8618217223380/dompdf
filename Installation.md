# Requirements #

  * PHP 5.0+ with the DOM extension enabled. Note that the domxml PECL extension conflicts with the DOM extension and must be disabled.
  * Some fonts. PDFs internally support Helvetica, Times-Roman, Courier & Zapf-Dingbats, but if you wish to use other fonts or Unicode charsets you will need to install some fonts. dompdf supports the same fonts as the underlying PDF backends: Type 1 (.pfb with the corresponding .afm) and TrueType (.ttf). At the minimum, you should probably have the Microsoft core fonts (now available at: http://corefonts.sourceforge.net/). See below for font installation instructions.
  * ttf2pt1 (available at http://ttf2pt1.sourceforge.net) is required to install new ttf fonts when using the CPDF backend.

# Installation #

  1. Untar/unzip the source package in a directory accessible by your webserver.
  1. Edit `dompdf_config.custom.inc.php` (in version 0.6) or `dompdf_config.custom.inc.php` (version 0.5) to fit your installation. If you leave the DOMPDF\_PDF\_BACKEND setting at 'auto' dompdf will use the bundled R&OS CPDF class.
  1. Give your webserver write permission on the path specified in DOMPDF\_FONT\_DIR (lib/fonts by default). Under `*nix`, ideally you can make the webserver group the owner of this directory and give the directory group write permissions. For example, on Debian systems, Apache runs as the www-data user:

> `$ chgrp www-data lib/fonts`<br>
<blockquote><code>$ chmod g+w lib/fonts</code></blockquote>

If your user is not a member of the www-data group or you do not have root privileges, you can make the directory world writable and set the sticky bit:<br>
<br>
<blockquote><code> $ chmod 1777 lib/fonts </code></blockquote>

<h1>Configuration tool</h1>

Since 0.6 beta 2, dompdf has a configuration/helper page available at <code>www/setup.php</code>. This page will tell you if an extension is missing, and will check if the temp path is writable. It will also tell you what fonts are installed for the CPDF backend (the one used by default).<br>
<br>
<h1>Font Installation</h1>

<h2>Note for all platforms</h2>

PDFs include support by default for Helvetica, Times-Roman, Courier and Zapf-Dingbats. You do not need to install any font files if you wish to use these fonts. This has the advantage of reducing the size of the resulting PDF, because additional fonts must be embedded in the PDF.<br>
<br>
Also, if you have problems installing the font files, you can try and use the distributed dompdf_font_family_cache.dist file in lib/fonts. Copy this file to lib/fonts/dompdf_font_family_cache and edit it directly to match the files present in your lib/fonts directory.<br>
<br>
<h2>Linux/Unix</h2>

The load_font.php utility installs and converts TrueType fonts for use with dompdf. Since CSS uses the concept of font families (i.e. the same face can be rendered in different styles & weights) dompdf needs to know which actual font files belong to which font family and which style. For example, the Microsoft core font pack includes the files !Verdana.ttf, Verdana_Italic.ttf, Verdana_Bold.ttf and Verdana_Bold_Italic.ttf. All four of these files need to be present in the dompdf font directory (DOMPDF_FONT_DIR), and entries need to be made in the dompdf_font_family_cache file.<br>
<br>
Given the font family name and the path to the 'normal' font face file (Verdana.ttf, in our example), load_font.php will search for the bold, italic and bold italic font face files in the same directory as the specified file. It searches for files with the same base name followed by '<i>Bold', 'B', or 'b' (similarly for italic and bold italic). If it can not find the correct files, you can specify them on the command line.</i>

In addition to copying the files to the dompdf font directory, it also generates .afm files. The R&OS CPDF class requires both the ttf file and an afm file, which describes glyph metrics. The afm file is generated using the ttf2pt1 utlity (available at <a href='http://ttf2pt1.sourceforge.net'>http://ttf2pt1.sourceforge.net</a>). If you are using the PDFLib backend, you will not need to create afm files for the fonts.<br>
<br>
load_font.php usage:<br>
<br>
<pre><code>$ ./load_font.php font-family n_file [b_file] [i_file] [bi_file]<br>
</code></pre>

<b>font_family</b> - the name of the font, e.g. Verdana, 'Times New Roman', monospace, sans-serif.<br>
<b>n_file</b> - the .pfb or .ttf file for the normal, non-bold, non-italic face of the font.<br>
<i>{b|i|bi}<b>file</b> - the files for each of the respective (bold, italic, bold-italic) faces.</i><br>



Examples:<br>
<pre><code>$ ./load_font.php silkscreen /usr/share/fonts/truetype/slkscr.ttf<br>
<br>
$ ./load_font.php 'Times New Roman' /mnt/c_drive/WINDOWS/Fonts/times.ttf<br>
<br>
$ php -f load_font.php -- sans-serif /home/dude_mcbacon/myfonts/Verdana.ttf \<br>
                                     /home/dude_mcbacon/myfonts/V_Bold.ttf<br>
</code></pre>

<h2>Windows</h2>

(Note I don't have a windows test box at the moment, so these instructions may not work... If someone has tried this and has any suggestions for me, please send me an email!)<br>
<br>
Read the Linux/Unix section above first, as most of it applies. The main difference is the ttf2pt1 utility. Fortunately, there is a windows version, available at <a href='http://gnuwin32.sourceforge.net/packages/ttf2pt1.htm'>http://gnuwin32.sourceforge.net/packages/ttf2pt1.htm</a>. You will have to edit your dompdf_config.inc.php file to point to the path where you installed ttf2pt1.<br>
<br>
You will also need the cli version of PHP in order to execute load_font.php, however it's usage is the same (see the last example above).