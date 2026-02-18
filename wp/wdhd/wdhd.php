<?php
/**
 * Plugin Name
 *
 * @package           WDHD plugin
 * @author            WSWDTeam
 * @copyright         2026 WSWDTeam
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




// A 'plugins_loaded' eseménynél már minden plugin függvénye elérhető
add_action('plugins_loaded',function() {
  if (defined('WSWDTEAM')){
    // előkészítés
    wdhd_main();
    // admin ellenőrzés, verziók
    if (is_admin()){
      wdhd_admin_menu();
    }
  }else{
    add_action('admin_notices',function(){
      echo('<div class="error"><p>A "WSWDTEAM" plugin szükséges a működéshez!</p></div>');
    });
  }
});



// betöltés, ha létezik minden előírt plugin
function wdhd_main(){
  global $wdhd_main_files,$wdhd_content_files,$wdhd_admin_file,$exit,
          $wdhd_dwveloper_mode,$wswdteam_developer_mode,
          $wdhd_pagerow,$wswdteam_pagerow;

  // alkalmazásfájlok betöltése
  if (isset($wdhd_content_files)){
    foreach($wdhd_content_files as $f){
      if (file_exists(__DIR__.$f)){
        include(__DIR__.$f);
      }else{
        exit;
      }
    }
  }
  $dev=wdhd_get_param("wdhd_developer_mode");
  if (isset($wswdteam_developer_mode)){
    $wdhd_developer_mode=$wswdteam_developer_mode;
    $dev='';
  }
  if ($dev===''){
    if ($wdhd_developer_mode){
      wdhd_save_param("wdhd_developer_mode","true");
      $dev="true";
    }else{
      wdhd_save_param("wdhd_developer_mode","false");
      $dev="false";
    }
  }
  if ($dev==="true"){
    $wdhd_developer_mode=true;
  }else{
    $wdhd_developer_mode=false;
  }
  $wdhd_pagerow=$wswdteam_pagerow;

  // rendszer beállítás
  wdhd_init();
}



// plugin előkészítés
function wdhd_init(){
  global $locale, $wp_local_package,$wdhd_options,$wdhd_plugin_version,
         $wdhd_user_role_list,$wdhd_category,$wdhd_locale,
         $wdhd_dir_lang,$wdhd_ticket_type,$wdhd_developer_mode;

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
    $wdhd_user_role_list[$i]=wdhd_lang($wdhd_user_role_list[$i],false);
    $i++;
  }
  $i=0;
  foreach($wdhd_category as $c){
    $wdhd_category[$i]=wdhd_lang($wdhd_category[$i],false);
    $i++;
  }
  $i=0;
  foreach($wdhd_ticket_type as $c){
    $wdhd_ticket_type[$i]=wdhd_lang($wdhd_ticket_type[$i],false);
    $i++;
  }
  if (isset($wswdteam_developer_mode)){
    $wdhd_developer_mode=$wswdteam_developer_mode;
  }
}
//add_action('init','wdhd_init');


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
    include(__DIR__.$wdhd_inc_css);
  }
  if (file_exists(__DIR__.$wdhd_inc_js)){
    include(__DIR__.$wdhd_inc_js);
  }
}
add_action('wp_enqueue_scripts','wdhd_inc');


// js script és css betöltése
function wdhd_admin_inc(){
  global $wdhd_inc_admin_css,$wdhd_inc_admin_js;

  if (is_admin()){
    // admin script betöltés 
    if (file_exists(__DIR__.$wdhd_inc_admin_css)){
      include(__DIR__.$wdhd_inc_admin_css);
    }
    if (file_exists(__DIR__.$wdhd_inc_admin_js)){
      include(__DIR__.$wdhd_inc_admin_js);
    }
  }
}
add_action('admin_enqueue_scripts','wdhd_admin_inc');


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
function wdhd_sys_setup(){
  wdhd_db_init();
  wdhd_sys_init();
}



// rendszer ellenőrzés
function wdhd_sys_init(){
  global $wdhd_plugin_version,$wdhd_options,$wdhd_developer_mode;

  $ver=get_option($wdhd_options[0],'0');
  // nincs plugin
  if ($ver==="0"){
    // új
    wdhd_sys_new($ver,$wdhd_plugin_version);
    wdhd_save_param($wdhd_options[0],$wdhd_plugin_version);
  }else{
    // frissítés kell
    if ($ver<>$wdhd_plugin_version){
      wdhd_sys_upgrade($ver,$wdhd_plugin_version);
      wdhd_save_param($wdhd_options[0],$wdhd_plugin_version);
    }
  }
}



// plugin bekapcsolás
function wdhd_activate(){
  global $wdhd_category,$wdhd_options;

  foreach($wdhd_category as $cat){
    if (!category_exists($cat)){
      wp_create_category($cat);
    }
  }
  wdhd_sys_setup();
}
register_activation_hook(__FILE__,'wdhd_activate');


// plugin kikapcsolás
function wdhd_deactivate(){
global $wdhd_options;

  delete_option($wdhd_options[0]);
  delete_option($wdhd_options[1]);
}
register_deactivation_hook(__FILE__,'wdhd_deactivate');


// shortcode kezelés [wdhd] text [/wdhd]
function wdhd_shortcode($atts=[],$content=null,$tag=''){
  $content=wdhd_main_center($atts,$content,$tag);
  return($content);
}
add_shortcode('wdhd','wdhd_shortcode');


?>
