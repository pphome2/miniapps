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
// vagy html:
// <script>alert("X");</script>
// <style>label{text-align:center;color:red;}</style>

// adatfeldolgozás

wdhd_upagehead();


//fejléc
function wdhd_upagehead(){
  echo("<br />");
  echo("<h1>".wdhd_lang('wdhd rendszer')."</h1>");
  echo("<br />");
  echo(wdhd_lang('Beállítások'));
  echo("<br />");
  echo("<br />");
  echo("<br />");
}


// új nyelvi elemek kiírása
wdhd_lang_newlines();

?>
