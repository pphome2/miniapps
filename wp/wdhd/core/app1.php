<?php

// app

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


function wdhd_1($l="",$urole=999){
  $c=$l;

  $cuser=wp_get_current_user();
  $username=$cuser->user_login;
  $c=$cuser->user_nicename." . ".$cuser->user_email;

  return($c);
}



?>
