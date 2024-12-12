<?php

// alap beállítások

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}

// alkalmazás változók

// a endszerben használt felhasználói szerepkörök
global $wdhd_ticket_type;
$wdhd_ticket_type=array(0=>'Bevizsgálás',
                        1=>'Javítás (TMK)',
                        2=>'Javítás (villanyszerelő)',
                        3=>'Beszerzés',
                        4=>'Egyéb'
                       );

// nyomtatóra munkalap
global $wdhd_print_page;
$wdhd_print_page="app_wpage.php";



// ----------------
// rendszer vátozók

// alkalmazás név
global $wdhd_app_name;
$wdhd_app_name='wdhd';

// verziók
global $wdhd_db_version,$wdhd_plugin_version;
$wdhd_plugin_version='1.0';
$wdhd_db_version='1.2';

// fejlesztői mód
global $wdhd_developer_mode;
$wdhd_developer_mode=false;

// wp opciók
global $wdhd_options;
$wdhd_options=array('wdhd_plugin_version',
                    'wdhd_db_version'
                    );

// a endszerben használt felhasználói szerepkörök
// 0 (nulla) mindíg adminisztrátor
global $wdhd_user_role_list;
$wdhd_user_role_list=array(0=>'Adminisztrátor',
                           1=>'Bejelentő',
                           2=>'Szervíz dolgozó',
                           3=>'Karbantartó',
                           4=>'Beszerző'
                          );
// aktuális felhasználó
global$wdhd_user_role;
$wdhd_user_role=9999;

// alapértelmezett felhasználói szerepkör
global$wdhd_user_name;
$wdhd_user_name="";

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
                       '/core/lib_sql.php',
                       '/core/lib_view.php',
                       '/core/lib_msg.php',
                       '/core/lib_lang.php',
                       '/core/lib_page.php',
                       '/core/lib_backup.php',
                       '/core/lib_param.php',
                       '/core/lib_right.php'
                       );

// rendszer fájlok
global $wdhd_content_files;
$wdhd_content_files=array( '/content/app_new.php',
                           '/content/app_ticket.php',
                           '/content/app_service.php',
                           '/content/app_help.php'
                           );

// mentés letöltés
global $wdhd_backup_dl;
$wdhd_backup_dl="lib_backup_dl.php";

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
$wdhd_pagerow=5;

// üzenetek automatikus bezárása
global $wdhd_message_autohide;
$wdhd_message_autohide=true;

// sql táblák
global $wdhd_table;
$wdhd_table=array('wdhdparam',
                  'wdhduser',
                  'wdhdticket'
                 );

// sql táblák létrehozása
global $wpdb;
global $wdhd_sql_install;
$charset_collate=$wpdb->get_charset_collate();
$sql0="CREATE TABLE IF NOT EXISTS ".$wpdb->prefix.$wdhd_table[0]." (
                          id mediumint(9) NOT NULL AUTO_INCREMENT,
                          name tinytext NOT NULL,
                          text text NOT NULL,
                          PRIMARY KEY  (id)
                          ) ".$charset_collate.";";
$sql1="CREATE TABLE IF NOT EXISTS ".$wpdb->prefix.$wdhd_table[1]." (
                          id mediumint(9) NOT NULL AUTO_INCREMENT,
                          uname tinytext NOT NULL,
                          urole int NOT NULL,
                          PRIMARY KEY  (id)
                          ) ".$charset_collate.";";
$sql2="CREATE TABLE IF NOT EXISTS ".$wpdb->prefix.$wdhd_table[2]." (
                          id mediumint(9) NOT NULL AUTO_INCREMENT,
                          t_time tinytext NOT NULL,
                          t_intype tinytext,
                          t_inname tinytext,
                          t_indep tinytext,
                          t_intel tinytext,
                          t_inmail tinytext,
                          t_text text,
                          t_plantime tinytext,
                          t_dep tinytext,
                          t_worker tinytext,
                          t_action text,
                          t_parts tinytext,
                          t_hour int,
                          t_km int,
                          t_endtime tinytext,
                          t_enduname tinytext,
                          PRIMARY KEY  (id)
                          ) ".$charset_collate.";";
$wdhd_sql_install=array($sql0,
                        $sql1,
                        $sql2
                       );

// sql táblák frissítése
global $wdteam_sql_update;
$wdhd_sql_update=array($sql0,
                        $sql1,
                        $sql2
                       );


?>
