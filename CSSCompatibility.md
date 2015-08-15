# Selectors #

dompdf supports the following CSS 2.1 selector syntaxes. dompdf also supports elements with multiple class attributes (e.g. `<p class="red bold">foo</p>` matches p.red and p.bold).

Note that the CSS selectors are **case sensitive** in dompdf (e.g. `.foo` will not match `<div class="FOO">bar</div>`)

| **Selector** | **Supported** | **Notes** |
|:-------------|:--------------|:----------|
|`*`           | 	yes          |           |
|`E`           |	yes           |           |
|`E F`         |	yes           |           |
|`E > F`       |	yes           |           |
|`E.class`     |	yes           |           |
|`E#myid`      |	yes           |           |
|`E:first-child` |	partial       |           |
|`E:last-child` |	partial       | Since 0.6 beta 3 |
|`E:first-of-type` |	yes           | Since 0.6 beta 3 |
|`E:last-of-type` |	yes           | Since 0.6 beta 3 |
|`E:nth-last-of-type` |	yes           | Since 0.6 beta 3 |
|`E:nth-last-child` |	yes           | Since 0.6 beta 3 |
|`E:nth-of-type` |	yes           | Since 0.6 beta 3 |
|`E:nth-child` |	yes           | Since 0.6 beta 3 |
|`E:link`      |	yes           |           |
|`E:visited`   |	N/A           |           |
|`E:active`    | 	N/A          |           |
|`E:hover`     |	N/A           |           |
|`E:focus`     |	N/A           |           |
|`E:lang(c)`   |	no            |           |
|`E + F`       |	yes           |           |
|`E[foo]`      |	yes           |           |
|`E[foo="warning"]` |	yes           |           |
|`E[foo~="warning"]` |	yes           |           |
|`E[foo$="warning"]` |	yes           | Since 0.6 beta 2 |
|`E[foo^="warning"]` |	yes           | Since 0.6 beta 2 |
|`E[foo*="warning"]` |	yes           | Since 0.6 beta 2 |
|`E[lang|="en"]` |	yes           |           |

# Page selectors #
|`@page` |	yes| |
|:-------|:---|:|
|`@page :left` |	yes| Since 0.6 beta 2, only margins are applied |
|`@page :right` |	yes| Since 0.6 beta 2, only margins are applied |
|`@page :off` |	yes| Since 0.6 beta 2, only margins are applied |
|`@page :even` |	yes| Since 0.6 beta 2, only margins are applied |
|`@page :first` |	yes| Since 0.6 beta 2, only margins are applied |

# Pseudo elements #

| **Property** | **Supported** | **Notes** |
|:-------------|:--------------|:----------|
|`E:before`    | 	yes          | Only on block and inline elements |
|`E:after`     |	yes           | Only on block and inline elements |

# Properties #

dompdf supports the majority of CSS 2.1 properties and some CSS 3 properties. Some notable properties are not supported however. See the following table for details on which properties are supported.

