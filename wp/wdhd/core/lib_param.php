<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// paraméter mentése
function wdhd_save_param($name="",$data=""){
  global $wdhd_table,$wpdb,$wdhd_db_version;

  $table_name=$wpdb->prefix.$wdhd_table[0];
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
function wdhd_get_param($name=""){
  global $wdhd_table,$wpdb,$wdhd_db_version;

  $r="";
  $table_name=$wpdb->prefix.$wdhd_table[0];
  $sql="SELECT * FROM $table_name WHERE name='$name';";
  $res=$wpdb->get_results($sql);
  if ($res){
    $t=$res[0];
    $r=$t->text;
  }
  return($r);
}

?>
