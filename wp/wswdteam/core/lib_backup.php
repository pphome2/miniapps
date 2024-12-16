<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// adatmentés
function wswdteam_backup(){
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
  echo("<h2>".wswdteam_lang("Teljes adat- és fájlmentés")."</h2>");
  echo("<span class=wswdteamspaceholder></span>");
  wswdteam_delete_bfiles();
  wswdteam_backup_tables();
  wswdteam_backup_files();
  wswdteam_backup_setup_dl();
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
  echo("<h2>".wswdteam_lang("Mentés feltöltése")."</h2>");
  echo("<span class=wswdteamspaceholder></span>");
  wswdteam_restore_tables();
}



// teplepítő letöltése
function wswdteam_backup_setup_dl(){
  global $wswdteam_setup_file;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wswdteamtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
  echo(wswdteam_lang("Telepítő program letöltése. Egy helyen kell lennie a mentésfájlokkal (teljes adatmentés, fájlmentés)."));
  echo("<span class=wswdteamspaceholder></span>");
  $pd=plugin_dir_url(__FILE__).$wswdteam_setup_file;
  $pdf=plugin_dir_path(__FILE__).$wswdteam_setup_file;
  if (file_exists($pdf)){
    echo("<a href=\"$pd\" id=\"bdl\" class=\"$cl\" download>".wswdteam_lang("Telepítő program letöltése")."</a>");
  }
  echo("<span class=wswdteamspaceholder></span>");
}



