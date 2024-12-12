<?php

// main - vezérlés és adatbázis feladatok

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// shortcode vezérlés
function wdhd_main_center($atts=[],$content=null,$tag=''){
  global $wdhd_category;

  if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
  }else{
    // jogosultság ellenőrzése
    $ur=wdhd_user_right();
    //if (!in_array($ur,[0])){
      //$l=wdhd_lang('Nem megfelelő jogosultság');
      //wdhd_error($l);
    //}else{
    $i=0;
    $content=$content."<div class=\"wdhd_content\">";
    foreach($atts as $k){
      switch($k){
        case '+':
          $content=$content.wdhd_new($k,$ur);
          break;
        case 'ticket':
          $content=$content.wdhd_ticket($k,$ur);
          break;
        case 'list':
          $content=$content.wdhd_service($k,$ur);
          break;
        case 'help':
          $content=$content.wdhd_postlist_view($wdhd_category[0]);
          break;
        default:
            wp_redirect(home_url());
          break;
      }
      $i++;
    }
    $content=$content."</div>";
    $content=$content.wdhd_lang_newlines();
    return $content;
  }
}



?>
