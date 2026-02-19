<?php

// felhasználó META adatok

// MINDÍG TÖMBÖT KEZELÜNK
// CSAK ALKALMAZÁS FÜGGVÉNYEN BELÜL MŰKÖDIK, AKKOR VAN WP FELHASZNÁLÓ


// felhasználóhoz tartozó adatok mentése mint a cookie
function wswdteam_save_metadata($tomb=array()){
  global $wswdteam_meta_name;

  $user_id=get_current_user_id();
  if ($user_id!=0){
    update_user_meta($user_id,$wswdteam_meta_name,$tomb);
  }
}



// felhasználóhoz tartozó adatok visszaolvasása
function wswdteam_get_metadata(){
  global $wswdteam_meta_name;

  $user_id=get_current_user_id();
  if ($user_id!=0){
    $prefs=get_user_meta($user_id,$wswdteam_meta_name,true);
    if (!empty($prefs) && is_array($prefs)){
      return($prefs);    
    }
  }
  return(false);
}



// felhasználóhoz tartozó adatok törlése
function wswdteam_delete_metadata(){
  global $wswdteam_meta_name;

  $user_id=get_current_user_id();
  if ($user_id!=0){
    delete_user_meta($user_id,$wswdteam_meta_name);
  }
}




?>
