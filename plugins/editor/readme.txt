ASCIIMath and ASCIIsvg plugins for TinyMCE
(c) 2008-2011 David Lippman.   http://dlippman.imathas.com
			       http://www.imathas.com

ver 0.32  8/29/11: Fixed math edit in Chrome, and column vector issues
ver 0.31  8/15/11: Fixed IE8 compatibility mode issues.
ver 0.30  8/14/11: Upgraded to work with TinyMCE 3.4.4 and IE9.  
		   Added SVG support for IE9 and newer WebKit
ver 0.20  9/15/09: Upgraded to work with TinyMCE 3.2.5
ver 0.15  2/20/09: Improve empty math area handling
		   Home/End to get out of math area (only FireFox)
		   Handle cut/paste of image-based better
ver 0.14 12/04/08: Bug fix empty math areas
ver 0.13 12/03/08: Disabled $ triggering rendering
		   Bug fix function parsing asciisvgimg.php
ver 0.12 10/18/08: Bug fix angle bracket handling in math areas
ver 0.11  9/30/08: Bug fix img fallback IE
ver 0.10  9/27/08: Initial public release

These are ports of similar plugins for HTMLArea written by David Lippman and
Peter Jipsen.  

This distribution includes the asciimath and asciisvg plugins and a partial
distribution of TinyMCE sufficient to run a demo.  I purposely formatted the
demo to have the same look as the old HTMLArea demo.  The TinyMCE scripts have 
not been modified from the original.  This distribution also includes a PHP
script for image-based graph fallback, and a GPL licensed font file.

Editor Setup
--------------
The demo.html file shows how to enable the asciimath and asciisvg plugins
in TinyMCE.  The important aspects of the configuration are:

1) Include the ASCIIMathMLwFallback.js script

2) Define AMTcgiloc - a web address pointing to an install of mimetex or another
   CGI-based LaTeX renderer.  MimeTeX can be downloaded from 
   http://www.forkosh.com/mimetex.html.  If your webhost does not support it, 
   you can use a public MimeTeX for light use by setting:
   
   var AMTcgiloc = "http://www.imathas.com/cgi-bin/mimetex.cgi";
   
3) In the tinyMCE.init function:
 a) Include asciisvg, asciimath, and asciimathcharmap in the 
    theme_advanced_buttons list
    
 b) Include asciimath and asciisvg in the plugins list
 
 c) Add AScgiloc and ASdloc as params.  AScgiloc needs to point to an install
    of the PHP image generator script included in this distribution.  The ASdloc
    needs to be an absolute url to the jscripts/tiny_mce/plugins/asciisvg/js/d.svg file.
    Both of these can be on a separate server if you want.  If your webhost does
    not support PHP, you can use this server for light use:
    
    AScgiloc : 'http://www.imathas.com/editordemo/php/svgimg.php'
    
4) Make sure your css/content.css or theme css file includes this line if you 
    want your math editor boxes to be obvious when in edit mode:
    span.AMedit {border: 1px solid #ff0000;}
     
    
Output
--------------
Be sure to include this in the <head> section of your website, adjusting paths 
and variable values appropriately:

<script type="text/javascript" src="jscript/plugins/asciimath/js/ASCIIMathMLwFallback.js"></script>
<script type="text/javascript" src="jscript/plugins/asciisvg/js/ASCIIsvg.js"></script>
<script type="text/javascript">
 var AScgiloc = 'http://www.imathas.com/imathas/filter/graph/svgimg.php';
 var AMTcgiloc = "http://www.imathas.com/cgi-bin/mimetex.cgi";
</script>


Compatibility Notes
--------------
TinyMCE supports IE, Mozilla, Opera 9, Safari 3, and others.  See
http://wiki.moxiecode.com/index.php/TinyMCE:Compatiblity.  All of these can
use these plugins using either browser-based technologies or image-based 
fallbacks.

Math and Graphs will fallback to image-based rendering when browser-based
rendering is not available. 

The version of ASCIIMathMLwFallback.js included in this distribution includes
Mozilla font detection in its MathML sniffer.  STIX or the MIT fonts are 
required on Mozilla 1.8 (FireFox 2) and the STIX fonts are required on 
Mozilla 1.9+ (FF3+).  This is done since many math expressions (like square roots)
do not display correctly without the necessary fonts.  Browser-based math
is possible in Mozilla (FF2+) and IE+MathPlayer.

The SVG sniffer included in the version of ASCIIsvg.js included in this
distribution is enabled for IE9, IE<9+AdobeSVGviewer, Mozilla 1.8+ (Firefox 2+), 
and newer Webkit (Safari 5+, Chrome).  


License
--------------
For TinyMCE license info, see http://tinymce.moxiecode.com/license.php

The included php/FreeSerifItalic.ttf is GPL licensed, I believe.

All code written by David Lippman included in this distribution is subject to:

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation; either version 2.1 of the License, or (at
your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT 
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS 
FOR A PARTICULAR PURPOSE. See the GNU Lesser General Public License 
(at http://www.gnu.org/licences/lgpl.html) for more details.

    
 

