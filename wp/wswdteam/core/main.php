<?php

// main - vezérlés és adatbázis feladatok

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// shortcode vezérlés
function wswdteam_main_center($atts=[],$content=null,$tag=''){
  global $wswdteam_category;

  if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
  }else{
    // jogosultság ellenőrzése
    $ur=wswdteam_user_right();
    //if (!in_array($ur,[0])){
      //$l=wswdteam_lang('Nem megfelelő jogosultság');
      //wswdteam_error($l);
    //}else{
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
      //}
      $i++;
    }
    //$content=wswdteam_x($content);
    $content=$content."</div>";
    $content=$content.wswdteam_lang_newlines();
    return $content;
  }
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
