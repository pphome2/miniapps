<?php

 #
 # GK
 #
 # info: main folder copyright file
 #
 #


function searchpage(){
	global $L_TITLE,$MA_BUTTON_TEXT,$MA_SEARCH_TEXT;

	searchview($L_TITLE,$MA_BUTTON_TEXT,$MA_SEARCH_TEXT);
}


function privacypage(){
	global $F_PRIVACYTITLE,$MA_APPPRIVACYFILE;

	privacyview("",$MA_APPPRIVACYFILE);
}


function printpage(){

	echo("<a href='start.php' style='text-decoration:none;color:black;'>");
	gk_print();
	echo("</a>");
}


function gk_header(){
	echo("<header></header>");
}


function gk_footer(){
	echo("<footer></footer>");
}


function gk_print(){
}



function gk_data(){
	global $MA_MENU_FIELD,$MA_MENUCODE,$MA_COPYRIGHT,$GK_WELCOME_TEXT,$MA_USERNAME;

	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	if (isset($_GET[$MA_MENU_FIELD])){
		switch ($_GET[$MA_MENU_FIELD]){
			case $MA_MENUCODE[0]:
				gk_export();
				break;
			default:
				gk_table();
				break;
		}
	}else{
	    sql_install();
		gk_table();
	}
	$MA_COPYRIGHT=$MA_COPYRIGHT." - ".$GK_WELCOME_TEXT.$MA_USERNAME." !";
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function gk_view(){
	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function main(){
	gk_header();
	gk_data();
	gk_footer();
}

function cron(){
    gk_cron();
}

function view(){
	#loadplugin("table");
	#loadplugin("cards");
	gk_header();
	gk_view();
	gk_footer();
}


?>
