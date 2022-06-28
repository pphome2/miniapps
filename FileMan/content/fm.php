<?php

 #
 # MiniApp - FileMan
 #
 # info: main folder copyright file
 #
 #


function searchpage(){
	global $DF_TITLE;

	echo("<header><h3>$DF_TITLE</h3></header>");
}


function privacypage(){
	global $DF_TITLE;

	echo("<header><h3>$DF_TITLE</h3></header>");
}


function printpage(){
	global $DF_TITLE;

	echo("<header><h3>$DF_TITLE</h3></header>");
}


function fm_header(){
	global $DF_TITLE;

	echo("<header><h3>$DF_TITLE</h3></header>");
}


function fm_header_view(){
	global $DF_TITLE_VIEW;

	echo("<header><h3>$DF_TITLE_VIEW</h3></header>");
}


function fm_footer(){
	echo("<footer></footer>");
}


function fm_data(){
	fm_admin();
	echo("<div class=spaceline></div>");
	echo("<div class=row100>");
	echo("<div class=col3-2>");
	echo("<div class=box>");
	fm_dl();
	echo("</div>");
	echo("</div>");
	echo("<div class=col3-1>");
	echo("<div class=box>");
	fm_up();
	echo("</div>");
	echo("</div>");
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function fm_view(){
	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	fm_dl();
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function main(){
    loadplugin("table");
    loadplugin("cards");
	fm_header();
	fm_data();
	fm_footer();
}

function view(){
    loadplugin("table");
    loadplugin("cards");
	fm_header_view();
	fm_view();
	fm_footer();
}


?>
