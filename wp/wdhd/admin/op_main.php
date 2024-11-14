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



echo("<div class=wdhdspaceholder></div>");

// adatfeldolgozás
// if (isset($_POST['name'])){}

// fej
wdhd_upagehead();

// adat
wdhd_admin_main();


// fő admin lap
function wdhd_admin_main(){
  global $wdhd_options;

  echo("<br />");
  echo("<br />");
  echo(wdhd_lang("Rendszer paraméterek").":<br /><br />");
  $ver=get_option($wdhd_options[0],'0');
  echo($wdhd_options[0]." - ".$ver);
  echo("<br />");
  $ver=get_option($wdhd_options[1],'0');
  echo($wdhd_options[1]." - ".$ver);
  echo("<br />");
  echo("<br />");
  echo(wdhd_lang("Alkalmazás paraméterek").":<br /><br />");
  $ver=wdhd_get_param($wdhd_options[0]);
  echo($wdhd_options[0]." - ".$ver);
  echo("<br />");
  $ver=wdhd_get_param($wdhd_options[1]);
  echo($wdhd_options[1]." - ".$ver);
  echo("<br />");
  echo("<br />");
}


//fejléc
function wdhd_upagehead(){
  echo("<br />");
  echo("<h1>".wdhd_lang('WD HD helpdesk rendszer')."</h1>");
  echo("<br />");
  echo(wdhd_lang('Beállítások'));
  echo("<br />");
  echo("<br />");
  echo("<br />");
}


// új nyelvi elemek kiírása
wdhd_lang_newlines();

?>
