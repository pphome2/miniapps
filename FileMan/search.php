<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

# load config and language file
if (!isset($MA_CONFIG_DIR)){
    if (file_exists("config/config.php")){
	    include("config/config.php");
    }

    if (file_exists("$MA_CONFIG_DIR/$MA_LANGFILE")){
	    include("$MA_CONFIG_DIR/$MA_LANGFILE");
    }
}


for ($i=0;$i<count($MA_LIB);$i++){
	if (file_exists("$MA_LIB[$i]")){
		include("$MA_LIB[$i]");
	}
}

$MA_SEARCH_PAGE=true;
$MA_BACKPAGE=true;

login();

# cookies or param 
setcss();

# build page: header
$mainpage=refererpage();
if ($mainpage<>$MA_ADMINFILE){
    if ($MA_ENABLE_HEADER_VIEW){
        page_header();
    }else{
        page_header_view();
    }
}else{
    page_header();
}


# search
#$MA_NOPAGE=true;
for ($i=0;$i<count($MA_APPFILE);$i++){
	if (file_exists("$MA_APPFILE[$i]")){
		include("$MA_APPFILE[$i]");
	}
}

if (function_exists("searchpage")){
	searchpage();
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
