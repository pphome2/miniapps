<?php

// segéd függvényel

// notice-success – zöld bal keret
// is-dismissible - x bezárás
function wswdteam_message($text=""){
  echo("<div class=\"notice notice-success is-dismissible\"><p>");
  echo(_e($text,'sample-text-domain'));
  echo("</p></div>");
}

// notice-error – vörös bal keret
function wswdteam_error($text=""){
  echo("<div class=\"notice notice-error is-dismissible\"><p>");
  echo(_e($text,'sample-text-domain'));
  echo("</p></div>");
}

// notice-warning– sárga bal keret
function wswdteam_warning($text=""){
  echo("<div class=\"notice notice-warning is-dismissible\"><p>");
  echo(_e($text,'sample-text-domain'));
  echo("</p></div>");
}

// notice-success – zöld bal keret
function wswdteam_success($text=""){
  echo("<div class=\"notice notice-success is-dismissible\"><p>");
  echo(_e($text,'sample-text-domain'));
  echo("</p></div>");
}

// notice-info – kék bal keret
function wswdteam_info($text=""){
  echo("<div class=\"notice notice-info is-dismissible\"><p>");
  echo(_e($text,'sample-text-domain'));
  echo("</p></div>");
}

// fordítás
function wswdteam_lang($text=''){
  global $WSWDTEAM_LANG_STR;

  if (isset($WSWDTEAM_LANG_STR)and(isset($WSWDTEAM_LANG_STR[$text]))){
    $line=$WSWDTEAM_LANG_STR[$text];
  }else{
    $line='.'.$text.'.';
  }
  return($line);
}

?>

