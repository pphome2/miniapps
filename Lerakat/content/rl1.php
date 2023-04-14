<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #



function r_store($title=""){
	global $MA_SQL_RESULT,$R_STR_TABLE_TITLE2,$R_SEARCH,$R_PAGEROW,$R_PAGE_LEFT,
			$R_PAGE_RIGHT,$R_GO,$R_LISTCODE,$R_DOWNLOADTEXT,$R_DOWNLOAD,$R_BACK,
			$R_DOWNLOAD_FILE,$R_STR_FIELDS;

	echo("<h3>$title</h3><br />");
	$r="0";
	if (isset($_POST['r'])){
		$r=$_POST['r'];
	}
	echo("<div class=frow>");
	echo("<div class=colx1></div>");
	echo("<div class=colx2>");
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("$R_DOWNLOADTEXT");
	$dload="";
	$db=count($R_STR_TABLE_TITLE2);
	for($i=0;$i<$db;$i++){
		$dload=$dload.$R_STR_TABLE_TITLE2[$i].";";
	}
	$dload=$dload.PHP_EOL;
	sql_run("select * from r_keszlet where rakt=$r order by id desc;");
	$data=$MA_SQL_RESULT;
	$db=count($data);
	for($i=0;$i<$db;$i++){
		$r=$data[$i];
		$ck="";
		$cn="";
		$ce="";
		$cr="";
		$sqlc="select * from r_cikk where id=$r[1];";
		if (sql_run($sqlc)){
			$d=$MA_SQL_RESULT[0];
			$cn=$d[3];
			$ck=$d[2];
			$ce=$d[5];
			$csz=$d[1];
		}
		$sqlc="select * from r_kat where id=$ck;";
		if (($ck<>"")and(sql_run($sqlc))){
			$d=$MA_SQL_RESULT[0];
			$ck=$d[2];
		}
		$sqlc="select * from r_raktar where id=$r[2];";
		if (($r[2]<>"")and(sql_run($sqlc))){
			$d=$MA_SQL_RESULT[0];
			$cr=$d[1];
		}
		$dload=$dload.$cr.";";
		$dload=$dload.$ck.";";
		$dload=$dload.$csz.";";
		$dload=$dload.$cn.";";
		$dload=$dload.$r[3].";";
		$dload=$dload.$ce.";";
		$dload=$dload.$r[6].";";
		$oe=intval($r[6])*intval($r[3]);
		$dload=$dload.$oe.";";
		$dload=$dload.$r[5].";";
		$dload=$dload.$r[4].";";
		$dload=$dload.PHP_EOL;
	}
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("<form method=post action=$R_DOWNLOAD_FILE>");
	echo("<input type=hidden id=lcode name=lcode value=\"$lcode\">");
	echo("<input type=hidden id=f name=f value=\"$dload\">");
	echo("<input class='button' type=submit id=x name=x value=\"$R_DOWNLOAD\">");
	echo("</form>");
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("<input class='button' type=submit id=x name=x value=\"$R_BACK\" onclick=\"history.back();\">");
	echo("</div>");
	echo("<div class=colx1></div>");
	echo("</div>");
}


?>
