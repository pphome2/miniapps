<?php

// admin menu

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// admin menü hozzáadása
function wdhd_register_menu_page(){
  $s1=plugin_dir_path(__FILE__).'/op_main.php';
  $s2=plugins_url().'/wdhd/images/icon.png';
  $l=wdhd_lang('WD HD',true);
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
add_action('admin_menu','wdhd_register_menu_page');

// almenü hozzáadása
function wdhd_register_submenu_page(){
  $s0=plugin_dir_path(__FILE__).'/op_main.php';
  $s1=plugin_dir_path(__FILE__).'/op_users.php';
  $l=wdhd_lang('Felhasználói jogok');
  add_submenu_page(
    $s0,
    $l,
    $l,
    'manage_options',
    $s1,
    ''
  );
}
add_action('admin_menu','wdhd_register_submenu_page');

// almenü hozzáadása
function wdhd_register_submenu_page2(){
  $s0=plugin_dir_path(__FILE__).'/op_main.php';
  $s2=plugin_dir_path(__FILE__).'/op_param.php';
  $l=wdhd_lang('Egyéb beállítások');
  add_submenu_page(
    $s0,
    $l,
    $l,
    'manage_options',
    $s2,
    ''
  );
}
add_action('admin_menu','wdhd_register_submenu_page2');

// menü törlése
function wdhd_remove_options_page(){
  remove_menu_page('wdhd');
}
// add_action( 'admin_menu', 'wdhd_remove_options_page', 99 );


// verzió ellenőrzés és telepítés ha kell
function wdhd_sys_check(){
  wdhd_db_init();
  wdhd_sys_init();
}

   
// rendszer ellenőrzés
function wdhd_sys_init(){
  global $wdhd_plugin_version,$wdhd_options;

  $ver=get_option($wdhd_options[1],'0');
  // nincs adatbázis
  if ($ver==="0"){
    // új
    wdhd_sys_new($ver,$wdhd_plugin_version);
    wdhd_save_param();
  }else{
    // frissítés kell
    if ($ver<>$wdhd_plugin_version){
      wdhd_sys_upgrade($ver,$wdhd_plugin_version);
      wdhd_save_param();
    }
  }
}


// rendszer telepítése
function wdhd_sys_new($installed='',$new=''){
  global $wdhd_options;

  update_option($wdhd_options[0],$new);
}


// rendszer frissítése
function wdhd_sys_upgrade($installed='',$new=''){
  global $wdhd_options;

  update_option($wdhd_options[0],$new);
}


// verziók mint paraméter
function wdhd_save_param(){
  global $wdhd_plugin_version,$wdhd_options,$wdhd_table,$wpdb,
         $wdhd_db_version;

  $table_name=$wpdb->prefix.$wdhd_table[0];
  $sql="SELECT * FROM $table_name WHERE name='$wdhd_options[0]';";
  $r=$wpdb->query($sql);
  if ($r){
    $sql="UPDATE $table_name SET text='$wdhd_plugin_version' WHERE name=\'$wdhd_options[0]\';";
  }else{
    $sql="INSERT INTO $table_name (name,text) VALUES ('$wdhd_options[0]','$wdhd_plugin_version');";
  }
  $r=$wpdb->query($sql);
  $sql="SELECT * FROM $table_name WHERE name='$wdhd_options[1]';";
  $r=$wpdb->query($sql);
  if ($r){
    $sql="UPDATE $table_name SET text='$wdhd_db_version'' WHERE name=\'$wdhd_options[1]\';";
    $sql="DELETE FROM $table_name WHERE name='$wdhd_options[1]';";
  }else{
    $sql="INSERT INTO $table_name (name,text) VALUES ('$wdhd_options[0]','$wdhd_db_version');";
  }
  $r=$wpdb->query($sql);
}


?>
