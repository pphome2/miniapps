<?php

 #
 # MiniApps
 #
 # info: main folder copyright file
 #
 #

# configuration
$MA_COPYRIGHT="© ".date("Y").". <a href=https://tulajceg.hu>TulajCég</a>";

# title, home link
$MA_SITENAME="DM";
$MA_TITLE="DMérleg";
$MA_CODENAME="dm";
$MA_ROOT_HOME="http://192.168.1.240";
$MA_ROOT_NAME="Tulajcég";
$MA_SITE_HOME="";

$MA_FAVICON="favicon.png";

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
$MA_APPFILE=array(
				"$MA_CONTENT_DIR/config.php",
				"$MA_CONTENT_DIR/mcfg.php",
				"$MA_CONTENT_DIR/mprint.php",
				"$MA_CONTENT_DIR/mtable.php",
				"$MA_CONTENT_DIR/mdata.php",
				"$MA_CONTENT_DIR/marchiv.php",
				"$MA_CONTENT_DIR/mnew.php",
				"$MA_CONTENT_DIR/mlist.php",
				"$MA_CONTENT_DIR/m.php",
				"$MA_CONTENT_DIR/$MA_LANGFILE"
			);
$MA_APPCSSFILE=array("$MA_CONTENT_DIR/m.css");
$MA_APPJSFILE=array("$MA_CONTENT_DIR/m.js");
$MA_APPPRIVACYFILE="$MA_CONTENT_DIR/privacy.txt";

?>
