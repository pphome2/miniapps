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
  //include(__DIR__.'/wswdteam_admin.js');
}
// vagy html:
// <script>alert("X");</script>
// <style>label{text-align:center;color:red;}</style>


// adatfeldolgozás
$table_name=$wpdb->prefix.$wswdteam_table[0];

// törlés
if (isset($_POST['del'])){
  $w_id=$_POST['id'];
  $sql="DELETE FROM $table_name WHERE id=$w_id;";
  $r=$wpdb->query($sql);
  $l=wswdteam_lang('Törölve');
  wswdteam_message($l);
}

// form-ból adat
if (isset($_POST['submit'])){
  // mehet gomb után
  $w_name=$_POST['name'];
  $w_text=$_POST['text'];
  if ((isset($_POST['id']))and($_POST['id']<>"")){
    // javítás
    $w_id=$_POST['id'];
    $sql="UPDATE $table_name SET name='$w_name',text='$w_text' WHERE id=$w_id;";
    $r=$wpdb->query($sql);
    $l=wswdteam_lang('Módosítva');
    wswdteam_message($l);
  }else{
    // új adat
    $w_id="";
    $sql="INSERT INTO $table_name (name,text) VALUES ('$w_name','$w_text');";
    $r=$wpdb->query($sql);
    $l=wswdteam_lang('Tárolva');
    wswdteam_message($l);
  }
  wswdteam_table();
}else{
  // tábla vagy táblából adat
  if (isset($_POST['m'])){
    // táblából adat javításra
    if (isset($_POST['id'])){
      $w_id=$_POST['id'];
    }else{
      $w_id="";
    }
    $w_name=$_POST['name'];
    $w_text=$_POST['text'];
    wswdteam_form($w_id,$w_name,$w_text);
  }else{
    if (isset($_POST['new'])){
      // új adat gomb a táblából
      wswdteam_form();
    }else{
      wswdteam_table();
    }
  }
}


// adat form
function wswdteam_form($w_id="",$w_name="",$w_text=""){
  wswdteam_pagehead();
  if (isset($_POST['page'])){
    $page=$_POST['page'];
  }
  ?>
  <form action="<?php menu_page_url(__FILE__) ?>" method="post">
    <label for="name"><?php echo(wswdteam_lang('Vezetéknév')); ?>:</label><br>
    <input type="text" id="name" name="name" value="<?php echo($w_name); ?>"><br>
    <label for="text"><?php echo(wswdteam_lang('Keresztnév')); ?>:</label><br>
    <input type="text" id="text" name="text" value="<?php echo($w_text); ?>">
    <input type="hidden" id="id" name="id" value="<?php echo($w_id); ?>">
    <input type="hidden" id="page" name="page" value="<?php echo($page); ?>">
    <br /><br />
    <input type="submit" class="button" id="submit" name="submit" value="<?php echo(wswdteam_lang('Mehet')); ?>">
    <input type="submit" class="button" id="x" name="x" value="<?php echo(wswdteam_lang('Mégse')); ?>">
  </form>
  <br /><br />
  <?php
}


// adat tábla
function wswdteam_table(){
  global $wpdb,$wswdteam_table,$wswdteam_pagerow;

  wswdteam_pagehead();
  $table_name=$wpdb->prefix.$wswdteam_table[0];
  $sql="select count(*) from $table_name";
  $db=$wpdb->get_var($sql);
  if (isset($_POST['page'])){
    $page=$_POST['page'];
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
  echo($db." - ".$page." - ".$i." - ".$wswdteam_pagerow);
  ?>
  <br />
  <form action="<?php menu_page_url(__FILE__) ?>" method="post">
    <input type="hidden" id="page" name="page" value="<?php echo($page); ?>">
    <input type="submit" class="button" id="new" name="new" value="<?php echo(wswdteam_lang('Új')); ?>">
  </form>
  <br />
  <br />
  <div style="width:99%">
  <table class="wp-list-table widefat fixed striped table-view-list">
    <thead>
	  <tr>
	    <th scope="col" id="title" class="manage-column" style="width:28%;"><?php echo(wswdteam_lang('Vezetéknév')); ?></th>
	    <th scope="col" id="author" class="manage-column" style="width:28%;"><?php echo(wswdteam_lang('Keresztnév')); ?></th>
	    <th scope="col" id="categories" class="manage-column" style="width:28%;"><?php echo(wswdteam_lang('Vezetéknév')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Javít/Töröl')); ?></th>
	  </tr>
    </thead>
    <tbody id="the-list">
  <?php
  $sql="SELECT * FROM $table_name limit $i,$wswdteam_pagerow;";
  $res=$wpdb->get_results($sql);
  $i=1;
  foreach($res as $t) {
	echo("<tr id=\"post-$i\">");
	echo("<td class=\"columnn-title\" data-colname=\"c$i\">$t->name</td>");
	echo("<td class=\"columnn-title\" data-colname=\"c$i\">$t->text</td>");
	echo("<td class=\"columnn-title\" data-colname=\"c$i\"></td>");
	echo("<td class=\"columnn-title\" data-colname=\"c$i\">");
	echo("<form action=\"".menu_page_url('wswdteam_options.php')."\" method=\"post\">");
	echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$t->id\">");
	echo("<input type=\"hidden\" id=\"name\" name=\"name\" value=\"$t->name\">");
	echo("<input type=\"hidden\" id=\"text\" name=\"text\" value=\"$t->text\">");
	echo("<input type=\"hidden\" id=\"page\" name=\"page\" value=\"$page\">");
    echo("<input type=\"submit\" id=\"m\" name=\"m\" class=\"button\" value=\"+\">");
	echo("</form>");
	echo("<form action=\"".menu_page_url('wswdteam_options.php')."\" method=\"post\">");
	echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$t->id\">");
	echo("<input type=\"hidden\" id=\"page\" name=\"page\" value=\"$page\">");
    echo("<input type=\"submit\" id=\"del\" name=\"del\" class=\"button\" value=\"-\">");
	echo("</form>");
	echo("</td>");
	echo("</tr>");
    $i++;
  }
  ?>
  </tbody>
    <tfoot>
	  <tr>
	    <th scope="col" id="title" class="manage-column"><?php echo(wswdteam_lang('Vezetéknév')); ?></th>
	    <th scope="col" id="author" class="manage-column"><?php echo(wswdteam_lang('Keresztnév')); ?></th>
    	  <th scope="col" id="categories" class="manage-column"><?php echo(wswdteam_lang('Vezetéknév')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Művelet')); ?></th>
	  </tr>
    </tfoot>
  </table>
  </div>

  <?php
  echo("<br />");
  wswdteam_pager($db,$wswdteam_pagerow,$page,"page");
  echo("<br />");
  echo("<br />");
}


//fejléc
function wswdteam_pagehead(){
  echo("<br />");
  echo("<h1>".wswdteam_lang('WSWDTeam beállítások')."</h1>");
  echo("<br />");
  echo(wswdteam_lang('Teszt üzem'));
  echo("<br />");
  echo("<br />");
  echo("<br />");
}


?>

