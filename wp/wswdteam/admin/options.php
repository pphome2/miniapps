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

?>

<h1>WSWDTeam beállítások lap</h1>
<br />
Teszt üzem.
<br />

<br /><br /><br />
<form action="<?php menu_page_url('wswdteam_options.php') ?>" method="post">
  <label for="fname">Vezetéknév:</label><br>
  <input type="text" id="fname" name="fname"><br>
  <label for="lname">Keresztnév:</label><br>
  <input type="text" id="lname" name="lname">
  <br /><br />
  <input type="submit" value="Mehet">
</form>
<br /><br />

<?php
?>

