<?php

// option menu


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}



// adat
wswdteam_admin_backup();



// új nyelvi elemek kiírása
echo(wswdteam_lang_newlines());

?>
