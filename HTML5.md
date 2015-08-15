# Introduction #

Since [r431](https://code.google.com/p/dompdf/source/detail?r=431), dompdf has an experimental HTML5 parser (and it got better in [r441](https://code.google.com/p/dompdf/source/detail?r=441)) : [html5lib](http://code.google.com/p/html5lib/). It can be activated with the SVN trunk be setting `DOMPDF_ENABLE_HTML5PARSER` to `true`.


# What is an HTML5 parser? #

An HTML parser is a library or software able to read an HTML source code and translate it into a [DOM tree](http://www.w3.org/TR/DOM-Level-2-Core/introduction.html).

The difference between a regular HTML parser and an HTML5 parser is that the latter knows how to deal with badly structured HTML code as all the cases are strictly defined in [W3C specifications](http://www.w3.org/TR/html5/parsing.html).

# What does it mean for dompdf? #

Having an HTML5 parser, dompdf will be able to handle more poorly written HTML documents.

For example, it happens that a `table` element has rows without closing `tr` elements.
A regular HTML parser (the one embedded with the PHP DOM extension: libxml) won't be able to handle it well and may, for example, ignore this line or append the next cells to the current line.
An HTML5 parser will handle it like if the `</tr>` tag is present.