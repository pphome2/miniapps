<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}



// paraméter mentése
function wswdteam_save_param($name="",$data=""){
  global $wswdteam_table,$wpdb,$wswdteam_db_version;

  $table_name=$wpdb->prefix.$wswdteam_table[0];
  $sql="SELECT * FROM $table_name WHERE name='$name';";
  $r=$wpdb->query($sql);
  if ($r){
    $sql="UPDATE $table_name SET text='$data' WHERE name='$name';";
  }else{
    $sql="INSERT INTO $table_name (name,text) VALUES ('$name','$data');";
  }
  $r=$wpdb->query($sql);
}


// paraméter beolvasása
function wswdteam_get_param($name=""){
  global $wswdteam_table,$wpdb,$wswdteam_db_version;

  $r="";
  $table_name=$wpdb->prefix.$wswdteam_table[0];
  $sql="SELECT * FROM $table_name WHERE name='$name';";
  $res=$wpdb->get_results($sql);
  $t=$res[0];
  $r=$t->text;
  return($r);
}


?>
