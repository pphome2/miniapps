<?php

// segéd függvények

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}





// mentés fájlok listája
function wswdteam_backup_backuplist($table=array(),$appname=""){
  global $wswdteam_pagerow,$wswdteam_app_name,$wswdteam_developer_mode,$wswdteam_table;

  if ($appname===""){
    $p=strpos(plugin_basename(__DIR__),'/');
    $appname=substr(plugin_basename(__DIR__),0,$p);
  }
  if (empty($table)){
    $table=$wswdteam_table;
  }
  $md=wp_upload_dir();
  $dn=$md['basedir']."/".$appname;
  $upload_dir=wp_upload_dir();
  $dnurl=$upload_dir['baseurl']."/".$appname;
  if(!is_dir($dn)){
    try{
      mkdir($dn);
    }catch (Exception $e){
      if ($wswdteam_developer_mode){
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
  $fl=scandir($dn,SCANDIR_SORT_DESCENDING);
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
	    echo("<td class=\"columnn-title\" data-colname=\"c$i\"><a href=\"$dnurl/$bf\">$bf</a></td>");
	    $s1=explode('-',$bf);
	    $sd=$s1[1];
	    $bfd=substr($sd,0,4).".".substr($sd,4,2).".".substr($sd,6,2)." ".substr($sd,8,2).":".substr($sd,10,2);
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






?>
