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
foreach ($wswdteam_table as $t){
  $tn=$wpdb->prefix.$t;
  $sql="DROP TABLE IF EXISTS $tn;";
  $r=$wpdb->query($sql);
}


// tárolt változók törlése
foreach ($wswdteam_options as $o){
  delete_option($o);
}

// tárolt változók törlése
foreach ($wswdteam_category as $c){
  $cid=get_cat_ID($c);
  wp_delete_category($cid);
}

// mentésfájlok törlése
$md=wp_upload_dir();
try{
  $bfile=$md['basedir'].'/'.$wswdteam_app_name.'.sql';
  if (file_exists($bfile)){
    unlink($bfile);
  }
  $bfile=$md['basedir'].'/'.$wswdteam_app_name.'.tar.gz';
  if (file_exists($bfile)){
    unlink($bfile);
  }
  $bd=$md['basedir'].'/'.$wswdteam_app_name;
  if (is_dir($bd)){
    $fl=scandir($bd);
    foreach($fl as $l){
      if (!in_array($l,array('.','..'))){
        unlink($bd."/".$l);
      }
    }
    rmdir($bd);
  }
}catch(Exception $e){
}

?>
