<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// adatmentés
function wdhd_backup(){
  echo("<span class=wdhdspaceholder></span>");
  echo("<span class=wdhdspaceholder></span>");
  echo("<h2>".wdhd_lang("Teljes adat- és fájlmentés")."</h2>");
  echo("<span class=wdhdspaceholder></span>");
  wdhd_delete_bfiles();
  wdhd_backup_tables();
  wdhd_backup_files();
  wdhd_backup_setup_dl();
  echo("<span class=wdhdspaceholder></span>");
  //echo("<span class=wdhdspaceholder></span>");
  //echo("<h2>".wdhd_lang("Mentés feltöltése")."</h2>");
  //echo("<span class=wdhdspaceholder></span>");
  //wdhd_restore_tables();
}



// teplepítő letöltése
function wdhd_backup_setup_dl(){
  global $wdhd_setup_file;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wdhdtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  echo("<span class=wdhdspaceholder></span>");
  echo("<span class=wdhdspaceholder></span>");
  echo(wdhd_lang("Telepítő program letöltése. Egy helyen kell lennie a mentésfájlokkal (teljes adatmentés, fájlmentés)."));
  echo("<span class=wdhdspaceholder></span>");
  $pd=plugin_dir_url(__FILE__).$wdhd_setup_file;
  $pdf=plugin_dir_path(__FILE__).$wdhd_setup_file;
  if (file_exists($pdf)){
    echo("<a href=\"$pd\" id=\"bdl\" class=\"$cl\" download>".wdhd_lang("Telepítő program letöltése")."</a>");
  }
  echo("<span class=wdhdspaceholder></span>");
}



// sql fájl betöltése
function wdhd_inst_sql($sqlfile=""){
  global $wpdb,$wdhd_developer_mode;

  $ret=false;
  if (file_exists($sqlfile)){
    try{
      $sql="";
      foreach(file($sqlfile) as $line){
        $line=str_replace(PHP_EOL,'',$line);
        if ($line<>''){
          $sql=$sql." ".$line;
          if (substr($line,-1)===";"){
            $r=$wpdb->query($sql);
            //echo($sql."<br />");
            $sql="";
          }
        }
      }
      $ret=true;
    }catch(Exception $e){
      echo($sql." - ".$e->getMessage()."<br />");
    }
  }
  return($ret);
}



// adatmentés
function wdhd_backup_apptables(){
  global $wpdb,$wdhd_backup_dl,$wdhd_app_name,$wdhd_developer_mode,$wdhd_table;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wdhdtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  $md=wp_upload_dir();
  $dn=$md['basedir']."/".$wdhd_app_name;
  try{
    if (!is_dir($dn)){
      mkdir($dn);
    }
  }catch (Exception $e){
    if ($wdhd_developer_mode){
      echo($e->getMessage());
    }
  }
  //$bfileurl=$md['baseurl']."/".date('YmdHis').'.sql';
  $bfile=$md['basedir']."/".$wdhd_app_name."/".current_time('YmdHis').'.sql';
  // adattáblák mentése
  echo("<span class=wdhdspaceholder></span>");
  echo(wdhd_lang("Alkalmazás adattábláinak mentése").".<br />");
  echo("<span class=wdhdspaceholder></span>");
  if (isset($_POST['b1'])){
    $err="";
    $ret="";
    foreach($wdhd_table as $tn){
      $tn=$wpdb->prefix.$tn;
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
            $ret=$ret.",'".$rdat."'";
          }else{
            $ret=$ret."'".$rdat."'";
          }
          $i++;
        }
        $ret=$ret.");\n";
      }
      $ret=$ret."\n\n\n";
    }
    try{
      $handle=fopen("$bfile",'w+');
      fwrite($handle,$ret);
      fclose($handle);
    }catch (Exception $e){
      echo(wdhd_lang("Hiba történt a mentés közben").".<br />");
      if ($wdhd_developer_mode){
        echo($e->getMessage());
      }
    }
    wdhd_message(wdhd_lang("Mentés elkészítése megtörtént").".");
    echo("<span class=wdhdspaceholder></span>");
  }
  echo("<form id=f0 action=\"".$act."\" method=\"post\">");
  echo("<input type=submit id=\"b1\" name=\"b1\" class=\"$cl\" value=\"".wdhd_lang("Alkalmazás adatmentés készítése")."\">");
  echo("</form>");
  echo("<span class=wdhdspaceholder></span>");
}


