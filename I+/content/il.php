<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #


function i_listtable($lcode=0,$sqlc="",$title=""){
	global $MA_SQL_RESULT,$I_LISTTABLE_TITLE,$I_FILESTORE,$I_DOWNLOAD,
			$I_SEPARATOR,$I_DOWNLOAD_FILE,$I_DOC_FIELDS,
			$I_PAGEROW,$I_PAGE_LEFT,$I_PAGE_RIGHT,$I_BACK;

	if ($sqlc<>""){
		echo("<h3>$title</h3>");
		if (isset($_POST['f'])){
			$dload="";
			$db=count($I_DOC_FIELDS);
			for($i=0;$i<$db;$i++){
				$dload=$dload.$I_DOC_FIELDS[$i].";";
			}
			$dload=$dload.PHP_EOL;
			$sqldlc="select * from ik_doc where $sqlc order by id desc;";
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
		}else{
			echo("<form method=post>");
			echo("<input type=hidden id=lcode name=lcode value=\"$lcode\">");
			echo("<input type=hidden id=f name=f value=\"f\">");
			echo("<input class='button' type=submit id=x name=x value=\"$I_DOWNLOAD\">");
			echo("</form>");
			if (isset($_POST['page'])){
					$page=(int)$_POST['page'];
					$first=$I_PAGEROW*$page;
			}else{
				$page=0;
				$first=0;
			}
			$last=false;
			if (sql_run("select count(*) from ik_doc where ".$sqlc.";")){
				$r=$MA_SQL_RESULT[0];
				$odb=$r[0];
				$adb=$first+$I_PAGEROW;
				if ($adb>=$odb){
					$last=true;
				}
			}
			echo("<center>");
			echo("<table class='df_table_full' id=ptable>");
			echo("<tr class='df_trh'>");
			echo("<th class='df_th'>$I_LISTTABLE_TITLE[0]</th>");
			echo("<th class='df_th'>$I_LISTTABLE_TITLE[1]</th>");
			echo("<th class='df_th'>$I_LISTTABLE_TITLE[2]</th>");
			echo("<th class='df_th'>$I_LISTTABLE_TITLE[3]</th>");
			echo("<th class='df_th'>$I_LISTTABLE_TITLE[4]</th>");
			echo("</tr>");
			$sqlc="select * from ik_doc where $sqlc order by id desc limit $first,$I_PAGEROW;";
			sql_run($sqlc);
			$dr=$MA_SQL_RESULT;
			$db=count($dr);
			for($i=0;$i<$db;$i++){
				$r=$dr[$i];
				echo("<tr class=df_tr>");
				$fn="$I_FILESTORE/$r[14]";
				echo("<td class='df_td'><a href=\"$fn\">$r[1]</a></td>");
				$sqlc="select * from ik_partner where id=$r[4];";
				if (sql_run($sqlc)){
					$pd=$MA_SQL_RESULT[0];
					$r[4]=$pd[1];
				}
				echo("<td class='df_td'>$r[4]</td>");
				$sqlc="select * from ik_cat;";
				sql_run($sqlc);
				$dbl=count($MA_SQL_RESULT);
				for($j=0;$j<$dbl;$j++){
					$cl=$MA_SQL_RESULT[$j];
					if ($r[7]==$cl[0]){
						$r[7]=$cl[2];
					}
				}
				echo("<td class='df_td'>$r[7]</td>");
				if ($r[9]<>""){
					$r[9]=strtotime($r[9]);
					$r[9]=date('Y. m. d.',$r[9]);
				}
				echo("<td class='df_td'>$r[9]</td>");
				if ($r[10]<>""){
					$r[10]=strtotime($r[10]);
					$r[10]=date('Y. m. d.',$r[10]);
				}
				echo("<td class='df_td'>$r[10]</td>");
				echo("</tr>");
			}
			echo("</table>");
			echo("<div class=spaceline></div>");
			echo("<div class=frow>");
			echo("<div class=pcol2>");
			if (($page>0)and($first>0)){
				echo("<form method=post>");
				$p=$page-1;
				echo("<input type=hidden id=page name=page value=$p>");
				echo("<input type=hidden id=lcode name=lcode value=\"$lcode\">");
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
				echo("<input type=hidden id=lcode name=lcode value=\"$lcode\">");
				echo("<input type=submit id=p name=p value=\"$I_PAGE_RIGHT\">");
				echo("</form>");
			}else{
				echo("<span style=\"color:transparent;\">?</span>");
			}
			echo("</div>");
			echo("</div>");
		}
	}
}


