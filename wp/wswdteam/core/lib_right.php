<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// jogosultság lekérdezése
function wswdteam_user_right(){
  global $wswdteam_table,$wpdb,$wswdteam_user_name;

  $cuser=wp_get_current_user();
  $wswdteam_user_name=$cuser->user_login;
  $table_name=$wpdb->prefix.$wswdteam_table[1];
  $sql="SELECT * FROM $table_name WHERE uname='$wswdteam_user_name';";
  $res=$wpdb->get_results($sql);
  if (count($res)<>0){
    $t=$res[0];
    $ur=$t->urole;
  }else{
    $um=get_userdata(get_current_user_id());
    $us=$um->roles[0];
    if ($us==="administrator"){
      $ur=0;
    }else{
      $ur=9999;
    }
  }
  return($ur);
}


// felhasználó neve
function wswdteam_user_nicename(){
  global $wswdteam_user_name;

  $cuser=wp_get_current_user();
  $r=$cuser->user_nicename;
  return($r);
}

?>
