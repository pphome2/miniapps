<?php

// felhasználói jogok beállítása


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}



// szükséges plugin ellenőrzés
if (!defined('WSWDTEAM')){
  exit;
}


// jogosultság ellenőrzése
$ur=wdhd_user_right();
if (!in_array($ur,[0])){
  $l=wdhd_lang('Nem megfelelő jogosultság');
  wdhd_error($l);
  wdhd_error($ur);
  //exit;
}



if (defined('WSWDTEAM')){
  $p=strpos(plugin_basename(__DIR__),'/');
  $appname=substr(plugin_basename(__DIR__),0,$p);
  wswdteam_backup_admin_app($wdhd_table,$appname);
}else{
  add_action('admin_notices',function(){
    echo('<div class="error"><p>'.wdhd_lang('A "WSWDTEAM" plugin szükséges a működéshez!').'</p></div>');
  });
}


// új nyelvi elemek kiírása
echo(wdhd_lang_newlines());



?>
