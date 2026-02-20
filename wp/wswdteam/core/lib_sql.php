<?php

// SQL adatbázis feladatok

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// adatbázis előkészítés
function wswdteam_db_init(){
  global $wswdteam_db_version,$wswdteam_options;

  $ver=get_option($wswdteam_options[1],'0');
  //nincs adatbázis
  if ($ver==="0"){
    wswdteam_db_new();
    wswdteam_save_option($wswdteam_db_version,$wswdteam_options[1]);
    //wswdteam_save_param($wswdteam_options[1],$wswdteam_db_version);
  }else{
    // frissítés kell
    if ($ver<>$wswdteam_db_version){
      wswdteam_db_upgrade($ver,$wswdteam_db_version);
      wswdteam_save_option($wswdteam_db_version[1],$ver);
      //wswdteam_save_param($wswdteam_options[1],$wswdteam_db_version);
    }
  }
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
