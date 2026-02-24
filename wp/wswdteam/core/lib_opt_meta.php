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
    $v=update_option($name,$tomb);
  }
  return($v);
}



// OPTION adatok visszaolvasása
function wswdteam_get_option($name=""){
  global $wswdteam_option_name;

  if ($name===""){
    $name=$wswdteam_option_name;
  }
  $tomb=get_option($name);
  if (!is_array($tomb)){
    $tomb=array();
  }
  return($tomb);
}



// OPTION adatok törlése
function wswdteam_delete_option($name=""){
  global $wswdteam_option_name;

  if ($name===""){
    $name=$wswdteam_option_name;
  }
  $r=delete_option($name);
  return($r);
}



// OPTION adatok mentése mint a cookie
function wswdteam_add_option($ti="",$d="",$name=""){
  global $wswdteam_option_name;

  if ($name===""){
    $name=$wswdteam_option_name;
  }
  if (($ti<>"")&&($d<>"")){
    $data=wswdteam_get_option($name);
    if (!isset($data[$ti])||($data[$ti]!=$d)){
      $data[$ti]=$d;
      $v=false;
      $v=update_option($name,$data);
    }
  }
  return($v);
}




// META FELHASZNÁLÓ ADATOK LEZELÉSE

// felhasználóhoz tartozó adatok mentése mint a cookie
function wswdteam_save_metadata($tomb=array(),$name=""){
  global $wswdteam_meta_name;

  if ($name===""){
    $name=$wswdteam_meta_name;
  }
  $id=get_current_user_id();
  if (($id!=0)&&($id!="")){
    update_user_meta($id,$name,$tomb);
  }
}



// felhasználóhoz tartozó adatok visszaolvasása
function wswdteam_get_metadata($name=""){
  global $wswdteam_meta_name;

  if ($name===""){
    $name=$wswdteam_meta_name;
  }
  $id=get_current_user_id();
  if (($id!=0)&&($id!="")){
    $prefs=get_user_meta($id,$name,true);
    if (!empty($prefs) && is_array($prefs)){
      return($prefs);    
    }
  }
  return(false);
}



// felhasználóhoz tartozó adatok törlése
function wswdteam_delete_metadata($name=""){
  global $wswdteam_meta_name;

  if ($name===""){
    $name=$wswdteam_meta_name;
  }
  $id=get_current_user_id();
  if (($id!=0)&&($id!="")){
    delete_user_meta($id,$name);
  }
}




?>
