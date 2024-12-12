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



echo("<span class=wswdteamspaceholder></span>");

// adatfeldolgozás
//$table_name=$wpdb->prefix.$wswdteam_table[0];
// if (isset($_POST['submit'])){}


// fejrész
wswdteam_upagehead();

//adatok
wswdteam_datatable();

// adattábla
function wswdteam_datatable(){
  global $wswdteam_options;

  echo("<span class=wswdteamspaceholder></span>");
  echo("<b>".wswdteam_lang("Rendszer paraméterek").":</b>");
  echo("<span class=wswdteamspaceholder></span>");
  $ver=get_option($wswdteam_options[0],'0');
  echo($wswdteam_options[0]." - ".$ver);
  echo("<br />");
  $ver=get_option($wswdteam_options[1],'0');
  echo($wswdteam_options[1]." - ".$ver);
  echo("<span class=wswdteamspaceholder></span>");
  echo("<b>".wswdteam_lang("Alkalmazás paraméterek").":</b>");
  echo("<span class=wswdteamspaceholder></span>");
  $ver=wswdteam_get_param($wswdteam_options[0]);
  echo($wswdteam_options[0]." - ".$ver);
  echo("<br />");
  $ver=wswdteam_get_param($wswdteam_options[1]);
  echo($wswdteam_options[1]." - ".$ver);
  echo("<br />");
  $ver=wswdteam_get_param("wswdteam_developer_mode");
  echo("wswdteam_developer_mode"." - ".$ver);
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
}


//fejléc
function wswdteam_upagehead(){
  echo("<br />");
  echo("<h1>".wswdteam_lang('WSWDTeam rendszer')."</h1>");
  echo("<br />");
  echo(wswdteam_lang('Beállítások'));
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
}


// új nyelvi elemek kiírása
echo(wswdteam_lang_newlines());

?>
