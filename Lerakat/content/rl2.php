<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #



function r_listbev($title=""){
	global $MA_SQL_RESULT,$R_IN_TABLE_TITLE,$R_SEARCH,$R_PAGEROW,$R_PAGE_LEFT,$R_PAGE_RIGHT;

	echo("<h3>$title</h3><br />");
	if (isset($_POST['page'])){
		$page=(int)$_POST['page'];
		$first=$R_PAGEROW*$page;
	}else{
		$page=0;
		$first=0;
	}
	$last=false;
	if (sql_run("select count(*) from r_bev;")){
		$r=$MA_SQL_RESULT[0];
		$odb=$r[0];
		$adb=$first+$R_PAGEROW;
		if ($adb>=$odb){
			$last=true;
		}
	}
	echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$R_SEARCH\">");
	sql_run("select * from r_bev order by id desc limit $first,$R_PAGEROW;");
	$dat=$MA_SQL_RESULT;
	echo("<center>");
	echo("<table class='df_table_full' id=ptable>");
	echo("<tr class='df_trh'>");
	echo("<th class='df_th'>$R_IN_TABLE_TITLE[0]</th>");
	echo("<th class='df_th'>$R_IN_TABLE_TITLE[1]</th>");
	echo("<th class='df_th'>$R_IN_TABLE_TITLE[2]</th>");
	echo("<th class='df_th'>$R_IN_TABLE_TITLE[3]</th>");
	echo("<th class='df_th'>$R_IN_TABLE_TITLE[4]</th>");
	echo("<th class='df_th'>$R_IN_TABLE_TITLE[5]</th>");
	echo("<th class='df_th'>$R_IN_TABLE_TITLE[6]</th>");
	echo("<th class='df_th'>$R_IN_TABLE_TITLE[7]</th>");
	echo("</tr>");
	$db=count($dat);
	for($i=0;$i<$db;$i++){
		$r=$dat[$i];
		$sqlc="select * from r_partner where id=$r[2];";
		if (sql_run($sqlc)){
			$d=$MA_SQL_RESULT[0];
			$r[2]=$d[1];
		}
		$sqlc="select * from r_cikk where id=$r[3];";
		if (sql_run($sqlc)){
			$d=$MA_SQL_RESULT[0];
			$r[3]=$d[3];
		}
		echo("<tr class=df_tr>");
		echo("<td class='df_td'>$r[1]</td>");
		echo("<td class='df_td'>$r[2]</td>");
		echo("<td class='df_td'>$r[3]</td>");
		echo("<td class='df_td'>$r[4]</td>");
		echo("<td class='df_td'>$r[5]</td>");
		echo("<td class='df_td'>$r[6]</td>");
		echo("<td class='df_td'>$r[7]</td>");
		echo("<td class='df_td'>$r[9]</td>");
		echo("</tr>");
	}
	echo("</table>");
	echo("<div class=frow>");
	echo("<div class=pcol2>");
	if (($page>0)and($first>0)){
		echo("<form method=post>");
		$p=$page-1;
		echo("<input type=hidden id=page name=page value=$p>");
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
		echo("<input type=hidden id=page name=page value=$p>");
		echo("<input type=submit id=p name=p value=\"$R_PAGE_RIGHT\">");
		echo("</form>");
	}else{
		echo("<span style=\"color:transparent;\">?</span>");
	}
	echo("</div>");
	echo("</div>");
}


?>
