<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #




function i_lpartner(){
	global $MA_SQL_RESULT,$I_NEWPARTNER,$I_PTABLE_TITLE,$I_DOWNLOAD,$I_DOWNLOADTEXT,$I_BACK,
			$I_WORKPARTNER,$I_SEARCH,$I_PAGEROW,$I_PAGE_LEFT,$I_PAGE_RIGHT,$I_PARTNER_FIELDS,
			$I_DOWNLOAD_FILE;

	if (isset($_POST['f'])){
		$dload="";
		$db=count($I_PARTNER_FIELDS);
		for($i=0;$i<$db;$i++){
			$dload=$dload.$I_PARTNER_FIELDS[$i].";";
		}
		$dload=$dload.PHP_EOL;
		$sqldlc="select * from ik_partner order by id desc;";
		sql_run($sqldlc);
		$db=count($MA_SQL_RESULT);
		for($i=0;$i<$db;$i++){
			$r=$MA_SQL_RESULT[$i];
			$xdb=count($r);
			for($j=0;$j<$xdb;$j++){
				$dload=$dload.$r[$j].";";
			}
			$dload=$dload.PHP_EOL;
		}
		echo("<div class=frow>");
		echo("<div class=colx1></div>");
		echo("<div class=colx2>");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("$I_DOWNLOADTEXT");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("<form method=post action=$I_DOWNLOAD_FILE>");
		echo("<input type=hidden id=lcode name=lcode value=\"$lcode\">");
		echo("<input type=hidden id=f name=f value=\"$dload\">");
		echo("<input class='button' type=submit id=x name=x value=\"$I_DOWNLOAD\">");
		echo("</form>");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("<input class='button' type=submit id=x name=x value=\"$I_BACK\" onclick=\"history.back();\">");
		echo("</div>");
		echo("<div class=colx1></div>");
		echo("</div>");
    }else{
		if (isset($_POST['page'])){
			$page=(int)$_POST['page'];
			$first=$I_PAGEROW*$page;
		}else{
			$page=0;
			$first=0;
		}
		$last=false;
		if (sql_run("select count(*) from ik_partner;")){
			$r=$MA_SQL_RESULT[0];
			$odb=$r[0];
			$adb=$first+$I_PAGEROW;
			if ($adb>=$odb){
				$last=true;
			}
		}
		echo("<form method=post>");
		echo("<input type=hidden id=lcode name=lcode value=\"$lcode\">");
		echo("<input type=hidden id=f name=f value=\"f\">");
		echo("<input class='button' type=submit id=x name=x value=\"$I_DOWNLOAD\">");
		echo("</form>");
		echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$I_SEARCH\">");
		sql_run("select * from ik_partner order by nev desc limit $first,$I_PAGEROW;");
		echo("<center>");
		echo("<table class='df_table_full' id=ptable>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th'>$I_PTABLE_TITLE[0]</th>");
		echo("<th class='df_th'>$I_PTABLE_TITLE[1]</th>");
		echo("<th class='df_th'>$I_PTABLE_TITLE[2]</th>");
		echo("<th class='df_th0'>$I_PTABLE_TITLE[3]</th>");
		echo("<th class='df_th0'>$I_PTABLE_TITLE[4]</th>");
		echo("</tr>");
		$db=count($MA_SQL_RESULT);
		for($i=0;$i<$db;$i++){
			$r=$MA_SQL_RESULT[$i];
			echo("<tr class=df_tr>");
			echo("<td class='df_td'>$r[1]</td>");
			echo("<td class='df_td'>$r[4]</td>");
			echo("<td class='df_td'>$r[7]</td>");
			echo("<td class='df_td'>$r[8]</td>");
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
			echo("<input type=submit id=p name=p value=\"$I_PAGE_LEFT\">");
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
			echo("<input type=submit id=p name=p value=\"$I_PAGE_RIGHT\">");
			echo("</form>");
		}else{
			echo("<span style=\"color:transparent;\">?</span>");
		}
		echo("</div>");
		echo("</div>");
	}
}




?>
