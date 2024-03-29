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
$MA_TITLE="FM";
$MA_CODENAME="fm";
$MA_ROOT_HOME="https://google.com";
$MA_ROOT_NAME="Google";
$MA_SITE_HOME="";
$MA_DOCTYPE="<!DOCTYPE HTML>";

# directories
$MA_CONFIG_DIR="config";
$MA_INCLUDE_DIR="inc";
$MA_CONTENT_DIR="content";
$MA_PLUGIN_DIR="plugins";

# cookies
$MA_COOKIE_STYLE="st";
$MA_COOKIE_LOGIN="u";

# include files
$MA_ADMINFILE="start.php";
$MA_VIEWFILE="view.php";
$MA_SEARCHFILE="search.php";
$MA_PRIVACYFILE="privacy.php";
$MA_PRINTFILE="print.php";

$MA_FAVICON="favicon.png";

$MA_CSS=array(
			"$MA_INCLUDE_DIR/siteb.css",
			"$MA_INCLUDE_DIR/sitew.css"
			);
$MA_ENABLE_SYSTEM_CSS=true;
$MA_CSSPRINT="$MA_INCLUDE_DIR/sitepr.css";

$MA_JS_BEGIN="$MA_INCLUDE_DIR/js_begin.js";
$MA_JS_END="$MA_INCLUDE_DIR/js_end.js";
$MA_ENABLE_SYSTEM_JS=true;

$MA_HEADER="$MA_INCLUDE_DIR/header.php";
$MA_FOOTER="$MA_INCLUDE_DIR/footer.php";
$MA_HEADER_VIEW="$MA_INCLUDE_DIR/header_view.php";
$MA_FOOTER_VIEW="$MA_INCLUDE_DIR/footer_view.php";

$MA_LIB=array(
			"$MA_INCLUDE_DIR/lib.php",
			"$MA_INCLUDE_DIR/libadmin.php",
			"$MA_INCLUDE_DIR/libview.php"
			);

# pages
$MA_ENABLE_PRIVACY=true;
$MA_ENABLE_PRINT=true;
$MA_ENABLE_SEARCH=true;
$MA_ENABLE_THEME=true;

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# cookies
$MA_COOKIES=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
$MA_APPFILE=array(
				"$MA_CONTENT_DIR/fmcfg.php",
				"$MA_CONTENT_DIR/fmdl.php",
				"$MA_CONTENT_DIR/fmup.php",
				"$MA_CONTENT_DIR/fmadmin.php",
				"$MA_CONTENT_DIR/fm.php",
				"$MA_CONTENT_DIR/$MA_LANGFILE"
			);
$MA_APPCSSFILE=array("$MA_CONTENT_DIR/fm.css");
$MA_APPJSFILE=array("$MA_CONTENT_DIR/fm.js");

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
# user menu
$MA_MENU=array();
# adminmenu
$MA_ADMINMENU=array();
# back icon in menu
$MA_BACKPAGE=false;

# variables (no change)
$MA_BACKPAGE=false;
$MA_NOPAGE=false;
$MA_LOGGEDIN=false;
$MA_ADMIN_USER=false;
$MA_STYLEINDEX=0;
$MA_LOGOUT_IN_HEADER=true;
$MA_PRIVACY_PAGE=false;
$MA_SEARCH_PAGE=false;
$MA_COOKIE_USER="user";
$MA_COOKIE_PASS="pass";


?>
