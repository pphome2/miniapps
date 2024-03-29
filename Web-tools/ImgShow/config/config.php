<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

# configuration

# copyright link
$MA_COPYRIGHT="© ".date("Y").". <a href=https://github.com/pphome2>Github</a>";

# title, home link
$MA_SITENAME="ImgShow";
$MA_SITE_HOME="http://www.google.com";
$MA_DOCTYPE="<!DOCTYPE HTML>";

# directories
$MA_CONFIG_DIR="config";
$MA_INCLUDE_DIR="inc";
$MA_CONTENT_DIR="content";

$MA_COOKIE_STYLE="st";
$MA_COOKIE_USER="user";
$MA_COOKIE_PASSWORD="passw";
$MA_COOKIE_TIME="ltime";

# include files
$MA_ADMINFILE="start.php";
$MA_PRIVACY="privacy.php";
$MA_PRINTFILE="print.php";
$MA_CSS=array(
			"$MA_INCLUDE_DIR/siteb.css",
			"$MA_INCLUDE_DIR/sitew.css"
			);
$MA_CSSPRINT="$MA_INCLUDE_DIR/sitepr.css";
$MA_JS_BEGIN="$MA_INCLUDE_DIR/js_begin.js";
$MA_JS_END="$MA_INCLUDE_DIR/js_end.js";
$MA_HEADER="$MA_INCLUDE_DIR/header.php";
$MA_FOOTER="$MA_INCLUDE_DIR/footer.php";
$MA_LIB=array(
			"$MA_INCLUDE_DIR/lib.php",
			"$MA_INCLUDE_DIR/libview.php"
			);

# local app main and css file
$MA_APPFILE=array(
				"$MA_CONTENT_DIR/imgshow.js",
				"$MA_CONTENT_DIR/imgshowcfg.php",
				"$MA_CONTENT_DIR/imgshow.php"
			);
$MA_APPCSSFILE="$MA_CONTENT_DIR/imgshow.css";

# language
$MA_LANGFILE="hu.php";

# search
$MA_SEARCH_ICON_HREF="search.php";
$MA_SEARCH_ICON_JS="";

# other variables
$MA_NOPAGE=false;
$MA_PASSWORD="";
$MA_LOGIN_TIME="";
$MA_LOGGEDIN=false;
$MA_STYLEINDEX=0;
$MA_LOGOUT_IN_HEADER=true;
$MA_PRIVACY_PAGE=false;

# auto logout - second
$MA_LOGIN_TIMEOUT=600;
$MA_ENABLE_COOKIES=true;
$MA_ADMIN_USER=false;
$MA_USERPAGE=false;

# header, footer
$MA_ENABLE_HEADER=true;
$MA_ENABLE_FOOTER=true;

# login
$MA_ENABLE_LOGIN=false;

# multiuser
$MA_ENABLE_USERNAME=false;
$MA_USERS_ADMINUSERS=array(
				"admin"
			);
$MA_USERS_CRED=array(
					array("admin","e3274be5c857fb42ab72d786e281b4b8"),
					array("user","5f4dcc3b5aa765d61d8327deb882cf99"),
				);
# need md5 passcode -- user password: password - admin password: adminpassword

# menu
$MA_MENU_FIELD="m";
$MA_MENU=array();

# adminmenu
$MA_ADMINMENU_FIELD="m";
$MA_ADMINMENU=array();

# load language file
if (file_exists("$MA_CONFIG_DIR/$MA_LANGFILE")){
	include("$MA_CONFIG_DIR/$MA_LANGFILE");
}


# if not enable cookie support:
# - all form need add this lines
#
#		<input type='hidden' name='$MA_COOKIE_PASSWORD' id='$MA_COOKIE_PASSWORD' value='$MA_PASSWORD'>
#		<input type='hidden' name='$MA_COOKIE_STYLE' id='$MA_COOKIE_STYLE' value='$MA_STYLEINDEX'>
#		<input type='hidden' name='$MA_COOKIE_TIME' id='$MA_COOKIE_TIME' value='$MA_LOGIN_TIME'>
#


############################################

# local app config, variables

$MA_MENU=array(
				array($L_MENU1,"list.php")
			);

$MA_ADMINMENU=array(
				array($L_MENU2,"list.php")
			);


?>
