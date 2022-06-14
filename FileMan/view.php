<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


# load config 
if (file_exists("config/config.php")){
	include("config/config.php");
}

echo($MA_DOCTYPE);
 
for ($i=0;$i<count($MA_LIB);$i++){
	if (file_exists("$MA_LIB[$i]")){
		include("$MA_LIB[$i]");
	}
}

plugins();

# css setting
setcss();

# page header
page_header_view();

# load local app file
for ($i=0;$i<count($MA_APPFILE);$i++){
	if (file_exists($MA_APPFILE[$i])){
		include($MA_APPFILE[$i]);
	}
}

# start public view
if (function_exists("view")){
	view();
}

# page footer
page_footer_view();

?>
