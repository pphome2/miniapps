<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// jogosultság lekérdezése
function wdhd_user_right(){
  global $wdhd_table,$wpdb,$wdhd_user_name;

  $cuser=wp_get_current_user();
  $wdhd_user_name=$cuser->user_login;
  $table_name=$wpdb->prefix.$wdhd_table[1];
  $sql="SELECT * FROM $table_name WHERE uname='$wdhd_user_name';";
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
  $cuser=wp_get_current_user();
  $r=$cuser->user_nicename;
  return($r);
}


// felhasználó neve
function wswdteam_user_fullname(){
  $cuser=wp_get_current_user();
  //$r=$cuser->first_name;
  //$r=$r." ".$cuser->last_name;
  $r=$cuser->display_name;
  return($r);
}


?>
