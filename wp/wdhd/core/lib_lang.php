<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// fordítás
function wdhd_lang($text='',$dot=true){
  global $wdhd_lang_str,$wdhd_lang_new,$wdhd_developer_mode;

  if (isset($wdhd_lang_str)and(isset($wdhd_lang_str[$text]))){
    $line=$wdhd_lang_str[$text];
  }else{
    if (($dot)and($wdhd_developer_mode)){
      $line='.'.$text.'.';
    }else{
      $line=$text;
    }
    $wdhd_lang_new[$text]=strip_tags($text);
  }
  $line=strip_tags($line);
  return($line);
}


// új fordítandók kiírása
function wdhd_lang_newlines(){
  global $wdhd_lang_new,$wdhd_developer_mode;

  $r="";
  if ($wdhd_developer_mode){
    if (count($wdhd_lang_new)>0){
      $r="<span class=wdhdspaceholder></span>";
      foreach($wdhd_lang_new as $l){
        $r=$r."'".$l."' => '".$l."',<br />";
      }
      $r=$r."<span class=wdhdspaceholder></span>";
    }
  }
  return($r);
}

?>
