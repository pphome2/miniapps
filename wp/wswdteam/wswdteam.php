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
 * Text Domain:       plugin-slug
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://wswdteam.hu/plugin/
 * Requires Plugins:  
 */


require_once(__DIR__ . '/core/config.php');
require_once(__DIR__ . '/core/lib1.php');


// exit if accessed directly
if (!defined('ABSPATH')){
  exit;
}

// init the plugin
function wswdteam_init(){
}
add_action('init','wswdteam_init');

// init the plugin
function wswdteam_head(){
  require_once(__DIR__ . '/inc/css.php');
  require_once(__DIR__ . '/inc/js.php');
}
add_action('wp_head', 'wswdteam_head');

// admin mode
if (is_admin()){
  require_once(__DIR__ . '/admin/admin.php');
}

// activate setup
function wswdteam_setup(){
  global $wpdb,$wswdteam_db_version,$wswdteam_table;

  $table_name=$wpdb->prefix.$wswdteam_table;
  $charset_collate=$wpdb->get_charset_collate();

  $sql="CREATE TABLE IF NOT EXISTS $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    name tinytext NOT NULL,
    text text NOT NULL,
    url varchar(55) DEFAULT '' NOT NULL,
    PRIMARY KEY  (id)
  ) $charset_collate;";

  //require_once ABSPATH.'wp-admin/includes/upgrade.php';
  //dbDelta($sql);
  $r=$wpdb->query($sql);
  add_option('jal_db_version', $wswdteam_db_version );
}

// activate the plugin
function wswdteam_activate(){
  wswdteam_setup();
}
register_activation_hook(__FILE__,'wswdteam_activate' );

// deactivation plugin
function wswdteam_deactivate(){
  global $wpdb,$wswdteam_db_version,$wswdteam_table;

  $table_name=$wpdb->prefix.$wswdteam_table;
  $sql="DROP TABLE IF EXISTS $table_name;";
  //$r=$wpdb->query($sql);
}
register_deactivation_hook(__FILE__,'wswdteam_deactivate' );


// shortcode [wswdteam] text [/wswdteam]
add_shortcode('wswdteam','wswdteam_shortcode');
function wswdteam_shortcode($atts=[],$content=null,$tag=''){
  global $wpdb,$wswdteam_db_version,$wswdteam_table;

  $i=0;
  $content=$content.'<br />';
  foreach($atts as $k){
    $content=$content.' - '.$k.' '.$i;
    switch($k){
      case 'egy':
        $content=$content.' - egyes';
        break;
      case 'kettő':
        $content=$content.' - kettes';
        break;
    }
    $content=$content.'<br />';
    $i++;
  }
  $content='<b>shortcoded - '.$tag.'</b> '.$content;
  $table_name=$wpdb->prefix.$wswdteam_table;
 
  $content=$content.'<br /><br />SQL:<br /><br />';
  $sql="SELECT * FROM $table_name;";
  //$r=$wpdb->query($sql);
  $res=$wpdb->get_results($sql);
  $i=1;
  foreach($res as $t) {
    $content=$content."$i - ";
    $content=$content.$t->name;
    $content=$content.' - ';
    $content=$content.$t->text;
    $content=$content.'<br />';
    $i++;
  }

  return $content;
}


// WP load file:
// plugins_url( 'myscript.js', __FILE__ ); -- full pth of file

// get plugins path:
// plugins_url()
// plugin_dir_url()
// plugin_dir_path()
// plugin_basename()

// load script or css:
// wp_enqueue_script() or wp_enqueue_style()

// get wp path:
// home_url()
// get_home_path()
// admin_url()
// site_url()
// content_url()
// includes_url()
// wp_upload_dir()

// wp constans:
// WP_CONTENT_DIR - full paths
// WP_CONTENT_URL - full url 
// WP_PLUGIN_DIR - full path
// WP_PLUGIN_URL - full url
// UPLOADS - /wp-content/uploads

?>
