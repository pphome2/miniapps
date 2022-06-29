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
$MA_SITENAME="FM";
$MA_SITE_HOME="http://www.google.com";
$MA_DOCTYPE="<!DOCTYPE HTML>";

# directories
$MA_CONFIG_DIR="config";
$MA_INCLUDE_DIR="inc";
$MA_CONTENT_DIR="content";
$MA_PLUGIN_DIR="plugins";

# cookies
$MA_COOKIE_STYLE="st";
$MA_COOKIE_USER="user";
$MA_COOKIE_PASSWORD="passw";
$MA_COOKIE_TIME="ltime";

# include files
$MA_ADMINFILE="start.php";
$MA_VIEWFILE="view.php";
$MA_SEARCHFILE="search.php";
$MA_PRIVACYFILE="privacy.php";
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
$MA_HEADER_VIEW="$MA_INCLUDE_DIR/header_view.php";
$MA_FOOTER_VIEW="$MA_INCLUDE_DIR/footer_view.php";

$MA_LIB=array(
			"$MA_INCLUDE_DIR/lib.php",
			"$MA_INCLUDE_DIR/libview.php"
			);

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# local app main and css file
$MA_APPFILE=array(
				"$MA_CONTENT_DIR/fm.js",
				"$MA_CONTENT_DIR/fmcfg.php",
				"$MA_CONTENT_DIR/fmdl.php",
				"$MA_CONTENT_DIR/fmup.php",
				"$MA_CONTENT_DIR/fmadmin.php",
				"$MA_CONTENT_DIR/fm.php"
			);
$MA_APPCSSFILE="$MA_CONTENT_DIR/fm.css";

# language
$MA_LANGFILE="hu.php";

# search
$MA_SEARCH_ICON_HREF="";
$MA_SEARCH_ICON_JS="";

# auto logout (seconds)
$MA_LOGIN_TIMEOUT=600;

# header, footer
$MA_ENABLE_HEADER=true;
$MA_ENABLE_FOOTER=true;
$MA_ENABLE_HEADER_VIEW=false;
$MA_ENABLE_FOOTER_VIEW=false;

# login
$MA_ENABLE_LOGIN=true;
$MA_ENABLE_LOGIN_VIEW=true;

# multiuser
$MA_ENABLE_USERNAME=false;
$MA_USERS_ADMINUSERS=array("admin");
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

# variables (no change)
$MA_NOPAGE=false;
$MA_PASSWORD="";
$MA_LOGIN_TIME="";
$MA_LOGGEDIN=false;
$MA_STYLEINDEX=0;
$MA_LOGOUT_IN_HEADER=true;
$MA_PRIVACY_PAGE=false;
$MA_SEARCH_PAGE=false;
$MA_ENABLE_COOKIES=true;
$MA_ADMIN_USER=false;
$MA_USERPAGE=false;

#
# if not enable cookie support:
# - all form need add this lines
#		<input type='hidden' name='$MA_COOKIE_PASSWORD' id='$MA_COOKIE_PASSWORD' value='$MA_PASSWORD'>
#		<input type='hidden' name='$MA_COOKIE_STYLE' id='$MA_COOKIE_STYLE' value='$MA_STYLEINDEX'>
#		<input type='hidden' name='$MA_COOKIE_TIME' id='$MA_COOKIE_TIME' value='$MA_LOGIN_TIME'>
#

?>
