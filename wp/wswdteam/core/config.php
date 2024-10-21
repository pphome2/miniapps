<?php

// alap beállítások

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}

global $wswdteam_db_version;
$wswdteam_db_version='1.0';

global $wswdteam_plugin_version;
$wswdteam_plugin_version='1.0';

global $wswdteam_table;
$wswdteam_table=array('wswdteam');

global $wswdteam_options;
$wswdteam_options=array('wswdteam_db_version',
                        'wswdteam_plugin_version'
                        );

global $WSWDTEAM_MAIN_FILES;
$WSWDTEAM_MAIN_FILES=array('/core/main.php',
                           '/core/sql.php',
                           '/core/lib1.php'
                           );

global $wswdteam_locale;

global $wswdteam_pagerow;
$wswdteam_pagerow=2;



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

