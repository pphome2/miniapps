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

  echo("<span class=wdhdspaceholder></span>");
  echo("<b>".wdhd_lang("Rendszer paraméterek").":</b>");
  echo("<span class=wdhdspaceholder></span>");
  $ver=get_option($wdhd_options[0],'0');
  echo($wdhd_options[0]." - ".$ver);
  echo("<br />");
  $ver=get_option($wdhd_options[1],'0');
  echo($wdhd_options[1]." - ".$ver);
  echo("<span class=wdhdspaceholder></span>");
  echo("<b>".wdhd_lang("Alkalmazás paraméterek").":</b>");
  echo("<span class=wdhdspaceholder></span>");
  $ver=wdhd_get_param($wdhd_options[0]);
  echo($wdhd_options[0]." - ".$ver);
  echo("<br />");
  $ver=wdhd_get_param($wdhd_options[1]);
  echo($wdhd_options[1]." - ".$ver);
  echo("<span class=wdhdspaceholder></span>");
  echo("<span class=wdhdspaceholder></span>");
  echo("<b>".wdhd_lang("Alkalmazás adatok").":</b>");
  echo("<span class=wdhdspaceholder></span>");
  $t=wdhd_get_param("cím");
  if (isset($_POST['submit'])){
    wdhd_save_param("cím",$_POST['text']);
    echo(wdhd_message("Adatok elmentve"));
    echo($t);
  }else{
    echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<label for=\"text\">".wdhd_lang('Címadatok munkalapra').":</label><br>");
    echo("<textarea id=text name=text class=wdhdinputtexta rows=10 >$t</textarea>");
    echo("<br />");
    echo("<input type=\"submit\" class=\"button\" id=\"submit\" name=\"submit\" value=\"".wdhd_lang('Mehet')."\">");
    echo("</form>");
  }
  echo("<span class=wdhdspaceholder></span>");
  echo("<span class=wdhdspaceholder></span>");
  wdhd_backup();
}


//fejléc
function wdhd_upagehead(){
  echo("<br />");
  echo("<h1>".wdhd_lang('WD HD helpdesk rendszer')."</h1>");
  echo("<br />");
  echo("<b>".wdhd_lang('Beállítások')."</b>");
  echo("<span class=wdhdspaceholder></span>");
}


// új nyelvi elemek kiírása
wdhd_lang_newlines();

?>
