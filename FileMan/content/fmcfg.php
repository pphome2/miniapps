<?php

 #
 # MiniApp - FileMan
 #
 # info: main folder copyright file
 #
 #

$DF_USE_FILEEXT=true;
$DF_FILEEXT=array('mp3','mkv','avi','mp4','pdf','epub','sub','srt');

$DF_FILEDIR="Raktár";
$DF_EXCLUDEDIR=array('seccam');
$DF_DIR='./'.$DF_FILEDIR;

$DF_NAMELENGTH=30;

$DF_COMPACTDIR=true;

$fmlang="$MA_CONTENT_DIR/$MA_LANGFILE";
if (file_exists($fmlang)){
	include($fmlang);
}


?>
