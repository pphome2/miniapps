<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// fordítás
function wswdteam_lang($text='',$dot=true){
  global $wswdteam_lang_str,$wswdteam_lang_new,$wswdteam_developer_mode;

  if (isset($wswdteam_lang_str)and(isset($wswdteam_lang_str[$text]))){
    $line=$wswdteam_lang_str[$text];
  }else{
    if (($dot)and($wswdteam_developer_mode)){
      $line='.'.$text.'.';
    }else{
      $line=$text;
    }
    $wswdteam_lang_new[$text]=strip_tags($text);
  }
  $line=strip_tags($line);
  return($line);
}

// új fordítandók kiírása
function wswdteam_lang_newlines(){
  global $wswdteam_lang_new,$wswdteam_developer_mode;

  if ($wswdteam_developer_mode){
    if (count($wswdteam_lang_new)>0){
      echo("<br /><br />");
      foreach($wswdteam_lang_new as $l){
        echo("'".$l."' => '".$l."',<br />");
      }
      echo("<br /><br />");
    }
  }
}


?>
