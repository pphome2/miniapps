<?php

 #
 # MiniApps
 #
 # info: main folder copyright file
 #
 #

# configuration
$MA_COPYRIGHT="© ".date("Y").". <a href=https://gogle.com>Google</a>";

# title, home link
$MA_SITENAME="DM";
$MA_TITLE="DMérleg";
$MA_CODENAME="dm";
$MA_ROOT_HOME="http://192.168.10.24";
$MA_ROOT_NAME="Demo";
$MA_SITE_HOME="";

$MA_FAVICON="favicon.png";

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
$MA_APPFILE=array("",
				"$MA_LANGFILE",
				"mcfg.php",
				"mprint.php",
				"mtable.php",
				"mdata.php",
				"marchiv.php",
				"mnew.php",
				"mlist.php",
				"m.php"
			);
$MA_APPCSSFILE=array("m.css");
$MA_APPJSFILE=array("m.js");
$MA_APPPRIVACYFILE="privacy.txt";

?>
