<?php

// segéd függvények

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}




// fő admin lap
function wswdteam_admin_backup(){
  // fej
  wswdteam_upagehead();
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
  echo("<h2>".wswdteam_lang("Alkalmazás adatmentés")."</h2>");
  echo("<span class=wswdteamspaceholder></span>");
  wswdteam_upload_file();
  wswdteam_backup_apptables();
  wswdteam_backup_backuplist();
  wswdteam_backup();
}



// adadtmentés indítása
function wswdteam_backup_admin_app($table,$appname){
  wswdteam_upagehead();
  echo("<span class=wswdteamspaceholder></span>");
  echo("<h2>".wswdteam_lang("Saját adatok mentése")."</h2>");
  echo("<span class=wswdteamspaceholder></span>");
  wswdteam_backup_apptables($table,$appname);
  wswdteam_backup_backuplist($table,$appname);
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
  wswdteam_upload_sql_file();
}



//fejléc
function wswdteam_upagehead(){
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
  echo("<h1>".wswdteam_lang('Adatmentés - visszaállítás')."</h1>");
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
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
function wswdteam_backup_apptables($table=array(),$appname=""){
  global $wpdb,$wswdteam_backup_dl,$wswdteam_developer_mode,$wswdteam_table;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wswdteamtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  if ($appname===""){
    $p=strpos(plugin_basename(__DIR__),'/');
    $appname=substr(plugin_basename(__DIR__),0,$p);
  }
  if (empty($table)){
    $table=$wswdteam_table;
  }
  $md=wp_upload_dir();
  $dn=$md['basedir']."/".$appname;
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
  $bfile=$md['basedir']."/".$appname."/".$appname."-".current_time('YmdHis').'.sql';
  // adattáblák mentése
  echo("<span class=wswdteamspaceholder></span>");
  echo(wswdteam_lang("Alkalmazás adattábláinak mentése").".<br />");
  echo("<span class=wswdteamspaceholder></span>");
  if (isset($_POST['b1'])){
    $err="";
    $ret="";
    foreach($table as $tn){
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
      wswdteam_error(wswdteam_lang("Hiba történt a mentés közben").".<br />");
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
  global $wswdteam_app_name,$wswdteam_setup_file;

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
    // mentés könyvtár
    $md=wp_upload_dir();
    $bdir=$md['basedir'];
    try{
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
    }catch (Exception $e){
      if ($wswdteam_developer_mode){
        echo($e->getMessage());
      }
    }
    // főkönyvtár
    $md=get_home_path();
    $bdir=$md;
    try{
      $fl=scandir($bdir);
      foreach($fl as $l){
        $ext=pathinfo($l,PATHINFO_EXTENSION);
        if ($l===$wswdteam_setup_file){
          echo($l."<br />");
          unlink($bdir."/".$l);
        }
        switch($ext){
          case "sql":
            echo($l."<br />");
            unlink($bdir."/".$l);
            break;
          case "gz":
            echo($l."<br />");
            unlink($bdir."/".$l);
            break;
          case "tar":
            echo($l."<br />");
            unlink($bdir."/".$l);
            break;
        }
      }
    }catch (Exception $e){
      if ($wswdteam_developer_mode){
        echo($e->getMessage());
      }
    }
    echo(wswdteam_lang("Mentések törölve").".");
  }
  echo("<span class=wswdteamspaceholder></span>");
}




// fájl mentés
function wswdteam_backup_files(){
  global $wswdteam_developer_mode;

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
  $p=strpos(plugin_basename(__DIR__),'/');
  $appname=substr(plugin_basename(__DIR__),0,$p);
  $bfileurl=$md['baseurl'].'/'.$appname.'.tar';
  $bfile=$md['basedir'].'/'.$appname.'.tar';
  if (isset($_POST['file0'])){
    try {
      if (file_exists($bfile.".gz")){
        unlink("$bfile.gz");
      }
      $a=new PharData($bfile);
      $a->buildFromDirectory($hd);
      $a->compress(Phar::GZ);
      unlink($bfile);
      echo("$bfileurl.gz - ".wswdteam_lang("Fájlmentés elkészült")."<br /><br />");
    }catch (Exception $e){
      wswdteam_error(wswdteam_lang("Hiba történt a mentés közben").".<br />");
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
  global $wpdb,$wswdteam_backup_dl,$wswdteam_developer_mode;

  
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
  $p=strpos(plugin_basename(__DIR__),'/');
  $appname=substr(plugin_basename(__DIR__),0,$p);
  $bfileurl=$md['baseurl'].'/'.$appname.'.sql';
  $bfile=$md['basedir'].'/'.$appname.'.sql';

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
        wswdteam_error(wswdteam_lang("Hiba történt a mentés közben").".<br />");
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




// egyedi sql fájl feltöltése
function wswdteam_upload_file(){
  global $wswdteam_developer_mode;

  if (isset($_POST['uploadsavedsql'])){
    echo("<span class=wswdteamspaceholder></span>");
    $md=wp_upload_dir();
    $p=strpos(plugin_basename(__DIR__),'/');
    $appname=substr(plugin_basename(__DIR__),0,$p);
    $bfileurl=$md['baseurl'].'/'.$appname;
    $tdir=$md['basedir'].'/'.$appname;
    try{
      if ($_FILES['file1']['name']<>""){
        $tfile=$tdir."/".$_FILES['file1']['name'];
        //echo($_FILES['file1']['name']);
        echo("<span class=wswdteamspaceholder></span>");
        $ext=pathinfo($tfile,PATHINFO_EXTENSION);
        if (in_array($ext,array('sql'))){
          if (file_exists($tfile)){
            unlink($tfile);
          }
          if (move_uploaded_file($_FILES['file1']['tmp_name'],$tfile)){
            wswdteam_message(wswdteam_lang("A feltöltés megtörtént").".<br />");
          }
        }else{
          wswdteam_error(wswdteam_lang("Nem megfelelő fájl.Csak *.sql fájl tölthető fel").".<br />");
        }
      }
    }catch (Exception $e){
      wswdteam_error(wswdteam_lang("Hiba történt a feltöltés közben").".<br />");
      if ($wswdteam_developer_mode){
        echo($e->getMessage());
      }
    }
  }
}
    
    
    
// adat visszatöltés
function wswdteam_upload_sql_file(){
  global $wswdteam_developer_mode;

  if (is_admin()){
    $cl="button";
    $act=menu_page_url(__FILE__);
  }else{
    $cl="wswdteamtablebutton";
    $act=$_SERVER['REQUEST_URI'];
  }
  // visszatöltés
  echo(wswdteam_lang("Mentés fájlok feltöltése visszaállításhoz").".<br />");
  echo(wswdteam_lang("A nagy fájlméret miatt ajánlott a tárhely szólgáltató saját funkcióit használni. (FTP, vezérlőpult megoldások.)").".<br />");
  echo(wswdteam_lang("Csak *.sql fájl tölthető fel").".<br />");
  $fup=(int)(ini_get('upload_max_filesize'));
  $pup=(int)(ini_get('post_max_size'));
  echo(wswdteam_lang("Beállított méretkorlát: ")."$fup Mb ($pup).");
  if (($fup>=2)and($pup>=8)){
    echo("<span class=wswdteamspaceholder></span>");
    echo("<form id=fres1 action=\"".$act."\" enctype=\"multipart/form-data\" method=\"post\">");
    echo("<label id=\"fres1l\" for=\"file1\" class=\"".$cl."\">".wswdteam_lang("Adatmentés kiválasztása")."</label>");
    echo("<input type=\"file\" name=\"file1\" id=\"file1\" onchange=\"chlabel();\">");
    echo("<script>");
    echo("function chlabel(){var v=document.forms['fres1']['file1'].files[0].name;document.getElementById('fres1l').innerHTML=v;}");
    echo("</script>");
    echo("<span class=wswdteamwordspace></span>");
    echo("<input type=submit id=\"uploadsavedsql\" name=\"uploadsavedsql\" class=\"$cl\" value=\"".wswdteam_lang("Feltöltés")."\">");
    echo("</form>");
    echo("<span class=wswdteamspaceholder></span>");
  }else{
    echo("<span class=wswdteamspaceholder></span>");
    echo(wswdteam_lang("A tárhely feltöltési beállításai miatt nem tölthetőek fel a fájlok").".");
    echo("<span class=wswdteamspaceholder></span>");

  }
  echo("<span class=wswdteamspaceholder></span>");
}



?>