// mentések törlése
function wdhd_delete_bfiles(){
  global $wdhd_app_name;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wdhdtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  // mentések törlése
  echo(wdhd_lang("Korábbi teljes mentések törlése").".");
  echo("<span class=wdhdspaceholder></span>");
  if (!isset($_POST['d1'])){
    echo("<form id=fdel action=\"".$act."\" method=\"post\">");
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


// fájl mentés
function wdhd_backup_files(){
  global $wdhd_app_name,$wdhd_developer_mode;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wdhdtablebutton";
    $act=$_SERVER['REQUEST_URI'];
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
      echo(wdhd_lang("Hiba történt a mentés közben").".<br />");
      if ($wdhd_developer_mode){
        echo($e->getMessage());
      }
    }
  }
  echo("<form id=f10 action=\"".$act."\" method=\"post\">");
  echo("<input type=submit id=\"file0\" name=\"file0\" class=\"$cl\" value=\"".wdhd_lang("Fájlmentés készítése")."\">");
  echo("</form>");
  if (file_exists($bfile.".gz")){
    echo("<a href=\"$bfileurl.gz\" id=\"bdl\" class=\"$cl\">".wdhd_lang("Fájlmentés letöltése")."</a>");
  }
}


// adatmentés
function wdhd_backup_tables(){
  global $wpdb,$wdhd_backup_dl,$wdhd_app_name,$wdhd_developer_mode;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wdhdtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  #$bfileurl=$md['baseurl']."/".current_time('YmdHis').'.sql';
  #$bfile=$md['basedir']."/".current_time('YmdHis').'.sql';
  $md=wp_upload_dir();
  $bfileurl=$md['baseurl'].'/'.$wdhd_app_name.'.sql';
  $bfile=$md['basedir'].'/'.$wdhd_app_name.'.sql';

  // adattáblák mentése
  echo("<span class=wdhdspaceholder></span>");
  echo(wdhd_lang("Teljes rendszer adattábláinak mentése").".<br />");
  echo(wdhd_lang("A mentés adatsérülés esetén a teljes rendszer újratelepítéséhez használható").".<br />");
  echo(wdhd_lang("Újratelepítés: instal.php segítségével a adat- és fájlmentés használatával").".<br />");
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
      $prefix=$wpdb->prefix;
      $ret='';
      foreach($res as $table){
        $tn="Tables_in_$wpdb->dbname";
        $tn=$table->$tn;
        if (strpos("-".$tn,$prefix)<>0){
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
                $ret=$ret.",'".$rdat."'";
              }else{
                $ret=$ret."'".$rdat."'";
              }
              $i++;
            }
            $ret=$ret.");\n";
          }
          $ret=$ret."\n\n\n";
        }
      }
      try{
        $handle=fopen("$bfile",'w+');
        fwrite($handle,$ret);
        fclose($handle);
      }catch (Exception $e){
        echo(wdhd_lang("Hiba történt a mentés közben").".<br />");
        if ($wdhd_developer_mode){
          echo($e->getMessage());
        }
      }
      echo("<span class=wdhdspaceholder></span>");
      echo("<b>".wdhd_lang("Mentés elkészítés megtörtént").".</b>");
      echo("<br />");
      echo('<br />'.$bfileurl.'<br /><br />');
    }
  }
  echo("<form id=f0 action=\"".$act."\" method=\"post\">");
  echo("<input type=submit id=\"b0\" name=\"b0\" class=\"$cl\" value=\"".wdhd_lang("Teljes adatmentés készítése")."\">");
  echo("</form>");
  if (file_exists($bfile)){
    echo("<a href=\"$bfileurl\" id=\"bdl\" class=\"$cl\">".wdhd_lang("Mentés letöltése")."</a>");
  }

  echo("<span class=wdhdspaceholder></span>");
}


