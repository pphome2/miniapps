<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #



function r_table(){
	global $MA_SQL_RESULT,$R_STR_TABLE_TITLE,$R_STR_TITLE,$R_GO,
			$R_SEARCH,$R_PAGEROW,$R_PAGE_LEFT,$R_PAGE_RIGHT;

		if (isset($_POST['storename'])){
			$store=r_storeage($_POST['storename']);
		}else{
			$store=r_storeage();
		}
		if(sql_run("select * from r_raktar where id=$store;")){
			$rd=$MA_SQL_RESULT[0];
			$storen=$rd[1];
		}else{
			$storen="";
		}
		$page=0;
		$first=0;
		if (isset($_POST['page'])){
			$page=(int)$_POST['page'];
			$first=$R_PAGEROW*$page;
		}
		$last=false;
		if (sql_run("select count(*) from r_keszlet where rakt like \"%$store%\";")){
			$r=$MA_SQL_RESULT[0];
			$odb=$r[0];
			$adb=$first+$R_PAGEROW;
			if ($adb>=$odb){
				$last=true;
			}
		}
		echo("<form method=post>");
		echo("<input type=hidden id=page name=page value=$page>");
		echo("<div class=frow>");
		echo("<div class=pcol2>");
		echo("<h3>$R_STR_TITLE: $storen</h3>");
		echo("</div>");
		echo("<div class=pcol1>");
		echo("<select style=\"width:20%;margin-right:20px;float:right;\" id=storename name=storename>");
		$sqlc="select * from r_raktar";
		sql_run($sqlc);
		$rdb=count($MA_SQL_RESULT);
		for($y=0;$y<$rdb;$y++){
			$rd=$MA_SQL_RESULT[$y];
			echo("<option value=$rd[0]>$rd[1]</option>");
		}
		echo("</select>");
		echo("</div>");
		echo("<div class=pcol2>");
		echo("<input type=submit id=storego name=storego value=\"$R_GO\">");
		echo("</div>");
		echo("</div>");
		echo("</form>");
		echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$R_SEARCH\">");
		sql_run("select * from r_keszlet where rakt like \"%$store%\" order by cikk desc limit $first,$R_PAGEROW;");
		echo("<center>");
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
		echo("<th class='df_th'>$R_STR_TABLE_TITLE[8]</th>");
		echo("</tr>");
		$db=count($MA_SQL_RESULT);
		$data=$MA_SQL_RESULT;
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
