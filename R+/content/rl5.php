<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #



function r_minklt($title=""){
	global $MA_SQL_RESULT,$R_STR_TABLE_TITLE2,$R_SEARCH,$R_PAGEROW,$R_PAGE_LEFT,
			$R_PAGE_RIGHT,$R_GO,$R_LISTCODE,$R_DOWNLOADTEXT,$R_DOWNLOAD,$R_BACK,
			$R_DOWNLOAD_FILE,$R_STR_FIELDS,$R_STR_TABLE_TITLE;

	$r="0";
	if (isset($_POST['r'])){
		$rid=$_POST['r'];
		$rak="";
		if (sql_run("select * from r_raktar where id=$rid;")){
			$rn=$MA_SQL_RESULT[0];
			$rak=$rn[1];
		}
	}
	echo("<h3>$title: $rak</h3><br />");
	if (isset($_POST['download'])){
		echo("<div class=frow>");
		echo("<div class=colx1></div>");
		echo("<div class=colx2>");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("$R_DOWNLOADTEXT");
		$dload="";
		$db=count($R_STR_TABLE_TITLE);
		for($i=0;$i<$db;$i++){
			$dload=$dload.$R_STR_TABLE_TITLE[$i].";";
		}
		$dload=$dload.PHP_EOL;
		sql_run("select * from r_keszlet where rakt=$rid order by cikk;");
		$db=count($MA_SQL_RESULT);
		$data=$MA_SQL_RESULT;
		for($i=0;$i<$db;$i++){
			$r=$data[$i];
			$ck="";
			$cn="";
			$ce="";
			$cr="";
			$min=0;
			$sqlc="select * from r_cikk where id=$r[1];";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$cn=$d[3];
				$ck=$d[2];
				$ce=$d[5];
				$csz=$d[1];
				$min=$d[6];
			}
			if($r[6]<$min){
				$sqlc2="select * from r_kat where id=$ck;";
				if (($ck<>"")and(sql_run($sqlc2))){
					$d=$MA_SQL_RESULT[0];
					$ck=$d[2];
				}
				$dload=$dload.$ck.";";
				$dload=$dload.$csz.";";
				$dload=$dload.$cn.";";
				$dload=$dload.$r[3].";";
				$dload=$dload.$ce.";";
				$dload=$dload.$r[6].";";
				$dload=$dload.$r[5].";";
				$dload=$dload.$r[4].";";
				$dload=$dload.$r[7].";";
				$dload=$dload.PHP_EOL;
			}
		}
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("<form method=post action=$R_DOWNLOAD_FILE>");
		echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[5]\">");
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
		echo("<form method=post>");
		echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[5]\">");
		echo("<input type=hidden id=r name=r value=\"$rid\"> ");
		echo("<input type=submit id=download name=download value=\"$R_DOWNLOAD\">");
		echo("</form>");
		echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$R_SEARCH\">");
		sql_run("select * from r_keszlet where rakt=$rid order by cikk;");
		echo("<table class='df_table_full' id=ptable>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th0'>$R_STR_TABLE_TITLE[0]</th>");
		echo("<th class='df_th0'>$R_STR_TABLE_TITLE[1]</th>");
		echo("<th class='df_th0'>$R_STR_TABLE_TITLE[2]</th>");
		echo("<th class='df_th0'>$R_STR_TABLE_TITLE[3]</th>");
		echo("<th class='df_th0'>$R_STR_TABLE_TITLE[4]</th>");
		echo("<th class='df_th0'>$R_STR_TABLE_TITLE[5]</th>");
		echo("<th class='df_th0'>$R_STR_TABLE_TITLE[6]</th>");
		echo("<th class='df_th0'>$R_STR_TABLE_TITLE[7]</th>");
		echo("<th class='df_th0'>$R_STR_TABLE_TITLE[8]</th>");
		echo("</tr>");
		$db=count($MA_SQL_RESULT);
		$data=$MA_SQL_RESULT;
		for($i=0;$i<$db;$i++){
			$r=$data[$i];
			$ck="";
			$cn="";
			$ce="";
			$cr="";
			$min=0;
			$sqlc="select * from r_cikk where id=$r[1];";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$cn=$d[3];
				$ck=$d[2];
				$ce=$d[5];
				$csz=$d[1];
				$min=$d[6];
			}
			if($r[6]<$min){
				$sqlc2="select * from r_kat where id=$ck;";
				if (($ck<>"")and(sql_run($sqlc2))){
					$d=$MA_SQL_RESULT[0];
					$ck=$d[2];
				}
				echo("<tr class=df_tr>");
				echo("<td class='df_td'>$ck</td>");
				echo("<td class='df_td'>$csz</td>");
				echo("<td class='df_td'>$cn</td>");
				echo("<td class='df_td'>$r[3]</td>");
				echo("<td class='df_td'>$ce</td>");
				echo("<td class='df_td'>$r[6]</td>");
				echo("<td class='df_td'>$r[5]</td>");
				echo("<td class='df_td'>$r[4]</td>");
				echo("<td class='df_td'>$r[7]</td>");
				echo("</tr>");
			}
		}
		echo("</table>");
	}
}

?>
