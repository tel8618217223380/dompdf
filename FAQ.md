<font color='green'>Q:</font> Is there a 'hello world' script for dompdf?<br>
<font color='blue'>A:</font><b>Put this script in the same directory as dompdf_config.inc.php. You'll have to change the paths in dompdf_config.inc.php to match your installation:<br>
<pre><code>&lt;?php<br>
require_once("dompdf_config.inc.php");<br>
$html =<br>
    '&lt;html&gt;&lt;body&gt;'.<br>
    '&lt;p&gt;Hello World!&lt;/p&gt;'.<br>
    '&lt;/body&gt;&lt;/html&gt;';<br>
<br>
$dompdf = new DOMPDF();<br>
$dompdf-&gt;load_html($html);<br>
<br>
$dompdf-&gt;render();<br>
$dompdf-&gt;stream("hello_world.pdf");<br>
<br>
?&gt;<br>
<br>
</code></pre></b>

<font color='green'>Q:</font> How do I save a PDF to disk?<br>
<font color='blue'>A:</font><b>If you are using the included dompdf.php script you can pass it the "save_file" option in conjunction with the "output_file" option.</b>

If you are using the DOMPDF class, you can save the generated PDF by calling:<br>
<br>
<pre><code>$dompdf-&gt;output():<br>
<br>
require_once("dompdf_config.inc.php");<br>
$html =<br>
    '&lt;html&gt;&lt;body&gt;'.<br>
    '&lt;p&gt;Foo&lt;/p&gt;'.<br>
    '&lt;/body&gt;&lt;/html&gt;';<br>
<br>
$dompdf = new DOMPDF();<br>
$dompdf-&gt;load_html($html);<br>
<br>
$dompdf-&gt;render();<br>
<br>
// The next call will store the entire PDF as a string in $pdf<br>
<br>
$pdf = $dompdf-&gt;output();<br>
<br>
// You can now write $pdf to disk, store it in a database or stream it<br>
// to the client.<br>
<br>
file_put_contents("saved_pdf.pdf", $pdf);<br>
</code></pre>

Note that typically <code>dompdf-&gt;stream()</code> and <code>dompdf-&gt;output()</code> are mutually exclusive.<br>
<br><br>

<font color='green'>Q:</font> I have a big table and it's broken!<br>
<font color='blue'>A:</font><b>This is fixed in versions 0.4 and higher. Previous versions did not support tables that spanned pages.<br></b><br><br>

<font color='green'>Q:</font> Is there a way to add headers and footers or page numbers?<br>
<font color='blue'>A:</font><b>Yes, you can add headers and footers using inline PHP. Headers and footers are added by accessing the PDF renderer directly using inline PHP embedded in your HTML file. This is similar to creating PDFs with FPDF or ezPDF from R&OS, in that you can draw lines, boxes and text directly on the PDF. Here are step by step instructions:</b>

<blockquote>Somewhere in your html file, near the top, open a script tag with a "text/php" type:</blockquote>

<blockquote><code>&lt;script type="text/php"&gt;</code></blockquote>

<blockquote>Check if the $pdf variable is set. dompdf sets this variable when evaluating embedded PHP.</blockquote>

<pre><code>        &lt;script type="text/php"&gt;<br>
<br>
        if ( isset($pdf) ) {<br>
</code></pre>

<blockquote>Pick a font:</blockquote>

<pre><code>        &lt;script type="text/php"&gt;<br>
<br>
        if ( isset($pdf) ) {<br>
<br>
          $font = Font_Metrics::get_font("helvetica", "bold");<br>
</code></pre>

<blockquote>Use the CPDF_Adapter::page_text() method to set text that will be displayed on every page:</blockquote>

<pre><code>        &lt;script type="text/php"&gt;<br>
<br>
        if ( isset($pdf) ) {<br>
<br>
          $font = Font_Metrics::get_font("helvetica", "bold");<br>
          $pdf-&gt;page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));<br>
<br>
        }<br>
        &lt;/script&gt;<br>
