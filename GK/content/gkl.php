<?php

 #
 # GK
 #
 # info: main folder copyright file
 #
 #


function gk_export(){
	global $MA_SQL_RESULT,$GK_DOWNLOAD,$GK_SEPARATOR,$MA_DOWNLOADFILE,$GK_FIELDS,$GK_DOWNLOADTEXT,
	        $GK_BACK,$MA_USERNAME;

	$dload="";
	$db=count($GK_FIELDS);
	for($i=0;$i<$db;$i++){
		$dload=$dload.$GK_FIELDS[$i].$GK_SEPARATOR;
	}
	$dload=$dload.PHP_EOL;
	$dat=array(5,6,12,13);
	$sqldlc="select * from gk_data where felh=\"$MA_USERNAME\" order by id desc;";
	#echo($sqldlc);
	sql_run($sqldlc);
	$dbr=count($MA_SQL_RESULT);
	for($i=0;$i<$dbr;$i++){
	    $r=$MA_SQL_RESULT[$i];
	    for($k=0;$k<$db;$k++){
	        if (in_array($k,$dat)){
	            $d=date("Y.m.d",strtotime($r[$k]));
	            $dload=$dload.$d.$GK_SEPARATOR;
	        }else{
	            $dload=$dload.$r[$k].$GK_SEPARATOR;
	        }
	    }
		$dload=$dload.PHP_EOL;
	}
	echo("<div class=frow>");
	echo("<div class=colx1></div>");
	echo("<div class=colx2>");
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("$GK_DOWNLOADTEXT");
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("<form method=post action=$MA_DOWNLOADFILE>");
	echo("<input type=hidden id=lcode name=lcode value=\"$lcode\">");
	echo("<input type=hidden id=f name=f value=\"$dload\">");
	echo("<input class='button' type=submit id=x name=x value=\"$GK_DOWNLOAD\">");
	echo("</form>");
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("<input class='button' type=submit id=x name=x value=\"$GK_BACK\" onclick=\"history.back();\">");
	echo("</div>");
	echo("<div class=colx1></div>");
	echo("</div>");
}


?>
