<?php

// rendszer frissítés

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// rendszer telepítése
function wswdteam_sys_new($installed='',$new=''){
  global $wswdteam_options;

  update_option($wswdteam_options[0],$new);
}


// rendszer frissítése
function wswdteam_sys_upgrade($installed='',$new=''){
  global $wswdteam_options;

  update_option($wswdteam_options[0],$new);
}



?>
