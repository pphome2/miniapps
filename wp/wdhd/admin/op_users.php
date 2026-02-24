<?php

// felhasználói jogok beállítása


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// jogosultság ellenőrzése
$ur=wdhd_user_right();
if (!in_array($ur,[0])){
  $l=wdhd_lang('Nem megfelelő jogosultság');
  wdhd_error($l);
  exit;
}



if (defined('WSWDTEAM')){
  wswdteam_users_admin_app($wdhd_user_role_list,$wdhd_option_user_name);
}else{
  add_action('admin_notices',function(){
    echo('<div class="error"><p>'.wdhd_lang('A "WSWDTEAM" plugin szükséges a működéshez!').'</p></div>');
  });
}


// új nyelvi elemek kiírása
echo(wdhd_lang_newlines());



?>
