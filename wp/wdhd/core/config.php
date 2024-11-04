<?php

// alap beállítások

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}

// verziók
global $wdhd_db_version,$wdhd_plugin_version;
$wdhd_db_version='1.0';
$wdhd_plugin_version='1.0';

// fejlesztői mód
global $wdhd_developer_mode;
$wdhd_developer_mode=true;

// sql táblák
global $wdhd_table;
$wdhd_table=array('wdhdparam',
                      'wdhdusers'
                      );

// wp opciók
global $wdhd_options;
$wdhd_options=array('wdhd_plugin_version',
                        'wdhd_db_version'
                        );

// a endszerben használt felhasználói szerepkörök
global $wdhd_user_role_list;
$wdhd_user_role_list=array(0=>'Felhasználó',
                               1=>'Szerkesztő',
                               2=>'Adminisztrátor'
                               );
// alapértelmezett felhasználói szerepkör
global$wdhd_user_role;
$wdhd_user_role=9999;

// a rendszer által használt post kategóriák
global $wdhd_category;
$wdhd_category=array('Leírás',
                         'Tudásbázis'
                         );

// betöltendő funkciók
global $wdhd_inc_head,
       $wdhd_inc_footer,
       $wdhd_inc_css,
       $wdhd_inc_js;
$wdhd_inc_head='/inc/wdhd_head.php';
$wdhd_inc_footer='/inc/wdhd_footer.php';
$wdhd_inc_css='/inc/wdhd.css';
$wdhd_inc_js='/inc/wdhd.js';

// admin vezérlő fájl
global $wdhd_admin_file;
$wdhd_admin_file='/admin/admin.php';

// rendszer fájlok
global $wdhd_main_files;
$wdhd_main_files=array('/core/main.php',
                           '/core/sql.php',
                           '/core/lib1.php',
                           '/core/lib2.php',
                           '/core/app1.php',
                           '/core/app2.php',
                           '/core/app3.php',
                           '/core/app4.php'
                           );

// post könyvtár
global $wdhd_dir_post;
$wdhd_dir_post='/txt/post';

// page könyvtár
global $wdhd_dir_page;
$wdhd_dir_page='/txt/page';

// nyelvi könyvtár
global $wdhd_dir_lang;
$wdhd_dir_lang='/lang';

// lokalizációs kód
global $wdhd_locale;
$wdhd_locale="hu_HU";

// táblázat egy lapon megjelenő sorai
global $wdhd_pagerow;
$wdhd_pagerow=20;

// üzenetek automatikus bezárása
global $wdhd_message_autohide;
$wdhd_message_autohide=true;


?>
