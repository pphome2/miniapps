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
$MA_SITENAME="Számlák";
$MA_TITLE="SZ+";
$MA_CODENAME="sz";
$MA_ROOT_HOME="http://10.16.1.249";
$MA_ROOT_NAME="Demo";
$MA_SITE_HOME="";
$MA_FAVICON="favicon.png";

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
unset($MA_APPFILE);
$MA_APPFILE=array("$MA_LANGFILE",
				"fcfg.php",
				"f1.php",
				"f.php"
			);

$MA_APPCSSFILE=array("f.css");
$MA_APPJSFILE=array("f.js");
$MA_APPPRIVACYFILE="$MA_CONTENT_DIR/privacy.txt";

$MA_USERS_CRED=array(
					array("user","e3274be5c857fb42ab72d786e281b4b8"),
					array("user2","5f4dcc3b5aa765d61d8327deb882cf99")
				);

?>
