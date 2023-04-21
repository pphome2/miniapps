<?php

header("Content-type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=file.csv");
header("Pragma: no-cache");
header("Expires: 0");

if ($_POST['f']){
  echo("\xEF\xBB\xBF");
  $csv=$_POST['f'];
  echo($csv);
}

die;

?>
