<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// adatmentés
function wswdteam_backup(){
  wswdteam_delete_bfiles();
  wswdteam_backup_tables();
  wswdteam_backup_files();
  wswdteam_restore_tables();
}



// fájl mentés
function wswdteam_backup_files(){
  global $wswdteam_app_name;

  if (is_admin()){
    $cl="button";
  }else{
    $cl="wswdteamtablebutton";
  }
  $md=wp_upload_dir();
  $hd=get_home_path();
  $bfileurl=$md['baseurl'].'/'.$wswdteam_app_name.'.tar';
  $bfile=$md['basedir'].'/'.$wswdteam_app_name.'.tar';
  #echo("$hd - $bfile");
  echo("<form id=f10 action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
  echo("<input type=submit id=\"file0\" name=\"file0\" class=\"$cl\" value=\"".wswdteam_lang("Fájlmentés készítése")."\">");
  echo("</form>");
  if (file_exists($bfile.".gz")){
    echo("<a href=\"$bfileurl.gz\" id=\"bdl\" class=\"$cl\">".wswdteam_lang("Fájlmentés letöltése")."</a>");
  }
  if (isset($_POST['file0'])){
    try {
      $a=new PharData($bfile);
      #$a->addFile('data.xls');
      $a->buildFromDirectory($hd);
      $a->compress(Phar::GZ);
      unlink($bfile);
    }
    catch (Exception $e){
    }
    if (file_exists($bfile.".gz")){
      echo("<a href=\"$bfileurl.gz\" id=\"bdl\" class=\"$cl\">".wswdteam_lang("Fájlmentés letöltése")."</a>");
    }
  }
}


// adatmentés
function wswdteam_backup_tables(){
  global $wpdb,$wswdteam_backup_dl,$wswdteam_app_name;

  if (is_admin()){
    $cl="button";
  }else{
    $cl="wswdteamtablebutton";
  }
  #$bfileurl=$md['baseurl']."/".date('YmdHms').'.sql';
  #$bfile=$md['basedir']."/".date('YmdHms').'.sql';
  $md=wp_upload_dir();
  $bfileurl=$md['baseurl'].'/'.$wswdteam_app_name.'.sql';
  $bfile=$md['basedir'].'/'.$wswdteam_app_name.'.sql';

  // adattáblák mentése
  if (isset($_POST['b0'])){
    $err="";
    $tables=array();
    $sql="SHOW TABLES;";
    $res=$wpdb->get_results($sql);
    if($res){
      echo("<span class=wswdteamspaceholder></span>");
      echo("<b>".wswdteam_lang("Adattábla mentés alatt").":</b>");
      echo("<span class=wswdteamspaceholder></span>");
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
      $md=wp_upload_dir();
      $handle=fopen("$bfile",'w+');
      fwrite($handle,$ret);
      fclose($handle);
      echo("<span class=wswdteamspaceholder></span>");
      echo("<b>".wswdteam_lang("Mentés elkészítés megtörtént").".</b>");
      echo("<br />");
      echo('<br />'.$bfileurl.'<br /><br />');
      #$ret=htmlentities($ret);
      #echo("<form id=f0 action=\"".$fn."\" method=\"post\">");
      #echo("<input id=\"0\" name=\"0\" type=hidden value=\"$ret\">");
      #echo("<input type=submit id=\"bdl\" class=\"$cl\" value=\"".wswdteam_lang("Mentés letöltése")."\" ");
      #echo("onclick=\"getElementById('bdl').style.display='none';\">");
      #echo("</form>");
    }
  }
  echo("<form id=f0 action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
  echo("<input type=submit id=\"b0\" name=\"b0\" class=\"$cl\" value=\"".wswdteam_lang("Adatmentés készítése")."\">");
  echo("</form>");
  if (file_exists($bfile)){
    echo("<a href=\"$bfileurl\" id=\"bdl\" class=\"$cl\">".wswdteam_lang("Mentés letöltése")."</a>");
  }

  echo("<span class=wswdteamspaceholder></span>");
}


// adat visszatöltés
function wswdteam_restore_tables(){
  global $wpdb,$wswdteam_backup_dl,$wswdteam_app_name;

  if (is_admin()){
    $cl="button";
  }else{
    $cl="wswdteamtablebutton";
  }
  // visszatöltés
  echo("<span class=wswdteamspaceholder></span>");
  if (!isset($_POST['res1'])){
    echo("<form id=fres action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=submit id=\"res1\" name=\"res1\" class=\"$cl\" value=\"".wswdteam_lang("Adattáblák visszatöltése")."\">");
    echo("</form>");
  }else{
    echo("<form id=fres action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=\"file\" name=\"file\" id=\"file\">");
    echo("<input type=submit id=\"res1x\" name=\"res1x\" class=\"$cl\" value=\"".wswdteam_lang("Kiválasztott adatmentés feltöltése")."\">");
    echo("</form>");
  }
  if (!isset($_POST['res2'])){
    echo("<form id=fres action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=submit id=\"res2\" name=\"res2\" class=\"$cl\" value=\"".wswdteam_lang("Fájlok visszatöltése")."\">");
    echo("</form>");
  }else{
    echo("<form id=fres action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=\"file\" name=\"file\" id=\"file\">");
    echo("<input type=submit id=\"res2x\" name=\"res2x\" class=\"$cl\" value=\"".wswdteam_lang("Kiválasztott fájlmentés feltöltése")."\">");
    echo("</form>");
  }
  if (isset($_POST['res1x'])){
    echo("tábla");
  }
  if (isset($_POST['res2x'])){
    echo("fájl");
  }
  echo("<span class=wswdteamspaceholder></span>");
}


// mentések törlése
function wswdteam_delete_bfiles(){
  global $wswdteam_app_name;

  if (is_admin()){
    $cl="button";
  }else{
    $cl="wswdteamtablebutton";
  }
  // mentések törlése
  if (!isset($_POST['d1'])){
    echo("<form id=fdel action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=submit id=\"d1\" name=\"d1\" class=\"$cl\" value=\"".wswdteam_lang("Mentések törlése")."\">");
    echo("</form>");
  }else{
    $md=wp_upload_dir();
    $bdir=$md['basedir'];
    $fl=scandir($bdir);
    foreach($fl as $l){
      $ext=pathinfo($l,PATHINFO_EXTENSION);
      switch($ext){
        case "sql":
          echo($bdir."/".$l."<br />");
          unlink($bdir."/".$l);
          break;
        case "gz":
          echo($bdir."/".$l."<br />");
          unlink($bdir."/".$l);
          break;
        case "tar":
          echo($bdir."/".$l."<br />");
          unlink($bdir."/".$l);
          break;
      }
    }
    echo(wswdteam_lang("Mentések törölve").".");
  }
  echo("<span class=wswdteamspaceholder></span>");
}


?>