<?php

// alap beállítások

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// alkalmazás változók



// -----------------
// rendszer változók

// alkalmazás név
global $wswdteam_app_name;
$wswdteam_app_name='wswdteam';

// verziók
global $wswdteam_db_version,$wswdteam_plugin_version;
$wswdteam_plugin_version='1.0';
$wswdteam_db_version='1.0';

// fejlesztői mód
global $wswdteam_developer_mode;
$wswdteam_developer_mode=false;

// wp opciók
global $wswdteam_options;
$wswdteam_options=array('wswdteam_plugin_version',
                        'wswdteam_db_version'
                        );

// a endszerben használt felhasználói szerepkörök
// 0 (nulla) mindíg adminisztrátor
global $wswdteam_user_role_list;
$wswdteam_user_role_list=array(0=>'Adminisztrátor',
                               1=>'Szerkesztő',
                               2=>'Felhasználó'
                               );
// alapértelmezett felhasználói szerepkör
global$wswdteam_user_role;
$wswdteam_user_role=9999;

// alapértelmezett felhasználói szerepkör
global$wswdteam_user_name;
$wswdteam_user_name="";

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

// telepítőfájl neve
global $wswdteam_setup_file;
$wswdteam_setup_file="install.php";


// rendszer fájlok
global $wswdteam_main_files;
$wswdteam_main_files=array('/core/main.php',
                           '/core/lib_sql.php',
                           '/core/lib_lang.php',
                           '/core/lib_msg.php',
                           '/core/lib_page.php',
                           '/core/lib_view.php',
                           '/core/lib_backup.php',
                           '/core/lib_param.php',
                           '/core/lib_right.php'
                           );

// alkalmazás fájlok
global $wswdteam_content_files;
$wswdteam_content_files=array('/content/app1.php',
                              '/content/app2.php',
                              '/content/app3.php',
                              '/content/app4.php'
                             );

// mentés letöltés
global $wswdteam_backup_dl;
$wswdteam_backup_dl="lib_backup_dl.php";

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

// sql táblák
global $wswdteam_table;
$wswdteam_table=array('wswdteamparam',
                      'wswdteamuser'
                     );

// sql táblák létrehozása
global $wpdb;
global $wswdteam_sql_install;
$charset_collate=$wpdb->get_charset_collate();
$sql0="CREATE TABLE IF NOT EXISTS ".$wpdb->prefix.$wswdteam_table[0]." (
                          id mediumint(9) NOT NULL AUTO_INCREMENT,
                          name tinytext NOT NULL,
                          text text NOT NULL,
                          PRIMARY KEY  (id)
                          ) ".$charset_collate.";";
$sql1="CREATE TABLE IF NOT EXISTS ".$wpdb->prefix.$wswdteam_table[1]." (
                          id mediumint(9) NOT NULL AUTO_INCREMENT,
                          uname tinytext NOT NULL,
                          urole int NOT NULL,
                          PRIMARY KEY  (id)
                          ) ".$charset_collate.";";
$wswdteam_sql_install=array($sql0,
                        $sql1
                       );

// sql táblák frissítése
global $wswdteam_sql_update;
$wswdteam_sql_update=array("");


// get plugins path:
// plugins_url()
// plugin_dir_url()
// plugin_dir_path()
// plugin_basename()

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

?>
