<?php

// main - vezérlés és adatbázis feladatok

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// shortcode vezérlés
function wswdteam_main_center($atts=[],$content=null,$tag=''){
  global $wpdb,$wswdteam_db_version,$wswdteam_table;

  if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
  }else{
    $cuser=wp_get_current_user();
    $username=$cuser->user_login;
    $content=$content."---".$username."---";
    $i=0;
    $content.'<br />';
    foreach($atts as $k){
      switch($k){
        case 'egy':
          $content=$content.wswdteam_1();
          break;
        case 'kettő':
          $content=$content.wswdteam_2();
          break;
      }
      $i++;
    }
    $content=wswdteam_x($content);
    return $content;
  }
}


function wswdteam_1(){
  $c='<br />egyes';

  return($c);
}


function wswdteam_2(){
  $c='<br />kettes';

  return($c);
}


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

