<?php

// felhasználó META adatok

// MINDÍG TÖMBÖT KEZELÜNK
// CSAK ALKALMAZÁS FÜGGVÉNYEN BELÜL MŰKÖDIK, AKKOR VAN WP FELHASZNÁLÓ

// OPTION ESETÉN TÖMBBEN ÉRDEMES TÁROLNI AZ ADATOKAT, KÜLÖN NÉV IS ADHATÓ

// option teszt
  //$t=array("nev"=>"senki","adat"=>"valami");
  //  wswdteam_save_option($t,"w");
  //  $t2=wswdteam_get_option("w");
  //  if ($t2){
  //    echo("----------------------------------> ".$t2["nev"]);
  //  }else{
  //    echo("hiba");
  //  }
  //  wswdteam_delete_option("w");



// OPTION adatok mentése mint a cookie
function wswdteam_save_option($tomb,$name=""){
  global $wswdteam_option_name;

  if ($name===""){
    $name=$wswdteam_option_name;
  }
  $v=false;
  if ((isset($tomb))&&(is_array($tomb))){
    $v=update_option($name, $tomb);
  }
  return($v);
}



// OPTION adatok visszaolvasása
function wswdteam_get_option($name=""){
  global $wswdteam_option_name;

  if ($name===""){
    $name=$wswdteam_option_name;
  }
  $prefs=get_option($name);
  if (!empty($prefs)){
    return($prefs);    
  }
  return(false);
}



// OPTION adatok törlése
function wswdteam_delete_option($name=""){
  global $wswdteam_option_name;

  if ($name===""){
    $name=$wswdteam_option_name;
  }
  $r=false;
  $r=delete_option($name);
  return($r);
}



// META FELHASZNÁLÓ ADATOK LEZELÉSE

// felhasználóhoz tartozó adatok mentése mint a cookie
function wswdteam_save_metadata($tomb=array()){
  global $wswdteam_meta_name;

  $id=get_current_user_id();
  if (($id!=0)&&($id!="")){
    update_user_meta($id,$wswdteam_meta_name,$tomb);
  }
}



// felhasználóhoz tartozó adatok visszaolvasása
function wswdteam_get_metadata(){
  global $wswdteam_meta_name;

  $id=get_current_user_id();
  if (($id!=0)&&($id!="")){
    $prefs=get_user_meta($id,$wswdteam_meta_name,true);
    if (!empty($prefs) && is_array($prefs)){
      return($prefs);    
    }
  }
  return(false);
}



// felhasználóhoz tartozó adatok törlése
function wswdteam_delete_metadata(){
  global $wswdteam_meta_name;

  $id=get_current_user_id();
  if (($id!=0)&&($id!="")){
    delete_user_meta($id,$wswdteam_meta_name);
  }
}




?>
