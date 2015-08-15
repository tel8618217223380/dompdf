  * [Usage](#Usage.md)
    * [Using the dompdf class directly](#Using_the_dompdf_class_directly.md)
    * [dompdf class reference](#Method_summary.md)
    * [Invoking dompdf via the web](#Invoking_dompdf_via_the_web.md)
    * [Invoking dompdf via the command line](#Invoking_dompdf_via_the_command_line.md)
  * [Inline PHP support](#Inline_PHP_support.md)

# Usage #

## Using the dompdf class directly ##

Using the dompdf class directly is fairly straightforward:

```
<?php
require_once("dompdf_config.inc.php");

$html =
  '<html><body>'.
  '<p>Put your html here, or generate it with your favourite '.
  'templating system.</p>'.
  '</body></html>';

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("sample.pdf");

?>
```

Below is a summary of the methods available in the dompdf class.

## Method summary ##

The methods available in the instances of the DOMPDF class are :

### load\_html ###
> Loads an HTML string. Parse errors are stored in the global array `$_dompdf_warnings`.

> Arguments:
    * `string $str`: HTML text to load
    * `string[optional] $encoding`: encoding, if not provided, dompdf will try to find it.

### load\_html\_file ###
> Loads an HTML file. Parse errors are stored in the global array `$_dompdf_warnings`.

> Arguments:
    * `string $file`: a filename or url to load

### output ###
> Returns the PDF as a string. The file will open a download dialog by default. The options parameter controls the output.

> Arguments:
    * `array $options`: accepted options are:
      * _compress_ => 1 or 0 - apply content stream compression, this is on (1) by default

### render ###
> Renders the HTML to PDF.

> Arguments: _none_.

### set\_base\_path ###
> Sets the base path, used for external stylesheets and images.

> Arguments:
    * `string $path`: The base path to be used when resolving external resources URLs.

### set\_paper ###
> Sets the paper size & orientation

> Arguments:
    * `string|array $size`: 'letter', 'legal', 'A4', etc. See [CPDF\_Adapter::$PAPER\_SIZES](http://www.google.com/codesearch/p?hl=en#KbP50B5TJDs/trunk/dompdf/include/cpdf_adapter.cls.php&q=CPDF_Adapter&d=3&l=82)
    * `string $orientation`: 'portrait' or 'landscape'

### stream ###
> Streams the PDF to the client. The file will open a download dialog by default. The options parameter controls the output.

> Arguments:
    * `string $filename`: the name of the streamed file
    * `array $options`: accepted options are:
      * 'compress' = > 1 or 0 - apply content stream compression, this is on (1) by default
      * 'Attachment' => 1 or 0 - if 1, force the browser to open a download dialog, on (1) by default


## Invoking dompdf via the web ##

The dompdf.php script is not intended to be an interactive page. It receives
input parameters via `$_GET` and can stream a PDF directly to the browser. This
makes it possible to embed links to the script in a page that look like static
PDF links, but are actually dynamically generated. This method is also useful
as a redirection target.

dompdf.php accepts the following `$_GET` variables:


---


| `input_file`  | required | a rawurlencoded() path to the HTML file to process. Remote files (http/ftp) are supported if fopen wrappers are enabled. |
|:--------------|:---------|:-------------------------------------------------------------------------------------------------------------------------|
| `paper`       | optional | the paper size. Defaults to 'letter' (unless the default has been changed in dompdf\_config.inc.php). See include/pdf\_adapter.cls.php, or invoke dompdf.php on the command line with the -l switch for accepted paper sizes. |
| `orientation` | optional | 'portrait' or 'landscape'. Defaults to 'portrait'.                                                                       |
| `base_path`   | optional | the base path to use when resolving relative links (images or CSS files). Defaults to the directory containing the file being accessed. (This option is useful for pointing dompdf at your CSS files even though the HTML file may be elsewhere.) |
| `output_file` | optional | the rawurlencoded() name of the output file. Defaults to 'dompdf\_out.pdf'. <font color='red'>Deprecated in 0.6, forced to "dompdf_out.pdf"</font> |
| `save_file`   | optional | If present (i.e. `isset($_GET["save_file"])`), output\_file is saved locally, Otherwise the file is streamed directly to the client. <font color='red'>Deprecated in 0.6, forced to <code>false</code></font> |


---


One technique for generating dynamic PDFs is to generate dynamic HTML as you normally would, except instead of displaying the output to the browser, you use output buffering and write the output to a temporary file. Once this file is saved, you redirect to the dompdf.php script.

If you use a templating engine like [Smarty](http://www.smarty.net/), you can simply do:

```
<?php
$tmpfile = tempnam("/tmp", "dompdf_");
file_put_contents($tmpfile, $smarty->fetch()); // Replace $smarty->fetch()
                                               // with your HTML string

$url = "dompdf.php?input_file=" . rawurlencode($tmpfile) . 
       "&paper=letter&output_file=" . rawurlencode("My Fancy PDF.pdf");

header("Location: http://" . $_SERVER["HTTP_HOST"] . "/$url");
?>
```

If you use any stylesheets, you may need to provide the base\_path option to tell dompdf where to look for them, as they are not likely relative to `/tmp` ;).

## Invoking dompdf via the command line ##

You can execute dompdf.php using the following command:

> `$ php -f dompdf.php -- [options]`

(If you find yourself using only the cli interface, you can add `#!/usr/bin/php` as the first line of dompdf.php to invoke dompdf.php directly.)

dompdf.php is invoked as follows:

> `$ ./dompdf.php [options] html_file`

`html_file` can be a filename, a url if fopen\_wrappers are enabled, or the '-' character to read from standard input.

| `-h`      | Show a brief help message |
|:----------|:--------------------------|
| `-l`      | list available paper sizes |
| `-p size` | paper size; something like 'letter', 'A4', 'legal', etc. Thee default is 'letter' |
| `-o orientation` | either 'portrait' or 'landscape'. Default is 'portrait'. |
| `-b path` | the base path to use when resolving relative links (images or CSS files). Default is the directory of html\_file. |
| `-f file` | the output filename. Default is the input `[html_file].pdf`. |
| `-v`      | verbose: display html parsing warnings and file not found errors. |
| `-d`      | very verbose: display oodles of debugging output; every frame in the tree is printed to stdout. |


---


Examples:

```
$ php -f dompdf.php -- my_resume.html
$ ./dompdf.php -b /var/www/ ./web_stuff/index.html
$ echo '<html><body>Hello world!</body></html>' | ./dompdf.php -
```

# Inline PHP support #

dompdf supports two varieties of inline PHP code. All PHP evaluation is controlled by the `DOMPDF_ENABLE_PHP` configuration option. If it is set to `false`, then no PHP code is executed. Otherwise, PHP is evaluated in two passes:

The first pass is useful for inserting dynamic data into your PDF. You can do this by embedding `<?php ?>` tags in your HTML file, as you would in a normal .php file. This code is evaluated prior to parsing the HTML, so you can echo any text or markup and it will appear in the rendered PDF.

The second pass is useful for performing drawing operations on the underlying PDF class directly. You can do this by embedding PHP code within `<script type="text/php"> </script>` tags. This code is evaluated during the rendering phase and you have access to a few internal objects and operations. In particular, the `$pdf` variable is the current instance of `Canvas`. Using this object, you can write and draw directly on the current page. Using the `Canvas::open_object()`, `Canvas::close_object()` and `Canvas::add_object()` methods, you can create text and drawing objects that appear on every page of your PDF (useful for headers & footers).

The following variables are defined for you during the second pass of PHP execution:

| `$pdf`        | the current instance of `Canvas` |
|:--------------|:---------------------------------|
| `$PAGE_NUM`   | the current page number          |
| `$PAGE_COUNT` | the total number of pages in the document |

For more complete documentation of the Canvas API, see the API documentation.