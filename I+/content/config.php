<?php

 #
 # MiniApps
 #
 # info: main folder copyright file
 #
 #

# configuration
$MA_COPYRIGHT="<a href=https://google.com>Google</a>";

# title, home link
$MA_SITENAME="Ikt";
$MA_TITLE="I+";
$MA_CODENAME="ik";
$MA_ROOT_HOME="http://10.16.1.249";
$MA_ROOT_NAME="Demo";
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
				"is.php",
				"il.php",
				"ild.php",
				"ilp.php",
				"id.php",
				"id2.php",
				"ipar.php",
				"i.php"
			);

$MA_APPCSSFILE=array("i.css");
$MA_APPJSFILE=array("i.js");
$MA_APPPRIVACYFILE="$MA_CONTENT_DIR/privacy.txt";

# SQL
$MA_SQL_SERVER="localhost";
$MA_SQL_DB="demo";
$MA_SQL_USER="demo";
$MA_SQL_PASS="demopassword";

?>
