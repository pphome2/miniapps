<?php

// felhasználói jogok beállítása


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}





// adatbeérkezés
function wswdteam_user_formdata_app($data="",$name=""){
  echo("<div class=wswdteamspaceholder></div>");
  // adatfeldolgozás
  $data=wswdteam_get_option($name);
  // törlés
  if (isset($_POST['del'])){
    $w_id=$_POST['id'];
    if (is_array($data)){
      unset($data[$w_id]);
    }
    $r=wswdteam_save_option($data,$name);
     if ($r){
       $l=wswdteam_lang('Törölve');
       wswdteam_message($l);
     }else{
       $l=wswdteam_lang('Hiba történt');
       wswdteam_error($l);
     }
  }

  // form-ból adat
  if (isset($_POST['submit'])){
    // mehet gomb után
    $w_name=$_POST['uname'];
    $w_text=$_POST['urole'];
    if ((isset($data[$w_name])&&$data[$w_name]!=$w_text)){
      $data[$w_name]=$w_text;
      $r=wswdteam_save_option($data,$name);
      if ($r){
        $l=wswdteam_lang('Tárolva');
        wswdteam_message($l);
      }else{
        $l=wswdteam_lang('Hiba történt');
        wswdteam_error($l);
      }
    }
  }else{
    // tábla vagy táblából adat
    if (isset($_POST['m'])){
      // táblából adat javításra
      if (isset($_POST['id'])){
        $w_id=$_POST['id'];
      }else{
        $w_id="";
      }
      $w_name=$_POST['uname'];
      $w_text=$_POST['urole'];
      wswdteam_user_form_app($w_id,$w_name,$w_text);
    }else{
    }
  }
}



// adat form
function wswdteam_user_form_app($w_id="",$w_uname="",$w_urole=""){
  global $wswdteam_user_role_list;

  wswdteam_user_pagehead();
  if (isset($_POST['wpage'])){
    $page=$_POST['wpage'];
  }
  $wusers=get_users(array('echo'=>false));
  ?>
  <form action="<?php menu_page_url(__FILE__) ?>" method="post">
    <label for="uname"><?php echo(wswdteam_lang('Felhasználó')); ?>:</label><br>
    <select id="uname" name="uname">
      <?php
        foreach($wusers as $u){
          if ($w_uname===$u->display_name){
            $sel="selected";
          }else{
            $sel="";
          }
          echo("<option value=\"$u->display_name\" $sel>".$u->display_name."</option>");
        }
      ?>
    </select><br /><br />
    <label for="urole"><?php echo(wswdteam_lang('Jogosultsági szint')); ?>:</label><br>
    <select id="urole" name="urole">
      <?php
        $i=0;
        foreach($wswdteam_user_role_list as $r){
          if ($w_urole==$i){
            $sel="selected";
          }else{
            $sel="";
          }
          echo("<option value=$i $sel>".$r."</option>");
          $i++;
        }
      ?>
    </select><br />
    <input type="hidden" id="id" name="id" value="<?php echo($w_id); ?>">
    <input type="hidden" id="wpage" name="wpage" value="<?php echo($page); ?>">
    <br /><br />
    <input type="submit" class="button" id="submit" name="submit" value="<?php echo(wswdteam_lang('Mehet')); ?>">
    <input type="submit" class="button" id="x" name="x" value="<?php echo(wswdteam_lang('Mégse')); ?>">
  </form>
  <br /><br />
  <?php
}



// adat tábla
function wswdteam_user_table_app($data,$role,$name=""){
  global $wswdteam_pagerow,$wswdteam_option_user_name,$wswdteam_user_role_list;

  wswdteam_user_pagehead_app();
  echo(wswdteam_lang("A rendszer által kezelt jogcsoportok").":<br /><br />");
  foreach($role as $r){
    echo("$r<br />");
  }
  echo("<div class=\"wswdteamspaceholder\"></div>");
  global $wswdteam_pagerow;

  wswdteam_user_pagehead_app();
  $data=wswdteam_get_option($name);
  $page=1;
  $db=0;
  if (is_array($data)){
    $db=count($data);
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
  }
  //echo($db." - ".$page." - ".$i." - ".$wswdteam_pagerow);
  ?>
  <br />
  <form action="<?php menu_page_url(__FILE__) ?>" method="post">
    <input type="hidden" id="wpage" name="wpage" value="<?php echo($page); ?>">
    <input type="submit" class="button" id="new" name="new" value="<?php echo(wswdteam_lang('Új')); ?>">
  </form>
  <br />
  <br />
  <div style="width:99%">
  <table class="wp-list-table widefat fixed striped table-view-list">
    <thead>
	  <tr>
	    <th scope="col" id="title" class="manage-column" style="width:45%;"><?php echo(wswdteam_lang('Felhasználó')); ?></th>
	    <th scope="col" id="author" class="manage-column" style="width:45%;"><?php echo(wswdteam_lang('Jogcsoport')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Javít/Töröl')); ?></th>
	  </tr>
    </thead>
    <tbody id="the-list">
  <?php
  if ($data){
    $i=1;
    foreach($data as $s=>$d) {
    	echo("<tr id=\"post-$i\">");
    	echo("<td class=\"columnn-title\" data-colname=\"c$i\">$s</td>");
	    echo("<td class=\"columnn-title\" data-colname=\"c$i\">$wswdteam_user_role_list[$d]</td>");
    	echo("<td class=\"columnn-title\" data-colname=\"c$i\">");
	    echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
	    echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$s\">");
	    echo("<input type=\"hidden\" id=\"uname\" name=\"uname\" value=\"$s\">");
	    echo("<input type=\"hidden\" id=\"urole\" name=\"urole\" value=\"$d\">");
	    echo("<input type=\"hidden\" id=\"wpage\" name=\"wpage\" value=\"$page\">");
      echo("<input type=\"submit\" id=\"m\" name=\"m\" class=\"button\" value=\"+\">");
    	echo("</form>");
	    echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
	    echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$s\">");
	    echo("<input type=\"hidden\" id=\"wpage\" name=\"wpage\" value=\"$page\">");
      echo("<input type=\"submit\" id=\"del\" name=\"del\" class=\"button\" value=\"-\">");
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
	    <th scope="col" id="title" class="manage-column"><?php echo(wswdteam_lang('Felhasználó')); ?></th>
	    <th scope="col" id="author" class="manage-column"><?php echo(wswdteam_lang('Jogcsoport')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Javít/Töröl')); ?></th>
	  </tr>
    </tfoot>
  </table>
  </div>

  <?php
  if (!$data){
    echo("<br />");
    wswdteam_pager_admin($db,$wswdteam_pagerow,$page,"wpage");
  }
  echo("<span class=wswdteamspaceholder></span>");
}



//fejléc
function wswdteam_user_pagehead_app(){
  echo("<br />");
  echo("<h1>".wswdteam_lang('Felhasználói jogok beállítása')."</h1>");
  echo("<br />");
  echo(wswdteam_lang('Jogosultsági szint rendelése felhasználóhoz.'));
  echo("<span class=wswdteamspaceholder></span>");
}



// új nyelvi elemek kiírása
echo(wswdteam_lang_newlines());



?>
