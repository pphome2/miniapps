<?php

 #
 # MiniApp
 #
 # info: main folder copyright file
 #
 #


function searchpage(){
	global $M_TITLE,$M_BUTTON_TEXT,$M_SEARCH_TEXT;

	searchview($M_TITLE,$M_BUTTON_TEXT,$M_SEARCH_TEXT);
}


function privacypage(){
	global $M_TITLE,$M_PRIVACY_FILE;

	privacyview($M_TITLE,$M_PRIVACY_FILE);
}


function printpage(){
	global $first;

	echo("<a href='start.php' style='text-decoration:none;color:black;'>");
	$first=true;
	m_print();
	$first=false;
	#m_print();
	echo("</a>");
}


function m_header(){
	global $M_TITLE;

	echo("<header><h3>$M_TITLE</h3></header>");
}


function m_footer(){
	echo("<footer></footer>");
}


function m_data(){
	global $MA_MENU_FIELD,$M_MENUCODE;;

	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	if (isset($_GET[$MA_MENU_FIELD])){
		switch ($_GET[$MA_MENU_FIELD]){
			case $M_MENUCODE[0]:
				m_new();
				break;
			case $M_MENUCODE[1]:
				m_partner();
				break;
			case $M_MENUCODE[2]:
				m_cargo();
				break;
			case $M_MENUCODE[3]:
				m_archiv();
				break;
			case $M_MENUCODE[4]:
				m_list();
				break;
			default:
				m_table();
				break;
		}
	}else{
		m_table();
	}
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function m_view(){
	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function main(){
	m_header();
	m_data();
	m_footer();
}

function view(){
	m_header();
	m_view();
	m_footer();
}


?>
