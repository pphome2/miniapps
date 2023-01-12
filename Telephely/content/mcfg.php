<?php

 #
 # MiniApp
 #
 # info: main folder copyright file
 #
 #

$M_OWNER="Tulajcég ZRt., 1XX0, Budapest, Kocsiskabát út 121.";

# language
$fmlang="$MA_CONTENT_DIR/$MA_LANGFILE";
if (file_exists($fmlang)){
	include($fmlang);
}

$M_MENUCODE=array("n","p","a","ar","l");

# app menu
$MA_MENU=array(
		array($M_MENU[0],$M_MENUCODE[0]),
		array($M_MENU[1],$M_MENUCODE[1]),
		array($M_MENU[2],$M_MENUCODE[2]),
		array($M_MENU[3],$M_MENUCODE[3]),
		array($M_MENU[4],$M_MENUCODE[4])
			);
$MA_ADMINMENU=array(
				#array($L_MENU2,"list.php")
			);

# variables
$M_DATA_DIR="Data";

$M_PRIVACY_FILE=$MA_APPPRIVACYFILE;

$M_PARTNER_FILE="$M_DATA_DIR/_partner";
$M_CARGO_FILE="$M_DATA_DIR/_cargo";
$M_TODAY_FILE="$M_DATA_DIR/".date('Y')."/".date('Ymd');

$M_SEPARATOR="|";
$M_ID_FIELD="id";

$first=true;

?>
