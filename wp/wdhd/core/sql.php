<?php

// SQL adatbázis feladatok

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// adatbázis előkészítés
function wdhd_db_init(){
  global $wdhd_db_version,$wdhd_options;

  $ver=get_option($wdhd_options[1],'0');
  //nincs adatbázis
  //$ver="0";
  if ($ver==="0"){
    wdhd_db_new();
    wdhd_save_param($wdhd_options[1],$wdhd_db_version);
  }else{
    // frissítés kell
    if ($ver<>$wdhd_db_version){
      wdhd_db_upgrade($ver,$wdhd_db_version);
      wdhd_save_param($wdhd_options[1],$wdhd_db_version);
    }
  }
}


// adatbázisban táblák létrehozása
function wdhd_db_new(){
  global $wdhd_sql_install,$wpdb,$wdhd_db_version,$wdhd_options;

  $charset_collate=$wpdb->get_charset_collate();
  foreach ($wdhd_sql_install as $sql){
    $r=$wpdb->query($sql);
  }

  add_option($wdhd_options[1],$wdhd_db_version);
}


// adatbázis táblák frissítése
function wdhd_db_upgrade($installed='',$new=''){
  global $wpdb,$wdhd_db_version,$wdhd_sql_update,$wdhd_options;

  foreach ($wdhd_sql_update as $sql){
    $r=$wpdb->query($sql);
  }
  $r=$wpdb->query($sql);

  update_option($wdhd_options[1],$wdhd_db_version);
}


// adatbázisban sql végrehajtása
function wdhd_sql($sql=''){
  global $wpdb;

  if (!empty($sql)){
    $r=$wpdb->query($sql);
  }else{
    $r="";
  }
  retur($r);
}


?>
