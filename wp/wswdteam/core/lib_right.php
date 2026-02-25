<?php

// segéd függvények

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}




// jogosultság lekérdezése
function wswdteam_user_right($user=""){
  global $wswdteam_user_role,$wswdteam_option_user_name;

  if ($user===""){
    $user=wp_get_current_user();
  }
  $data=wswdteam_get_option($wswdteam_option_user_name);
  $ur="";
  if (isset($data[$user])){
    $ur=$data[$user];
  }
  if ($ur===""){
    $ur=$wswdteam_user_role;
  }
  return($ur);
  return($ur);
}



// jogosultság lekérdezése
function wswdteam_user_right_app($name,$user){
  global $wswdteam_user_role;

  $data=wswdteam_get_option($name);
  $ur="";
  if (isset($data[$user])){
    $ur=$data[$user];
  }
  if ($ur===""){
    $ur=$wswdteam_user_role;
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
function wswdteam_user_nicename_app(){
  $r=wswdteam_user_nicename();
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



// felhasználó neve
function wswdteam_user_fullname_app(){
  $r=wswdteam_user_fullname();
  return($r);
}


?>