// adat visszatöltés
function wdhd_restore_tables(){
  global $wpdb,$wdhd_backup_dl,$wdhd_app_name,$wdhd_developer_mode,$wdhd_app_name,
         $wdhd_setup_file;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wdhdtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  // visszatöltés
  echo(wdhd_lang("Mentés fájlok feltöltése visszaállításhoz").".<br />");
  echo(wdhd_lang("A nagy fájlméret miatt ajánlott a tárhely szólgáltató saját funkcióit használni. (FTP, vezérlőpult megoldások.)").".");
  $fup=(int)(ini_get('upload_max_filesize'));
  $pup=(int)(ini_get('post_max_size'));
  $tdir=get_home_path();
  if (($fup>=64)and($pup>=8)){
    if (isset($_POST['res1'])){
      echo("<span class=wdhdspaceholder></span>");
      //$md=wp_upload_dir();
      //$tdir=$md['basedir'].'/';
      try{
        if ($_FILES['file1']['name']<>""){
          $tfile=$tdir."/".$_FILES['file1']['name'];
          echo($_FILES['file1']['name']);
          echo("<span class=wdhdspaceholder></span>");
          $ext=pathinfo($tfile,PATHINFO_EXTENSION);
          if (in_array($ext,array('sql','gz'))){
            if (file_exists($tfile)){
              unlink($tfile);
            }
            if (move_uploaded_file($_FILES['file1']['tmp_name'],$tfile)){
              echo(wdhd_lang("A feltöltés megtörtént").".<br />");
            }
          }else{
            echo(wdhd_lang("Nem megfelelő fájl.Csak *.sql és *.tar.gz tölthető fel").".<br />");
          }
        }
      }catch (Exception $e){
        echo(wdhd_lang("Hiba történt a feltöltés közben").".<br />");
        if ($wdhd_developer_mode){
          echo($e->getMessage());
        }
      }
    }
    echo("<span class=wdhdspaceholder></span>");
    echo("<form id=fres1 action=\"".$act."\" enctype=\"multipart/form-data\" method=\"post\">");
    echo("<label id=\"fres1l\" for=\"file1\" class=\"".$cl."\">".wdhd_lang("Adatmentés kiválasztása")."</label>");
    echo("<input type=\"file\" name=\"file1\" id=\"file1\" onchange=\"chlabel();\">");
    echo("<script>");
    echo("function chlabel(){var v=document.forms['fres1']['file1'].files[0].name;document.getElementById('fres1l').innerHTML=v;}");
    echo("</script>");
    echo("<span class=wdhdwordspace></span>");
    echo("<input type=submit id=\"res1\" name=\"res1\" class=\"$cl\" value=\"".wdhd_lang("Feltöltés")."\">");
    echo("</form>");
    echo("<span class=wdhdspaceholder></span>");
  }else{
    echo("<span class=wdhdspaceholder></span>");
    echo(wdhd_lang("A tárhely feltöltési beállításai miatt nem tölthetőek fel a fájlok").".");
    echo("<span class=wdhdspaceholder></span>");

  }
  $ok1=false;
  $ok2=false;
  $fl=scandir($tdir);
  foreach($fl as $l){
    $ext=pathinfo($l,PATHINFO_EXTENSION);
    switch($ext){
      case "sql":
        $ok1=true;
        break;
      case "gz":
        $ok2=true;
        break;
    }
  }
  if($ok1 and $ok2){
    echo("<span class=wdhdspaceholder></span>");
    $sfile=plugin_dir_path(__FILE__).$wdhd_setup_file;
    $tfile=$tdir.$wdhd_setup_file;
    try{
      if(file_exists($tfile)){
        unlink($tfile);
      }
      copy($sfile,$tfile);
    }catch (Exception $e){
      echo(wdhd_lang("Hiba történt a telepítő másolása közben").".<br />");
      if ($wdhd_developer_mode){
        echo($e->getMessage());
      }
      echo("<span class=wdhdspaceholder></span>");
    }
    if (file_exists($tfile)){
      echo(wdhd_lang(".sql és .tar.gz fájl található a fő könyvtárban. Az újratelepítés elindítható."));
      echo("<span class=wdhdspaceholder></span>");
      $pd=get_site_url()."/".$wdhd_setup_file;
      echo("<a href=\"$pd\" id=\"bdl\" class=\"$cl\">".wdhd_lang("Telepítő program indítása")."</a>");
    }
    echo("<span class=wdhdspaceholder></span>");
  }
}



?>
