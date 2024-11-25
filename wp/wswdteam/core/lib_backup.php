<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// adatmentés
function wswdteam_backup(){
  global $wpdb;

  $err="";
  $tables=array();
  $sql="SHOW TABLES;";
  $res=$wpdb->get_results($sql);
  if(true){
    $ret='';
    foreach($res as $table){
      echo("$table->Tables_in_wdb<br />");
      $sql="SELECT * FROM $table->Tables_in_wdb";
      $resx=$wpdb->get_results($sql);
      $ret=$ret."DROP TABLE ".$table->Tables_in_wdb .";";
      $sql="SHOW CREATE TABLE ".$table->Tables_in_wdb.";";
      $res2=$wpdb->get_results($sql);
      $r=$res2[0];
      $x="Create Table";
      $ret=$ret."\n\n".$r->$x.";\n\n";
      foreach($resx as $rd){
        $ret=$ret."INSERT INTO ".$table->Tables_in_wdb." VALUES(";
        $i=0;
        foreach($rd as $rdat){
          if($i=0){
            $ret=$ret.$rdat;
          }else{
            $ret=$ret.",".$rdat;
          }
          $i++;
        }
        $ret=$ret.");\n";
      }
      $ret=$ret."\n\n\n";
    }
    #$bfile=$dbname.'.sql';
    #$handle=fopen("{$bfile}",'w+');
    #fwrite($handle,$return);
    #close($handle);
  }else{
    $err="!!!";
  }
  echo $ret;
}

?>
