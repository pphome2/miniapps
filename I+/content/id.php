<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #



function i_doctable(){
	global $MA_SQL_RESULT,$I_NEWDOC,$I_DOCTABLE_TITLE,$I_PAGEROW,$I_FIRSTYEAR,$I_DB,
			$I_WORKDOC,$I_SEARCH,$I_FILESTORE,$I_PAGE_RIGHT,$I_PAGE_LEFT,$I_FIRSTYEAR;

	$ptable=true;
	if (isset($_POST['newdoc'])){
		$ptable=false;
		i_docdata(true);
	}
	if (isset($_POST['newd'])){
		$ptable=false;
		i_docdata(true);
	}
	if (isset($_POST['deld'])){
		i_docdel();
	}
	if (isset($_POST['chd'])){
		$ptable=false;
		i_docdata(false);
	}
	if ($ptable){
		if (isset($_POST['year'])){
			$year=$_POST['year'];
		}else{
			$year=0;
		}
		$year=i_year($year);
		if (isset($_POST['page'])){
			$page=(int)$_POST['page'];
			$first=$I_PAGEROW*$page;
		}else{
			$page=0;
			$first=0;
		}
		$last=false;
		if (sql_run("select count(*) from ik_doc where id like \"%$year%\";")){
			$r=$MA_SQL_RESULT[0];
			$odb=$r[0];
			$adb=$first+$I_PAGEROW;
			if ($adb>=$odb){
				$last=true;
			}
		}
		echo("<form method=post>");
		echo("<input type=hidden id=page name=page value=$page>");
		echo("<div class=frow>");
		echo("<div class=pcol2>");
		echo("<h3>$year ( $odb $I_DB )</h3>");
		echo("</div>");
		echo("<div class=pcol1>");
		echo("<select style=\"width:20%;margin-right:20px;float:right;\" id=year name=year>");
		for($y=date('Y');$y>=$I_FIRSTYEAR;$y--){
			echo("<option value=\"$y\">$y</option>");
		}
		echo("</select>");
		echo("</div>");
		echo("<div class=pcol2>");
		echo("<input type=submit id=yeargo name=yeargo value=\"$I_WORKDOC\">");
		echo("</div>");
		echo("</div>");
		echo("</form>");
		echo("<div class=frow>");
		echo("<div class=pcol2>");
		if (($page>0)and($first>0)){
			echo("<form method=post>");
			$p=$page-1;
			echo("<input type=hidden id=page name=page value=\"$p\">");
			echo("<input type=hidden id=year name=year value=\"$year\">");
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
		if ((!$last)){
			$p=$page+1;
			echo("<form method=post>");
			echo("<input type=hidden id=page name=page value=\"$p\">");
			echo("<input type=hidden id=year name=year value=\"$year\">");
			echo("<input type=submit id=p name=p value=\"$I_PAGE_RIGHT\">");
			echo("</form>");
		}else{
			echo("<span style=\"color:transparent;\">?</span>");
		}
		echo("</div>");;
		echo("</div>");
		echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$I_SEARCH\">");
		echo("<center>");
		echo("<table class='df_table_full' id=ptable>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th0'>$I_DOCTABLE_TITLE[0]</th>");
		echo("<th class='df_th0'>$I_DOCTABLE_TITLE[1]</th>");
		echo("<th class='df_th1'>$I_DOCTABLE_TITLE[2]</th>");
		echo("<th class='df_th0'>$I_DOCTABLE_TITLE[3]</th>");
		echo("<th class='df_th0'>$I_DOCTABLE_TITLE[4]</th>");
		echo("<th class='df_th0'>$I_DOCTABLE_TITLE[5]</th>");
		echo("<th class='df_th0'>$I_DOCTABLE_TITLE[6]</th>");
		echo("<th class='df_th0'>$I_DOCTABLE_TITLE[7]</th>");
		echo("</tr>");
		sql_run("select * from ik_doc where id like \"%$year%\" order by sorsz desc limit $first,$I_PAGEROW;");
		$dr=$MA_SQL_RESULT;
		$db=count($dr);
		for($i=0;$i<$db;$i++){
			$r=$dr[$i];
			echo("<tr class=df_tr>");
			$fn="$I_FILESTORE/$r[15]";
			if (!file_exists("$fn")){;
				if (!file_exists("$I_FILESTORE/$year/$r[15]")){
					$fn="$I_FILESTORE/$year/$r[15]";
				}
			}
			echo("<td class='df_td'><a href=\"$fn\">$r[1]</a></td>");
			echo("<td class='df_td'>$r[3]</td>");
			$idp=$r[4];
			$sqlc="select * from ik_partner where id=$idp;";
			if (sql_run($sqlc)){
				$dp=$MA_SQL_RESULT[0];
				echo("<td class='df_td'>$dp[1]</td>");
			}else{
				echo("<td class='df_td'>$r[4]</td>");
			}
			if ($r[9]<>""){
				$r[9]=strtotime($r[9]);
				$r[9]=date('Y. m. d.',$r[9]);
			}
			if ($r[10]<>""){
				$r[10]=strtotime($r[10]);
				$r[10]=date('Y. m. d.',$r[10]);
			}
			if ($r[11]<>""){
				$r[11]=strtotime($r[11]);
				$r[11]=date('Y. m. d.',$r[11]);
			}
			echo("<td class='df_td'>$r[9]</td>");
			echo("<td class='df_td'>$r[11]</td>");
			echo("<td class='df_td'>$r[10]</td>");
			echo("<td class='df_td'>$r[12]</td>");
			echo("<td class='df_td'>");
			echo("<center>");
			echo("<form method=post>");
			echo("<input type=hidden id=id name=id value=\"$r[0]\">");
			echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=chd name=chd value=\"$I_WORKDOC\">");
			echo("</form>");
			echo("</td>");
			echo("</tr>");
		}
		echo("</table>");
		echo("<div class=frow>");
		echo("<div class=pcol2>");
		if (($page>0)and($first>0)){
			echo("<form method=post>");
			$p=$page-1;
			echo("<input type=hidden id=page name=page value=\"$p\">");
			echo("<input type=hidden id=year name=year value=\"$year\">");
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
			echo("<input type=hidden id=page name=page value=\"$p\">");
			echo("<input type=hidden id=year name=year value=\"$year\">");
			echo("<input type=submit id=p name=p value=\"$I_PAGE_RIGHT\">");
			echo("</form>");
		}else{
			echo("<span style=\"color:transparent;\">?</span>");
		}
		echo("</div>");;
		echo("</div>");
	}
}


?>
