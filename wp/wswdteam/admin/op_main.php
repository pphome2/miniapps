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
// vagy html:
// <script>alert("X");</script>
// <style>label{text-align:center;color:red;}</style>



echo("<div class=wswdspaceholder></div>");

// adatfeldolgozás
//$table_name=$wpdb->prefix.$wswdteam_table[0];
// if (isset($_POST['submit'])){}


// fejrész
wswdteam_upagehead();


// adattábla
function wswdteam_datatable(){
}


//fejléc
function wswdteam_upagehead(){
  echo("<br />");
  echo("<h1>".wswdteam_lang('WSWDTeam rendszer')."</h1>");
  echo("<br />");
  echo(wswdteam_lang('Beállítások'));
  echo("<br />");
  echo("<br />");
  echo("<br />");
}


// új nyelvi elemek kiírása
wswdteam_lang_newlines();

?>
