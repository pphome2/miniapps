<?php

 #
 # MiniApp - FileMan
 #
 # info: main folder copyright file
 #
 #


function searchpage(){
	echo("search page");
}


function privacypage(){
	echo("privacy page");
}


function printpage(){
	echo("print page");
}


function fm_header(){
	global $DF_TITLE;

	echo("<header><h3>$DF_TITLE</h3></header>");
}


function fm_footer(){
	echo("<header></header>");
}


function fm_data(){
	fm_admin();
	echo("<div class=spaceline></div>");
	echo("<div class=row>");
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

function main(){
	fm_header();
	fm_data();
	fm_footer();
}


?>
