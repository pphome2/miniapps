<?php

// WSWDTEAM plugin kapcsolat

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}




//
// paraméterek kezelése
//

// paraméter mentése
function wdhd_save_param($name="",$data=""){
  global $wdhd_table;

  if (function_exists('wswdteam_save_param_app')){
    wswdteam_save_param_app($wdhd_table,$name,$data);
  }
}


// paraméter beolvasása
function wdhd_get_param($name=""){
  global $wdhd_table;

  $r='';
  if (function_exists('wswdteam_get_param_app')){
    $r=wswdteam_get_param_app($wdhd_table,$name);
  }
  return($r);
}






//
// jogosultságok lekérése
//

// jogosultság lekérdezése
function wdhd_user_right(){
  global $wdhd_table,$wpdb,$wdhd_user_name;

  $cuser=wp_get_current_user();
  $wdhd_user_name=$cuser->user_login;
  $us="";
  if (function_exists('wswdteam_user_right_app')){
    $us=wswdteam_user_right_app($wdhd_table);
  }
  return($us);
}


// felhasználó neve
function wdhd_user_nicename(){
  $r="";
  if (function_exists('wswdteam_user_nicename')){
    $r=wswdteam_user_nicename();
  }
  return($r);
}


// felhasználó neve
function wdhd_user_nickname(){
  $r="";
  if (function_exists('wswdteam_user_nickname')){
    $r=wswdteam_user_nickname();
  }
  return($r);
}


// felhasználó neve
function wdhd_user_fullname(){
  $r="";
  if (function_exists('wswdteam_user_fullname')){
    $r=wswdteam_user_fullname();
  }
  return($r);
}







//
// nyelvi függvények
//

// nyelvi fordítás
function wdhd_lang($text){
  global $wdhd_lang_str;

  $t='';
  if (function_exists('wswdteam_lang_app')){
    $t=wswdteam_lang_app($text,$wdhd_lang_str);
  }
  return($t);
}


// új fordítandók kiírása
function wdhd_lang_newlines(){  
  $t='';
  if (function_exists('wswdteam_lang_newlines_app')){
    $t=wswdteam_lang_newlines_app();
  }
  return($t);
}






//
// post lista és a post megjelenítése
//

// post lista kategória alapján
function wdhd_postlist($cat=""){
  $c='';
  if (function_exists('wswdteam_postlist')){
    $c=wswdteam_postlist($cat);
  }else{
    $t=wdhd_lang('HIBA: nincs megjeleníthető elem');
    wdhd_action_errormessage($t);
  }
  return($c);
}


// bejegyzések listája és megjelenítése
function wdhd_postlist_view($cat=""){
  $c='';
  if (function_exists('wswdteam_postlist_view')){
    $c=wswdteam_postlist_view($cat);
  }else{
    $t=wdhd_lang('HIBA: nincs megjeleníthető elem');
    wdhd_action_errormessage($t);
  }
  return($c);
}






//
// lapozó műveletek
//

// lapozó admin felületen
function wdhd_pager_admin($db=0,$row=0,$apage=0,$formid=""){
  if (function_exists('wswdteam_pager_admin')){
    wswdteam_pager_admin($db=0,$row=0,$apage=0,$formid="");
  }
}


// lapozó felhasználói felületen
function wdhd_pager($db=0,$row=0,$apage=0,$formid="",$little=false){
  if (function_exists('wswdteam_pager')){
    wswdteam_pager($db=0,$row=0,$apage=0,$formid="",$little=false);
  }
}






//
// Üzenetek
//

// üzenet
function wdhd_action_message($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_action_message')){
    $text=wdhd_lang($text);
    wswdteam_action_message($text,$wdhd_message_autohide);
  }
}

// üzenet
function wdhd_action_errormessage($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_action_errormessage')){
    $text=wdhd_lang($text);
    wswdteam_action_errormessage($text,$wdhd_message_autohide);
  }
}


// notice-success – zöld bal keret - is-dismissible - x bezárás
function wdhd_message($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_message')){
    $text=wdhd_lang($text);
    wswdteam_message($text,$wdhd_message_autohide);
  }
}

// notice-error – vörös bal keret
function wdhd_error($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_error')){
    $text=wdhd_lang($text);
    wswdteam_error($text,$wdhd_message_autohide);
  }
}

// notice-warning– sárga bal keret
function wdhd_warning($text,$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_warning')){
    $text=wdhd_lang($text);
    wswdteam_warning($text,$wdhd_message_autohide);
  }
}

// notice-success – zöld bal keret
function wdhd_success($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_success')){
    $text=wdhd_lang($text);
    wswdteam_success($text,$wdhd_message_autohide);
  }
}

// notice-info – kék bal keret
function wdhd_info($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_info')){
    $text=wdhd_lang($text);
    wswdteam_info($text,$wdhd_message_autohide);
  }
}

?>