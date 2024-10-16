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
foreach ($wswdteam_table as $t){
  $tn=$wpdb->prefix.$t;
  $sql="DROP TABLE IF EXISTS $n;";
  $r=$wpdb->query($sql);
}

?>

