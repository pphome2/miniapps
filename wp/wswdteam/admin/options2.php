<?php

// option menu 

if (isset($_POST['fname'])){
  $x1=$_POST['fname'];
  $x2=$_POST['lname'];
  $table_name=$wpdb->prefix.$wswdteam_table;
  $sql="INSERT INTO $table_name (name,text) VALUES ('$x1','$x2');";
  $r=$wpdb->query($sql);
  wswdteam_message("Tárolva.");
}

echo("<h1>".wswdteam_lang('WSWDTeam beállítások')."</h1>");
echo("<br />");
echo(wswdteam_lang('Teszt üzem'));
echo("<br />");
echo("<br />");
echo("<br />");
?>

<form action="<?php menu_page_url('wswdteam_options.php') ?>" method="post">
  <label for="fname"><?php echo(wswdteam_lang('E-mail')); ?>:</label><br>
  <input type="text" id="fname" name="fname"><br>
  <label for="lname"><?php echo(wswdteam_lang('Telefon')); ?>:</label><br>
  <input type="text" id="lname" name="lname">
  <br /><br />
  <input type="submit" value="<?php echo(wswdteam_lang('Mehet')); ?>">
</form>

<?php
echo("<br />");
echo("<br />");
?>

