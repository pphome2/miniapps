<?php

// SQL adatbázis feladatok

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// adatbázis előkészítés
function wdhd_db_init(){
  global $wdhd_db_version,$wdhd_options;

  $ver=get_option($wdhd_options[0],'0');
  //nincs adatbázis
  if ($ver==="0"){
    wdhd_db_new();
  }else{
    // frissítés kell
    if ($ver<>$wdhd_db_version){
      wdhd_db_upgrade($ver,$wdhd_db_version);
    }
  }
}


// adatbázisban táblák létrehozása
function wdhd_db_new(){
  global $wpdb,$wdhd_db_version,$wdhd_table,$wdhd_options;

  $charset_collate=$wpdb->get_charset_collate();
  $table_name=$wpdb->prefix.$wdhd_table[0];
  $sql="CREATE TABLE IF NOT EXISTS $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    name tinytext NOT NULL,
    text text NOT NULL,
    url varchar(55) DEFAULT '' NOT NULL,
    PRIMARY KEY  (id)
  ) $charset_collate;";
  $r=$wpdb->query($sql);

  $table_name=$wpdb->prefix.$wdhd_table[1];
  $sql="CREATE TABLE IF NOT EXISTS $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    uname tinytext NOT NULL,
    urole int NOT NULL,
    PRIMARY KEY  (id)
  ) $charset_collate;";
  $r=$wpdb->query($sql);

  add_option($wdhd_options[1],$wdhd_db_version);
}


// adatbázis táblák frissítése
function wdhd_db_upgrade($installed='',$new=''){
  global $wpdb,$wdhd_db_version,$wdhd_table,$wdhd_options;

  $charset_collate=$wpdb->get_charset_collate();
  $table_name=$wpdb->prefix.$wdhd_table[0];
  $sql="";
  //$r=$wpdb->query($sql);

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
