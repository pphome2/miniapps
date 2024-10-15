<?php

// uninstall plugin

// ha nem a wp rendszer indította
if (!defined('WP_UNINSTALL_PLUGIN')){
  die;
}

// beállítások betöltése
if (file_exists(__DIR__.'/core/config.php')){
  include(__DIR__.'/core/config.php');
}else{
  exit;
}

// adatbázis tisztítása
$table_name=$wpdb->prefix.$wswdteam_table;
$sql="DROP TABLE IF EXISTS $table_name;";
$r=$wpdb->query($sql);

?>

