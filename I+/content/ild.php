<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #


function i_exporttable($sqlc="",$lcode=""){
	global $MA_SQL_RESULT,$I_DOWNLOAD,$I_SEPARATOR,$I_DOWNLOAD_FILE,$I_DOC_FIELDS,$I_DOWNLOADTEXT,$I_BACK;

	$year=i_year();
	$dload="";
	$db=count($I_DOC_FIELDS);
	for($i=0;$i<$db;$i++){
		$dload=$dload.$I_DOC_FIELDS[$i].";";
	}
	$dload=$dload.PHP_EOL;
	$ex=array(4,7);
	$date=array(2,8,9,10);
	$sqldlc="select * from ik_doc where $sqlc and id like \"%$year%\" order by id desc;";
	#echo($sqldlc);
	sql_run($sqldlc);
	$dat=$MA_SQL_RESULT;
	$db=count($dat);
	for($i=0;$i<$db;$i++){
		$r=$dat[$i];
		$xdb=count($r);
		for($j=0;$j<$xdb;$j++){
			$out="";
			if (in_array($j,$ex)){
				if ($j===$ex[0]){
					if (sql_run("select * from ik_partner where id=$r[$j];")){
						$rw=$MA_SQL_RESULT[0];
						$out=$rw[1];
					}
				}
				if ($j===$ex[1]){
					if (sql_run("select * from ik_cat where id=$r[$j];")){
						$rw=$MA_SQL_RESULT[0];
						$out=$rw[2];
					}
				}
			}else{
				$out=$r[$j];
			}
			if (in_array($j,$date)){
				$out=str_replace("-",".",$out);
			}
			$dload=$dload.$out.";";
		}
		$dload=$dload.PHP_EOL;
	}
	#echo("<h3>$year</h3>");
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
}


function i_listtable($lcode=0,$sqlc="",$title=""){
	global $MA_SQL_RESULT,$I_LISTTABLE_TITLE,$I_FILESTORE,$I_DOWNLOAD,
			$I_SEPARATOR,$I_PAGEROW,$I_PAGE_LEFT,$I_PAGE_RIGHT,$I_BACK;

	$year=i_year();
	if ($sqlc<>""){
		echo("<h3>$title - $year</h3>");
		if (isset($_POST['f'])){
			i_exporttable($sqlc,$lcode);
		}else{
			if (isset($_POST['id'])){
				$id=$_POST['id'];
			}else{
				$id="";
			}
			echo("<form method=post>");
			echo("<input type=hidden id=lcode name=lcode value=\"$lcode\">");
			echo("<input type=hidden id=f name=f value=\"f\">");
			echo("<input type=hidden id=id name=id value=\"$id\">");
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
			if (sql_run("select count(*) from ik_doc where $sqlc and id like \"%$year%\";")){
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
			echo("<th class='df_th0'>$I_LISTTABLE_TITLE[0]</th>");
			echo("<th class='df_th0'>$I_LISTTABLE_TITLE[1]</th>");
			echo("<th class='df_th'>$I_LISTTABLE_TITLE[2]</th>");
			echo("<th class='df_th0'>$I_LISTTABLE_TITLE[3]</th>");
			echo("<th class='df_th0'>$I_LISTTABLE_TITLE[4]</th>");
			echo("<th class='df_th0'>$I_LISTTABLE_TITLE[5]</th>");
			echo("<th class='df_th0'>$I_LISTTABLE_TITLE[6]</th>");
			echo("</tr>");
			$sqlc="select * from ik_doc where $sqlc and id like \"%$year%\" order by id desc limit $first,$I_PAGEROW;";
			sql_run($sqlc);
			$dr=$MA_SQL_RESULT;
			$db=count($dr);
			for($i=0;$i<$db;$i++){
				$r=$dr[$i];
				echo("<tr class=df_tr>");
				$fn="$I_FILESTORE/$r[15]";
				echo("<td class='df_td'><a href=\"$fn\">$r[1]</a></td>");
				echo("<td class='df_td'>$r[3]</td>");
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
				if ($r[11]<>""){
					$r[11]=strtotime($r[11]);
					$r[11]=date('Y. m. d.',$r[11]);
				}
				echo("<td class='df_td'>$r[11]</td>");
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




?>
