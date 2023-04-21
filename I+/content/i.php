<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #


function searchpage(){
	global $I_SEARCH_TEXT,$L_BUTTON_NEXT,$L_SEARCH;

	#searchview($I_SEARCH_TEXT,$L_BUTTON_NEXT,$L_SEARCH);
	i_search();
}


function privacypage(){
	global $I_PRIVACYTITLE,$MA_APPPRIVACYFILE;

	privacyview($I_PRIVACYTITLE,$MA_APPPRIVACYFILE);
}


function printpage(){

	echo("<a href='start.php' style='text-decoration:none;color:black;'>");
	m_print();
	echo("</a>");
}


function i_header(){
	echo("<header></header>");
}


function i_footer(){
	echo("<footer></footer>");
}


function i_table(){
	i_doctable();
}


function i_data(){
	global $MA_MENU_FIELD,$MA_MENUCODE;

	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	if (isset($_GET[$MA_MENU_FIELD])){
		switch ($_GET[$MA_MENU_FIELD]){
			case $MA_MENUCODE[0]:
				i_partner();
				break;
			case $MA_MENUCODE[1]:
				i_cat();
				break;
			case $MA_MENUCODE[2]:
				i_list();
				break;
			case $MA_MENUCODE[3]:
				i_search();
				break;
			default:
				i_table();
				break;
		}
	}else{
		sql_install();
		#sql_test();
		i_table();
	}
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function i_view(){
	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function main(){
	i_header();
	i_data();
	i_footer();
}

function view(){
	#loadplugin("table");
	#loadplugin("cards");
	i_header();
	i_view();
	i_footer();
}


?>
