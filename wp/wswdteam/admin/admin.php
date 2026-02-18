<?php

// admin menu

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// admin menü hozzáadása
function wswdteam_register_menu_page(){
  $s1=plugin_dir_path(__FILE__).'/op_main.php';
  $s2=plugins_url().'/wswdteam/images/icon.png';
  $l=wswdteam_lang('WSWDTeam',false);
  add_menu_page(
    $l,
    $l,
    'manage_options',
    $s1,
    '',
    '',
    90
  );
}
//icon: 'dashicons-welcome-widgets-menus',
add_action('admin_menu','wswdteam_register_menu_page');

// almenü hozzáadása
function wswdteam_register_submenu_page(){
  $s0=plugin_dir_path(__FILE__).'/op_main.php';
  $s1=plugin_dir_path(__FILE__).'/op_users.php';
  $l=wswdteam_lang('Felhasználói jogok',false);
  add_submenu_page(
    $s0,
    $l,
    $l,
    'manage_options',
    $s1,
    ''
  );
}
add_action('admin_menu','wswdteam_register_submenu_page');

// almenü hozzáadása
function wswdteam_register_submenu_page2(){
  $s0=plugin_dir_path(__FILE__).'/op_main.php';
  $s2=plugin_dir_path(__FILE__).'/op_backup.php';
  $l=wswdteam_lang('Adatmentés',false);
  add_submenu_page(
    $s0,
    $l,
    $l,
    'manage_options',
    $s2,
    ''
  );
}
add_action('admin_menu','wswdteam_register_submenu_page2');

// almenü hozzáadása
function wswdteam_register_submenu_page3(){
  $s0=plugin_dir_path(__FILE__).'/op_main.php';
  $s2=plugin_dir_path(__FILE__).'/op_param.php';
  $l=wswdteam_lang('Egyéb beállítások',false);
  add_submenu_page(
    $s0,
    $l,
    $l,
    'manage_options',
    $s2,
    ''
  );
}
add_action('admin_menu','wswdteam_register_submenu_page3');

// menü törlése
function wswdteam_remove_options_page(){
  remove_menu_page('wswdteam');
}
add_action('admin_menu','wswdteam_remove_options_page',90);


// rendszer ellenőrzés
function wswdteam_sys_init(){
  global $wswdteam_plugin_version,$wswdteam_options,
          $wswdteam_developer_mode,$wswdteam_maintenance_mode;

  $ver=get_option($wswdteam_options[0],'0');
  // nincs plugin
  if ($ver==="0"){
    // új
    wswdteam_sys_new($ver,$wswdteam_plugin_version);
    wswdteam_save_param($wswdteam_options[0],$wswdteam_plugin_version);
  }else{
    // frissítés kell
    if ($ver<>$wswdteam_plugin_version){
      wswdteam_sys_upgrade($ver,$wswdteam_plugin_version);
      wswdteam_save_param($wswdteam_options[0],$wswdteam_plugin_version);
    }
  }
}



?>
