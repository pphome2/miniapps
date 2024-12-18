<?php

// option menu


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// admin script betöltés 
if (file_exists(__DIR__.'/wdhd_admin.css')){
  include(__DIR__.'/wdhd_admin.css');
}
if (file_exists(__DIR__.'/wdhd_admin.js')){
  include(__DIR__.'/wdhd_admin.js');
}

echo("<div class=wdhdspaceholder></div>");

// adatfeldolgozás
// if (isset($_POST['name'])){}

// fej
wdhd_upagehead();

// adat
wdhd_backup_backuplist();
wdhd_admin_backup();



// mentés fájlok listája
function wdhd_backup_backuplist(){
  global $wdhd_pagerow,$wdhd_app_name,$wdhd_developer_mode;

  $md=wp_upload_dir();
  $dn=$md['basedir']."/".$wdhd_app_name;
  if(!is_dir($dn)){
    try{
      mkdir($dn);
    }catch (Exception $e){
      if ($wdhd_developer_mode){
        echo($e->getMessage());
      }
    }
  }
  // fájl törlése
  if (isset($_POST['bdel'])){
    $bdelf=$dn."/".$_POST['file'];
    //echo($bdelf);
    try{
      unlink($bdelf);
      wdhd_message(wdhd_lang("Törlés megtörtént").".");
    }catch (Exception $e){
      wdhd_message(wdhd_lang("Hiba történt a törlés közben").".");
      if ($wdhd_developer_mode){
        echo($e->getMessage());
      }
    }
  }
  // sql visszaállítás
  if (isset($_POST['bres'])){
    $bresf=$dn."/".$_POST['file'];
    if (wdhd_inst_sql($bresf)){
      wdhd_message(wdhd_lang("Visszatöltés megtörtént").".");
    }else{
      wdhd_message(wdhd_lang("Hiba történt a visszatöltés közben").".");
    }
  }
  echo("<span class=wdhdspaceholder></span>");
  // könyvtár beolvasás
  $fl=scandir($dn,SCANDIR_SORT_DESCENDING);
  $db=count($fl)-2;
  // lapozás
  if (isset($_POST['wpage'])){
    $page=$_POST['wpage'];
    if ($page<1){
      $page=1;
    }
    if ($db<($page*$wdhd_pagerow)){
      if ($db<(($page-1)*$wdhd_pagerow)){
        $page=1;
      }
    }
  }else{
    $page=1;
  }
  $i=($page-1)*$wdhd_pagerow;
  ?>
  <div style="width:99%">
  <table class="wp-list-table widefat fixed striped table-view-list">
    <thead>
	  <tr>
	    <th scope="col" id="title" class="manage-column" style="width:45%;"><?php echo(wdhd_lang('Fájlnév')); ?></th>
	    <th scope="col" id="author" class="manage-column" style="width:45%;"><?php echo(wdhd_lang('Mentés ideje')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wdhd_lang('Visszaálít/Töröl')); ?></th>
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
	    <th scope="col" id="title" class="manage-column" style="width:45%;"><?php echo(wdhd_lang('Fájlnév')); ?></th>
	    <th scope="col" id="author" class="manage-column" style="width:45%;"><?php echo(wdhd_lang('Mentés ideje')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wdhd_lang('Visszaálít/Töröl')); ?></th>
	  </tr>
    </tfoot>
  </table>
  </div>

  <?php
  echo("<br />");
  wdhd_pager_admin($db,$wdhd_pagerow,$page,"wpage");
  echo("<span class=wdhdspaceholder></span>");
}




// fő admin lap
function wdhd_admin_backup(){
  echo("<span class=wdhdspaceholder></span>");
  echo("<span class=wdhdspaceholder></span>");
  wdhd_backup();
}


//fejléc
function wdhd_upagehead(){
  echo("<br />");
  echo("<h1>".wdhd_lang('Adatmentés - visszaállítás')."</h1>");
  echo("<br />");
  echo("<span class=wdhdspaceholder></span>");
}


// új nyelvi elemek kiírása
echo(wdhd_lang_newlines());

?>
