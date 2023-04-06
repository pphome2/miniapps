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
$MA_SITENAME="Filelis";
$MA_TITLE="FL";
$MA_CODENAME="fl";
$MA_ROOT_HOME="http://10.16.1.249";
$MA_ROOT_NAME="Google";
$MA_SITE_HOME="";
$MA_FAVICON="favicon.png";

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
unset($MA_APPFILE);
$MA_APPFILE=array("","$MA_LANGFILE",
				"fcfg.php",
				"f1.php",
				"f.php"
			);

$MA_APPCSSFILE=array("f.css");
$MA_APPJSFILE=array("f.js");
$MA_APPPRIVACYFILE="$MA_CONTENT_DIR/privacy.txt";

$MA_USERS_CRED=array(
					array("admin","e3274be5c857fb42ab72d786e281b4b8"),
					array("user","5f4dcc3b5aa765d61d8327deb882cf99"),
					array("fouser","3dfcc3705e01fa98e3c00efc3b65409d")
				);

?>
