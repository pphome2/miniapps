<?php

// SQL adatbázis feladatok

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}



// rendszer ellenőrzés
function wdhd_sys_init(){
  global $wdhd_plugin_version,$wdhd_options,$wdhd_developer_mode,
          $wdhd_option_name;

  $name=$wdhd_options[0];
  $data=get_option($wdhd_option_name);
  if (isset($data[$name])){
    $ver=$data[$name];
  }else{
    $ver="";
  }
  // nincs plugin
  if ($ver===""){
    // új
    wdhd_sys_new($ver,$wdhd_plugin_version);
    $data[$name]=$wdhd_plugin_version;
    update_option($wdhd_option_name,$data);
  }else{
    // frissítés kell
    if ($ver<>$wdhd_plugin_version){
      wdhd_sys_upgrade($ver,$wdhd_plugin_version);
      $data[$name]=$wdhd_plugin_version;
      update_option($wdhd_option_name,$data);
    }
  }
}



// adatbázis előkészítés
function wdhd_db_init(){
  global $wdhd_db_version,$wdhd_options,$wdhd_option_name;

  $name=$wdhd_options[1];
  $data=get_option($wdhd_option_name);
  if (isset($data[$name])){
    $ver=$data[$name];
  }else{
    $ver="";
  }
  //nincs adatbázis
  //$ver="0";
  if ($ver===""){
    wdhd_db_new();
    $data[$name]=$wdhd_db_version;
    update_option($wdhd_option_name,$data);
  }else{
    // frissítés kell
    if ($ver<>$wdhd_db_version){
      wdhd_db_upgrade($ver,$wdhd_db_version);
      $data[$name]=$wdhd_db_version;
      update_option($wdhd_option_name,$data);
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
}


// adatbázis táblák frissítése
function wdhd_db_upgrade($installed='',$new=''){
  global $wpdb,$wdhd_db_version,$wdhd_sql_update,$wdhd_options;

  foreach ($wdhd_sql_update as $sql){
    $r=$wpdb->query($sql);
  }
  $r=$wpdb->query($sql);
}



// admin frissítés
// rendszer telepítése
function wdhd_sys_new($installed='',$new=''){
}


// rendszer frissítése
function wdhd_sys_upgrade($installed='',$new=''){
}




?>
