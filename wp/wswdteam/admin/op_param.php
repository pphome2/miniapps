<?php

// paraméterek beállítása


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// jogosultság ellenőrzése
$ur=wswdteam_user_right();
if (!in_array($ur,[0])){
  $l=wswdteam_lang('Nem megfelelő jogosultság');
  wswdteam_error($l);
  exit;
}



echo("<div class=wswdspaceholder></div>");

wswdteam_param_formdata();

// főbb funkciók
if (isset($_POST['new'])){
  // új adat gomb a táblából
  wswdteam_param_form();
}else{
  if (!isset($_POST['m'])){
    wswdteam_param_table();
    wswdteam_post_load();
    wswdteam_page_load();
  }
}



echo("<div class=wswdspaceholder></div>");



// adat formból, feldolgozás
function wswdteam_param_formdata(){
  global $wswdteam_option_data,$wswdteam_option_name;

  wswdteam_param_formdata_app($wswdteam_option_data,$wswdteam_option_name);
}



// adat form
function wswdteam_param_form(){
  wswdteam_param_form_app();
}


// adat tábla
function wswdteam_param_table(){
  global $wswdteam_option_data,$wswdteam_option_name;

  wswdteam_param_table_app($wswdteam_option_data,$wswdteam_option_name);
}





//fejléc
function wswdteam_param_pagehead(){
  wswdteam_param_pagehead_app();
}




// bejegyzése betöltése könyvtárból
function wswdteam_post_load(){
  global $wswdteam_dir_post,$wswdteam_locale;
  
  wswdteam_post_load_app(dirname(dirname(__FILE__)).$wswdteam_dir_post,$wswdteam_locale);
}



// lapok betöltése könyvtárból
function wswdteam_page_load(){
  global $wswdteam_dir_page,$wswdteam_locale;
  
  wswdteam_page_load_app(dirname(dirname(__FILE__)).$wswdteam_dir_page,$wswdteam_locale);
}


// új nyelvi elemek kiírása
echo(wswdteam_lang_newlines());


?>
