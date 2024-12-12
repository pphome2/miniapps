<?php

// option menu


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// admin script betöltés 
if (file_exists(__DIR__.'/wdhd_admin.css')){
  include(__DIR__.'/wdhd_admin.css');
}
if (file_exists(__DIR__.'/wdhd_admin.js')){
  include(__DIR__.'/wdhd_admin.js');
}

echo("<div class=wdhdspaceholder></div>");

// adatfeldolgozás
// if (isset($_POST['name'])){}

// fej
wdhd_upagehead();

// adat
wdhd_admin_backup();


// fő admin lap
function wdhd_admin_backup(){
  echo("<span class=wdhdspaceholder></span>");
  echo("<span class=wdhdspaceholder></span>");
  wdhd_backup();
}


//fejléc
function wdhd_upagehead(){
  echo("<br />");
  echo("<h1>".wdhd_lang('Adatmentés - visszaállítás')."</h1>");
  echo("<br />");
  echo("<span class=wdhdspaceholder></span>");
}


// új nyelvi elemek kiírása
echo(wdhd_lang_newlines());

?>
