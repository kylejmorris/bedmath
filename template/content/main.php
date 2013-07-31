<!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#" xlmns:og="http://opengraphprotocol.org/schema/">
    <head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta name="keywords" content="Math, math platform, tutor platform " />
		<meta name="description" content="Solve your math questions by asking our community, help others and get paid." />
		<meta name="author" content="Bedmath.com">
		<!-- Social Media Meta -->
		<meta property="og:site_name" content="Bedmath"/>
		<meta property="og:title" content="Solves your math Questions"/>
		<meta property="og:url" content="http://www.bedmath.com"/>
		<meta property="og:description" content="Solve your Questions by asking our community, help others and get paid."/>
		<meta name="twitter:card" content="summary"/>
		<meta name="twitter:description" content="Bedmath solves your questions. Help others and get paid."/>
		<meta name="twitter:image" content=""/>
        <title>
          <?php $this->title; ?>
        </title>
		<!-- Content -->
		<link rel="stylesheet/less" type="text/css" href="<?php echo ROOT; ?>template/less/Master.less">
		<script src="<?php echo ROOT; ?>template/scripts/less.js" type="text/javascript"></script>
		<script src="<?php echo ROOT; ?>plugins/editor/jscripts/tiny_mce/plugins/asciimath/js/ASCIIMathMLwFallback.js"</script>
		<script type="text/javascript">
			var AMTcgiloc = "http://www.imathas.com/cgi-bin/mimetex.cgi";  		//change me
		</script>
		<script type="text/javascript" src="<?php echo ROOT; ?>plugins/editor/jscripts/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
			tinyMCE.init({
				mode : "textareas",
				theme : "advanced",
				theme_advanced_buttons1 : "fontselect,fontsizeselect,formatselect,bold,italic,underline,strikethrough,separator,sub,sup,separator,cut,copy,paste,undo,redo",
				theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,separator,numlist,bullist,outdent,indent,separator,forecolor,backcolor,separator,hr, table,separator,asciimath,asciimathcharmap,asciisvg",
				theme_advanced_buttons3 : "",
				theme_advanced_fonts : "Arial=arial,helvetica,sans-serif,Courier New=courier new,courier,monospace,Georgia=georgia,times new roman,times,serif,Tahoma=tahoma,arial,helvetica,sans-serif,Times=times new roman,times,serif,Verdana=verdana,arial,helvetica,sans-serif",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				plugins : 'asciimath,asciisvg,table,inlinepopups,media',
			   
				AScgiloc : 'http://www.imathas.com/editordemo/php/svgimg.php',			      //change me  
				ASdloc : 'http://www.imathas.com/editordemo/jscripts/tiny_mce/plugins/asciisvg/js/d.svg',  //change me  	
					
				content_css : "css/content.css"
			});
		</script>
    </head>