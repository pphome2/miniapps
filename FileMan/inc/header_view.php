<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

?>

<html>
	<head>
		<title><?php echo($MA_SITENAME." ".$L_SITENAME); ?></title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="favicon.png">
		<link rel="shortcut icon" type="image/png" href="favicon.png" />
		<?php
	        echo("<style>");
		    if (!$MA_NOPAGE){
	            if (file_exists($MA_CSS[$MA_STYLEINDEX])){
		            include("$MA_CSS[$MA_STYLEINDEX]");
		        }
		    }else{
	            if (file_exists($MA_PRINTCS)){
		            include("$MA_PRINTCSS");
		        }
		    }
	        if (file_exists($MA_APPCSSFILE)){
		        include("$MA_APPCSSFILE");
		    }
		    echo("</style>");
		?>
	</head>
<body>


<div class=all-page>

<header>

</header>

<div class="content">
