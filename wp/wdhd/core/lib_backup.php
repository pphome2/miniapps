<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// adatmentés
function wdhd_backup(){
  wdhd_delete_bfiles();
  wdhd_backup_tables();
  wdhd_backup_files();
  wdhd_restore_tables();
}



// fájl mentés
function wdhd_backup_files(){
  global $wdhd_app_name;

  if (is_admin()){
    $cl="button";
  }else{
    $cl="wdhdtablebutton";
  }
  echo("<span class=wdhdspaceholder></span>");
  echo(wdhd_lang("A rendszer fájljainak mentése").".");
  echo("<span class=wdhdspaceholder></span>");
  $md=wp_upload_dir();
  $hd=get_home_path();
  $bfileurl=$md['baseurl'].'/'.$wdhd_app_name.'.tar';
  $bfile=$md['basedir'].'/'.$wdhd_app_name.'.tar';
  if (isset($_POST['file0'])){
    try {
      if (file_exists($bfile.".gz")){
        unlink("$bfile.gz");
      }
      $a=new PharData($bfile);
      $a->buildFromDirectory($hd);
      $a->compress(Phar::GZ);
      unlink($bfile);
      echo("$bfile.gz - ".wdhd_lang("Fájlmentés elkészült")."<br /><br />");
    }catch (Exception $e){
      echo($e->getMessage());
    }
  }
  echo("<form id=f10 action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
  echo("<input type=submit id=\"file0\" name=\"file0\" class=\"$cl\" value=\"".wdhd_lang("Fájlmentés készítése")."\">");
  echo("</form>");
  if (file_exists($bfile.".gz")){
    echo("<a href=\"$bfileurl.gz\" id=\"bdl\" class=\"$cl\">".wdhd_lang("Fájlmentés letöltése")."</a>");
  }
}


// adatmentés
function wdhd_backup_tables(){
  global $wpdb,$wdhd_backup_dl,$wdhd_app_name;

  if (is_admin()){
    $cl="button";
  }else{
    $cl="wdhdtablebutton";
  }
  #$bfileurl=$md['baseurl']."/".date('YmdHms').'.sql';
  #$bfile=$md['basedir']."/".date('YmdHms').'.sql';
  $md=wp_upload_dir();
  $bfileurl=$md['baseurl'].'/'.$wdhd_app_name.'.sql';
  $bfile=$md['basedir'].'/'.$wdhd_app_name.'.sql';

  // adattáblák mentése
  echo("<span class=wdhdspaceholder></span>");
  echo(wdhd_lang("Teljes rendszer vagy az alkalmazás adattábláinak mentése").".");
  echo("<span class=wdhdspaceholder></span>");
  if (isset($_POST['b0'])){
    $err="";
    $tables=array();
    $sql="SHOW TABLES;";
    $res=$wpdb->get_results($sql);
    if($res){
      echo("<span class=wdhdspaceholder></span>");
      echo("<b>".wdhd_lang("Adattáblák mentés alatt").":</b>");
      echo("<span class=wdhdspaceholder></span>");
      $ret='';
      foreach($res as $table){
        $tn="Tables_in_$wpdb->dbname";
        $tn=$table->$tn;
        echo($tn."<br />");
        $sql="SELECT * FROM $tn;";
        $resx=$wpdb->get_results($sql);
        $ret=$ret."DROP TABLE IF EXISTS $tn;";
        $sql="SHOW CREATE TABLE $tn;";
        $res2=$wpdb->get_results($sql);
        $r=$res2[0];
        $x="Create Table";
        $ret=$ret."\n\n".$r->$x.";\n\n";
        foreach($resx as $rd){
          $ret=$ret."INSERT INTO $tn VALUES(";
          $i=0;
          foreach($rd as $rdat){
            if($i>0){
              //$ret=$ret.",\"".$rdat."\"";
              $ret=$ret.",'".$rdat."'";
            }else{
              //$ret=$ret."\"".$rdat."\"";
              $ret=$ret."'".$rdat."'";
            }
            $i++;
          }
          $ret=$ret.");\n";
        }
        $ret=$ret."\n\n\n";
      }
      $md=wp_upload_dir();
      try{
      $handle=fopen("$bfile",'w+');
      fwrite($handle,$ret);
      fclose($handle);
      }catch (Exception $e){
        echo($e->getMessage());
      }
      echo("<span class=wdhdspaceholder></span>");
      echo("<b>".wdhd_lang("Mentés elkészítés megtörtént").".</b>");
      echo("<br />");
      echo('<br />'.$bfileurl.'<br /><br />');
    }
  }
  echo("<form id=f0 action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
  echo("<input type=submit id=\"b0\" name=\"b0\" class=\"$cl\" value=\"".wdhd_lang("Teljes adatmentés készítése")."\">");
  echo("</form>");
  echo("<form id=f0 action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
  echo("<input type=submit id=\"b1\" name=\"b1\" class=\"$cl\" value=\"".wdhd_lang("Alkalmazás adatmentés készítése")."\">");
  echo("</form>");
  if (file_exists($bfile)){
    echo("<a href=\"$bfileurl\" id=\"bdl\" class=\"$cl\">".wdhd_lang("Mentés letöltése")."</a>");
  }

  echo("<span class=wdhdspaceholder></span>");
}


// adat visszatöltés
function wdhd_restore_tables(){
  global $wpdb,$wdhd_backup_dl,$wdhd_app_name;

  if (is_admin()){
    $cl="button";
  }else{
    $cl="wdhdtablebutton";
  }
  // visszatöltés
  echo("<span class=wdhdspaceholder></span>");
  echo("<span class=wdhdspaceholder></span>");
  echo(wdhd_lang("Mentés fájlok feltöltése visszaállításhoz").".");
  echo("<span class=wdhdspaceholder></span>");
  if (!isset($_POST['res1'])){
    echo("<form id=fres action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=submit id=\"res1\" name=\"res1\" class=\"$cl\" value=\"".wdhd_lang("Adattáblák visszatöltése")."\">");
    echo("</form>");
  }else{
    echo("<form id=fres action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=\"file\" name=\"file\" id=\"file\">");
    echo("<input type=submit id=\"res1x\" name=\"res1x\" class=\"$cl\" value=\"".wdhd_lang("Kiválasztott adatmentés feltöltése")."\">");
    echo("</form>");
  }
  if (!isset($_POST['res2'])){
    echo("<form id=fres action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=submit id=\"res2\" name=\"res2\" class=\"$cl\" value=\"".wdhd_lang("Fájlok visszatöltése")."\">");
    echo("</form>");
  }else{
    echo("<form id=fres action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=\"file\" name=\"file\" id=\"file\">");
    echo("<input type=submit id=\"res2x\" name=\"res2x\" class=\"$cl\" value=\"".wdhd_lang("Kiválasztott fájlmentés feltöltése")."\">");
    echo("</form>");
  }
  if (isset($_POST['res1x'])){
    echo("tábla");
  }
  if (isset($_POST['res2x'])){
    echo("fájl");
  }
  echo("<span class=wdhdspaceholder></span>");
}


// mentések törlése
function wdhd_delete_bfiles(){
  global $wdhd_app_name;

  if (is_admin()){
    $cl="button";
  }else{
    $cl="wdhdtablebutton";
  }
  // mentések törlése
  echo(wdhd_lang("Korábbi mentések törlése").".");
  echo("<span class=wdhdspaceholder></span>");
  if (!isset($_POST['d1'])){
    echo("<form id=fdel action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=submit id=\"d1\" name=\"d1\" class=\"$cl\" value=\"".wdhd_lang("Mentések törlése")."\">");
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
    echo(wdhd_lang("Mentések törölve").".");
  }
  echo("<span class=wdhdspaceholder></span>");
}


?>
