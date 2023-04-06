<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


# load config and  language file
if (!isset($MA_CONFIG_DIR)){
    if (file_exists("config/config.php")){
	    include("config/config.php");
    }
    if (file_exists("$MA_CONFIG_DIR/$MA_LANGFILE")){
	    include("$MA_CONFIG_DIR/$MA_LANGFILE");
    }
}


for ($i=0;$i<count($MA_LIB);$i++){
	if (file_exists("$MA_INCLUDE_DIR/$MA_LIB[$i]")){
		include("$MA_INCLUDE_DIR/$MA_LIB[$i]");
	}
}

$MA_PRIVACY_PAGE=true;
$MA_BACKPAGE=true;

# cookies or param 
setcss();

# local app files
for ($j=0;$j<count($MA_APPFILE);$j++){
	if (file_exists("$MA_CONTENT_DIR/$MA_APPFILE[$j]")){
		include("$MA_CONTENT_DIR/$MA_APPFILE[$j]");
	}
}

# build page: header
$mainpage=refererpage();
if ($mainpage<>$MA_ADMINFILE){
    #if ($MA_ENABLE_HEADER_VIEW){
        page_header();
    #}else{
    #    page_header_view();
    #}
}else{
    page_header();
}

# privacy data to screen
#$MA_NOPAGE=true;

# load local app jsfile
for ($i=0;$i<count($MA_APPJSFILE);$i++){
	if (file_exists("$MA_CONTENT_DIR/$MA_APPJSFILE[$i]")){
		include("$MA_CONTENT_DIR/$MA_APPJSFILE[$i]");
	}
}


if (function_exists("privacypage")){
	privacypage();
}

button_back();

# page footer
if ($mainpage<>$MA_ADMINFILE){
    if ($MA_ENABLE_FOOTER_VIEW){
        page_footer();
    }else{
        page_footer_view();
    }
}else{
    page_footer();
}



?>
