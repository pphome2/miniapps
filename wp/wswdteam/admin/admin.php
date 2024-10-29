<?php

// admin menu

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// add admin menu
function register_menu_page(){
  $s1=plugin_dir_path(__FILE__).'/op_main.php';
  $s2=plugins_url().'/wswdteam/images/icon.png';
  $l=wswdteam_lang('WSWDTeam');
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
add_action('admin_menu','register_menu_page');

// add admin menu
function register_submenu_page(){
  $s0=plugin_dir_path(__FILE__).'/op_main.php';
  $s1=plugin_dir_path(__FILE__).'/op_users.php';
  $l=wswdteam_lang('Felhasználói jogok');
  add_submenu_page(
    $s0,
    $l,
    $l,
    'manage_options',
    $s1,
    ''
  );
}
add_action('admin_menu','register_submenu_page');

// add admin menu
function register_submenu_page2(){
  $s0=plugin_dir_path(__FILE__).'/op_main.php';
  $s2=plugin_dir_path(__FILE__).'/op_param.php';
  $l=wswdteam_lang('Egyéb beállítások');
  add_submenu_page(
    $s0,
    $l,
    $l,
    'manage_options',
    $s2,
    ''
  );
}
add_action('admin_menu','register_submenu_page2');

// remove menu
function wswdteam_remove_options_page(){
  remove_menu_page('wswdteam');
}
// add_action( 'admin_menu', 'wswdteam_remove_options_page', 99 );

?>
