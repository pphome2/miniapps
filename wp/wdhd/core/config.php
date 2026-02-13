<?php

// alap beállítások

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}



//
// alkalmazás változók
//

// a rendszerben használt felhasználói szerepkörök
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

// felhasználói szerepkörök és kódok
global $wdhd_user_role_list;
$wdhd_user_role_list=array(0=>'Adminisztrátor',
                           1=>'Bejelentő',
                           2=>'Szervíz dolgozó',
                           3=>'Karbantartó',
                           4=>'Beszerző'
                          );

// nincs jogok// aktuális felhasználó
global$wdhd_user_role;
$wdhd_user_role=9999;

// opciók
global $wdhd_options;
$wdhd_options=array('wdhd_plugin_version',
                    'wdhd_db_version'
                    );

// a rendszer által használt post kategóriák
global $wdhd_category;
$wdhd_category=array('Leírás',
                     'Tudásbázis'
                    );

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

// első telepítés
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






//
// !!!!!!!!!!!!!!!!
// rendszer vátozók
//

// alkalmazás név
global $wdhd_app_name;
$wdhd_app_name='Helpdesk Rendszer';
global $wdhd_aauthor_name;
$wdhd_author_name='WSWDTeam-HD';


// verziók
global $wdhd_db_version,$wdhd_plugin_version;
$wdhd_plugin_version='1.0';
$wdhd_db_version='1.0';


// fejléc és lábléc tartalom a programból
global $wdhd_header_title;
$wdhd_header_title=$wdhd_app_name;
global $wdhd_credit;
$wdhd_credit= $wdhd_author_name.' '.$wdhd_plugin_version.' '.date('Y.');
global $wdhd_status_line;
$wdhd_status_line='';
global $wdhd_app_logo;
$wdhd_app_logo=plugin_dir_url(__FILE__).'../img/applogo.png';




//
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// applikácihoz módisítandó változók
//

// fejlesztői mód
global $wdhd_developer_mode;
$wdhd_developer_mode=false;

// wp opciók
if (!isset($wdhd_options)){
  global $wdhd_options;
  $wdhd_options=array('wdhd_plugin_version',
                      'wdhd_db_version'
                      );
}

// a endszerben használt felhasználói szerepkörök
// 0 (nulla) mindíg adminisztrátor
if (!isset($wdhd_user_role_list)){
  global $wdhd_user_role_list;
  $wdhd_user_role_list=array(0=>'Adminisztrátor',
                             1=>'Felhasználó'
                            );
}
// aktuális felhasználó
if (!isset($wdhd_user_role)){
  global $wdhd_user_role;
  $wdhd_user_role=9999;
}

// alapértelmezett felhasználói szerepkör
global$wdhd_user_name;
$wdhd_user_name="";

// a rendszer által használt post kategóriák
if (!isset($wdhd_category)){
  global $wdhd_category;
  $wdhd_category=array('Leírás',
                       'Tudásbázis'
                      );
}

//
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// a endszer részét képező fájlok (NE MÓDOSÍTSD)
//

// betöltendő funkciók
global $wdhd_inc_head,
       $wdhd_inc_footer,
       $wdhd_inc_css,
       $wdhd_inc_js;
$wdhd_inc_head='/inc/wdhd_header.php';
$wdhd_inc_footer='/inc/wdhd_footer.php';
$wdhd_inc_css='/inc/wdhd.css';
$wdhd_inc_js='/inc/wdhd.js';

// admin vezérlő fájl
global $wdhd_admin_file;
$wdhd_admin_file='/admin/admin.php';

// rendszer fájlok
global $wdhd_main_files;
$wdhd_main_files=array('/core/main.php',
                       '/core/lib_connect.php',
                       '/core/lib_sql_setup.php'
                       );

// rendszer fájlok
global $wdhd_content_files;
$wdhd_content_files=array( '/content/app_new.php',
                           '/content/app_ticket.php',
                           '/content/app_service.php',
                           '/content/app_help.php'
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

// táblázatban megjelenő sorok száma
global $wdhd_pagerow;
$wdhd_pagerow=20;


//
// adatbázis beállítás
//

// sql táblák
if (!isset($wdhd_table)){
  global $wdhd_table;
  $wdhd_table=array('wdhdparam',
                    'wdhduser'
                   );
}

// sql táblák létrehozása
if (!isset($wdhd_sql_install)){
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
  $sql2="";
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
}


//
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// téma illesztés beállítások (NE MÓDOSÍTSD)
//

// fejrész és lábrész előkészítése
if (!isset($w_header_title)){
  global $w_header_title;
}
$w_header_title=$wdhd_header_title;

if (!isset($w__status_line)){
  global $w_status_line;
}
$w_status_line=$wdhd_status_line;

if (!isset($w_credit)){
  global $ws_credit;
}
$w_credit=$wdhd_credit;

if (!isset($w_applogo)){
  global $w_applogo;
}
$w_applogo=$wdhd_app_logo;

?>

