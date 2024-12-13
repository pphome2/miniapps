<?php

// app


if (isset($_POST['0'])){
  $l=$_POST['0'];
  header('Content-Disposition: attachment; filename=\"".date(YmdHis).".sql\"');
  header('Content-Type: text/plain');
  header('Content-Length: '.strlen($l));
  header('Connection: close');
}else{
}

?>
