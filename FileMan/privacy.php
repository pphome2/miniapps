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
# load language file
if (file_exists("$MA_CONFIG_DIR/$MA_LANGFILE")){
	include("$MA_CONFIG_DIR/$MA_LANGFILE");
}


for ($i=0;$i<count($MA_LIB);$i++){
	if (file_exists("$MA_LIB[$i]")){
		include("$MA_LIB[$i]");
	}
}


$MA_PRIVACY_PAGE=true;

# cookies or param 
setcss();

# page build
page_header();

# privacy data to screen
#$MA_NOPAGE=true;

for ($i=0;$i<count($MA_APPFILE);$i++){
	if (file_exists("$MA_APPFILE[$i]")){
		include("$MA_APPFILE[$i]");
	}
}


if (function_exists("privacypage")){
	privacypage();
}

button_back();

# page end
page_footer();


?>
