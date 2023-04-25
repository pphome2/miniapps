<?php

if (isset($_POST['f'])){
	if (isset($_POST['fn'])){
		$fn=$_POST['fn'];
		$fdata="";
	}else{
		$fn="file.csv";
		$fdata="\xEF\xBB\xBF";
	}

	header("Content-type: text/csv; charset=UTF-8");
	header("Content-Disposition: attachment; filename=$fn");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo($fdata);
	$fdata=$_POST['f'];
	echo($fdata);
}

die;

?>
