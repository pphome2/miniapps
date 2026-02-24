<?php

// option menu


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// szükséges plugin ellenőrzés
if (!defined('WSWDTEAM')){
  exit;
}




// adatfeldolgozás
// if (isset($_POST['name'])){}

// fej
wdhd_upagehead();

// adat
wdhd_admin_main();


// fő admin lap
function wdhd_admin_main(){
  global $wdhd_options,$wdhd_option_name,$wdhd_developer_mode;

  $data=wswdteam_get_option($wdhd_option_name);
  echo("<span class=wdhdspaceholder></span>");
  // paraméterek
  echo("<b>".wdhd_lang("Rendszer paraméterek").":</b>");
  echo("<span class=wdhdspaceholder></span>");
  $d=$wdhd_options[0];
  if (isset($data[$d])){
    $ver=$data[$d];
  }else{
    $ver="-";
  }
  echo($wdhd_options[0]." - ".$ver);
  echo("<br />");
  $d=$wdhd_options[1];
  if (isset($data[$d])){
    $ver=$data[$d];
  }else{
    $ver="-";
  }
  echo($wdhd_options[1]." - ".$ver);
  echo("<span class=wdhdspaceholder></span>");
  echo("<b>".wdhd_lang("Alkalmazás paraméterek").":</b>");
  echo("<span class=wdhdspaceholder></span>");
  $d=$wdhd_options[0];
  if (isset($data[$d])){
    $ver=$data[$d];
  }else{
    $ver="-";
  }
  echo($wdhd_options[0]." - ".$ver);
  echo("<br />");
  $d=$wdhd_options[1];
  if (isset($data[$d])){
    $ver=$data[$d];
  }else{
    $ver="-";
  }
  echo($wdhd_options[1]." - ".$ver);
  echo("<br />");
  //$d=$wdhd_options[1];
  //if (isset($data['wdhd_developer_mode'])){
  //  $ver=$data[$d];
  //}else{
  //  $ver="-";
  //}
  if ($wdhd_developer_mode){
    echo("wdhd_developer_mode"." - ".wdhd_lang('true'));
  }else{
    echo("wdhd_developer_mode"." - ".wdhd_lang('false'));
  }
  echo("<span class=wdhdspaceholder></span>");
  // alkalmazás
  echo("<span class=wdhdspaceholder></span>");
  echo("<b>".wdhd_lang("Alkalmazás adatok").":</b>");
  echo("<span class=wdhdspaceholder></span>");
  if (isset($data['wdhd_sp'])){
    $t=$data['wdhd_sp'];
  }else{
    $t="-";
  }
  if (isset($_POST['submit'])){
    wswdteam_add_option("wdhd_sp",$_POST['text'],$wdhd_option_name);
    $t=$_POST['text'];
    echo(wdhd_message("Adatok elmentve").'<br />');
  }
  echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
  echo("<label for=\"text\">".wdhd_lang('Címadatok munkalapra').":</label><br>");
  echo("<textarea id=text name=text class=wdhdinputtexta rows=10 >$t</textarea>");
  //echo("<br />");
  //echo("<input type=\"submit\" class=\"button\" id=\"submit\" name=\"submit\" value=\"".wdhd_lang('Mehet')."\">");
  submit_button();
  echo("</form>");
  echo("<span class=wdhdspaceholder></span>");
  echo("<span class=wdhdspaceholder></span>");
}


//fejléc
function wdhd_upagehead(){
  echo("<span class=wdhdspaceholder></span>");
  echo("<br />");
  echo("<h1>".wdhd_lang('WD HD helpdesk rendszer')."</h1>");
  echo("<br />");
  echo("<b>".wdhd_lang('Beállítások')."</b>");
  echo("<span class=wdhdspaceholder></span>");
}


// új nyelvi elemek kiírása
echo(wdhd_lang_newlines());

?>
