<?php

// SQL adatbázis frissítés

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
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

  update_option($wswdteam_options[1],$wswdteam_db_version);
}



?>
