<?php

// admin menu

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}



// rendszer admin menu
function wdhd_admin_menu(){
  add_action('admin_menu','wdhd_register_menu_page');
  add_action('admin_menu','wdhd_register_submenu_page');
  add_action('admin_menu','wdhd_register_submenu_page2');
  add_action('admin_menu','wdhd_register_submenu_page4');
  add_action('admin_menu','wdhd_register_submenu_page5');
}


// admin menü hozzáadása
function wdhd_register_menu_page(){
  $s1=plugin_dir_path(__FILE__).'/op_main.php';
  $s2=plugins_url().'/wdhd/images/icon.png';
  $l=wdhd_lang('WD HD',false);
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
//add_action('admin_menu','wdhd_register_menu_page');

// almenü hozzáadása
function wdhd_register_submenu_page(){
  $s0=plugin_dir_path(__FILE__).'/op_main.php';
  $s1=plugin_dir_path(__FILE__).'/op_ticket.php';
  $l=wdhd_lang('Hibajegyek',false);
  add_submenu_page(
    $s0,
    $l,
    $l,
    'manage_options',
    $s1,
    ''
  );
}
//add_action('admin_menu','wdhd_register_submenu_page');

// almenü hozzáadása
function wdhd_register_submenu_page2(){
  $s0=plugin_dir_path(__FILE__).'/op_main.php';
  $s1=plugin_dir_path(__FILE__).'/op_users.php';
  $l=wdhd_lang('Felhasználói jogok',false);
  add_submenu_page(
    $s0,
    $l,
    $l,
    'manage_options',
    $s1,
    ''
  );
}
//add_action('admin_menu','wdhd_register_submenu_page2');


// almenü hozzáadása
function wdhd_register_submenu_page4(){
  $s0=plugin_dir_path(__FILE__).'/op_main.php';
  $s2=plugin_dir_path(__FILE__).'/op_param.php';
  $l=wdhd_lang('Egyéb beállítások',false);
  add_submenu_page(
    $s0,
    $l,
    $l,
    'manage_options',
    $s2,
    ''
  );
}
//add_action('admin_menu','wdhd_register_submenu_page4');


// almenü hozzáadása
function wdhd_register_submenu_page5(){
  $s0=plugin_dir_path(__FILE__).'/op_main.php';
  $s2=plugin_dir_path(__FILE__).'/op_install.php';
  $l=wdhd_lang('Frissítések után',false);
  add_submenu_page(
    $s0,
    $l,
    $l,
    'manage_options',
    $s2,
    ''
  );
}
//add_action('admin_menu','wdhd_register_submenu_page4');


// menü törlése
function wdhd_remove_options_page(){
  remove_menu_page('wdhd');
}
add_action('admin_menu','wdhd_remove_options_page',90);




?>