| **Property** | **Supported** | **Notes** |
|:-------------|:--------------|:----------|
|background-attachment 	|N/A            |           |
|background-color 	|yes            |           |
|background-image 	|yes            |           |
|background-position 	|yes            |           |
|background-repeat 	|yes            |           |
|background 	  |yes            |           |
|border-collapse |	yes           |           |
|border-color 	|yes            |           |
|border-spacing 	|yes            |           |
|border-style 	|yes            |           |
|border-top 	  |yes            |           |
|border-top-color |	yes           |           |
|border-top-style |	yes           |           |
|border-top-width |	yes           |           |
|border-width 	|yes            |           |
|border 	      |yes            |           |
|bottom 	      |no             |           |
|caption-side 	|no. Caption elements are moved before the table, as block elements.|           |
|clear 	       |partial        | Since 0.6 beta 3 (DOMPDF\_ENABLE\_CSS\_FLOAT must be true)|
|clip 	        |no             |           |
|color         | 	yes          |           |
|content       | 	yes          |           |
|counter-increment| yes           |           |
|counter-reset | yes           |           |
|cursor        |	N/A           |           |
|direction     | 	no           |           |
|display 	     |partial        |           |
|empty-cells 	 |yes            | Since 0.6 beta 3 |
|float 	       |partial        | Since 0.6 beta 3 (DOMPDF\_ENABLE\_CSS\_FLOAT must be true)|
|font-family 	 |yes            |           |
|font-size 	   |yes            |           |
|font-style 	  |yes            |           |
|font-variant 	|no             |           |
|font-weight 	 |yes            |           |
|font 	        |yes            |           |
|height 	      |yes            |           |
|left 	        |yes            |           |
|letter-spacing |	yes           |           |
|line-height 	 |yes            |           |
|list-style-image 	|yes            |           |
|list-style-position |	yes           |           |
|list-style-type 	|yes            |           |
|list-style    |	yes           |           |
|margin-right  |	yes           |           |
|margin-top    |	yes           |           |
|margin 	      |yes            |           |
|max-height    |	yes           |           |
|max-width 	   |yes            |           |
|min-height 	  |no             |           |
|min-width 	   |yes            |           |
|opacity       |partial        | CSS3      |
|orphans 	     |yes            |           |
|outline-color |	yes           |           |
|outline-style 	|yes            |           |
|outline-width 	|yes            |           |
|outline 	     |yes            |           |
|overflow 	    |partial        |           |
|padding-top 	 |yes            |           |
|padding 	     |yes            |           |
|page-break-after |	yes           |           |
|page-break-before |	yes           |           |
|page-break-inside |	yes           |           |
|position 	    |yes            |           |
|quotes 	      |yes            |           |
|right 	       |no             |           |
|size 	        |yes            | for @page |
|src 	         |partial        | for @font-face |
|table-layout 	|no             |           |
|text-align 	  |yes            |           |
|text-decoration |	yes           |           |
|text-indent 	 |yes            |           |
|text-transform 	|yes            |           |
|transform 	   |yes            | CSS3      |
|top           |	yes           |           |
|unicode-bidi  |no             |           |
|unicode-range |no             | for @font-face |
|vertical-align|yes            |           |
|visibility 	  |yes            |           |
|white-space 	 |yes            |           |
|widows        |no             |           |
|width         |yes            |           |
|word-spacing  |yes            |           |
|word-wrap 	   |yes            |           |
|z-index       |yes            |           |

  1. Display types inline-block and run-in are not supported.

# CSS Units #
| **Unit** | **Supported** | **Notes** |
|:---------|:--------------|:----------|
| `px`     | yes           |           |
| `pt`     | yes           |           |
| `%`      | yes           |           |
| `rem`    | yes           | Since 0.6 beta 3 |
| `em`     | yes           |           |
| `cm`     | yes           |           |
| `mm`     | yes           |           |
| `ex`     | yes           | Equals to em/2 |
| `in`     | yes           |           |
| `pc`     | yes           |           |
| `rad`    | yes           | Since 0.6 beta 2, for 2D transforms |
| `deg`    | yes           | Since 0.6 beta 2, for 2D transforms |

# Colors #
| **Color** | **Supported** | **Notes** |
|:----------|:--------------|:----------|
| `transparent` | yes           |           |
| `currentColor` | no            |           |
| [Basic color keywords](http://www.w3.org/TR/css3-color/#html4) | yes           |           |
| [Extended color keywords](http://www.w3.org/TR/css3-color/#svg-color) | yes           |           |
| [Numerical color values](http://www.w3.org/TR/css3-color/#numerical)  | yes           |           |
| [CMYK color values](http://www.w3.org/TR/css3-gcpm/#cmyk-colors)  | yes           |           |
| [RGBA color values](http://www.w3.org/TR/css3-color/#rgba-color) | no            |           |
| [HSL color values](http://www.w3.org/TR/css3-color/#hsl-color) | no            |           |
| [HSLA color values](http://www.w3.org/TR/css3-color/#hsla-color) | no            |           |
| [CSS2 system colors](http://www.w3.org/TR/css3-color/#css2-system) | no            |           |