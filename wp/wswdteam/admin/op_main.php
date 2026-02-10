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

// bálllítások érkezése
wswdteam_postdata();

//adatok
wswdteam_datatable();


function wswdteam_postdata(){
  global $wswdteam_maintenance_mode;

  if (isset($_POST['submit'])){
    if (isset($_POST['maintenance'])){
      $wswdteam_maintenance_mode=true;
      wswdteam_save_param("wswdteam_maintenance_mode","true");
    } else {
      $wswdteam_maintenance_mode=false;
      wswdteam_save_param("wswdteam_maintenance_mode","false");
    }
    if (isset($_POST['developer'])){
      $wswdteam_developer_mode=true;
      wswdteam_save_param("wswdteam_developer_mode","true");
    } else {
      $wswdteam_developer_mode=false;
      wswdteam_save_param("wswdteam_developer_mode","false");
    }
    //echo('<script type="text/javascript">location.reload();</script>');
  }
}


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
  $dev=wswdteam_get_param("wswdteam_developer_mode");
  echo("wswdteam_developer_mode"." - ".wswdteam_lang($dev));
  echo("<br />");
  $maint=wswdteam_get_param("wswdteam_maintenance_mode");
  echo("wswdteam_maintenance_mode"." - ".wswdteam_lang($maint));
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
  echo('<b>'.wswdteam_lang('Beállítások').'</b>');
  echo("<span class=wswdteamspaceholder></span>");
  echo('<form action="'.menu_page_url(__FILE__).'" method="post">');
  if ($dev==='true'){
    $checked='checked';
  } else {
    $checked='';
  }
  echo('<input type="checkbox" id="developer" name="developer" value="1" '.$checked.">");
  echo('<span>'.wswdteam_lang('Developer üzemmód bekapcsolása').'</span>');
  echo(' </label>');
  echo("<span class=wswdteamspaceholder></span>");
  echo('<label class="switch">');
  if ($maint==='true'){
    $checked='checked';
  } else {
    $checked='';
  }
  echo('<input type="checkbox" id="maintenance" name="maintenance" value="1" '.$checked.">");
  echo('<span>'.wswdteam_lang('Karbantartási üzemmód bekapcsolása').'</span>');
  echo(' </label>');
  submit_button(wswdteam_lang('Beállítások mentése'));
  echo('</form>');
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
