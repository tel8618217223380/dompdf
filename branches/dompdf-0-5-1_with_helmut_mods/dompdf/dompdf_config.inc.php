<?php
/**
 * DOMPDF - PHP5 HTML to PDF renderer
 *
 * File: $RCSfile: dompdf_config.inc.php,v $
 * Created on: 2004-08-04
 *
 * Copyright (c) 2004 - Benj Carson <benjcarson@digitaljunkies.ca>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library in the file LICENSE.LGPL; if not, write to the
 * Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA
 * 02111-1307 USA
 *
 * Alternatively, you may distribute this software under the terms of the
 * PHP License, version 3.0 or later.  A copy of this license should have
 * been distributed with this file in the file LICENSE.PHP .  If this is not
 * the case, you can obtain a copy at http://www.php.net/license/3_0.txt.
 *
 * The latest version of DOMPDF might be available at:
 * http://www.digitaljunkies.ca/dompdf
 *
 * @link http://www.digitaljunkies.ca/dompdf
 * @copyright 2004 Benj Carson
 * @author Benj Carson <benjcarson@digitaljunkies.ca>
 * @package dompdf
 * @version 0.5.1
 */

/* $Id: dompdf_config.inc.php,v 1.30 2009-04-29 04:11:35 benjcarson Exp $ */

//error_reporting(E_STRICT | E_ALL);

/**
 * The root of your DOMPDF installation
 */
define("DOMPDF_DIR", str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__))));

/**
 * The location of the DOMPDF include directory
 */
define("DOMPDF_INC_DIR", DOMPDF_DIR . "/include");

/**
 * The location of the DOMPDF lib directory
 */
define("DOMPDF_LIB_DIR", DOMPDF_DIR . "/lib");

/**
 * The location of the DOMPDF font directory
 *
 * Note this directory must be writable by the webserver process (or user
 * executing DOMPDF from the CLI).  *Please note the trailing slash.*
 *
 * Notes regarding fonts:
 * Additional .afm font metrics can be added by executing load_font.php from command line.
 * Converting ttf fonts to afm requires the external tool referenced by TTF2AFM
 *
 * Only the original "Base 14 fonts" are present on all pdf viewers. Additional fonts must 
 * be embedded in the pdf file or the PDF may not display correctly. This can significantly 
 * increase file size and could violate copyright provisions of a font. Font embedding is 
 * not currently supported (? via HT).
 *
 * Any font specification in the source HTML is translated to the closest font available 
 * in the font directory.
 *
 * The pdf standard "Base 14 fonts" are:
 * Courier, Courier-Bold, Courier-BoldOblique, Courier-Oblique,
 * Helvetica, Helvetica-Bold, Helvetica-BoldOblique, Helvetica-Oblique,
 * Times-Roman, Times-Bold, Times-BoldItalic, Times-Italic,
 * Symbol,
 * ZapfDingbats,
 */
define("DOMPDF_FONT_DIR", DOMPDF_DIR . "/lib/fonts/");

/**
 * The location of the DOMPDF font cache directory
 *
 * Note this directory must be writable by the webserver process
 * This folder must already exist!
 * It contains the .afm files, on demand parsed, converted to php syntax and cached
 * This folder can be the same as DOMPDF_FONT_DIR
 *
 * *Please note the trailing slash.*
 */
define("DOMPDF_FONT_CACHE", DOMPDF_FONT_DIR);

/**
 * The location of the system's temporary directory.
 *
 * This directory must be writeable by the webserver process.
 * It is used to download remote images.
 * Since e.g. on Windows there is no mandatory tmp location, we should 
 * consider using sys_get_temp_dir().
 */
define("DOMPDF_TEMP_DIR", "/tmp");

/**
 * ==== IMPORTANT ====
 *
 * dompdf's "chroot": Prevents dompdf from accessing system files or other
 * files on the webserver.  All local files opened by dompdf must be in a
 * subdirectory of this directory.  DO NOT set it to '/' since this could
 * allow an attacker to use dompdf to read any files on the server.  This
 * should be an absolute path.
 */
