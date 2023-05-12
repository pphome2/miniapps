<?php

 #
 # Dokumentum
 #
 # info: main folder copyright file
 #
 #


function searchpage(){
	global $I_SEARCH_TEXT,$L_BUTTON_NEXT,$L_SEARCH;

	#searchview($I_SEARCH_TEXT,$L_BUTTON_NEXT,$L_SEARCH);
	d_search();
}


function privacypage(){
	global $I_PRIVACYTITLE,$MA_APPPRIVACYFILE;

	privacyview($I_PRIVACYTITLE,$MA_APPPRIVACYFILE);
}


function printpage(){

	echo("<a href='start.php' style='text-decoration:none;color:black;'>");
	d_print();
	echo("</a>");
}


function d_header(){
	echo("<header></header>");
}


function d_footer(){
	echo("<footer></footer>");
}


function d_table(){
	d_doc();
}


function d_data(){
	global $MA_MENU_FIELD,$MA_MENUCODE;

	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	if (isset($_GET[$MA_MENU_FIELD])){
		switch ($_GET[$MA_MENU_FIELD]){
			case $MA_MENUCODE[0]:
				d_newdoc();
				break;
			default:
				d_table();
				break;
		}
	}else{
		sql_install();
		#sql_test();
		d_table();
	}
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function d_view(){
	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function main(){
	d_header();
	d_data();
	d_footer();
}

function view(){
	#loadplugin("table");
	#loadplugin("cards");
	d_header();
	d_view();
	d_footer();
}


?>