function i_list(){
	global$I_LISTS,$I_LISTCODE,$I_GO,$MA_SQL_RESULT,$I_SITE;

	$listall=true;
	if (isset($_POST['lcode'])){
		switch ($_POST['lcode']){
			case $I_LISTCODE[0]:
				$listall=false;
				$sqlc="fiz = \"\"";
				i_listtable($I_LISTCODE[0],$sqlc,$I_LISTS[0]);
				break;
			case $I_LISTCODE[1]:
				$listall=false;
				if (isset($_POST['id'])){
					$id=$_POST['id'];
					$sqlc="partner = $id";
					i_listtable($I_LISTCODE[1],$sqlc,$I_LISTS[1]);
				}
				break;
			case $I_LISTCODE[2]:
				$listall=false;
				if (isset($_POST['id'])){
					$id=$_POST['id'];
					$sqlc="kat = $id";
					i_listtable($I_LISTCODE[2],$sqlc,$I_LISTS[2]);
				}
				break;
			case $I_LISTCODE[3]:
				$listall=false;
				if (isset($_POST['id'])){
					$id=$_POST['id'];
					$sqlc="telep = \"$id\"";
					i_listtable($I_LISTCODE[3],$sqlc,$I_LISTS[3]);
				}
				break;
			default:
				$listall=true;
				break;
		}
	}
	if ($listall){
		$db=count($I_LISTS);
		echo("<div class=frow>");
		echo("<div class=colx1></div>");
		echo("<div class=colx2>");
		echo("<div class=spaceline></div>");
		echo("<h3>$I_LISTS[0]</h3>");
		echo("<form id=$i name=$i method=post>");
		echo("<input type=hidden id=lcode name=lcode value=\"$I_LISTCODE[0]\">");
		echo("<input type=submit id=x name=x value=\"$I_GO\">");
		echo("</form>");
		echo("<div class=spaceline></div>");
		echo("<h3>$I_LISTS[1]</h3>");
		echo("<form id=$i name=$i method=post>");
		$sqlc="select * from ik_partner;";
		if (sql_run($sqlc)){
			echo("<select id=id name=id>");
			$db=count($MA_SQL_RESULT);
			for($j=0;$j<$db;$j++){
				$r=$MA_SQL_RESULT[$j];
				echo("<option value=\"$r[0]\">$r[1]</option>");
			}
			echo("</select>");
		}
		echo("<input type=hidden id=lcode name=lcode value=\"$I_LISTCODE[1]\">");
		echo("<input type=submit id=x name=x value=\"$I_GO\">");
		echo("</form>");
		echo("<div class=spaceline></div>");
		echo("<h3>$I_LISTS[2]</h3>");
		echo("<form id=$i name=$i method=post>");
		$sqlc="select * from ik_cat;";
		if (sql_run($sqlc)){
			echo("<select id=id name=id>");
			$db=count($MA_SQL_RESULT);
			for($j=0;$j<$db;$j++){
				$r=$MA_SQL_RESULT[$j];
				echo("<option value=\"$r[0]\">$r[2]</option>");
			}
			echo("</select>");
		}
		echo("<input type=hidden id=lcode name=lcode value=\"$I_LISTCODE[2]\">");
		echo("<input type=submit id=x name=x value=\"$I_GO\">");
		echo("</form>");
		echo("<div class=spaceline></div>");
		echo("<h3>$I_LISTS[3]</h3>");
		echo("<form id=$i name=$i method=post>");
		echo("<select id=id name=id>");
		$db=count($I_SITE);
		for($j=0;$j<$db;$j++){
			echo("<option value=\"$I_SITE[$j]\">$I_SITE[$j]</option>");
		}
		echo("</select>");
		echo("<input type=hidden id=lcode name=lcode value=\"$I_LISTCODE[3]\">");
		echo("<input type=submit id=x name=x value=\"$I_GO\">");
		echo("</form>");;
		echo("<div class=spaceline></div>");
		echo("</div>");
		echo("<div class=colx1></div>");
		echo("</div>");
	}
}


?>
