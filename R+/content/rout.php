<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #


function r_outst1($rid){
	global $MA_SQL_RESULT,$R_INAME_TABLE_TITLE,
		$R_WORK_INAME,$R_SEARCH,$R_PAGEROW,$R_PAGE_LEFT,$R_PAGE_RIGHT,
		$R_OUT_STAGE,$R_SELECT;

	echo("<h3>$R_OUT_STAGE[1] </h3><br />");
	if (isset($_POST['page'])){
		$page=(int)$_POST['page'];
		$first=$R_PAGEROW*$page;
	}else{
		$page=0;
		$first=0;
	}
	$last=false;
	if (sql_run("select count(*) from r_cikk;")){
		$r=$MA_SQL_RESULT[0];
		$odb=$r[0];
		$adb=$first+$R_PAGEROW;
		if ($adb>=$odb){
			$last=true;
		}
	}
	echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$R_SEARCH\">");
	sql_run("select * from r_cikk order by csz limit $first,$R_PAGEROW;");
	echo("<center>");
	echo("<table class='df_table_full' id=ptable>");
	echo("<tr class='df_trh'>");
	echo("<th class='df_th'>$R_INAME_TABLE_TITLE[0]</th>");
	echo("<th class='df_th1'>$R_INAME_TABLE_TITLE[1]</th>");
	echo("<th class='df_th1'>$R_INAME_TABLE_TITLE[2]</th>");
	echo("<th class='df_th'>$R_INAME_TABLE_TITLE[3]</th>");
	echo("<th class='df_th'>$R_SELECT</th>");
	echo("</tr>");
	$res=$MA_SQL_RESULT;
	$db=count($res);
	for($i=0;$i<$db;$i++){
		$r=$res[$i];
		echo("<tr class=df_tr>");
		echo("<td class='df_td'>$r[1]</td>");
		$sqlc="select * from r_kat where id=$r[2];";
		if (sql_run($sqlc)){
			$resx=$MA_SQL_RESULT[$i];
			echo("<td class='df_td'>$resx[2]</td>");
		}else{
			echo("<td class='df_td'>$r[2]</td>");
		}
		echo("<td class='df_td'>$r[3]</td>");
		echo("<td class='df_td'>$r[4]</td>");
		echo("<td class='df_td'>");
		echo("<center>");
		echo("<form method=post>");
		echo("<input type=hidden id=rid name=rid value=\"$rid\">");
		echo("<input type=hidden id=iid name=iid value=\"$r[0]\">");
		echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=chc name=chc value=\"$R_WORK_INAME\">");
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
		echo("<input type=hidden id=rid name=pid value=\"$rid\">");
		echo("<input type=hidden id=page name=page value=\"$p\">");
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
		echo("<input type=hidden id=rid name=pid value=\"$rid\">");
		echo("<input type=hidden id=page name=page value=\"$p\">");
		echo("<input type=submit id=p name=p value=\"$R_PAGE_RIGHT\">");
		echo("</form>");
	}else{
		echo("<span style=\"color:transparent;\">?</span>");
	}
	echo("</div>");
	echo("</div>");
}




function r_outst0(){
	global $MA_SQL_RESULT,$R_STR_TABLE_TITLE,
			$R_WORK_RAK,$R_SEARCH,$R_PAGEROW,$R_PAGE_LEFT,$R_PAGE_RIGHT,
			$R_OUT_STAGE,$R_SELECT;

	echo("<h3>$R_OUT_STAGE[0] </h3><br />");
	$page=0;
	$first=0;
	if (isset($_POST['page'])){
		$page=(int)$_POST['page'];
		$first=$R_PAGEROW*$page;
	}else{
	}
	$last=false;
	if (sql_run("select count(*) from r_raktar;")){
		$r=$MA_SQL_RESULT[0];
		$odb=$r[0];
		$adb=$first+$R_PAGEROW;
		if ($adb>=$odb){
			$last=true;
		}
	}
	echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$R_SEARCH\">");
	sql_run("select * from r_raktar order by nev desc limit $first,$R_PAGEROW;");
	echo("<center>");
	echo("<table class='df_table_full' id=ptable>");
	echo("<tr class='df_trh'>");
	echo("<th class='df_th'>$R_STR_TABLE_TITLE[0]</th>");
	echo("<th class='df_th0'>$R_SELECT</th>");
	echo("</tr>");
	$db=count($MA_SQL_RESULT);
	for($i=0;$i<$db;$i++){
		$r=$MA_SQL_RESULT[$i];
		echo("<tr class=df_tr>");
		echo("<td class='df_td'>$r[1]</td>");
		echo("<td class='df_td'>");
		echo("<center>");
		echo("<form method=post>");
		echo("<input type=hidden id=rid name=rid value=\"$r[0]\">");
		echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=chp name=chp value=\"$R_WORK_RAK\">");
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
		echo("<input type=submit id=p name=p value=\"$R_PAGE_RIGHT\">");
		echo("</form>");
	}else{
		echo("<span style=\"color:transparent;\">?</span>");
	}
	echo("</div>");
	echo("</div>");
}



function r_out(){
	$st=0;
	if (isset($_POST['rid'])){
		$rid=$_POST['rid'];
		$st++;
	}
	if (isset($_POST['iid'])){
		$iid=$_POST['iid'];
		$st++;
	}
	if (isset($_POST['newout'])){
		r_outst2($rid,$iid);
	}else{
		switch($st){
			case 0:
				r_outst0();
				break;
			case 1:
				r_outst1($rid);
				break;
			case 2:
				r_outst2($rid,$iid);
				break;
			default:
				break;
		}
	}
}


?>
