<?php

// option menu


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// admin script betöltés 
if (file_exists(__DIR__.'/wswdteam_admin.css')){
  include(__DIR__.'/wswdteam_admin.css');
}
if (file_exists(__DIR__.'/wswdteam_admin.js')){
  include(__DIR__.'/wswdteam_admin.js');
}

echo("<span class=wswdteamspaceholder></span>");

// adatfeldolgozás
// if (isset($_POST['name'])){}

// fej
wswdteam_upagehead();

// adat
wswdteam_admin_backup();


// fő admin lap
function wswdteam_admin_backup(){
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
  echo("<h2>".wswdteam_lang("Alkalmazás adatmentés")."</h2>");
  echo("<span class=wswdteamspaceholder></span>");
  wswdteam_backup_apptables();
  wswdteam_backup_backuplist();
  wswdteam_backup();
}



// mentés fájlok listája
function wswdteam_backup_backuplist(){
  global $wswdteam_pagerow,$wswdteam_app_name,$wswdteam_developer_mode;

  $md=wp_upload_dir();
  $dn=$md['basedir']."/".$wswdteam_app_name;
  // fájl törlése
  if (isset($_POST['bdel'])){
    $bdelf=$dn."/".$_POST['file'];
    //echo($bdelf);
    try{
      unlink($bdelf);
      wswdteam_message(wswdteam_lang("Törlés megtörtént").".");
    }catch (Exception $e){
      wswdteam_message(wswdteam_lang("Hiba történt a törlés közben").".");
      if ($wswdteam_developer_mode){
        echo($e->getMessage());
      }
    }
  }
  // sql visszaállítás
  if (isset($_POST['bres'])){
    $bresf=$dn."/".$_POST['file'];
    if (wswdteam_inst_sql($bresf)){
      wswdteam_message(wswdteam_lang("Visszatöltés megtörtént").".");
    }else{
      wswdteam_message(wswdteam_lang("Hiba történt a visszatöltés közben").".");
    }
  }
  echo("<span class=wswdteamspaceholder></span>");
  // könyvtár beolvasás
  $fl=scandir($dn);
  $db=count($fl)-2;
  // lapozás
  if (isset($_POST['wpage'])){
    $page=$_POST['wpage'];
    if ($page<1){
      $page=1;
    }
    if ($db<($page*$wswdteam_pagerow)){
      if ($db<(($page-1)*$wswdteam_pagerow)){
        $page=1;
      }
    }
  }else{
    $page=1;
  }
  $i=($page-1)*$wswdteam_pagerow;
  ?>
  <div style="width:99%">
  <table class="wp-list-table widefat fixed striped table-view-list">
    <thead>
	  <tr>
	    <th scope="col" id="title" class="manage-column" style="width:45%;"><?php echo(wswdteam_lang('Fájlnév')); ?></th>
	    <th scope="col" id="author" class="manage-column" style="width:45%;"><?php echo(wswdteam_lang('Mentés ideje')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Visszaálít/Töröl')); ?></th>
	  </tr>
    </thead>
    <tbody id="the-list">
  <?php
  $i=1;
  foreach($fl as $bf) {
    if(!in_array($bf,array('.','..'))){
  	  echo("<tr id=\"post-$i\">");
	  echo("<td class=\"columnn-title\" data-colname=\"c$i\">$bf</td>");
	  $s=explode('.',$bf);
	  $bfd=substr($s[0],0,4).".".substr($s[0],4,2).".".substr($s[0],6,2)." ".substr($s[0],8,2).":".substr($s[0],10,2);
	  //$bfd=date("Y.m.d. H:i",filemtime($dn."/".$bf));
      echo("<td class=\"columnn-title\" data-colname=\"c$i\">$bfd</td>");
	  echo("<td class=\"columnn-title\" data-colname=\"c$i\">");
	  echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
	  echo("<input type=\"hidden\" id=\"file\" name=\"file\" value=\"$bf\">");
	  echo("<input type=\"hidden\" id=\"wpage\" name=\"wpage\" value=\"$page\">");
      echo("<input type=\"submit\" id=\"bres\" name=\"bres\" class=\"button\" value=\"+\">");
	  echo("</form>");
	  echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
	  echo("<input type=\"hidden\" id=\"file\" name=\"file\" value=\"$bf\">");
	  echo("<input type=\"hidden\" id=\"wpage\" name=\"wpage\" value=\"$page\">");
      echo("<input type=\"submit\" id=\"bdel\" name=\"bdel\" class=\"button\" value=\"-\">");
	  echo("</form>");
	  echo("</td>");
	  echo("</tr>");
      $i++;
    }
  }
  ?>
  </tbody>
    <tfoot>
	  <tr>
	    <th scope="col" id="title" class="manage-column" style="width:45%;"><?php echo(wswdteam_lang('Fájlnév')); ?></th>
	    <th scope="col" id="author" class="manage-column" style="width:45%;"><?php echo(wswdteam_lang('Mentés ideje')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Visszaálít/Töröl')); ?></th>
	  </tr>
    </tfoot>
  </table>
  </div>

  <?php
  echo("<br />");
  wswdteam_pager_admin($db,$wswdteam_pagerow,$page,"wpage");
  echo("<span class=wswdteamspaceholder></span>");
}



//fejléc
function wswdteam_upagehead(){
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
  echo("<h1>".wswdteam_lang('Adatmentés - visszaállítás')."</h1>");
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
}


// új nyelvi elemek kiírása
echo(wswdteam_lang_newlines());

?>
