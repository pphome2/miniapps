<?php

// admin menu

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// add admin menu
function register_menu_page(){
  $s1=plugin_dir_path(__FILE__).'/options1.php';
  $s2=plugins_url().'/wswdteam/images/icon.png';
  add_menu_page(
    '',
    'WSWDTeam',
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
  $s1=plugin_dir_path(__FILE__).'/options1.php';
  $s2=plugin_dir_path(__FILE__).'/options2.php';
  $l=wswdteam_lang('Egyéb beállítások');
  add_submenu_page(
    $s1,
    $l,
    $l,
    'manage_options',
    $s2,
    ''
  );
}
add_action('admin_menu','register_submenu_page');

// remove menu
function wswdteam_remove_options_page(){
  remove_menu_page('wswdteam');
}
// add_action( 'admin_menu', 'wswdteam_remove_options_page', 99 );

?>

