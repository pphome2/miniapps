<?php

// app

  header('Content-Disposition: attachment; filename='.date('YmdHis').'.sql');
  header('Content-Type: text/plain');
  header('Content-Length: '.strlen($l));
  header('Connection: close');

if (isset($_POST['0'])){
  $l=$_POST['0'];
  echo($l);
}else{
  echo("Nincs adat.");
}

?>
