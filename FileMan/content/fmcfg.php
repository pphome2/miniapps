<?php

 #
 # MiniApp - FileMan
 #
 # info: main folder copyright file
 #
 #

$DF_USE_FILEEXT=true;
$DF_FILEEXT=array('mp3','mkv','avi','mp4','pdf','epub');
$DF_FILEDIR="Raktár";
$DF_DIR='./'.$DF_FILEDIR;


$fmlang="$MA_CONTENT_DIR/$MA_LANGFILE";
if (file_exists($fmlang)){
	include($fmlang);
}


?>
