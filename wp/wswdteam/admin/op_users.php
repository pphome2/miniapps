<?php

// felhasználói jogok beállítása


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


// adatfeldolgozás
wswdteam_user_formdata();

// főbb funkciók
if (isset($_POST['new'])){
  // új adat gomb a táblából
  wswdteam_user_form();
}else{
  if (!isset($_POST['m'])){
    wswdteam_user_table();
  }
}



echo("<div class=wswdspaceholder></div>");



// adat formból, feldolgozás
function wswdteam_user_formdata(){
  global $wswdteam_option_user_data,$wswdteam_option_user_name;

  wswdteam_user_formdata_app($wswdteam_option_user_data,$wswdteam_option_user_name);
}



// adat form
function wswdteam_user_form(){
  global $wswdteam_option_user_data,$wswdteam_option_user_name;

  wswdteam_user_form_app($wswdteam_option_user_data,$wswdteam_option_user_name);
}



// adat tábla
function wswdteam_user_table(){
  global $wswdteam_option_user_data,$wswdteam_user_role_list,$wswdteam_option_user_name;

  wswdteam_user_table_app($wswdteam_option_user_data,$wswdteam_user_role_list,$wswdteam_option_user_name);
}



//fejléc
function wswdteam_user_pagehead(){
  wswdteam_user_pagehead_app();
}



// új nyelvi elemek kiírása
echo(wswdteam_lang_newlines());



?>
