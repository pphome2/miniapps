<?php

 #
 # MiniApps
 #
 # info: main folder copyright file
 #
 #

# configuration
$MA_COPYRIGHT="<a href=https://demo.hu>Demo</a>";

# title, home link
$MA_SITENAME="Gépjármű nyílvántartás";
$MA_TITLE="GK";
$MA_CODENAME="gk";
$MA_ROOT_HOME="http://192.168.1.200";
$MA_ROOT_NAME="Intranet";
$MA_SITE_HOME="";
$MA_FAVICON="favicon.png";

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
$MA_APPFILE=array("$MA_LANGFILE",
				"gkcfg.php",
				"gkl.php",
				"gkcron.php",
				"gkt.php",
				"gk.php"
			);

$MA_APPCSSFILE=array("gk.css");
$MA_APPJSFILE=array("gk.js");
$MA_APPPRIVACYFILE="$MA_CONTENT_DIR/privacy.txt";

# users
$MA_USERS_CRED=array(
					array("admin","e3274be5c857fb42ab72d786e281b4b8")
				);

# SQL
$MA_SQL_SERVER="localhost";
$MA_SQL_DB="demo";
$MA_SQL_USER="demouser";
$MA_SQL_PASS="password";

?>
