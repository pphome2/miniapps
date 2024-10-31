<?php

// admin menu

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// admin menü hozzáadása
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

// almenü hozzáadása
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

// almenü hozzáadása
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

// menü törlése
function wswdteam_remove_options_page(){
  remove_menu_page('wswdteam');
}
// add_action( 'admin_menu', 'wswdteam_remove_options_page', 99 );


// verzió ellenőrzés és telepítés ha kell
function wswdteam_sys_check(){
  wswdteam_db_init();
  wswdteam_sys_init();
}

   
// rendszer ellenőrzés
function wswdteam_sys_init(){
  global $wswdteam_plugin_version,$wswdteam_options;

  $ver=get_option($wswdteam_options[1],'0');
  // nincs adatbázis
  if ($ver==="0"){
    // új
    wswdteam_sys_new($ver,$wswdteam_plugin_version);
    wswdteam_save_param();
  }else{
    // frissítés kell
    if ($ver<>$wswdteam_plugin_version){
      wswdteam_sys_upgrade($ver,$wswdteam_plugin_version);
      wswdteam_save_param();
    }
  }
}


// rendszer telepítése
function wswdteam_sys_new($installed='',$new=''){
  global $wswdteam_options;

  update_option($wswdteam_options[0],$new);
}


// rendszer frissítése
function wswdteam_sys_upgrade($installed='',$new=''){
  global $wswdteam_options;

  update_option($wswdteam_options[0],$new);
}


// verziók mint paraméter
function wswdteam_save_param(){
  global $wswdteam_plugin_version,$wswdteam_options,$wswdteam_table,$wpdb,
         $wswdteam_db_version;

  $table_name=$wpdb->prefix.$wswdteam_table[0];
  $sql="SELECT * FROM $table_name WHERE name='$wswdteam_options[0]';";
  $r=$wpdb->query($sql);
  if ($r){
    $sql="UPDATE $table_name SET text='$wswdteam_plugin_version' WHERE name=\'$wswdteam_options[0]\';";
  }else{
    $sql="INSERT INTO $table_name (name,text) VALUES ('$wswdteam_options[0]','$wswdteam_plugin_version');";
  }
  $r=$wpdb->query($sql);
  $sql="SELECT * FROM $table_name WHERE name='$wswdteam_options[1]';";
  $r=$wpdb->query($sql);
  if ($r){
    $sql="UPDATE $table_name SET text='$wswdteam_db_version'' WHERE name=\'$wswdteam_options[1]\';";
    $sql="DELETE FROM $table_name WHERE name='$wswdteam_options[1]';";
  }else{
    $sql="INSERT INTO $table_name (name,text) VALUES ('$wswdteam_options[0]','$wswdteam_db_version');";
  }
  $r=$wpdb->query($sql);
}


?>
