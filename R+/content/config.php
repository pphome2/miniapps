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
$MA_SITENAME="Raktar";
$MA_TITLE="R+";
$MA_CODENAME="ra";
$MA_ROOT_HOME="http://192.168.11.24";
$MA_ROOT_NAME="Demo";
$MA_SITE_HOME="";
$MA_FAVICON="favicon.png";

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
unset($MA_APPFILE);
$MA_APPFILE=array("","$MA_LANGFILE",
				"rcfg.php",
				"rp.php",
				"rc.php",
				"rr.php",
				"rk.php",
				"rpar.php",
				"rct.php",
				"rout.php",
				"rout2.php",
				"rin.php",
				"rin2.php",
				"rl.php",
				"rl0.php",
				"rl1.php",
				"rl2.php",
				"rl3.php",
				"rl4.php",
				"rt.php",
				"rs.php",
				"r.php"
			);

$MA_APPCSSFILE=array("r.css");
$MA_APPJSFILE=array("r.js");
$MA_APPPRIVACYFILE="$MA_CONTENT_DIR/privacy.txt";

# SQL
$MA_SQL_SERVER="localhost";
$MA_SQL_DB="demo";
$MA_SQL_USER="demo";
$MA_SQL_PASS="demopassword";

?>
