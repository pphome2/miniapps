<?php

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");
header("Pragma: no-cache");
header("Expires: 0");

#include("content/ilfile.php");
#genfile();

if ($_POST['f']){
	echo($_POST['f']);
}

die;

?>