define("DOMPDF_CHROOT", realpath(DOMPDF_DIR));

/**
 * Whether to use Unicode fonts or not.
 *
 * When set to true the PDF backend must be set to "CPDF" and fonts must be
 * loaded via the modified ttf2ufm tool included with dompdf (see below).
 * Unicode font metric files (with .ufm extensions) must be created with
 * ttf2ufm.  load_font.php should do this for you if the TTF2AFM define below
 * points to the modified ttf2ufm tool included with dompdf.
 *
 * When enabled, dompdf can support all Unicode glyphs.  Any glyphs used in a
 * document must be present in your fonts, however.
 *
 */
define("DOMPDF_UNICODE_ENABLED", false);

/**
 * The path to the tt2pt1 utility (used to convert ttf to afm)
 *
 * Not strictly necessary, but useful if you would like to install 
 * additional fonts using the {@link load_font.php} utility.
 *
 * Windows users should use something like this:
 * define("TTF2AFM", "C:\\Program Files\\Ttf2Pt1\\bin\\ttf2pt1.exe");
 *
 * @link http://ttf2pt1.sourceforge.net/
 */
define("TTF2AFM", DOMPDF_LIB_DIR ."/ttf2ufm/ttf2ufm-src/ttf2pt1");
//define("TTF2AFM", "/usr/bin/ttf2pt1");


/**
 * The PDF rendering backend to use
 *
 * Valid settings are 'PDFLib', 'CPDF' (the bundled R&OS PDF class), 'GD' and
 * 'auto'.  'auto' will look for PDFLib and use it if found, or if not it will
 * fall back on CPDF.  'GD' renders PDFs to graphic files.  {@link
 * Canvas_Factory} ultimately determines which rendering class to instantiate
 * based on this setting.
 *
 * Both PDFLib & CPDF rendering backends provide sufficient rendering
 * capabilities for dompdf, however additional features (e.g. object,
 * image and font support, etc.) differ between backends.  Please see
 * {@link PDFLib_Adapter} for more information on the PDFLib backend
 * and {@link CPDF_Adapter} and lib/class.pdf.php for more information
 * on CPDF.  Also see the documentation for each backend at the links
 * below.
 *
 * The GD rendering backend is a little different than PDFLib and
 * CPDF.  Several features of CPDF and PDFLib are not supported or do
 * not make any sense when creating image files.  For example,
 * multiple pages are not supported, nor are PDF 'objects'.  Have a
 * look at {@link GD_Adapter} for more information.  GD support is new
 * and experimental, so use it at your own risk.
 * 
 * @link http://www.pdflib.com
 * @link http://www.ros.co.nz/pdf
 * @link http://www.php.net/image
 */
define("DOMPDF_PDF_BACKEND", "auto");


/**
 * PDFlib license key
 *
 * If you are using a licensed, commercial version of PDFlib, specify
 * your license key here.  If you are using PDFlib-Lite or are evaluating
 * the commercial version of PDFlib, comment out this setting.
 *
 * @link http://www.pdflib.com
 */
#define("DOMPDF_PDFLIB_LICENSE", "your license key here");

/**
 * The default paper size.
 *
 * North America standard is "letter"; other countries generally "a4"
 *
 * @see CPDF_Adapter::PAPER_SIZES for valid sizes
 */
define("DOMPDF_DEFAULT_PAPER_SIZE", "letter");


/**
 * The default font family
 *
 * Used if no suitable fonts can be found. This must exist in the font folder.
 * @var string
 */
define("DOMPDF_DEFAULT_FONT", "serif");

