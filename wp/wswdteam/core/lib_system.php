<?php

// segéd függvények

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}



// .htaccess-be:
//php_value post_max_size 64M
//php_value max_execution_time 300
//php_value max_input_time 300
//php.ini-be:
//post_max_size = 64M;
//upload_max_filesize 64M";



// .htaccess kezelése
function wswdteam_htaccess($searchline="",$addline=""){
  global $wswdteam_developer_mode;

  if (is_admin()){
    $htf=ABSPATH.'.htaccess';
    $out="";
    $fs=false;
    try{
      foreach(file($htf) as $line){
        if (strpos($line,$searchline)<>0){
          $line=$addline.PHP_EOL;
          $fs=true;
       }
        $out=$out.$line;
      }
      if (!$fs){
        $out=$out.PHP_EOL;
        $out=$out."# BEGIN WSWDTEAM".PHP_EOL;
        $out=$out."php_value upload_max_filesize 64M".PHP_EOL;
        $out=$out."# END WSWDTeam".PHP_EOL;
      }
    }catch (Exception $e){
      if($wswdteam_developer_mode){
        echo($e->getMessage());
      }
    }
    try{
      $handle=fopen($htf,'w+');
      fwrite($handle,$out);
      fclose($handle);
    }catch (Exception $e){
      if($wswdteam_developer_mode){
        echo($e->getMessage());
      }
    }
    //echo("<span class=wswdteamspaceholder></span>");
  }
}

    
?>
