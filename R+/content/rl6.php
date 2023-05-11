<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #



function r_lelist($title=""){
	global $MA_SQL_RESULT,$R_LELLIST_TABLE_TITLE,$R_SEARCH,$R_PAGEROW,$R_PAGE_LEFT,
			$R_PAGE_RIGHT,$R_GO,$R_LISTCODE,$R_DOWNLOADTEXT,$R_DOWNLOAD,$R_BACK,
			$R_DOWNLOAD_FILE;
	$r="0";
	if (isset($_POST['r'])){
		$rid=$_POST['r'];
		$rak="";
		if (sql_run("select * from r_raktar where id=$rid;")){
			$rn=$MA_SQL_RESULT[0];
			$rak=$rn[1];
		}
	}
	$dat1=0;
	if(isset($_POST['dat1'])){
		$dat1=str_replace("-",".",$_POST['dat1']);
	}
	$dat2=0;
	if(isset($_POST['dat2'])){
		$dat2=str_replace("-",".",$_POST['dat2']);
	}
	echo("<h3>$title: $rak ( $dat1 - $dat2 )</h3><br />");
	if (isset($_POST['download'])){
		echo("<div class=frow>");
		echo("<div class=colx1></div>");
		echo("<div class=colx2>");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("$R_DOWNLOADTEXT");
		$dload="";
		$db=count($R_LELLIST_TABLE_TITLE);
		for($i=0;$i<$db;$i++){
			$dload=$dload.$R_LELLIST_TABLE_TITLE[$i].";";
		}
		$dload=$dload.PHP_EOL;
		sql_run("select * from r_lel where rakt=$rid and dat between \"$dat1\" and \"$dat2\" order by cikk;");
		$db=count($MA_SQL_RESULT);
		$data=$MA_SQL_RESULT;
		for($i=0;$i<$db;$i++){
			$r=$data[$i];
			$ck="";
			$cn="";
			$ce="";
			$cr="";
			$min=0;
			$sqlc="select * from r_cikk where id=$r[3];";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$cn=$d[3];
				$ck=$d[2];
				$ce=$d[5];
				$csz=$d[1];
				$min=$d[6];
			}
			$sqlc="select * from r_kat where id=$ck;";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$ck=$d[2];
			}
			$dload=$dload.$r[1].";";
			$dload=$dload.$ck.";";
			$dload=$dload.$csz.";";
			$dload=$dload.$cn.";";
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
		echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[6]\">");
		echo("<input type=hidden id=r name=r value=\"$rid\"> ");
		echo("<input type=hidden id=dat1 name=dat1 value=\"$dat1\"> ");
		echo("<input type=hidden id=dat2 name=dat2 value=\"$dat2\"> ");
		echo("<input type=submit id=download name=download value=\"$R_DOWNLOAD\">");
		echo("</form>");
		echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$R_SEARCH\">");
		sql_run("select * from r_lel where rakt=$rid and dat between \"$dat1\" and \"$dat2\" order by cikk limit $first,$R_PAGEROW;");
		$db=count($MA_SQL_RESULT);
		echo("<table class='df_table_full' id=ptable>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th0'>$R_LELLIST_TABLE_TITLE[0]</th>");
		echo("<th class='df_th0'>$R_LELLIST_TABLE_TITLE[1]</th>");
		echo("<th class='df_th0'>$R_LELLIST_TABLE_TITLE[2]</th>");
		echo("<th class='df_th0'>$R_LELLIST_TABLE_TITLE[3]</th>");
		echo("<th class='df_th0'>$R_LELLIST_TABLE_TITLE[4]</th>");
		echo("<th class='df_th0'>$R_LELLIST_TABLE_TITLE[5]</th>");
		echo("</tr>");
		$data=$MA_SQL_RESULT;
		for($i=0;$i<$db;$i++){
			$r=$data[$i];
			$ck="";
			$cn="";
			$ce="";
			$cr="";
			$min=0;
			$sqlc="select * from r_cikk where id=$r[3];";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$cn=$d[3];
				$ck=$d[2];
				$ce=$d[5];
				$csz=$d[1];
				$min=$d[6];
			}
			$sqlc="select * from r_kat where id=$ck;";
			if (sql_run($sqlc)){
				$d=$MA_SQL_RESULT[0];
				$ck=$d[2];
			}
			echo("<tr class=df_tr>");
			echo("<td class='df_td'>$r[1]</td>");
			echo("<td class='df_td'>$ck</td>");
			echo("<td class='df_td'>$csz</td>");
			echo("<td class='df_td'>$cn</td>");
			echo("<td class='df_td'>$r[4]</td>");
			echo("<td class='df_td'>$r[5]</td>");
			echo("</tr>");
		}
		echo("</table>");
		echo("<div class=frow>");
		echo("<div class=pcol2>");
		if (($page>0)and($first>0)){
			echo("<form method=post>");
			$p=$page-1;
			echo("<input type=hidden id=page name=page value=\"$p\">");
			echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[6]\">");
			echo("<input type=hidden id=r name=r value=\"$rid\"> ");
			echo("<input type=hidden id=dat1 name=dat1 value=\"$dat1\"> ");
			echo("<input type=hidden id=dat2 name=dat2 value=\"$dat2\"> ");
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
		if (($db==$R_PAGEROW)and(!$last)){
			$p=$page+1;
			echo("<form method=post>");
			echo("<input type=hidden id=page name=page value=\"$p\">");
			echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[6]\">");
			echo("<input type=hidden id=r name=r value=\"$rid\"> ");
			echo("<input type=hidden id=dat1 name=dat1 value=\"$dat1\"> ");
			echo("<input type=hidden id=dat2 name=dat2 value=\"$dat2\"> ");
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
