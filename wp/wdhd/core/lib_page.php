<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// lapozó admin felületen
function wdhd_pager_admin($db=0,$row=0,$apage=0,$formid=""){
  if (function_exists('wswdteam_pager_admin')){
    wswdteam_pager_admin($db=0,$row=0,$apage=0,$formid="");
  }
}


// lapozó felhasználói felületen
function wdhd_pager($db=0,$row=0,$apage=0,$formid="",$little=false){
  if (function_exists('wswdteam_pager')){
    wswdteam_pager($db=0,$row=0,$apage=0,$formid="",$little=false);
  }
}



?>
