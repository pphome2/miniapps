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


// adatfeldolgozás
$table_name=$wpdb->prefix.$wswdteam_table[0];

if (isset($_POST['del'])){
  $w_id=$_POST['del'];
  $sql="DELETE FROM $table_name WHERE id=$w_id;";
  $r=$wpdb->query($sql);
  $l=wswdteam_lang('Törölve');
  wswdteam_message($l);
}

if (isset($_POST['submit'])){
  $w_name=$_POST['name'];
  $w_text=$_POST['text'];
  if ((isset($_POST['id']))and($_POST['id']<>"")){
    $w_id=$_POST['id'];
    $sql="UPDATE $table_name SET name='$w_name',text='$w_text' WHERE id=$w_id;";
    $r=$wpdb->query($sql);
    $l=wswdteam_lang('Módosítva');
    wswdteam_message($l);
  }else{
    $w_id="";
    $sql="INSERT INTO $table_name (name,text) VALUES ('$w_name','$w_text');";
    $r=$wpdb->query($sql);
    $l=wswdteam_lang('Tárolva');
    wswdteam_message($l);
  }
  wswdteam_pagehead();
  wswdteam_table();
}else{
  if (isset($_POST['m'])){
    if (isset($_POST['id'])){
      $w_id=$_POST['id'];
    }else{
      $w_id="";
    }
    $w_name=$_POST['name'];
    $w_text=$_POST['text'];
    wswdteam_pagehead();
    wswdteam_form($w_id,$w_name,$w_text);
  }else{
    if (isset($_POST['new'])){
      wswdteam_pagehead();
      wswdteam_form();
    }else{
      wswdteam_pagehead();
      wswdteam_table();
    }
  }
}


// <script>alert("X");</script>
// <style>label{text-align:center;color:red;}</style>

function wswdteam_form($w_id="",$w_name="",$w_text=""){
  ?>
  <form action="<?php menu_page_url('wswdteam_options.php') ?>" method="post">
    <label for="name"><?php echo(wswdteam_lang('Vezetéknév')); ?>:</label><br>
    <input type="text" id="name" name="name" value="<?php echo($w_name); ?>"><br>
    <label for="text"><?php echo(wswdteam_lang('Keresztnév')); ?>:</label><br>
    <input type="text" id="text" name="text" value="<?php echo($w_text); ?>">
    <input type="hidden" id="id" name="id" value="<?php echo($w_id); ?>">
    <br /><br />
    <input type="submit" id="submit" name="submit" value="<?php echo(wswdteam_lang('Mehet')); ?>">
  </form>
  <br /><br />
  <?php
}


function wswdteam_table(){
  global $wpdb,$wswdteam_table;

  ?>
  <br /><br />
  <form action="<?php menu_page_url('wswdteam_options.php') ?>" method="post">
    <input type="submit" id="new" name="new" value="<?php echo(wswdteam_lang('Új')); ?>">
  </form>
  <br />
  <div style="width:99%">
  <table class="wp-list-table widefat fixed striped table-view-list">
    <thead>
	  <tr>
	    <th scope="col" id="title" class="manage-column" style="width:28%;"><?php echo(wswdteam_lang('Vezetéknév')); ?></th>
	    <th scope="col" id="author" class="manage-column" style="width:28%;"><?php echo(wswdteam_lang('Keresztnév')); ?></th>
	    <th scope="col" id="categories" class="manage-column" style="width:28%;"><?php echo(wswdteam_lang('Vezetéknév')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Javít')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Töröl')); ?></th>
	  </tr>
    </thead>
    <tbody id="the-list">
  <?php
  $table_name=$wpdb->prefix.$wswdteam_table[0];
  $sql="SELECT * FROM $table_name;";
  $res=$wpdb->get_results($sql);
  $i=1;
  foreach($res as $t) {
	echo("<tr id=\"post-$i\">");
	echo("<td class=\"columnn-date\" data-colname=\"c$i\">$t->name</td>");
	echo("<td class=\"columnn-date\" data-colname=\"c$i\">$t->text</td>");
	echo("<td class=\"columnn-date\" data-colname=\"c$i\"></td>");
	echo("<td class=\"columnn-date\" data-colname=\"c$i\">");
	echo("<form action=\"".menu_page_url('wswdteam_options.php')."\" method=\"post\">");
	echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$t->id\">");
	echo("<input type=\"hidden\" id=\"name\" name=\"name\" value=\"$t->name\">");
	echo("<input type=\"hidden\" id=\"text\" name=\"text\" value=\"$t->text\">");
	echo("<input type=\"hidden\" id=\"m\" name=\"m\" value=\"0\">");
    echo("<input type=\"submit\" value=\"+\">");
	echo("</form>");
	echo("</td>");
	echo("<td class=\"columnn-date\" data-colname=\"c$i\">");
	echo("<form action=\"".menu_page_url('wswdteam_options.php')."\" method=\"post\">");
	echo("<input type=\"hidden\" id=\"del\" name=\"del\" value=\"$t->id\">");
    echo("<input type=\"submit\" value=\"-\">");
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
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Töröl')); ?></th>
	  </tr>
    </tfoot>
  </table>
  </div>

  <?php
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

