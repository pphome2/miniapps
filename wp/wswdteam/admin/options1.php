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

// adatfeldolgozás
$w_id="";
$w_name="";
$w_text="";
$wmet="";
if (isset($_POST['m'])){
  $wmet=$_POST['m'];
}
if (isset($_POST['del'])){
  $w_id=$_POST['del'];
  $table_name=$wpdb->prefix.$wswdteam_table[0];
  $sql="DELETE FROM $table_name WHERE id=$w_id;";
  $r=$wpdb->query($sql);
  $l=wswdteam_lang('Törölve');
  wswdteam_message($l);
  $w_id="";
  $wmet="";
}
if (($wmet==="1")and(isset($_POST['name']))){
  $x1=$_POST['name'];
  $x2=$_POST['text'];
  if ($x1<>""){
    $table_name=$wpdb->prefix.$wswdteam_table[0];
    $sql="INSERT INTO $table_name (name,text) VALUES ('$x1','$x2');";
    $r=$wpdb->query($sql);
    $l=wswdteam_lang('Tárolva');
    wswdteam_message($l);
  }
  $wmet="";
  $w_id="";
  $w_name="";
  $w_text="";
}
if (($wmet==="2")and(isset($_POST['name']))){
  $w_id=$_POST['id'];
  $x1=$_POST['name'];
  $x2=$_POST['text'];
  $table_name=$wpdb->prefix.$wswdteam_table[0];
  $sql="UPDATE $table_name SET name='$x1',text='$x2' WHERE id=$w_id;";
  $r=$wpdb->query($sql);
  $l=wswdteam_lang('Módosítva');
  wswdteam_message($l);
  $wmet="";
  $w_id="";
  $w_name="";
  $w_text="";
}
if ($wmet==="0"){
  $w_id=$_POST['id'];
  $w_name=$_POST['name'];
  $w_text=$_POST['text'];
  $wmet="2";
}
if ($wmet===""){
  $wmet="1";
  $w_id="";
  $w_name="";
  $w_text="";
}

//fejléc
echo("<h1>".wswdteam_lang('WSWDTeam beállítások')."</h1>");
echo("<br />");
echo(wswdteam_lang('Teszt üzem'));
echo("<br />");
echo("<br />");
echo("<br />");

?>

<!--
<script>alert("X");</script>
<style>label{text-align:center;color:red;}</style>
-->

<div style="width:99%">

<form action="<?php menu_page_url('wswdteam_options.php') ?>" method="post">
  <label for="name"><?php echo(wswdteam_lang('Vezetéknév')); ?>:</label><br>
  <input type="text" id="name" name="name" value="<?php echo($w_name); ?>"><br>
  <label for="text"><?php echo(wswdteam_lang('Keresztnév')); ?>:</label><br>
  <input type="text" id="text" name="text" value="<?php echo($w_text); ?>">
  <input type="hidden" id="id" name="id" value="<?php echo($w_id); ?>">
  <input type="hidden" id="m" name="m" value="<?php echo($wmet); ?>">
  <br /><br />
  <input type="submit" value="<?php echo(wswdteam_lang('Mehet')); ?>">
</form>

<br />
<br />
<br />
<br />

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
  <tbody id="dblist">

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

?>

