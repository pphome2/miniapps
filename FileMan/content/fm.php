<?php

 #
 # MiniApp - demo
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
	global $FM_TITLE;

	echo("<header><h3>$FM_TITLE</h3></header>");
}


function fm_footer(){
	echo("<header></header>");
}


function fm_data(){
	global $FM_FILEDIR;

	echo("$FM_FILEDIR");
	echo("<div class=spaceline></div>");
	echo("<div class=row>");
	echo("<div class=col3-2>");
	echo("<div class=box>");
	fm_dl($FM_FILEDIR,$FM_EXT);
	echo("</div>");
	echo("</div>");
	echo("<div class=col3-1>");
	echo("<div class=box>");
	echo("2");
	echo("</div>");
	echo("</div>");
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function main(){
	fm_header();
	if (isset($_GET['i'])){
		fm_data();
	}else{
		fm_data();
	}
	fm_footer();
}


?>
