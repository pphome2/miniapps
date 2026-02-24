<?php

// segéd függvények


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// teljes paraméterkezelés
function wswdteam_param_admin(){
  // POST adatok kezelése
  wswdteam_param_formdata();
  // főbb funkciók
  if (isset($_POST['new'])){
    // új adat gomb a táblából
    wswdteam_param_form();
  }else{
    if (!isset($_POST['m'])){
      wswdteam_param_table();
      wswdteam_post_load();
      wswdteam_page_load();
    }
  }
}



// teljes paraméterkezelés
function wswdteam_param_admin_app($name,$dir1,$dir2){
  if ($name!=""){
    // POST adatok kezelése
    wswdteam_param_formdata_app($name);
    // főbb funkciók
    if (isset($_POST['new'])){
      // új adat gomb a táblából
      wswdteam_param_form_app($name);
    }else{
      if (!isset($_POST['m'])){
        wswdteam_param_table_app($name);
        wswdteam_post_load_app($dir1);
        wswdteam_page_load_app($dir2);
      }
    }
  }
}



// adat formból, feldolgozás
function wswdteam_param_formdata(){
  global $wswdteam_option_name;

  wswdteam_param_formdata_app($wswdteam_option_name);
}



// adat form
function wswdteam_param_form(){
  wswdteam_param_form_app();
}


// adat tábla
function wswdteam_param_table(){
  global $wswdteam_option_name;

  wswdteam_param_table_app($wswdteam_option_name);
}



//fejléc
function wswdteam_param_pagehead(){
  wswdteam_param_pagehead_app();
}



// bejegyzése betöltése könyvtárból
function wswdteam_post_load(){
  global $wswdteam_dir_post,$wswdteam_locale;
  
  wswdteam_post_load_app(dirname(dirname(__FILE__)).$wswdteam_dir_post,$wswdteam_locale);
}



// lapok betöltése könyvtárból
function wswdteam_page_load(){
  global $wswdteam_dir_page,$wswdteam_locale;
  
  wswdteam_page_load_app(dirname(dirname(__FILE__)).$wswdteam_dir_page,$wswdteam_locale);
}



// paraméter mentése
function wswdteam_save_param($data){
  wswdteam_save_option($data);
}



// paraméter beolvasása
function wswdteam_get_param(){
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