// sql fájl betöltése
function wswdteam_inst_sql($sqlfile=""){
  global $wpdb,$wswdteam_developer_mode;

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
function wswdteam_backup_apptables(){
  global $wpdb,$wswdteam_backup_dl,$wswdteam_app_name,$wswdteam_developer_mode,$wswdteam_table;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wswdteamtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  $md=wp_upload_dir();
  $dn=$md['basedir']."/".$wswdteam_app_name;
  try{
    if (!is_dir($dn)){
      mkdir($dn);
    }
  }catch (Exception $e){
    if ($wswdteam_developer_mode){
      echo($e->getMessage());
    }
  }
  //$bfileurl=$md['baseurl']."/".date('YmdHis').'.sql';
  $bfile=$md['basedir']."/".$wswdteam_app_name."/".current_time('YmdHis').'.sql';
  // adattáblák mentése
  echo("<span class=wswdteamspaceholder></span>");
  echo(wswdteam_lang("Alkalmazás adattábláinak mentése").".<br />");
  echo("<span class=wswdteamspaceholder></span>");
  if (isset($_POST['b1'])){
    $err="";
    $ret="";
    foreach($wswdteam_table as $tn){
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
      echo(wswdteam_lang("Hiba történt a mentés közben").".<br />");
      if ($wswdteam_developer_mode){
        echo($e->getMessage());
      }
    }
    wswdteam_message(wswdteam_lang("Mentés elkészítése megtörtént").".");
    echo("<span class=wswdteamspaceholder></span>");
  }
  echo("<form id=f0 action=\"".$act."\" method=\"post\">");
  echo("<input type=submit id=\"b1\" name=\"b1\" class=\"$cl\" value=\"".wswdteam_lang("Alkalmazás adatmentés készítése")."\">");
  echo("</form>");
  echo("<span class=wswdteamspaceholder></span>");
}


// mentések törlése
function wswdteam_delete_bfiles(){
  global $wswdteam_app_name;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wswdteamtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  // mentések törlése
  echo(wswdteam_lang("Korábbi teljes mentések törlése").".");
  echo("<span class=wswdteamspaceholder></span>");
  if (!isset($_POST['d1'])){
    echo("<form id=fdel action=\"".$act."\" method=\"post\">");
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


// fájl mentés
function wswdteam_backup_files(){
  global $wswdteam_app_name,$wswdteam_developer_mode;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wswdteamtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  echo("<span class=wswdteamspaceholder></span>");
  echo(wswdteam_lang("A rendszer fájljainak mentése").".");
  echo("<span class=wswdteamspaceholder></span>");
  $md=wp_upload_dir();
  $hd=get_home_path();
  $bfileurl=$md['baseurl'].'/'.$wswdteam_app_name.'.tar';
  $bfile=$md['basedir'].'/'.$wswdteam_app_name.'.tar';
  if (isset($_POST['file0'])){
    try {
      if (file_exists($bfile.".gz")){
        unlink("$bfile.gz");
      }
      $a=new PharData($bfile);
      $a->buildFromDirectory($hd);
      $a->compress(Phar::GZ);
      unlink($bfile);
      echo("$bfile.gz - ".wswdteam_lang("Fájlmentés elkészült")."<br /><br />");
    }catch (Exception $e){
      echo(wswdteam_lang("Hiba történt a mentés közben").".<br />");
      if ($wswdteam_developer_mode){
        echo($e->getMessage());
      }
    }
  }
  echo("<form id=f10 action=\"".$act."\" method=\"post\">");
  echo("<input type=submit id=\"file0\" name=\"file0\" class=\"$cl\" value=\"".wswdteam_lang("Fájlmentés készítése")."\">");
  echo("</form>");
  if (file_exists($bfile.".gz")){
    echo("<a href=\"$bfileurl.gz\" id=\"bdl\" class=\"$cl\">".wswdteam_lang("Fájlmentés letöltése")."</a>");
  }
}


// adatmentés
function wswdteam_backup_tables(){
  global $wpdb,$wswdteam_backup_dl,$wswdteam_app_name,$wswdteam_developer_mode;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wswdteamtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  #$bfileurl=$md['baseurl']."/".current_time('YmdHis').'.sql';
  #$bfile=$md['basedir']."/".current_time('YmdHis').'.sql';
  $md=wp_upload_dir();
  $bfileurl=$md['baseurl'].'/'.$wswdteam_app_name.'.sql';
  $bfile=$md['basedir'].'/'.$wswdteam_app_name.'.sql';

  // adattáblák mentése
  echo("<span class=wswdteamspaceholder></span>");
  echo(wswdteam_lang("Teljes rendszer adattábláinak mentése").".<br />");
  echo(wswdteam_lang("A mentés adatsérülés esetén a teljes rendszer újratelepítéséhez használható").".<br />");
  echo(wswdteam_lang("Újratelepítés: instal.php segítségével a adat- és fájlmentés használatával").".<br />");
  echo("<span class=wswdteamspaceholder></span>");
  if (isset($_POST['b0'])){
    $err="";
    $tables=array();
    $sql="SHOW TABLES;";
    $res=$wpdb->get_results($sql);
    if($res){
      echo("<span class=wswdteamspaceholder></span>");
      echo("<b>".wswdteam_lang("Adattáblák mentés alatt").":</b>");
      echo("<span class=wswdteamspaceholder></span>");
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
        echo(wswdteam_lang("Hiba történt a mentés közben").".<br />");
        if ($wswdteam_developer_mode){
          echo($e->getMessage());
        }
      }
      echo("<span class=wswdteamspaceholder></span>");
      echo("<b>".wswdteam_lang("Mentés elkészítés megtörtént").".</b>");
      echo("<br />");
      echo('<br />'.$bfileurl.'<br /><br />');
    }
  }
  echo("<form id=f0 action=\"".$act."\" method=\"post\">");
  echo("<input type=submit id=\"b0\" name=\"b0\" class=\"$cl\" value=\"".wswdteam_lang("Teljes adatmentés készítése")."\">");
  echo("</form>");
  if (file_exists($bfile)){
    echo("<a href=\"$bfileurl\" id=\"bdl\" class=\"$cl\">".wswdteam_lang("Mentés letöltése")."</a>");
  }

  echo("<span class=wswdteamspaceholder></span>");
}


// adat visszatöltés
function wswdteam_restore_tables(){
  global $wpdb,$wswdteam_backup_dl,$wswdteam_app_name,$wswdteam_developer_mode,$wswdteam_app_name;

  $htf=ABSPATH.'.htaccess';
  $out="";
  $fs=false;
  try{
    foreach(file($htf) as $line){
      if (strpos($line,"upload_max_filesize")<>0){
        $line="php_value upload_max_filesize 64M".PHP_EOL;
        $fs=true;
      }
      $out=$out.$line;
    }
    if (!$fs){
      $out=$out.PHP_EOL;
      $out=$out."# BEGIN WSWDTEAM".PHP_EOL;
      $out=$out."php_value upload_max_filesize 64M".PHP_EOL;
      $out=$out."# END WSWDTeam".PHP_EOL;
      //php_value post_max_size 64M
      //php_value max_execution_time 300
      //php_value max_input_time 300
    }
  }catch (Exception $e){
    echo($e->getMessage());
  }
  try{
    $handle=fopen($htf,'w+');
    fwrite($handle,$out);
    fclose($handle);
  }catch (Exception $e){
    echo($e->getMessage());
  }
  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wswdteamtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  // visszatöltés
  echo(wswdteam_lang("Mentés fájlok feltöltése visszaállításhoz").".<br />");
  echo(wswdteam_lang("A nagy fájlméret miatt ajánlott a tárhely szólgáltató saját funkcióit használni. (FTP, vezérlőpult megoldások.)").".");
  if (isset($_POST['res1']) or isset($_POST['res2'])){
    echo("<span class=wswdteamspaceholder></span>");
    $md=wp_upload_dir();
    //$tdir=$md['baseurl'].'/'.$wswdteam_app_name;
    $tdir=$md['basedir'].'/';
    //$tfile=$tdir.basename($_FILES['file1']['name']);
    try{
      if (isset($_POST['res1'])){
        if ($_FILES['file1']['name']<>""){
          $tfile=$tdir."/".$_FILES['file1']['name'];
          if (file_exists($tfile)){
            unlink($tfile);
          }
          if (move_uploaded_file($_FILES['file1']['tmp_name'],$tfile)){
            echo(wswdteam_lang("A feltöltés megtörtént").".<br />");
          }
        }
      }else{
        if ($_FILES['file2']['name']<>""){
          $tfile=$tdir."/".$_FILES['file2']['name'];
          echo("www");
          if (file_exists($tfile)){
            unlink($tfile);
          }
          if (move_uploaded_file($_FILES['file2']['tmp_name'],$tfile)){
            echo(wswdteam_lang("A feltöltés megtörtént").".<br />");
          }
        }
      }
    }catch (Exception $e){
      echo(wswdteam_lang("Hiba történt a feltöltés közben").".<br />");
      if ($wswdteam_developer_mode){
        echo($e->getMessage());
      }
    }
  }
  echo("<span class=wswdteamspaceholder></span>");
  echo("<form id=fres1 action=\"".$act."\" enctype=\"multipart/form-data\" method=\"post\">");
  //echo("<input type=\"file\" name=\"file1\" id=\"file1\" onchange=\"alert(document.forms['fres1']['file1'].files[0].name);\">");
  echo("<label id=\"fres1l\" for=\"file1\" class=\"".$cl."\">".wswdteam_lang("Adatmentés kiválasztása")."</label>");
  echo("<input type=\"file\" name=\"file1\" id=\"file1\" onchange=\"chlabel();\">");
  echo("<script>");
  echo("function chlabel(){var v=document.forms['fres1']['file1'].files[0].name;document.getElementById('fres1l').innerHTML=v;}");
  echo("</script>");
  echo("<span class=wswdteamwordspace></span>");
  echo("<input type=submit id=\"res1\" name=\"res1\" class=\"$cl\" value=\"".wswdteam_lang("Feltöltés")."\">");
  echo("</form>");
  echo("<span class=wswdteamspaceholder></span>");
  echo("<form id=fres2 action=\"".$act."\" enctype=\"multipart/form-data\" method=\"post\">");
  echo("<label id=\"fres2l\" for=\"file2\" class=\"".$cl."\">".wswdteam_lang("Fájlmentés kiválasztása")."</label>");
  echo("<input type=\"file\" name=\"file2\" id=\"file2\" onchange=\"chlabel2();\">");
  echo("<script>");
  echo("function chlabel2(){var v=document.forms['fres2']['file2'].files[0].name;document.getElementById('fres2l').innerHTML=v;}");
  echo("</script>");
  echo("<span class=wswdteamwordspace></span>");
  echo("<input type=submit id=\"res2\" name=\"res2\" class=\"$cl\" value=\"".wswdteam_lang("Feltöltés")."\">");
  echo("</form>");
  echo("<span class=wswdteamspaceholder></span>");
}



?>
