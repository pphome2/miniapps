<?php

 #
 # Fájlok
 #
 # info: main folder copyright file
 #
 #


function searchpage(){
	global $F_TITLE,$MA_BUTTON_TEXT,$MA_SEARCH_TEXT;

	searchview($F_TITLE,$MA_BUTTON_TEXT,$MA_SEARCH_TEXT);
}


function privacypage(){
	global $F_PRIVACYTITLE,$MA_APPPRIVACYFILE;

	privacyview("",$MA_APPPRIVACYFILE);
}


function printpage(){

	echo("<a href='start.php' style='text-decoration:none;color:black;'>");
	f_print();
	echo("</a>");
}


function f_header(){
	echo("<header></header>");
}


function f_footer(){
	echo("<footer></footer>");
}


function f_print(){
}



function f_data(){
	global $MA_MENU_FIELD,$MA_MENUCODE;

	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	sql_install();
	#sql_test();
	f_table();
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function f_view(){
	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function main(){
	f_header();
	f_data();
	f_footer();
}

function view(){
	#loadplugin("table");
	#loadplugin("cards");
	f_header();
	f_view();
	f_footer();
}


?>
