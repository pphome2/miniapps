<?php

// admin frissítés


// rendszer telepítése
function wdhd_sys_new($installed='',$new=''){
  global $wdhd_options;

  update_option($wdhd_options[0],$new);
}


// rendszer frissítése
function wdhd_sys_upgrade($installed='',$new=''){
  global $wdhd_options;

  update_option($wdhd_options[0],$new);
}



?>