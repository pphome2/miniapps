<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// üzenet
function wdhd_action_message($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_action_message')){
    $text=wdhd_lang($text);
    wdhd_action_message($text="",$wdhd_message_autohide);
  }
}

// üzenet
function wdhd_action_errormessage($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_action_errormessage')){
    $text=wdhd_lang($text);
    wdhd_action_errormessage($text="",$wdhd_message_autohide);
  }
}


// notice-success – zöld bal keret - is-dismissible - x bezárás
function wdhd_message($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_message')){
    $text=wdhd_lang($text);
    wdhd_message($text="",$wdhd_message_autohide);
  }
}

// notice-error – vörös bal keret
function wdhd_error($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_error')){
    $text=wdhd_lang($text);
    wdhd_error($text="",$wdhd_message_autohide);
  }
}

// notice-warning– sárga bal keret
function wdhd_warning($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_warning')){
    $text=wdhd_lang($text);
    wdhd_warning($text="",$wdhd_message_autohide);
  }
}

// notice-success – zöld bal keret
function wdhd_success($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_success')){
    $text=wdhd_lang($text);
    wdhd_success($text="",$wdhd_message_autohide);
  }
}

// notice-info – kék bal keret
function wdhd_info($text="",$autohide=false){
  global $wdhd_message_autohide;
  
  if (function_exists('wswdteam_info')){
    $text=wdhd_lang($text);
    wdhd_info($text="",$wdhd_message_autohide);
  }
}

?>

