<?php

// SQL adatbázis feladatok

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}



// adatbázisban sql végrehajtása
function wswdteam_sql($sql=''){
  global $wpdb;

  if (!empty($sql)){
    $r=$wpdb->query($sql);
  }else{
    $r="";
  }
  retur($r);
}


?>
