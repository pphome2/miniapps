<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #


function searchpage(){
	global $I_TITLE,$MA_BUTTON_TEXT,$MA_SEARCH_TEXT;

	searchview($I_TITLE,$MA_BUTTON_TEXT,$MA_SEARCH_TEXT);
}


function privacypage(){
	global $I_PRIVACYTITLE,$MA_APPPRIVACYFILE;

	privacyview("",$MA_APPPRIVACYFILE);
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
	global $MA_MENU_FIELD,$I_MENUCODE;

	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	if (isset($_GET[$MA_MENU_FIELD])){
		switch ($_GET[$MA_MENU_FIELD]){
			case $I_MENUCODE[0]:
				i_partner();
				break;
			case $I_MENUCODE[1]:
				i_cat();
				break;
			case $I_MENUCODE[2]:
				i_list();
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
