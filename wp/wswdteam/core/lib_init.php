<?php

// inicializálás



// AKTIVÁLÁSKOR
// plugin bekapcsolási feladatok
function wswdteam_setup(){
  wswdteam_db_init();
  wswdteam_sys_init();
}



// rendszer ellenőrzés
function wswdteam_sys_init(){
  global $wswdteam_plugin_version,$wswdteam_options,
          $wswdteam_developer_mode,$wswdteam_maintenance_mode;

  $ver=get_option($wswdteam_options[0],'0');
  // nincs plugin
  if ($ver==="0"){
    // új
    wswdteam_sys_new($ver,$wswdteam_plugin_version);
    wswdteam_save_option($wswdteam_plugin_version,$wswdteam_options[0]);
    //wswdteam_save_param($wswdteam_options[0],$wswdteam_plugin_version);
  }else{
    // frissítés kell
    if ($ver<>$wswdteam_plugin_version){
      wswdteam_sys_upgrade($ver,$wswdteam_plugin_version);
      wswdteam_save_option($ver,$wswdteam_options[0]);
      //wswdteam_save_param($wswdteam_options[0],$wswdteam_plugin_version);
    }
  }
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



?>
