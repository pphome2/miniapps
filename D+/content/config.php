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
$MA_SITENAME="Dok";
$MA_TITLE="D+";
$MA_CODENAME="do";
$MA_ROOT_HOME="http://10.16.1.249";
$MA_ROOT_NAME="Dmo";
$MA_SITE_HOME="";
$MA_FAVICON="favicon.png";

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
$MA_APPFILE=array("$MA_LANGFILE",
				"$MA_LANGFILE",
				"dcfg.php",
				"dd.php",
				"dn.php",
				"dpar.php",
				"d.php"
			);

$MA_APPCSSFILE=array("d.css");
$MA_APPJSFILE=array("d.js");
$MA_APPPRIVACYFILE="$MA_CONTENT_DIR/privacy.txt";

# SQL
$MA_SQL_SERVER="localhost";
$MA_SQL_DB="demo";
$MA_SQL_USER="demo";
$MA_SQL_PASS="demopassword";

?>
