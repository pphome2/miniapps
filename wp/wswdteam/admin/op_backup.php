<?php

// option menu


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// admin script betöltés 
if (file_exists(__DIR__.'/wswdteam_admin.css')){
  include(__DIR__.'/wswdteam_admin.css');
}
if (file_exists(__DIR__.'/wswdteam_admin.js')){
  include(__DIR__.'/wswdteam_admin.js');
}

echo("<span class=wswdteamspaceholder></span>");

// adatfeldolgozás
// if (isset($_POST['name'])){}

// fej
wswdteam_upagehead();

// adat
wswdteam_admin_backup();


// fő admin lap
function wswdteam_admin_backup(){
  echo("<span class=wswdteamspaceholder></span>");
  wswdteam_backup();
}


//fejléc
function wswdteam_upagehead(){
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
  echo("<h1>".wswdteam_lang('Adatmentés - visszaállítás')."</h1>");
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
}


// új nyelvi elemek kiírása
wswdteam_lang_newlines();

?>
