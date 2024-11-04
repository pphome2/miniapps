<?php

// plugin eltávolítás

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
foreach ($wdhd_table as $t){
  $tn=$wpdb->prefix.$t;
  $sql="DROP TABLE IF EXISTS $n;";
  $r=$wpdb->query($sql);
}


// tárolt változók törlése
foreach ($wdhd_options as $o){
  delete_option($o);
}

// tárolt változók törlése
foreach ($wdhd_category as $c){
  $cid=get_cat_ID($c);
  wp_delete_category($cid);
}


?>
