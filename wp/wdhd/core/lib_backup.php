<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// adatmentés
function wdhd_backup(){
  global $wpdb,$wdhd_dir_backup,$wdhd_backup_dl;

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
          if($i>0){
            $ret=$ret.",".$rdat;
          }else{
            $ret=$ret.$rdat;
          }
          $i++;
        }
        $ret=$ret.");\n";
      }
      $ret=$ret."\n\n\n";
    }
    #$md=dirname(dirname(__FILE__)).$wdhd_dir_backup."/";
    #$bfile=$md.date('YmdHms').'.sql';
    #$handle=fopen("$bfile",'w+');
    #fwrite($handle,$ret);
    #close($handle);
    $fn=plugin_dir_url( __FILE__ ).$wdhd_backup_dl;
    $ret=htmlentities($ret);
    echo("<br /><form id=0 action=\"".$fn."\" method=\"post\">");
    echo("<input id=\"0\" name=\"0\" type=hidden value=\"$ret\">");
    echo("<input type=submit id=\"1\" class=\"wdhdtablebutton\" value=\"".wdhd_lang("Mentés letöltése")."\">");
    echo("</form>");
  }else{
    $err="!!!";
  }
  #echo $ret;
}

?>
