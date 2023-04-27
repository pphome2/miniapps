<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #



function r_catdel(){
	global $R_CAT_TITLE_DEL,$R_OK,$R_ERROR;

	if (isset($_POST['idd'])){
		$id=$_POST['idd'];
		$sqlc="delete from r_kat where id=$id;";
		if (sql_run($sqlc)){
			mess_ok($R_CAT_TITLE_DEL.": ".$R_OK.".");
		}else{
			mess_error($R_CAT_TITLE_DEL.": ".$R_ERROR.".");
		}
	}
}



function r_catdata($new){
	global $MA_SQL_RESULT,$R_CAT_FIELDS,$MA_ADMINFILE,
			$R_SAVE,$R_CAT_TITLE_NEW,$R_CAT_TITLE_CHANGE,
			$R_OK,$R_ERROR,$R_DEL_CAT;

	$db=count($R_CAT_FIELDS);
	$form=true;
	if ($new){
		$title=$R_CAT_TITLE_NEW;
		if (isset($_POST['0'])){
			$form=false;
			$da="\"".$_POST[0]."\"";
			for($i=1;$i<$db;$i++){
				$da=$da.", \"".$_POST[$i]."\"";
			}
			$sqlc="insert into r_kat (id,kod,nev) values ($da);";
			if (sql_run($sqlc)){
				mess_ok($R_CAT_TITLE_NEW.": ".$R_OK.".");
			}else{
				mess_error($R_CAT_TITLE_NEW.": ".$R_ERROR.".");
			}
		}
		$d[0]=r_genid();
		for($i=1;$i<$db;$i++){
			$d[$i]="";
		}
	}else{
		$title=$R_CAT_TITLE_CHANGE;
		if (isset($_POST['id'])){
			if (isset($_POST['id2'])){
				$form=false;
				$id2=$_POST['id2'];
				$sqlc="update r_kat set";
				$sqlc=$sqlc." id = ".$_POST[0].", ";
				$sqlc=$sqlc." kod = \"$_POST[1]\", ";
				$sqlc=$sqlc." nev = \"$_POST[2]\" ";
				$sqlc=$sqlc." where id=$id2;";
				if (sql_run($sqlc)){
					mess_ok($R_CAT_TITLE_CHANGE.": ".$R_OK.".");
				}else{
					mess_error($R_CAT_TITLE_CHANGE.": ".$R_ERROR.".");
				}
			}
			$id=$_POST['id'];
			$sqlc="select * from r_kat where id=$id;";
			if (sql_run($sqlc)){
				$r=$MA_SQL_RESULT[0];
				for($i=0;$i<$db;$i++){
					$d[$i]=$r[$i];
				}
			}else{
				$d[0]=r_genid();
				for($i=1;$i<$db;$i++){
					$d[$i]="";
				}
			}
		}
	}
	if ($form){
		echo("<div class=spaceline></div>");
		echo("<h3>$title</h3>");
		echo("<div class=spaceline></div>");
		echo("<form method=post>");
		echo("<input type=hidden id=0 name=0 value=\"$d[0]\">");
		for($i=1;$i<$db;$i++){
			echo("<div class=frow>");
			echo("<div class=fcol1>$R_CAT_FIELDS[$i]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<input type=text id=$i name=$i placeholder=\"$R_CAT_FIELDS[$i]\" value=\"$d[$i]\">");
			echo("</div>");
			echo("</div>");
		}
		echo("<div class=frow><br /></div>");
		if ($new){
			echo("<input type=hidden id=id name=id value=\"$d[0]\">");
			echo("<input type=submit id=newc name=newc value=\"$R_SAVE\">");
			echo("</form>");
		}else{
			echo("<input type=hidden id=id name=id value=\"$d[0]\">");
			echo("<input type=hidden id=id2 name=id2 value=\"$d[0]\">");
			echo("<input type=submit id=chc name=chc value=\"$R_SAVE\">");
			echo("</form>");
			echo("<div class=frow><br /></div>");
			echo("<form method=post>");
			echo("<input type=hidden id=idd name=idd value=\"$d[0]\">");
			echo("<input  type=submit id=delc name=delc value=\"$R_DEL_CAT\">");
			echo("</form>");
		}
		return(false);
	}
	return(true);
}


function r_cat(){
	global $MA_SQL_RESULT,$R_NEW_CAT,$R_CAT_TABLE_TITLE,
			$R_WORK_CAT,$R_SEARCH,$R_PAGEROW,$R_PAGE_LEFT,$R_PAGE_RIGHT;

	$ptable=true;
	if (isset($_POST['newc'])){
		$ptable=r_catdata(true);
	}
	if (isset($_POST['delc'])){
		r_catdel();
	}
	if (isset($_POST['chc'])){
		$ptable=r_catdata(false);
	}
	if ($ptable){
		if (isset($_POST['page'])){
			$page=(int)$_POST['page'];
			$first=$R_PAGEROW*$page;
		}else{
			$page=0;
			$first=0;
		}
		$last=false;
		if (sql_run("select count(*) from r_kat;")){
			$r=$MA_SQL_RESULT[0];
			$odb=$r[0];
			$adb=$first+$R_PAGEROW;
			if ($adb>=$odb){
				$last=true;
			}
		}
		echo("<form method=post>");
		echo("<input type=submit id=newc name=newc value=\"$R_NEW_CAT\">");
		echo("</form>");
		echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$R_SEARCH\">");
		sql_run("select * from r_kat order by kod limit $first,$R_PAGEROW;");
		echo("<center>");
		echo("<table class='df_table_full' id=ptable>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th1'>$R_CAT_TABLE_TITLE[0]</th>");
		echo("<th class='df_th5'>$R_CAT_TABLE_TITLE[1]</th>");
		echo("<th class='df_th1'>$R_CAT_TABLE_TITLE[2]</th>");
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
			echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=chc name=chc value=\"$R_WORK_CAT\">");
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
		if (($db==$R_PAGEROW)and(!$last)){
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
}


?>
