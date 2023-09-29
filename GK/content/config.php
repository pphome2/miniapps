<?php

 #
 # MiniApps
 #
 # info: main folder copyright file
 #
 #

# configuration
$MA_COPYRIGHT="<a href=https://derula.hu>Derula</a>";

# title, home link
$MA_SITENAME="Gépjármű nyílvántartás";
$MA_TITLE="GK";
$MA_CODENAME="gk";
$MA_ROOT_HOME="http://10.16.1.222";
$MA_ROOT_NAME="Derula";
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
					array("admin","e3274be5c857fb42ab72d786e281b4b8"),
					array("Máté","4909a2ba236087056ae2c12af3fe04ac"),
					array("Dávid","abcdd21a428f21eb27f11ac560f9cf1c"),
					array("Gábor","6eea48f4a49ae335f1788ff56bafaa74"),
					array("Imre","e60e44d0764cce6277b8289ff0af876d"),
					array("Derula","3dfcc3705e01fa98e3c00efc3b65409d")
				);

# SQL
$MA_SQL_SERVER="localhost";
$MA_SQL_DB="derula";
$MA_SQL_USER="derulait";
$MA_SQL_PASS="D3rula@!";

?>
