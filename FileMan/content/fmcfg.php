<?php

 #
 # MiniApp - FileMan
 #
 # info: main folder copyright file
 #
 #

# language
$fmlang="$MA_CONTENT_DIR/$MA_LANGFILE";
if (file_exists($fmlang)){
	include($fmlang);
}
# app menu
$MA_MENU=array(
				#array($L_MENU1,"list.php")
			);
$MA_ADMINMENU=array(
				#array($L_MENU2,"list.php")
			);

# variables
$DF_USE_FILEEXT=true;
$DF_FILEEXT=array('mp3','mkv','avi','mp4','pdf','epub','sub','srt');

$DF_FILEDIR="Raktár";
$DF_EXCLUDEDIR=array('seccam');
$DF_DIR='./'.$DF_FILEDIR;

$DF_TEXT_EXT=".txt";

$DF_NAMELENGTH=30;

$DF_COMPACTDIR=true;


?>
