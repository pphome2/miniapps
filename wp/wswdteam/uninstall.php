<?php

// uninstall plugin

require_once(__DIR__ . '/config.php');

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')){
  die;
}

$option_name='wswdteam_option';
delete_option($option_name);

$table_name=$wpdb->prefix.$wswdteam_table;
$sql="DROP TABLE IF EXISTS $table_name;";
$r=$wpdb->query($sql);

?>

