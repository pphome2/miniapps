<?php

// main - vezérlés és adatbázis feladatok

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// shortcode vezérlés
function wswdteam_main_center($atts=[],$content=null,$tag=''){
  global $wswdteam_category,$wswdteam_table,$wpdb;

  if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
  }else{
    // jogok beállítása
    $cuser=wp_get_current_user();
    $username=$cuser->user_login;
    $table_name=$wpdb->prefix.$wswdteam_table[1];
    $sql="SELECT * FROM $table_name WHERE uname='$username';";
    $res=$wpdb->get_results($sql);
    if (count($res)<>0){
      $t=$res[0];
      $ur=$t->urole;
    }else{
     $ur=9999;
    }
    $i=0;
    $content=$content."<div class=\"wswdteam_content\">";
    foreach($atts as $k){
      switch($k){
        case '+':
          $content=$content.wswdteam_1($k,$ur);
          break;
        case 'open':
          $content=$content.wswdteam_2($k,$ur);
          break;
        case 'list':
          $content=$content.wswdteam_2($k,$ur);
          break;
        case 'help':
          $content=$content.wswdteam_postlist_view($wswdteam_category[0]);
          break;
        default:
            wp_redirect(home_url());
          break;
      }
      $i++;
    }
    //$content=wswdteam_x($content);
    $content=$content."</div>";
    return $content;
  }
}
   
   
// rendszer ellenőrzés
function wswdteam_sys_init(){
  global $wswdteam_plugin_version,$wswdteam_options;

  $ver=get_option($wswdteam_options[1],'0');
  // nincs adatbázis
  if ($ver==="0"){
    // új
  }else{
    // frissítés kell
  }
  wswdteam_save_param();
}

// rendszer frissítése
function wswdteam_sys_upgrade($installed='',$new=''){
  global $wswdteam_plugin_version,$wswdteam_options,$wswdteam_table,$wpdb,
         $wswdteam_db_version;

  update_option($wswdteam_options[0],$new);
}


// verziók mint paraméter
function wswdteam_save_param(){
  global $wswdteam_plugin_version,$wswdteam_options,$wswdteam_table,$wpdb,
         $wswdteam_db_version;

  $table_name=$wpdb->prefix.$wswdteam_table[0];
  $sql="SELECT * FROM $table_name WHERE name='$wswdteam_options[0]';";
  $r=$wpdb->query($sql);
  if ($r){
    $sql="DELETE FROM $table_name WHERE name='$wswdteam_options[0]';";
    $r=$wpdb->query($sql);
  }
  $sql="SELECT * FROM $table_name WHERE name='$wswdteam_options[1]';";
  $r=$wpdb->query($sql);
  if ($r){
    $sql="DELETE FROM $table_name WHERE name='$wswdteam_options[1]';";
    $r=$wpdb->query($sql);
  }
  $sql="INSERT INTO $table_name (name,text) VALUES ('$wswdteam_options[1]','$wswdteam_plugin_version');";
  $r=$wpdb->query($sql);
  $sql="INSERT INTO $table_name (name,text) VALUES ('$wswdteam_options[0]','$wswdteam_db_version');";
  $r=$wpdb->query($sql);
}
 

// teszt: sql lekérdezés
function wswdteam_x($c){
  global $wpdb,$wswdteam_table;

  $table_name=$wpdb->prefix.$wswdteam_table[0];
  $c=$c.'<br /><br />SQL:<br /><br />';
  $sql="SELECT * FROM $table_name;";
  $res=$wpdb->get_results($sql);
  $i=1;
  foreach($res as $t) {
    $c=$c."$i - ";
    $c=$c.$t->name;
    $c=$c.' - ';
    $c=$c.$t->text;
    $c=$c.'<br />';
    $i++;
  }

  return($c);
}


?>
