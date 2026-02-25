<?php

// paraméterek beállítása


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
  $dir1=dirname(dirname(__FILE__)).$wdhd_dir_post.'/'.$wdhd_locale;
  $dir2=dirname(dirname(__FILE__)).$wdhd_dir_page.'/'.$wdhd_locale;
  wswdteam_install_admin_app($wdhd_option_name,$dir1,$dir2);
}else{
  add_action('admin_notices',function(){
    echo('<div class="error"><p>'.wdhd_lang('A "WSWDTEAM" plugin szükséges a működéshez!').'</p></div>');
  });
}




// új nyelvi elemek kiírása
echo(wdhd_lang_newlines());


?>
