<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


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

?>
