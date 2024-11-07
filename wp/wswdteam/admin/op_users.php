<?php

// felhasználói jogok beállítása


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// jogosultság ellenőrzése
$ur=wswdteam_user_right();
if (!in_array($ur,[0])){
  $l=wswdteam_lang('Nem megfelelő jogosultság');
  wswdteam_error($l);
  exit;
}


// admin script betöltés 
if (file_exists(__DIR__.'/wswdteam_admin.css')){
  include(__DIR__.'/wswdteam_admin.css');
}
if (file_exists(__DIR__.'/wswdteam_admin.js')){
  include(__DIR__.'/wswdteam_admin.js');
}


echo("<br /><br />");

// adatfeldolgozás
$table_name=$wpdb->prefix.$wswdteam_table[1];

// törlés
if (isset($_POST['del'])){
  $w_id=$_POST['id'];
  $sql="DELETE FROM $table_name WHERE id=$w_id;";
  $r=$wpdb->query($sql);
  if ($r){
    $l=wdhd_lang('Törölve');
    wdhd_message($l);
  }else{
    $l=wdhd_lang('Hiba történt');
    wdhd_error($l);
  }
}

// form-ból adat
if (isset($_POST['submit'])){
  // mehet gomb után
  $w_uname=$_POST['uname'];
  $w_urole=$_POST['urole'];
  if ((isset($_POST['id']))and($_POST['id']<>"")){
    // javítás
    $w_id=$_POST['id'];
    $sql="UPDATE $table_name SET uname='$w_uname',urole='$w_urole' WHERE id=$w_id;";
    $r=$wpdb->query($sql);
    if ($r){
      $l=wdhd_lang('Módosítva');
      wdhd_message($l);
    }else{
      $l=wdhd_lang('Hiba történt');
      wdhd_error($l);
    }
  }else{
    // új adat
    $w_id="";
    $sql="SELECT * FROM $table_name WHERE uname='$w_uname';";
    $res=$wpdb->get_results($sql);
    if (count($res)<>0){
      $l=wswdteam_lang('A felhasználó már felvéve.');
      wswdteam_error($l);
    }else{
      $sql="INSERT INTO $table_name (uname,urole) VALUES ('$w_uname',$w_urole);";
      $r=$wpdb->query($sql);
      if ($r){
        $l=wdhd_lang('Tárolva');
        wdhd_message($l);
      }else{
        $l=wdhd_lang('Hiba történt');
        wdhd_error($l);
      }
    }
  }
  wswdteam_utable();
}else{
  // tábla vagy táblából adat
  if (isset($_POST['m'])){
    // táblából adat javításra
    if (isset($_POST['id'])){
      $w_id=$_POST['id'];
    }else{
      $w_id="";
    }
    $w_uname=$_POST['uname'];
    $w_urole=$_POST['urole'];
    wswdteam_uform($w_id,$w_uname,$w_urole);
  }else{
    if (isset($_POST['new'])){
      // új adat gomb a táblából
      wswdteam_uform();
    }else{
      wswdteam_utable();
    }
  }
}


// adat form
function wswdteam_uform($w_id="",$w_uname="",$w_urole=""){
  global $wswdteam_user_role_list;

  wswdteam_upagehead();
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
          echo("<option value=\"$u->display_name\">".$u->display_name."</option>");
        }
      ?>
    </select><br />
    <label for="urole"><?php echo(wswdteam_lang('Jogosultsági szint')); ?>:</label><br>
    <select id="urole" name="urole">
      <?php
        $i=0;
        foreach($wswdteam_user_role_list as $r){
          echo("<option value=$i>".$r."</option>");
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
function wswdteam_utable(){
  global $wpdb,$wswdteam_table,$wswdteam_pagerow,$wswdteam_user_role_list;

  wswdteam_upagehead();
  $table_name=$wpdb->prefix.$wswdteam_table[1];
  $sql="SELECT COUNT(*) FROM $table_name";
  $db=$wpdb->get_var($sql);
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
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Töröl')); ?></th>
	  </tr>
    </thead>
    <tbody id="the-list">
  <?php
  $sql="SELECT * FROM $table_name limit $i,$wswdteam_pagerow;";
  $res=$wpdb->get_results($sql);
  if (count($res)<>0){
  $i=1;
  foreach($res as $t) {
	echo("<tr id=\"post-$i\">");
	$l=$wswdteam_user_role_list[$t->urole];
	echo("<td class=\"columnn-title\" data-colname=\"c$i\">$t->uname</td>");
	echo("<td class=\"columnn-title\" data-colname=\"c$i\">$l</td>");
	echo("<td class=\"columnn-title\" data-colname=\"c$i\">");
	echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
	echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$t->id\">");
	//echo("<input type=\"hidden\" id=\"uname\" name=\"uname\" value=\"$t->uname\">");
	//echo("<input type=\"hidden\" id=\"urole\" name=\"urole\" value=\"$t->urole\">");
	//echo("<input type=\"hidden\" id=\"wpage\" name=\"wpage\" value=\"$page\">");
    //echo("<input type=\"submit\" id=\"m\" name=\"m\" class=\"button\" value=\"+\">");
	//echo("</form>");
	echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
	echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$t->id\">");
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
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Töröl')); ?></th>
	  </tr>
    </tfoot>
  </table>
  </div>

  <?php
  echo("<br />");
  wswdteam_pager_admin($db,$wswdteam_pagerow,$page,"wpage");
  echo("<br />");
  echo("<br />");
}


//fejléc
function wswdteam_upagehead(){
  echo("<br />");
  echo("<h1>".wswdteam_lang('Felhasználói jogok beállítása')."</h1>");
  echo("<br />");
  echo(wswdteam_lang('Jogosultsági szint rendelése felhasználóhoz.'));
  echo("<br />");
  echo("<br />");
  echo("<br />");
}



// új nyelvi elemek kiírása
wswdteam_lang_newlines();



?>
