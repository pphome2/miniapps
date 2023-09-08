<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #


function searchpage(){
	global $R_SEARCH_TEXT,$L_BUTTON_NEXT,$L_SEARCH;

	searchview($R_SEARCH_TEXT,$L_BUTTON_NEXT,$L_SEARCH);
}

function privacypage(){
	global $R_PRIVACYTITLE,$MA_APPPRIVACYFILE;

	privacyview($R_PRIVACYTITLE,$MA_APPPRIVACYFILE);
}


function printpage(){

	echo("<a href='start.php' style='text-decoration:none;color:black;'>");
	r_print();
	echo("</a>");
}


function r_header(){
	echo("<header></header>");
}


function r_footer(){
	echo("<footer></footer>");
}


function r_print(){
}


function r_data(){
  global $MA_MENU_FIELD,$MA_MENUCODE,$MA_USERNAME,$R_AVE,$MA_COPYRIGHT;

  $MA_COPYRIGHT=$MA_COPYRIGHT." [ ".$MA_USERNAME." ]";
  echo("<div class=spaceline></div>");
  echo("<div class=content>");
  if (isset($_GET[$MA_MENU_FIELD])){
    switch ($_GET[$MA_MENU_FIELD]){
      case $MA_MENUCODE[0]:
        r_partner();
        break;
      case $MA_MENUCODE[1]:
        r_cat();
        break;
      case $MA_MENUCODE[2]:
        r_iname();
        break;
      case $MA_MENUCODE[3]:
        r_raktar();
        break;
      case $MA_MENUCODE[4]:
        r_kolt();
        break;
      case $MA_MENUCODE[5]:
        r_in();
        break;
      case $MA_MENUCODE[6]:
        r_out();
        break;
      case $MA_MENUCODE[7]:
        r_list();
        break;
      case $MA_MENUCODE[8]:
        r_lel();
        break;
      case $MA_MENUCODE[9]:
        r_search();
        break;
      default:
        #echo("<h3>$R_AVE $MA_USERNAME !</h3>");
        r_table();
        break;
    }
  }else{
    sql_install();
    #sql_test();
    echo("<h3>$R_AVE $MA_USERNAME !</h3>");
	r_table();
  }
  echo("</div>");
  echo("<div class=spaceline></div>");
}

function r_view(){
	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function main(){
	r_header();
	r_data();
	r_footer();
}

function view(){
	#loadplugin("table");
	#loadplugin("cards");
	r_header();
	r_view();
	r_footer();
}


?>