</code></pre>

<blockquote>In this example, the text will be displayed 72pt (1 in) from the left edge of the page and 18pt (1/4 in) from the top of the page, in 6pt font. {PAGE_NUM} and {PAGE_COUNT} are automatically replaced by dompdf to the appropriate values on each page. The last argument to page_text() is the colour which takes an array of the form array(r,g,b) where each of r, g, and b are between 0.0 and 1.0.</blockquote>

<blockquote>There are several other methods available. See the API documentation for the CPDF_Adapter class (<a href='http://eclecticgeek.com/dompdf/docs/api/'>http://eclecticgeek.com/dompdf/docs/api/</a>) for more details. Also have a look at the demo_01.html file in the www/test/ directory. It adds a header and footer using PDF_Adapter->page_text(). It also adds text superimposed over the rendered text using a PDF 'object'. This object is added using CPDF_Adapter->add_object(). See <a href='Usage.md'>Usage</a> for more info on inline PHP.</blockquote>


<font color='green'>Q:</font> How can I add an image to a header or footer on every page?<br>
<font color='blue'>A:</font><b>You can add images and shapes (line, rectangles, etc.) to every page using PDF 'objects'. A PDF object captures all rendering commands as a sort of template that can then be added to multiple pages:</b>

<pre><code>&lt;script type="text/php"&gt;<br>
<br>
if ( isset($pdf) ) {<br>
<br>
  // Open the object: all drawing commands will<br>
  // go to the object instead of the current page<br>
  $footer = $pdf-&gt;open_object();<br>
<br>
  $w = $pdf-&gt;get_width();<br>
  $h = $pdf-&gt;get_height();<br>
<br>
  // Draw a line along the bottom<br>
  $y = $h - 2 * $text_height - 24;<br>
  $pdf-&gt;line(16, $y, $w - 16, $y, $color, 1);<br>
<br>
  // Add an initals box<br>
  $font = Font_Metrics::get_font("helvetica", "bold");<br>
  $text = "Initials:";<br>
  $width = Font_Metrics::get_text_width($text, $font, $size);<br>
  $pdf-&gt;text($w - 16 - $width - 38, $y, $text, $font, $size, $color);<br>
  $pdf-&gt;rectangle($w - 16 - 36, $y - 2, 36, $text_height + 4, array(0.5,0.5,0.5), 0.5);<br>
<br>
  // Add a logo<br>
  $img_w = 2 * 72; // 2 inches, in points<br>
  $img_h = 1 * 72; // 1 inch, in points -- change these as required<br>
  $pdf-&gt;image("print_logo.png", "png", ($w - $img_w) / 2.0, $y - $img_h, $img_w, $img_h);<br>
<br>
  // Close the object (stop capture)<br>
  $pdf-&gt;close_object();<br>
<br>
  // Add the object to every page. You can<br>
  // also specify "odd" or "even"<br>
  $pdf-&gt;add_object($footer, "all");<br>
}<br>
<br>
&lt;/script&gt;<br>
</code></pre>
<br><br>

<font color='green'>Q:</font> How do I insert page breaks?<br>
<font color='blue'>A:</font><b>Page breaks can be inserted by applying the CSS properties page-break-before and page-break-after to any block level element.</b><br><br>

<font color='green'>Q:</font> How can I make PDFs open in the browser window instead of opening the download dialog?<br>
<font color='blue'>A:</font><b>This is controlled by the "Attachment" header sent by dompdf when it streams the PDF to the client. You can modify the headers sent by dompdf by passing additional options to the <code>$dompdf-&gt;stream()</code> function:<br>
<pre><code>require_once("dompdf_config.inc.php");<br>
$html =<br>
    '&lt;html&gt;&lt;body&gt;'.<br>
    '&lt;p&gt;Some text&lt;/p&gt;'.<br>
    '&lt;/body&gt;&lt;/html&gt;';<br>
<br>
$dompdf = new DOMPDF();<br>
$dompdf-&gt;load_html($html);<br>
<br>
$dompdf-&gt;render();<br>
$dompdf-&gt;stream("my_pdf.pdf", array("Attachment" =&gt; 0));<br>
</code></pre></b><br><br>

<font color='green'>Q:</font> How do I centre a table, paragraph or div?<br>
<font color='blue'>A:</font><b>You can centre any block level element (table, p, div, ul, etc.) by using margins:</b>

<pre><code>&lt;table style="margin-left: auto; margin-right: auto"&gt;<br>
 &lt;tr&gt;<br>
  &lt;td&gt; ... &lt;/td&gt;<br>
 &lt;/tr&gt;<br>
&lt;/table&gt;<br>
</code></pre>
<br><br>
<font color='green'>Q:</font> How can I print the euro symbol?<br>
<font color='blue'>A:</font><b>You can print the euro symbol (€) using the following entity: <code>&amp;#0128;</code>.</b><br><br>

<font color='green'>Q:</font> I'm getting the following error: <br><font color='red'>Parse error: parse error, unexpected T_NEW in /var/www/dompdf/include/functions.inc.php on line 240 </font> <br>
<font color='blue'>A:</font><b>Any parse error generated by dompdf is caused by trying to run dompdf under PHP4. dompdf only works under PHP 5 and there are no plans for a PHP 4 port. If you can run dompdf on your home machine, but not on your web host, confirm which version of PHP is running on your web host via phpinfo().</b>

Some web hosts have both PHP 4 and PHP 5 installed. Check with your webhost how to enable PHP 5.<br>
<br><br>

<font color='green'>Q:</font> I'm getting the following error: <br>
<font color='red'>Cannot access undefined property for object with overloaded property access in /var/www/dompdf/include/frame_tree.cls.php on line 160</font><br>
<font color='blue'>A:</font><b>This error is caused by an incompatibility with the Zend Optimizer. Disable the optimizer when using dompdf.</b><br><br>

<font color='green'>Q:</font> I'm getting the following error: <br>
<font color='red'>Fatal error: DOMPDF_autoload() <code>[function.require]</code>: Failed opening required '/var/www/dompdf/include/domdocument.cls.php' (include_path='.:') in /var/www/dompdf/dompdf_config.inc.php on line 146</font><br>
<font color='blue'>A:</font><b>This error occurs when the version of PHP that you are using does not have the DOM extension enabled. You can check which extensions are enabled by examining the output of phpinfo().</b>

There are a couple of ways that the DOM extension could have been disabled. DOM uses libxml, so if libxml is not present on your server then the DOM extension will not work. Alternatively, if PHP was compiled with the '--disable-dom' switch or the '--disable-xml' switch, DOM support will also be removed. You can check which switches were used to compile PHP with phpinfo().<br>
<br>
<font color='green'>Q:</font> I'm getting the following error:<br>
<font color='red'>Fatal error: Maximum execution time of 30 seconds exceeded in /var/www/dompdf/dompdf.php on line XXX</font><br>
<font color='blue'>A: </font><b>Nested tables are not supported yet and can cause dompdf to enter an endless loop, thus giving rise to this error.</b>

<font color='green'>Q:</font> I'm getting the following error:<br>
<font color='red'>Fatal error: Uncaught exception 'DOMPDF_Exception' with message 'No block-level parent found. Not good.' in C:\Program Files\Apache\htdocs\dompdf\include\inline_positioner.cls.php:68</font><br>
<font color='blue'>A: </font><b>This should be fixed in versions 0.4.1 and up. The error was caused by parse_url() thinking that the 'c' in 'c:\' was a protocol. Version 0.4.1 works around this issue.</b><br>
<font color='blue'>A: </font><b>Another possible issue is caused by files not uploading correctly. Try reuploading the files.</b>

<font color='green'>Q:</font> I set the <code>DOMPDF_ENABLE_REMOTE</code> configuration constant to <code>true</code> and remote stylesheet and/or images still don't work, what am I missing?<br>
<font color='blue'>A: </font>