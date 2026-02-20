<?php
/**
 * Plugin Name
 *
 * @package           WSWDTeam plugin
 * @author            WSWDTeam
 * @copyright         2024 WSWDTeam
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       WSWDTeam plugin
 * Plugin URI:        https://wswdteam.hu/plugin
 * Description:       WSWDTeam admin plugin.
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            WSWDTeam
 * Author URI:        https://wswdteam.hu
 * Text Domain:       wswdteam-dom
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://wswdteam.hu/plugin/
 * Requires Plugins:  
 */



// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// beállítások, értékek, elérések, könyvtárak
if (file_exists(__DIR__.'/core/config.php')){
  include(__DIR__.'/core/config.php');
}else{
  exit;
}


// rendszerfájlok betöltése
if (isset($wswdteam_main_files)){
  foreach($wswdteam_main_files as $f){
    if (file_exists(__DIR__.$f)){
      include(__DIR__.$f);
    }else{
      exit;
    }
  }
}



// alapállapot beállítása
$dev=wswdteam_get_param("wswdteam_developer_mode");
if ($dev==="true"){
  $wswdteam_developer_mode=true;
}else{
  $wswdteam_developer_mode=false;
}
$dev=wswdteam_get_param("wswdteam_maintenance_mode");
if ($dev==="true"){
  $wswdteam_maintenance_mode=true;
}else{
  $wswdteam_maintenance_mode=false;
}
$dark=wswdteam_get_param("wswdteam_dark_mode");
if ($dark==="true"){
  $wswdteam_dark_mode=true;
  $w_darkmode=true;
}else{
  $wswdteam_dark_mode=false;
  $w_darkmode=false;
}



// karbantartási mód
function wswdteam_maintenance(){
  global $wswdteam_maintenance_mode,$wswdteam_maintenance_page;

  if ($wswdteam_maintenance_mode && !current_user_can('manage_options')){
    status_header(503);
    header('Retry-After: 3600');
    wp_redirect(plugin_dir_url(__FILE__).$wswdteam_maintenance_page);
  }
}
if ($wswdteam_maintenance_mode){
  add_action('template_redirect', 'wswdteam_maintenance');
}




// alkalmazásfájlok betöltése
if (isset($wswdteam_content_files)){
  foreach($wswdteam_content_files as $f){
    if (file_exists(__DIR__.$f)){
      include(__DIR__.$f);
    }else{
      exit;
    }
  }
}


// admin mód és admin vezérlés betöltése
if (is_admin()){
  if (file_exists(__DIR__.$wswdteam_admin_file)){
    include(__DIR__.$wswdteam_admin_file);
  }else{
    exit;
  }
}


// plugin előkészítés
function wswdteam_init(){
  global $locale, $wp_local_package,$wswdteam_options,$wswdteam_plugin_version,
         $wswdteam_user_role_list,$wswdteam_category,$wswdteam_locale,
         $wswdteam_dir_lang,$wswdteam_option_data,$wswdteam_option_name;

  // nyelvi beállítás
  $loc="";
  if (isset($locale)){
    $loc=$locale;
  }
  if (($loc==="")and(isset($wp_local_package))){
    $loc=$wp_local_package;
  }
  // nyelvi fájl betöltése
  if (file_exists(__DIR__.$wswdteam_dir_lang."/".$loc.".php")){
    include(__DIR__.$wswdteam_dir_lang."/".$loc.".php");
    $wswdteam_locale=$loc;
  }else{
    if (file_exists(__DIR__.$wswdteam_dir_lang."/".$wswdteam_locale.".php")){
      include(__DIR__.$wswdteam_dir_lang."/".$wswdteam_locale.".php");
    }
  }
  // rendszerbeállítások fordításai
  $i=0;
  foreach($wswdteam_user_role_list as $ur){
    $wswdteam_user_role_list[$i]=wswdteam_lang($wswdteam_user_role_list[$i]);
    $i++;
  }
  $i=0;
  foreach($wswdteam_category as $c){
    $wswdteam_category[$i]=wswdteam_lang($wswdteam_category[$i],false);
    $i++;
  }
  //wswdteam_setup();
  $wswdteam_option_data=wswdteam_get_option($wswdteam_option_name);
}
add_action('init','wswdteam_init');



// user menu a felső fekete sáv letiltása
add_filter('show_admin_bar',function($show){
    // Ha a felhasználó NEM tud opciókat kezelni (tehát nem admin), rejtsük el
    if (!current_user_can('manage_options')){
        return false;
    }
    // Mindenki másnak (adminoknak) maradjon az eredeti beállítás
    return $show;
});



// fejrész
function wswdteam_head(){
  global $wswdteam_inc_head;

  if (file_exists(__DIR__.$wswdteam_inc_head)){
    include(__DIR__.$wswdteam_inc_head);
  }
}
add_action('wp_head','wswdteam_head');



// lábrész
function wswdteam_footer(){
  global $wswdteam_inc_footer,$wswdteam_developer_mode;

  if (file_exists(__DIR__.$wswdteam_inc_footer)){
    include(__DIR__.$wswdteam_inc_footer);
  }
}
add_action('wp_footer','wswdteam_footer');



// js script és css betöltése
function wswdteam_inc(){
  global $wswdteam_inc_css,$wswdteam_inc_js;

  if (file_exists(__DIR__.$wswdteam_inc_css)){
    include(__DIR__.$wswdteam_inc_css);
  }
  if (file_exists(__DIR__.$wswdteam_inc_js)){
    include(__DIR__.$wswdteam_inc_js);
  }
}
add_action('wp_enqueue_scripts','wswdteam_inc');



// js script és css betöltése
function wswdteam_admin_inc(){
  global $wswdteam_inc_admin_css,$wswdteam_inc_admin_js;

  if (is_admin()){
    // admin script betöltés 
    if (file_exists(__DIR__.$wswdteam_inc_admin_css)){
      include(__DIR__.$wswdteam_inc_admin_css);
    }
    if (file_exists(__DIR__.$wswdteam_inc_admin_js)){
      include(__DIR__.$wswdteam_inc_admin_js);
    }
  }
}
add_action('admin_enqueue_scripts','wswdteam_admin_inc');



// 
function wswdteam_login_redirect(){
  return(home_url());
}
add_filter('login_redirect', 'wswdteam_login_redirect');



// kilépés
function wswdteam_logout_redirect(){
    return(home_url());
}
add_filter('logout_redirect','wswdteam_logout_redirect');



// plugin bekapcsolási feladatok
function wswdteam_setup(){
  wswdteam_db_init();
  wswdteam_sys_init();
}



// plugin bekapcsolás
function wswdteam_activate(){
  global $wswdteam_category;

  foreach($wswdteam_category as $cat){
    if (!category_exists($cat)){
      wp_create_category($cat);
    }
  }
  wswdteam_setup();
}
register_activation_hook(__FILE__,'wswdteam_activate' );



// plugin kikapcsolás
function wswdteam_deactivate(){
}
register_deactivation_hook(__FILE__,'wswdteam_deactivate' );



// shortcode kezelés [wswdteam] text [/wswdteam]
function wswdteam_shortcode($atts=[],$content=null,$tag=''){
  $content=wswdteam_main_center($atts,$content,$tag);
  return($content);
}
add_shortcode('wswdteam','wswdteam_shortcode');


?>