/**
 * Image DPI setting
 *
 * This setting determines the default DPI setting for images.  The
 * DPI may be overridden for inline images by explictly setting the
 * image's width & height style attributes (i.e. if the image's native
 * width is 600 pixels and you specify the image's width as 72 points,
 * the image will have a DPI of 600 in the rendered PDF.  The DPI of
 * background images can not be overridden and is controlled entirely
 * via this parameter.
 *
 * For the purposes of DOMPDF, pixels per inch (PPI) = dots per inch (DPI).
 * If a size in html is given as px (or without unit as image size),
 * this tells the corresponding size in pt.
 * This adjusts the relative sizes to be similar to the rendering of the
 * html page in a reference browser.
 *
 * In pdf, always 1 pt = 1/72 inch
 *
 * Rendering resolution of various browsers in px per inch:
 * Windows Firefox and Internet Explorer:
 *   SystemControl->Display properties->FontResolution: Default:96, largefonts:120, custom:?
 * Linux Firefox:
 *   about:config *resolution: Default:96
 *   (xorg screen dimension in mm and Desktop font dpi settings are ignored)
 *
 * Take care about extra font/image zoom factor of browser.
 *
 * In images, <img> size in pixel attribute, img css style, are overriding
 * the real image dimension in px for rendering.
 *
 * @var int
 */
define("DOMPDF_DPI", "150");

/**
 * Enable inline PHP
 *
 * If this setting is set to true then DOMPDF will automatically evaluate
 * inline PHP contained within <script type="text/php"> ... </script> tags.
 *
 * Enabling this for documents you do not trust (e.g. arbitrary remote html
 * pages) is a security risk.  Set this option to false if you wish to process
 * untrusted documents.
 *
 * @var bool
 */
define("DOMPDF_ENABLE_PHP", true);


/**
 * Enable remote file access
 *
 * If this setting is set to true, DOMPDF will access remote sites for
 * images and CSS files as required.
 *
 * @var bool 
 */
define("DOMPDF_ENABLE_REMOTE", false);
 
/**
 * DOMPDF autoload function
 *
 * If you have an existing autoload function, add a call to this function
 * from your existing __autoload() implementation.
 *
 * TODO: use spl_autoload(), if available
 *
 * @param string $class
 */
function DOMPDF_autoload($class) {
  $filename = DOMPDF_INC_DIR . "/" . mb_strtolower($class) . ".cls.php";
  
  if ( is_file($filename) )
    require_once($filename);
}

if ( function_exists("spl_autoload_register") ) {

   spl_autoload_register("DOMPDF_autoload");

} else if ( !function_exists("__autoload") ) {
  /**
   * Default __autoload() function
   *
   * @param string $class
   */
  function __autoload($class) {
    DOMPDF_autoload($class);
  }
} 

// ### End of user-configurable options ###


/**
 * Global array of warnings generated by DomDocument parser and
 * stylesheet class
 *
 * @var array
 */
$_dompdf_warnings = array();

/**
 * If true, $_dompdf_warnings is dumped on script termination.
 *
 * @var bool
 */
$_dompdf_show_warnings = false;

/**
 * If true, the entire tree is dumped to stdout in dompdf.cls.php 
 *
 * @var bool
 */
$_dompdf_debug = false;

/**
 * Array of enabled debug message types
 *
 * @var array
 */
$_DOMPDF_DEBUG_TYPES = array(); //array("page-break" => 1);

/* Optionally enable different classes of debug output before the pdf content.
 * Visible if displaying pdf as text,
 * E.g. on repeated display of same pdf in browser when pdf is not taken out of
 * the browser cache and the premature output prevents setting of the mime type.
 */
if (!defined('DEBUGPNG')) {
  define('DEBUGPNG',0);
}
if (!defined('DEBUGKEEPTEMP')) {
  define('DEBUGKEEPTEMP',0);
}
if (!defined('DEBUGCSS')) {
  define('DEBUGCSS',0);
}

require_once(DOMPDF_INC_DIR . "/functions.inc.php");

?>