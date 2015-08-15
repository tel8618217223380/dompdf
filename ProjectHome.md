
---

> # DOMPDF moved to Github: https://github.com/dompdf/dompdf #

---


**dompdf is an HTML to PDF converter**. At its heart, dompdf is (mostly) [CSS 2.1](http://www.w3.org/TR/CSS2/) compliant HTML layout and rendering engine written in [PHP](http://www.php.net/). It is a style-driven renderer: it will download and read external stylesheets, inline style tags, and the style attributes of individual HTML elements. It also supports most presentational [HTML attributes](http://www.w3.org/TR/html4/index/attributes.html).

PDF rendering is currently provided either by [PDFLib](http://www.pdflib.com) or by a bundled version the [R&OS CPDF class](http://www.ros.co.nz/pdf) written by Wayne Munro. (Some important changes have been made to the R&OS class, however). In order to use PDFLib with dompdf, the [PDFLib PECL extension](http://pecl.php.net/package/pdflib) is required. Using PDFLib improves performance and reduces the memory requirements of dompdf somewhat, while the R&OS CPDF class, though slightly slower, eliminates any dependencies on external PDF libraries.

<table>
<tr>
<td valign='center'>
<a href='http://www.twitter.com/dompdf'><img src='http://twitter-badges.s3.amazonaws.com/twitter-a.png' alt='Follow dompdf on Twitter' /></a>
</td>
<td>
<a href='https://plus.google.com/108710008521858993320?prsrc=3'><img src='https://ssl.gstatic.com/images/icons/gplus-32.png' width='32' height='32' /></a>
</td>
</tr>
</table>


---


> ## 09/02/2012 - [DOMPDF 0.6.0 beta 3 is out!](http://code.google.com/p/dompdf/wiki/ReleaseNotes#DOMPDF_0.6.0_beta_3) ##


---


> ## Features ##

  * handles most [CSS 2.1](http://code.google.com/p/dompdf/wiki/CSSCompatibility) and a few [CSS3 properties](http://www.w3.org/Style/CSS/current-work), including [@import](http://www.w3.org/TR/CSS2/cascade.html#at-import), [@media](http://www.w3.org/TR/CSS2/media.html) & [@page](http://www.w3.org/TR/css3-page/) rules
  * supports most presentational HTML 4.0 attributes
  * supports external stylesheets, either local or through http/ftp (via fopen-wrappers)
  * supports complex tables, including row & column spans, separate & collapsed border models, individual cell styling
  * image support (gif, png (8, 24 and 32 bit with alpha channel), bmp & jpeg)
  * no dependencies on external PDF libraries, thanks to the R&OS PDF class
  * inline PHP support


> ## Requirements ##

  * PHP 5.0+ (5.3 recommended)
  * [MBString extension](http://www.php.net/manual/book.mbstring.php)
  * [DOM extension](http://www.php.net/manual/book.dom.php) (bundled with PHP 5)
  * Some fonts.  PDFs internally support Helvetica, Times-Roman, Courier & Zapf-Dingbats, but if you wish to use other fonts you will need to install some fonts.  dompdf supports the same fonts as the underlying R&OS PDF class: Type 1 (.pfb with the corresponding .afm) and TrueType (.ttf). At the minimum, you should probably have the [Microsoft core fonts](http://corefonts.sourceforge.net/).  See the [font installation instructions](http://code.google.com/p/dompdf/wiki/Installation#Font_Installation).


> ## Limitations (Known Issues) ##

  * not particularly tolerant to poorly-formed HTML input (using Tidy first may help).
  * large files or large tables can take a while to render
  * CSS float is not supported (but is [in the works](http://code.google.com/p/dompdf/issues/detail?id=19)).


<table border='0'><tr><td><b>If you find this project useful, please consider making a donation.</b><br />(Any funds donated will be used to help further development on this project.)</td><td><a href='http://goo.gl/DSvWf'><img src='https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif' /></a></td></tr></table>

&lt;wiki:gadget url="http://www.ohloh.net/p/dompdf/widgets/project\_basic\_stats.xml" width="350" height="220" border="0" /&gt;