<?php

// segéd függvények


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}




// paraméter mentése
function wswdteam_save_param($data){
  wswdteam_save_option($data);
}



// paraméter beolvasása
function wswdteam_get_param(){
  $r="";
  $r=wswdteam_get_option();
  return($r);
}



// paraméter mentése app
function wswdteam_save_param_app($data,$name=""){
  wswdteam_save_option($data,$name);
}



// paraméter beolvasása
function wswdteam_get_param_app($name=""){
  $r=wswdteam_get_option($name);
  return($r);
}



// paraméter mentése app
function wswdteam_save_param_sql_app($table,$name="",$data=""){
  global $wpdb;

  $table_name=$wpdb->prefix.$table[0];
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
function wswdteam_get_param_sql_app($table,$name=""){
  global $wpdb;

  $r="";
  $table_name=$wpdb->prefix.$table[0];
  $sql="SELECT * FROM $table_name WHERE name='$name';";
  $res=$wpdb->get_results($sql);
  if ($res){
    $t=$res[0];
    $r=$t->text;
  }
  return($r);
}


?>
