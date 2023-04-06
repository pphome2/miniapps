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
$MA_SITENAME="Demo";
$MA_TITLE="Demo";
$MA_CODENAME="fm";
$MA_ROOT_HOME="https://google.com";
$MA_ROOT_NAME="Google";
$MA_SITE_HOME="";
$MA_DOCTYPE="<!DOCTYPE HTML>";
$MA_SITEURL=basename($_SERVER['PHP_SELF']);

# directories
$MA_CONFIG_DIR="config";
$MA_INCLUDE_DIR="inc";
$MA_CONTENT_DIR="content";
$MA_PLUGIN_DIR="plugins";

# cookies
$MA_COOKIE_STYLE=$MA_CODENAME."st";
$MA_COOKIE_LOGIN=$MA_CODENAME."u";

# include files
$MA_ADMINFILE="start.php";
$MA_VIEWFILE="view.php";
$MA_SEARCHFILE="search.php";
$MA_PRIVACYFILE="privacy.php";
$MA_PRINTFILE="print.php";

$MA_FAVICON="favicon.png";

$MA_CSS=array(
			"siteb.css",
			"sitew.css"
			);
$MA_ENABLE_SYSTEM_CSS=true;
$MA_CSSPRINT="sitepr.css";

$MA_JS_BEGIN="js_begin.js";
$MA_JS_END="js_end.js";
$MA_ENABLE_SYSTEM_JS=true;

$MA_HEADER="header.php";
$MA_FOOTER="footer.php";
$MA_HEADER_VIEW="header_view.php";
$MA_FOOTER_VIEW="footer_view.php";

$MA_LIB=array(
			"lib.php",
			"libadmin.php",
			"libview.php",
			"libsql.php"
			);

# SQL
$MA_SQL_SERVER="";
$MA_SQL_DB="";
$MA_SQL_USER="";
$MA_SQL_PASS="";
$MA_SQL_ERROR="";
$MA_SQL_RESULT=array();
$MA_SQL_FILE="inst.sql";

# pages
$MA_ENABLE_PRIVACY=true;
$MA_ENABLE_PRINT=true;
$MA_ENABLE_SEARCH=true;
$MA_ENABLE_THEME=true;

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
$MA_APPFILE=array("config.php");
$MA_APPCSSFILE=array("");
$MA_APPJSFILE=array("");
$MA_APPPRIVACYFILE="";

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
$MA_USERNAME="";
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
# footer menu
$MA_FOOTERMENU=array();
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
