<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #



function r_outklt($title=""){
	global $MA_SQL_RESULT,$R_OUT_TABLE_TITLE_MOUNTH,$R_SEARCH,$R_PAGEROW,$R_PAGE_LEFT,
			$R_PAGE_RIGHT,$R_GO,$R_LISTCODE,$R_DOWNLOADTEXT,$R_DOWNLOAD,$R_BACK,
			$R_DOWNLOAD_FILE,$R_OUT_FIELDS,$R_OUT_FIELDS2;

	$d="";
	$d2="";
	if (isset($_POST['date'])){
		$d2=$_POST['date'];
		$d=str_replace("-",".",$d2);
		$d=substr($d,0,7);
	}
	if (isset($_POST['klt'])){
		$klt=$_POST['klt'];
		$sqlc="select * from r_kolt where id=$klt;";
		if (sql_run($sqlc)){
			$da=$MA_SQL_RESULT[0];
			$kltn=$da[1];
		}
	}
	if ($d===""){
		$d=date('Y.m');
	}
	echo("<h3>$title - $d - $kltn</h3><br />");
	if (isset($_POST['download'])){
		echo("<div class=frow>");
		echo("<div class=colx1></div>");
		echo("<div class=colx2>");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("$R_DOWNLOADTEXT");
		$w="";
		if ($d<>""){
			$w="where dat between \"$d.01\" and \"$d.31\"";
			if ($klt<>""){
				$w=$w." and klt=\"$klt\"";
			}
		}
		$dload="";
		$db=count($R_OUT_TABLE_TITLE_MOUNTH);
		for($i=0;$i<$db;$i++){
			$dload=$dload.$R_OUT_TABLE_TITLE_MOUNTH[$i].";";
		}
		$dload=$dload.PHP_EOL;
		sql_run("select * from r_kiad $w order by id desc;");
		$data=$MA_SQL_RESULT;
		$db=count($data);
		for($i=0;$i<$db;$i++){
			$r=$data[$i];
			$sqlc="select * from r_keszlet where cikk=$r[2] and rakt=$r[7];";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$ear=$d[6];
			}
			$sqlc="select * from r_cikk where id=$r[2];";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$r[2]=$d[3];
			}
			$sqlc="select * from r_raktar where id=$r[7];";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$r[7]=$d[1];
			}
			$sqlc="select * from r_kolt where id=$r[5];";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$r[5]=$d[1];
			}
			$dload=$dload.$r[1].";";
			$dload=$dload.$r[2].";";
			$dload=$dload.$ear.";";
			$dload=$dload.$r[3].";";
			$dload=$dload.$r[4].";";
			$dload=$dload.$r[5].";";
			$dload=$dload.$r[6].";";
			$dload=$dload.$r[7].";";
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
	}else{
		$page=0;
		$first=0;
		if (isset($_POST['page'])){
			$page=(int)$_POST['page'];
			$first=$R_PAGEROW*$page;
		}else{
			}
		$last=false;
		if (sql_run("select count(*) from r_kiad;")){
			$r=$MA_SQL_RESULT[0];
			$odb=$r[0];
			$adb=$first+$R_PAGEROW;
			if ($adb>=$odb){
				$last=true;
			}
		}
		echo("<form method=post>");
		echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[4]\">");
		echo("<input type=hidden id=date name=date value=\"$d2\"> ");
		echo("<input type=hidden id=klt name=klt value=\"$klt\"> ");
		echo("<input type=submit id=download name=download value=\"$R_DOWNLOAD\">");
		echo("</form>");
		echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$R_SEARCH\">");
		$w="";
		if ($d<>""){
			$w="where dat between \"$d.01\" and \"$d.31\"";
			if ($klt<>""){
				$w=$w." and klt=\"$klt\"";
			}
		}
		sql_run("select * from r_kiad $w order by id desc limit $first,$R_PAGEROW;");
		$dat=$MA_SQL_RESULT;
		echo("<center>");
		echo("<table class='df_table_full' id=ptable>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th'>$R_OUT_TABLE_TITLE_MOUNTH[0]</th>");
		echo("<th class='df_th'>$R_OUT_TABLE_TITLE_MOUNTH[1]</th>");
		echo("<th class='df_th'>$R_OUT_TABLE_TITLE_MOUNTH[2]</th>");
		echo("<th class='df_th'>$R_OUT_TABLE_TITLE_MOUNTH[3]</th>");
		echo("<th class='df_th'>$R_OUT_TABLE_TITLE_MOUNTH[4]</th>");
		echo("<th class='df_th'>$R_OUT_TABLE_TITLE_MOUNTH[5]</th>");
		echo("<th class='df_th'>$R_OUT_TABLE_TITLE_MOUNTH[6]</th>");
		echo("<th class='df_th'>$R_OUT_TABLE_TITLE_MOUNTH[7]</th>");
		echo("</tr>");
		$db=count($dat);
		for($i=0;$i<$db;$i++){
			$r=$dat[$i];
			$sqlc="select * from r_keszlet where cikk=$r[2] and rakt=$r[7];";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$ear=$d[6];
			}
			$sqlc="select * from r_cikk where id=$r[2];";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$r[2]=$d[3];
			}
			$sqlc="select * from r_raktar where id=$r[7];";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$r[7]=$d[1];
			}
			$sqlc="select * from r_kolt where id=$r[5];";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$r[5]=$d[1];
			}
			echo("<tr class=df_tr>");
			echo("<td class='df_td'>$r[1]</td>");
			echo("<td class='df_td'>$r[2]</td>");
			echo("<td class='df_td'>$ear</td>");
			echo("<td class='df_td'>$r[3]</td>");
			echo("<td class='df_td'>$r[4]</td>");
			echo("<td class='df_td'>$r[5]</td>");
			echo("<td class='df_td'>$r[6]</td>");
			echo("<td class='df_td'>$r[7]</td>");
			echo("</tr>");
		}
		echo("</table>");
		echo("<div class=frow>");
		echo("<div class=pcol2>");
		if (($page>0)and($first>0)){
			echo("<form method=post>");
			$p=$page-1;
			echo("<input type=hidden id=page name=page value=\"$p\">");
			echo("<input type=hidden id=date name=date value=\"$d2\"> ");
			echo("<input type=hidden id=klt name=klt value=\"$klt\"> ");
			echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[4]\">");
			echo("<input type=submit id=p name=p value=\"$R_PAGE_LEFT\">");
			echo("</form>");
		}else{
			echo("<span style=\"color:transparent;\">?</span>");
		}
		echo("</div>");
		echo("<div class=pcol1>");
		echo("<div style=\"width:90%;float:middle;\">");
		echo("<span style=\"color:transparent;\">?</span>");
		echo("</div>");
		echo("</div>");
		echo("<div class=pcol2>");
		if (($db==$I_PAGEROW)and(!$last)){
			$p=$page+1;
			echo("<form method=post>");
			echo("<input type=hidden id=page name=page value=\"$p\">");
			echo("<input type=hidden id=date name=date value=\"$d2\"> ");
			echo("<input type=hidden id=klt name=klt value=\"$klt\"> ");
			echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[4]\">");
			echo("<input type=submit id=p name=p value=\"$R_PAGE_RIGHT\">");
			echo("</form>");
		}else{
			echo("<span style=\"color:transparent;\">?</span>");
		}
		echo("</div>");
		echo("</div>");
	}
}

?>
