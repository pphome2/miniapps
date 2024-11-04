<?php

// SQL adatbázis feladatok

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// adatbázis előkészítés
function wswdteam_db_init(){
  global $wswdteam_db_version,$wswdteam_options;

  $ver=get_option($wswdteam_options[0],'0');
  //nincs adatbázis
  if ($ver==="0"){
    wswdteam_db_new();
    wswdteam_save_param($wswdteam_options[1],$wswdteam_db_version);
  }else{
    // frissítés kell
    if ($ver<>$wswdteam_db_version){
      wswdteam_db_upgrade($ver,$wswdteam_db_version);
      wswdteam_save_param($wswdteam_options[1],$wswdteam_db_version);
    }
  }
}


// adatbázisban táblák létrehozása
function wswdteam_db_new(){
  global $wswdteam_sql_install,$wpdb,$wswdteam_db_version,$wswdteam_options;

  $charset_collate=$wpdb->get_charset_collate();
  foreach ($wswdteam_sql_install as $sql){
    $r=$wpdb->query($sql);
  }

  add_option($wswdteam_options[1],$wswdteam_db_version);
}


// adatbázis táblák frissítése
function wswdteam_db_upgrade($installed='',$new=''){
  global $wpdb,$wswdteam_db_version,$wswdteam_sql_update,$wswdteam_options;

  foreach ($wswdteam_sql_update as $sql){
    $r=$wpdb->query($sql);
  }
  //$r=$wpdb->query($sql);

  update_option($wswdteam_options[1],$wswdteam_db_version);
}


// adatbázisban sql végrehajtása
function wswdteam_sql($sql=''){
  global $wpdb;

  if (!empty($sql)){
    $r=$wpdb->query($sql);
  }else{
    $r="";
  }
  retur($r);
}


?>
