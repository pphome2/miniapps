<?php

// alap beállítások

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}

// verziók
global $wswdteam_db_version,$wswdteam_plugin_version;
$wswdteam_db_version='1.0';
$wswdteam_plugin_version='1.0';

// fejlesztői mód
global $wswdteam_developer_mode;
$wswdteam_developer_mode=true;

// sql táblák
global $wswdteam_table;
$wswdteam_table=array('wswdteam',
                      'wusers'
                      );

// wp opciók
global $wswdteam_options;
$wswdteam_options=array('wswdteam_db_version',
                        'wswdteam_plugin_version'
                        );

// a endszerben használt felhasználói szerepkörök
global $wswdteam_user_role_list;
$wswdteam_user_role_list=array(0=>'Felhasználó',
                               1=>'Szerkesztő',
                               2=>'Adminisztrátor'
                               );
// alapértelmezett felhasználói szerepkör
global$wswdteam_user_role;
$wswdteam_user_role=9999;

// a rendszer által használt post kategóriák
global $wswdteam_category;
$wswdteam_category=array('Leírás',
                         'Tudásbázis'
                         );

// betöltendő funkciók
global $wswdteam_inc_head,
       $wswdteam_inc_footer,
       $wswdteam_inc_css,
       $wswdteam_inc_js;
$wswdteam_inc_head='/inc/wswdteam_head.php';
$wswdteam_inc_footer='/inc/wswdteam_footer.php';
$wswdteam_inc_css='/inc/wswdteam.css';
$wswdteam_inc_js='/inc/wswdteam.js';

// admin vezérlő fájl
global $wswdteam_admin_file;
$wswdteam_admin_file='/admin/admin.php';

// rendszer fájlok
global $wswdteam_main_files;
$wswdteam_main_files=array('/core/main.php',
                           '/core/sql.php',
                           '/core/lib1.php',
                           '/core/lib2.php',
                           '/core/app1.php',
                           '/core/app2.php',
                           '/core/app3.php',
                           '/core/app4.php'
                           );

// post könyvtár
global $wswdteam_dir_post;
$wswdteam_dir_post='/txt/post';

// page könyvtár
global $wswdteam_dir_page;
$wswdteam_dir_page='/txt/page';

// nyelvi könyvtár
global $wswdteam_dir_lang;
$wswdteam_dir_lang='/lang';

// lokalizációs kód
global $wswdteam_locale;
$wswdteam_locale="hu_HU";

// táblázat egy lapon megjelenő sorai
global $wswdteam_pagerow;
$wswdteam_pagerow=20;

// üzenetek automatikus bezárása
global $wswdteam_message_autohide;
$wswdteam_message_autohide=true;



// get plugins path:
// plugins_url()
// plugin_dir_url()
// plugin_dir_path()
// plugin_basename()

// load script or css:
// wp_enqueue_script() or wp_enqueue_style()

// get wp path:
// home_url()
// get_home_path()
// admin_url()
// site_url()
// content_url()
// includes_url()
// wp_upload_dir()

// wp constans:
// WP_CONTENT_DIR - full paths
// WP_CONTENT_URL - full url 
// WP_PLUGIN_DIR - full path
// WP_PLUGIN_URL - full url
// UPLOADS - /wp-content/uploads

?>
