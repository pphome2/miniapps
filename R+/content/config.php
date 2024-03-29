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
$MA_ROOT_HOME="http://192.168.10.249";
$MA_ROOT_NAME="Home";
$MA_SITE_HOME="";
$MA_FAVICON="favicon.png";

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
unset($MA_APPFILE);
$MA_APPFILE=array("$MA_LANGFILE",
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
				"rl5.php",
				"rl6.php",
				"rt.php",
				"rs.php",
				"rle.php",
				"r.php"
			);

$MA_APPCSSFILE=array("r.css");
$MA_APPJSFILE=array("r.js");
$MA_APPPRIVACYFILE="$MA_CONTENT_DIR/privacy.txt";

# users
$MA_USERS_CRED=array(
					array("admin","e3274be5c857fb42ab72d786e281b4b8"),
					array("user","5f4dcc3b5aa765d61d8327deb882cf99")
				);

# SQL
$MA_SQL_SERVER="localhost";
$MA_SQL_DB="demo";
$MA_SQL_USER="demo";
$MA_SQL_PASS="demopassword";

?>
