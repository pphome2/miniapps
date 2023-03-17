<?php

 #
 # MiniApps
 #
 # info: main folder copyright file
 #
 #

# configuration
$MA_COPYRIGHT="© ".date("Y").". <a href=https://github.com/pphome2>I+</a>";

# title, home link
$MA_SITENAME="I+";
$MA_TITLE="I+";
$MA_CODENAME="ko";
$MA_ROOT_HOME="http://10.16.1.249";
$MA_ROOT_NAME="Intranet";
$MA_SITE_HOME="";
$MA_FAVICON="favicon.png";

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
$MA_APPFILE=array("$MA_LANGFILE",
				"$MA_LANGFILE",
				"icfg.php",
				"ic.php",
				"ip.php",
				"il.php",
				"id.php",
				"ipar.php",
				"i.php"
			);

$MA_APPCSSFILE=array("i.css");
$MA_APPJSFILE=array("i.js");
$MA_APPPRIVACYFILE="$MA_CONTENT_DIR/privacy.txt";

# SQL
$MA_SQL_SERVER="localhost";
$MA_SQL_DB="demo";
$MA_SQL_USER="admin";
$MA_SQL_PASS="";

?>
