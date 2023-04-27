<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #



function i_partnerdel(){
	global $I_TITLE_DEL,$I_OK,$I_ERROR;

		if (isset($_POST['idd'])){
			$id=$_POST['idd'];
			$sqlc="delete from ik_partner where id=$id;";
			#echo($sqlc);
			if (sql_run($sqlc)){
				mess_ok($I_TITLE_DEL.": ".$I_OK.".");
			}else{
				mess_error($I_TITLE_DEL.": ".$I_ERROR.".");
			}
		}
}



function i_partnerdata($new){
	global $MA_SQL_RESULT,$I_PARTNER_FIELDS,$MA_ADMINFILE,
			$I_SAVE,$I_TITLE_NEW,$I_TITLE_CHANGE,
			$I_OK,$I_ERROR,$I_DELPARTNER,$I_PARTNERNEWDOC;

	$db=count($I_PARTNER_FIELDS);
	if ($new){
		$title=$I_TITLE_NEW;
		if (isset($_POST['0'])){
			$da="'".$_POST[0]."'";
			for($i=1;$i<$db;$i++){
				$t=$_POST[$i];
				$da=$da.", \"$t\"";
			}
			$sqlc="insert into ik_partner (id,nev,orsz,irsz,varo,cim1,cim2,mail,asz,megj) values ($da);";
			if (sql_run($sqlc)){
				mess_ok($I_TITLE_NEW.": ".$I_OK.".");
			}else{
				mess_error($I_TITLE_NEW.": ".$I_ERROR.".");
			}
		}
		$d[0]=date('YmdHis');
		for($i=1;$i<$db;$i++){
			$d[$i]="";
		}
	}else{
		$title=$I_TITLE_CHANGE;
		if (isset($_POST['id'])){
			if (isset($_POST['id2'])){
				$id2=$_POST['id2'];
				$sqlc="update ik_partner set";
				$sqlc=$sqlc." id = ".$_POST[0].", ";
				$t=$_POST[1];
				$sqlc=$sqlc." nev = \"$t\", ";
				$t=$_POST[2];
				$sqlc=$sqlc." orsz = \"$t\", ";
				$t=$_POST[3];
				$sqlc=$sqlc." irsz = \"$t\", ";
				$t=$_POST[4];
				$sqlc=$sqlc." varo = \"$t\", ";
				$t=$_POST[5];
				$sqlc=$sqlc." cim1 = \"$t\", ";
				$t=$_POST[6];
				$sqlc=$sqlc." cim2 = \"$t\", ";
				$t=$_POST[7];
				$sqlc=$sqlc." mail = \"$t\", ";
				$t=$_POST[8];
				$sqlc=$sqlc." asz = \"$t\", ";
				$t=$_POST[9];
				$sqlc=$sqlc." megj = \"$t\" ";
				$sqlc=$sqlc." where id=$id2;";
				if (sql_run($sqlc)){
					mess_ok($I_TITLE_CHANGE.": ".$I_OK.".");
				}else{
					mess_error($I_TITLE_CHANGE.": ".$I_ERROR.".");
				}
			}
			$id=$_POST['id'];
			$sqlc="select * from ik_partner where id=$id;";
			if (sql_run($sqlc)){
				$r=$MA_SQL_RESULT[0];
				for($i=0;$i<$db;$i++){
					$d[$i]=$r[$i];
				}
			}else{
				$d[0]=date('YmdHis');
				for($i=1;$i<$db;$i++){
					$d[$i]="";
				}
			}
		}
	}
	if (!$new){
		echo("<form method=post action=$MA_ADMINFILE>");
		echo("<input type=hidden id=ndid name=ndid value=\"$d[0]\">");
		echo("<input type=submit id=newdoc name=newdoc value=\"$I_PARTNERNEWDOC\">");
		echo("</form>");
	}
	echo("<div class=spaceline></div>");
	echo("<h3>$title</h3>");
	echo("<div class=spaceline></div>");
	echo("<form method=post>");
	echo("<input type=hidden id=0 name=0 value=\"$d[0]\">");
	for($i=1;$i<$db;$i++){
		echo("<div class=frow>");
		echo("<div class=fcol1>$I_PARTNER_FIELDS[$i]");
		echo("</div>");
		echo("<div class=fcol2>");
		echo("<input type=text id=$i name=$i placeholder=\"$I_PARTNER_FIELDS[$i]\" value=\"$d[$i]\">");
		echo("</div>");
		echo("</div>");
	}
	echo("<div class=frow><br /></div>");
	if ($new){
		echo("<input type=hidden id=id name=id value=\"$d[0]\">");
		echo("<input type=submit id=newp name=newp value=\"$I_SAVE\">");
		echo("</form>");
	}else{
		echo("<input type=hidden id=id name=id value=\"$d[0]\">");
		echo("<input type=hidden id=id2 name=id2 value=\"$d[0]\">");
		echo("<input type=submit id=chp name=chp value=\"$I_SAVE\">");
		echo("</form>");
		echo("<div class=frow><br /></div>");
		echo("<form method=post>");
		echo("<input type=hidden id=idd name=idd value=\"$d[0]\">");
		echo("<input  type=submit id=delp name=delp value=\"$I_DELPARTNER\">");
		echo("</form>");
	}
}


function i_partner(){
	global $MA_SQL_RESULT,$I_NEWPARTNER,$I_PARTNERTABLE_TITLE,
			$I_WORKPARTNER,$I_SEARCH,$I_PAGEROW,$I_PAGE_LEFT,$I_PAGE_RIGHT;

	$ptable=true;
	if (isset($_POST['newp'])){
		$ptable=false;
		i_partnerdata(true);
	}
	if (isset($_POST['delp'])){
		i_partnerdel();
	}
	if (isset($_POST['chp'])){
		$ptable=false;
		i_partnerdata(false);
	}
	if ($ptable){
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
		echo("<input type=submit id=newp name=newp value=\"$I_NEWPARTNER\">");
		echo("</form>");
		echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$I_SEARCH\">");
		sql_run("select * from ik_partner order by nev limit $first,$I_PAGEROW;");
		echo("<center>");
		echo("<table class='df_table_full' id=ptable>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th'>$I_PARTNERTABLE_TITLE[0]</th>");
		echo("<th class='df_th'>$I_PARTNERTABLE_TITLE[1]</th>");
		echo("<th class='df_th'>$I_PARTNERTABLE_TITLE[2]</th>");
		echo("<th class='df_th0'>$I_PARTNERTABLE_TITLE[3]</th>");
		echo("<th class='df_th0'>$I_PARTNERTABLE_TITLE[4]</th>");
		echo("<th class='df_th0'>$I_PARTNERTABLE_TITLE[5]</th>");
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
			echo("<td class='df_td'>");
			echo("<center>");
			echo("<form method=post>");
			echo("<input type=hidden id=id name=id value=\"$r[0]\">");
			echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=chp name=chp value=\"$I_WORKPARTNER\">");
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
