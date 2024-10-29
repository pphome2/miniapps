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



if (file_exists(__DIR__.'/core/config.php')){
  include(__DIR__.'/core/config.php');
}else{
  exit;
}

if (isset($wswdteam_main_files)){
  foreach($wswdteam_main_files as $f){
    if (file_exists(__DIR__.$f)){
      include(__DIR__.$f);
    }else{
      exit;
    }
  }
}


// admin mód
if (is_admin()){
  if (file_exists(__DIR__.'/admin/admin.php')){
    include(__DIR__.'/admin/admin.php');
  }else{
    exit;
  }
}


// plugin előkészítés
function wswdteam_init(){
  global $locale, $wp_local_package,$wswdteam_options,$wswdteam_plugin_version,
         $wswdteam_user_role_list,$wswdteam_category;

  $loc="";
  if (isset($locale)){
    $loc=$locale;
  }
  if (($loc==="")and(isset($wp_local_package))){
    $loc=$wp_local_package;
  }
  if (file_exists(__DIR__."/lang/".$loc.".php")){
    include(__DIR__."/lang/".$loc.".php");
  }

  $ver=get_option($wswdteam_options[1],'0');
  if ($ver==="0"){
    add_option($wswdteam_options[1],$wswdteam_plugin_version);
    wswdteam_setup();
  }else{
    if ($ver<>$wswdteam_plugin_version){
      wswdteam_setup();
    }
  }
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
}
add_action('init','wswdteam_init');


// fejrész
function wswdteam_head(){
  if (file_exists(__DIR__.'/inc/wswdteam_head.php')){
    include(__DIR__.'/inc/wswdteam_head.php');
  }
}
add_action('wp_head','wswdteam_head');

// lábrész
function wswdteam_footer(){
  if (file_exists(__DIR__.'/inc/wswdteam_footer.php')){
    include(__DIR__.'/inc/wswdteam_footer.php');
  }
}
add_action('wp_footer','wswdteam_footer');


// js script és css betöltése
function wswdteam_inc(){
  if (file_exists(__DIR__.'/inc/wswdteam.css')){
    wp_enqueue_style('wswdteam_css',plugin_dir_url(__FILE__).'inc/wswdteam.css');
  }
  if (file_exists(__DIR__.'/inc/wswdteam.js')){
    wp_enqueue_script('wswdteam_js',plugin_dir_url(__FILE__).'inc/wswdteam.js');
  }
}
add_action('wp_enqueue_scripts','wswdteam_inc');


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
  global $wswdteam_category;

  wswdteam_db_init();
  foreach($wswdteam_category as $cat){
    if (!category_exists($cat)){
      wp_create_category($cat);
    }
  }
}


// plugin bekapcsolás
function wswdteam_activate(){
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
