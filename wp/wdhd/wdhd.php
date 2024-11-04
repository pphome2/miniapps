<?php
/**
 * Plugin Name
 *
 * @package           WDHD plugin
 * @author            WSWDTeam
 * @copyright         2024 WSWDTeam
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       WD HD plugin
 * Plugin URI:        https://wswdteam.hu/plugin
 * Description:       WD HD heldesk plugin.
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            WSWDTeam
 * Author URI:        https://wswdteam.hu
 * Text Domain:       wdhd-dom
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
if (isset($wdhd_main_files)){
  foreach($wdhd_main_files as $f){
    if (file_exists(__DIR__.$f)){
      include(__DIR__.$f);
    }else{
      exit;
    }
  }
}


// admin mód és admin vezérlés betöltése
if (is_admin()){
  if (file_exists(__DIR__.$wdhd_admin_file)){
    include(__DIR__.$wdhd_admin_file);
  }else{
    exit;
  }
}


// plugin előkészítés
function wdhd_init(){
  global $locale, $wp_local_package,$wdhd_options,$wdhd_plugin_version,
         $wdhd_user_role_list,$wdhd_category,$wdhd_locale,
         $wdhd_dir_lang;

  // nyelvi beállítás
  $loc="";
  if (isset($locale)){
    $loc=$locale;
  }
  if (($loc==="")and(isset($wp_local_package))){
    $loc=$wp_local_package;
  }
  // nyelvi fájl betöltése
  if (file_exists(__DIR__.$wdhd_dir_lang."/".$loc.".php")){
    include(__DIR__.$wdhd_dir_lang."/".$loc.".php");
    $wdhd_locale=$loc;
  }else{
    if (file_exists(__DIR__.$wdhd_dir_lang."/".$wdhd_locale.".php")){
      include(__DIR__.$wdhd_dir_lang."/".$wdhd_locale.".php");
    }
  }
  // rendszerbeállítások fordításai
  $i=0;
  foreach($wdhd_user_role_list as $ur){
    $wdhd_user_role_list[$i]=wdhd_lang($wdhd_user_role_list[$i]);
    $i++;
  }
  $i=0;
  foreach($wdhd_category as $c){
    $wdhd_category[$i]=wdhd_lang($wdhd_category[$i],false);
    $i++;
  }
}
add_action('init','wdhd_init');


// fejrész
function wdhd_head(){
  global $wdhd_inc_head;

  if (file_exists(__DIR__.$wdhd_inc_head)){
    include(__DIR__.$wdhd_inc_head);
  }
}
add_action('wp_head','wdhd_head');

// lábrész
function wdhd_footer(){
  global $wdhd_inc_footer;

  if (file_exists(__DIR__.$wdhd_inc_footer)){
    include(__DIR__.$wdhd_inc_footer);
  }
}
add_action('wp_footer','wdhd_footer');


// js script és css betöltése
function wdhd_inc(){
  global $wdhd_inc_css,$wdhd_inc_js;

  if (file_exists(__DIR__.$wdhd_inc_css)){
    wp_enqueue_style('wdhd_css',plugin_dir_url(__FILE__).$wdhd_inc_css);
  }
  if (file_exists(__DIR__.$wdhd_inc_js)){
    wp_enqueue_script('wdhd_js',plugin_dir_url(__FILE__).$wdhd_inc_js);
  }
}
add_action('wp_enqueue_scripts','wdhd_inc');


//
function wdhd_login_redirect(){
  return(home_url());
}
add_filter('login_redirect', 'wdhd_login_redirect');


// kilépés
function wdhd_logout_redirect(){
    return(home_url());
}
add_filter('logout_redirect','wdhd_logout_redirect');


// plugin bekapcsolási feladatok
function wdhd_setup(){
  wdhd_db_init();
  wdhd_sys_init();
}

// plugin bekapcsolás
function wdhd_activate(){
  global $wdhd_category;

  foreach($wdhd_category as $cat){
    if (!category_exists($cat)){
      wp_create_category($cat);
    }
  }
  wdhd_setup();
}
register_activation_hook(__FILE__,'wdhd_activate' );

// plugin kikapcsolás
function wdhd_deactivate(){
}
register_deactivation_hook(__FILE__,'wdhd_deactivate' );


// shortcode kezelés [wdhd] text [/wdhd]
function wdhd_shortcode($atts=[],$content=null,$tag=''){
  $content=wdhd_main_center($atts,$content,$tag);
  return($content);
}
add_shortcode('wdhd','wdhd_shortcode');


?>
