<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #



function i_catdel(){
	global $I_CATTITLE_DEL,$I_OK,$I_ERROR;

		if (isset($_POST['idd'])){
			$id=$_POST['idd'];
			$sqlc="delete from ik_cat where id=$id;";
			#echo($sqlc);
			if (sql_run($sqlc)){
				mess_ok($I_CATTITLE_DEL.": ".$I_OK.".");
			}else{
				mess_error($I_CATTITLE_DEL.": ".$I_ERROR.".");
			}
		}
}



function i_catdata($new){
	global $MA_SQL_RESULT,$I_CAT_FIELDS,$MA_ADMINFILE,
			$I_SAVE,$I_CATTITLE_NEW,$I_CATTITLE_CHANGE,
			$I_OK,$I_ERROR,$I_DELCAT;

	$db=count($I_CAT_FIELDS);
	if ($new){
		$title=$I_CATTITLE_NEW;
		if (isset($_POST['0'])){
			$da="'".$_POST[0]."'";
			for($i=1;$i<$db;$i++){
				$da=$da.", \"".$_POST[$i]."\"";
			}
			$sqlc="insert into ik_cat (id,kod,nev) values ($da);";
			if (sql_run($sqlc)){
				mess_ok($I_CATTITLE_NEW.": ".$I_OK.".");
			}else{
				mess_error($I_CATTITLE_NEW.": ".$I_ERROR.".");
			}
		}
		$d[0]=date('YmdHis');
		for($i=1;$i<$db;$i++){
			$d[$i]="";
		}
	}else{
		$title=$I_CATTITLE_CHANGE;
		if (isset($_POST['id'])){
			if (isset($_POST['id2'])){
				$id2=$_POST['id2'];
				$sqlc="update ik_cat set";
				$sqlc=$sqlc." id = ".$_POST[0].", ";
				$sqlc=$sqlc." kod = \"$_POST[1]\", ";
				$sqlc=$sqlc." nev = \"$_POST[2]\" ";
				$sqlc=$sqlc." where id=$id2;";
				echo($sqlc);
				if (sql_run($sqlc)){
					mess_ok($I_CATTITLE_CHANGE.": ".$I_OK.".");
				}else{
					mess_error($I_CATTITLE_CHANGE.": ".$I_ERROR.".");
				}
			}
			$id=$_POST['id'];
			$sqlc="select * from ik_cat where id=$id;";
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
	echo("<div class=spaceline></div>");
	echo("<h3>$title</h3>");
	echo("<div class=spaceline></div>");
	echo("<form method=post>");
	echo("<input type=hidden id=0 name=0 value=\"$d[0]\">");
	for($i=1;$i<$db;$i++){
		echo("<div class=frow>");
		echo("<div class=fcol1>$I_CAT_FIELDS[$i]");
		echo("</div>");
		echo("<div class=fcol2>");
		echo("<input type=text id=$i name=$i placeholder=\"$I_CAT_FIELDS[$i]\" value=\"$d[$i]\">");
		echo("</div>");
		echo("</div>");
	}
	echo("<div class=frow><br /></div>");
	if ($new){
		echo("<input type=hidden id=id name=id value=\"$d[0]\">");
		echo("<input type=submit id=newc name=newc value=\"$I_SAVE\">");
		echo("</form>");
	}else{
		echo("<input type=hidden id=id name=id value=\"$d[0]\">");
		echo("<input type=hidden id=id2 name=id2 value=\"$d[0]\">");
		echo("<input type=submit id=chc name=chc value=\"$I_SAVE\">");
		echo("</form>");
		echo("<div class=frow><br /></div>");
		echo("<form method=post>");
		echo("<input type=hidden id=idd name=idd value=\"$d[0]\">");
		echo("<input  type=submit id=delc name=delc value=\"$I_DELCAT\">");
		echo("</form>");
	}
}


function i_cat(){
	global $MA_SQL_RESULT,$I_NEWCAT,$I_CATTABLE_TITLE,
			$I_WORKCAT,$I_SEARCH,$I_PAGEROW,$I_PAGE_LEFT,$I_PAGE_RIGHT;

	$ptable=true;
	if (isset($_POST['newc'])){
		$ptable=false;
		i_catdata(true);
	}
	if (isset($_POST['delc'])){
		i_catdel();
	}
	if (isset($_POST['chc'])){
		$ptable=false;
		i_catdata(false);
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
		if (sql_run("select count(*) from ik_cat;")){
			$r=$MA_SQL_RESULT[0];
			$odb=$r[0];
			$adb=$first+$I_PAGEROW;
			if ($adb>=$odb){
				$last=true;
			}
		}
		echo("<form method=post>");
		echo("<input type=submit id=newc name=newc value=\"$I_NEWCAT\">");
		echo("</form>");
		echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$I_SEARCH\">");
		sql_run("select * from ik_cat order by nev limit $first,$I_PAGEROW;");
		echo("<center>");
		echo("<table class='df_table_full' id=ptable>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th1'>$I_CATTABLE_TITLE[0]</th>");
		echo("<th class='df_th5'>$I_CATTABLE_TITLE[1]</th>");
		echo("<th class='df_th1'>$I_CATTABLE_TITLE[2]</th>");
		echo("</tr>");
		$db=count($MA_SQL_RESULT);
		for($i=0;$i<$db;$i++){
			$r=$MA_SQL_RESULT[$i];
			echo("<tr class=df_tr>");
			echo("<td class='df_td'>$r[1]</td>");
			echo("<td class='df_td'>$r[2]</td>");
			echo("<td class='df_td'>");
			echo("<center>");
			echo("<form method=post>");
			echo("<input type=hidden id=id name=id value=\"$r[0]\">");
			echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=chc name=chc value=\"$I_WORKCAT\">");
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
