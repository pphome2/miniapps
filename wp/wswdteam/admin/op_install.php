<?php

// paraméterek beállítása


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// jogosultság ellenőrzése
$ur=wswdteam_user_right();
if (!in_array($ur,[0])){
  $l=wswdteam_lang('Nem megfelelő jogosultság');
  wswdteam_error($l);
  exit;
}



// teljes paraméterkezelés
wswdteam_install_admin();



// új nyelvi elemek kiírása
echo(wswdteam_lang_newlines());

?>
