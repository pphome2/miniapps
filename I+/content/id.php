<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #



function i_docdel(){
	global $I_DOCTITLE_DEL,$I_OK,$I_ERROR;

		if (isset($_POST['idd'])){
			$id=$_POST['idd'];
			$sqlc="delete from ik_doc where id=$id;";
			#echo($sqlc);
			if (sql_run($sqlc)){
				mess_ok($I_DOCTITLE_DEL.": ".$I_OK.".");
			}else{
				mess_error($I_DOCTITLE_DEL.": ".$I_ERROR.".");
			}
		}
}



function i_docdata($new){
	global $MA_SQL_RESULT,$I_DOC_FIELDS,$MA_ADMINFILE,
			$I_SAVE,$I_DOCTITLE_NEW,$I_DOCTITLE_CHANGE,
			$I_OK,$I_ERROR,$I_DELDOC,$I_DOCFROMPARTNER,
			$I_MONEYTYPE,$I_SITE,$I_FILESTORE,$I_FILECOUNTLIMIT;

	$db=count($I_DOC_FIELDS);
	if ($new){
		if (isset($_POST['0'])){
			i_genid($_POST['1']);
			if (!is_numeric($_POST[5])){
				$_POST[5]=0;
			}
			$sqlc="insert into ik_doc (id,sorsz,datum,szsz,partner,ossz,pnem,kat,kiall,fhat,fiz,telep,bank,megj,fajl) ";
			$sqlc=$sqlc."values ('$_POST[0]','$_POST[1]','$_POST[2]','$_POST[3]',$_POST[4],$_POST[5],'$_POST[6]',$_POST[7],";
			$sqlc=$sqlc."'$_POST[8]','$_POST[9]','$_POST[10]','$_POST[11]','$_POST[12]','$_POST[13]','$_POST[14]');";
			#echo($sqlc);
			if (sql_run($sqlc)){
				mess_ok($I_DOCTITLE_NEW.": ".$I_OK.".");
			}else{
				mess_error($I_DOCTITLE_NEW.": ".$I_ERROR.".");
			}
		}
		$d[0]=date('YmdHis');
		$d[1]=i_genid();
		for($i=2;$i<$db;$i++){
			$d[$i]="";
		}
		$d[2]=date('Y-m-d');
		$d[4]=$_POST[4];
		$d[5]=0;
		echo("<h3>$I_DOCTITLE_NEW<h3>");
		if (isset($_POST['ndid'])){
			$idp=$_POST['ndid'];
			$sqlc="select * from ik_partner where id=$idp;";
			if (sql_run($sqlc)){
				$dp=$MA_SQL_RESULT[0];
				echo("<h3>$I_DOCFROMPARTNER $dp[1]</h3>");
				$d[4]=$idp;
			}
		}
	}else{
		echo("<h3>$I_DOCTITLE_CHANGE</h3>");
		if (isset($_POST['id'])){
			if (isset($_POST['id2'])){
				$id2=$_POST['id2'];
				$sqlc="update ik_doc set";
				$sqlc=$sqlc." id = ".$_POST[0].", ";
				$sqlc=$sqlc." sorsz = \"$_POST[1]\", ";
				$sqlc=$sqlc." datum = \"$_POST[2]\", ";
				$sqlc=$sqlc." szsz = \"$_POST[3]\", ";
				$sqlc=$sqlc." partner = $_POST[4], ";
				if (!is_numeric($_POST[5])){
					$sqlc=$sqlc." ossz = 0, ";
				}else{
					$sqlc=$sqlc." ossz = $_POST[5], ";
				}
				$sqlc=$sqlc." pnem = \"$_POST[6]\", ";
				$sqlc=$sqlc." kat = $_POST[7], ";
				$sqlc=$sqlc." kiall = \"$_POST[8]\", ";
				$sqlc=$sqlc." fhat = \"$_POST[9]\", ";
				$sqlc=$sqlc." fiz = \"$_POST[10]\", ";
				$sqlc=$sqlc." telep = \"$_POST[11]\", ";
				$sqlc=$sqlc." bank = \"$_POST[12]\", ";
				$sqlc=$sqlc." megj = \"$_POST[13]\", ";
				$sqlc=$sqlc." fajl = \"$_POST[14]\" ";
				$sqlc=$sqlc." where id=$id2;";
				if (sql_run($sqlc)){
					mess_ok($I_DOCTITLE_CHANGE.": ".$I_OK.".");
				}else{
					mess_error($I_DOCTITLE_CHANGE.": ".$I_ERROR.".");
				}
			}
			$id=$_POST['id'];
			$sqlc="select * from ik_doc where id=$id;";
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
				$d[2]=date('Y-m-d');
				echo($d[2]);
			}
			$sqlc="select * from ik_partner where id=$d[4];";
			if (sql_run($sqlc)){
				$dp=$MA_SQL_RESULT[0];
				echo("<h3>$I_DOCFROMPARTNER $dp[1]</h3>");
			}
		}
	}
	echo("<div class=spaceline></div>");
	echo("<form method=post>");
	echo("<input type=hidden id=0 name=0 value='$d[0]'>");
	$dat=array(2,8,9,10);
	$self=array(6,7,11,14);
	$rof=array(1,4);
	for($i=1;$i<$db;$i++){
		echo("<div class=frow>");
		echo("<div class=fcol1>$I_DOC_FIELDS[$i]");
		echo("</div>");
		echo("<div class=fcol2>");
		if (in_array($i,$self)){
			if ($i===6){
				echo("<select id=$i name=$i>");
				echo("<option value=\"\"></option>");
				$dbl=count($I_MONEYTYPE);
				for($j=0;$j<$dbl;$j++){
					if ($d[$i]===$I_MONEYTYPE[$j]){
						$sel="selected";
					}else{
						$sel="";
					}
					echo("<option value=\"$I_MONEYTYPE[$j]\" $sel>$I_MONEYTYPE[$j]</option>");
				}
				echo("</select>");
			}
			if ($i===7){
				echo("<select id=$i name=$i>");
				#echo("<option value=\"\"></option>");
				$sqlc="select * from ik_cat order by kod;";
				sql_run($sqlc);
				$dbl=count($MA_SQL_RESULT);
				for($j=0;$j<$dbl;$j++){
					$cl=$MA_SQL_RESULT[$j];
					if ($d[$i]==$cl[0]){
						$sel="selected";
					}else{
						$sel="";
					}
					echo("<option value=\"$cl[0]\" $sel>$cl[2]</option>");
				}
				echo("</select>");
			}
			if ($i===11){
				echo("<select id=$i name=$i>");
				echo("<option value=\"\"></option>");
				$dbl=count($I_SITE);
				for($j=0;$j<$dbl;$j++){
					if ($d[$i]===$I_SITE[$j]){
						$sel="selected";
					}else{
						$sel="";
					}
					echo("<option value=\"$I_SITE[$j]\" $sel>$I_SITE[$j]</option>");
				}
				echo("</select>");
			}
			if ($i===14){
				echo("<select id=$i name=$i>");
				echo("<option value=\"\"></option>");
				#$fl=scandir($I_FILESTORE);
				$fl=glob("$I_FILESTORE/*.pdf");
				usort($fl,function($a,$b){
					return filemtime($b)-filemtime($a);
				});
				$dbl=count($fl);
				if ($db1>$I_FILECOUNTLIMIT){
					$db1=$I_FILECOUNTLIMIT;
				}
				for($j=0;$j<$dbl;$j++){
					$fn=explode("/",$fl[$j]);
					if (substr($fn[1],0,1)<>"."){
						if ($d[$i]===$fn[1]){
							$sel="selected";
						}else{
							$sel="";
						}
						echo("<option value=\"$fn[1]\" $sel>$fn[1]</option>");
					}
				}
				echo("</select>");
			}
		}else{
			if (in_array($i,$rof)){
				$ro="readonly";
			}else{
				$ro="";
			}
			if (in_array($i,$dat)){
				echo("<input type=date id=$i name=$i placeholder='$I_DOC_FIELDS[$i]' value='$d[$i]' $ro>");
			}else{
				echo("<input type=text id=$i name=$i placeholder='$I_DOC_FIELDS[$i]' value='$d[$i]' $ro>");
			}
		}
		echo("</div>");
		echo("</div>");
	}
	echo("<div class=frow><br /></div>");
	if ($new){
		echo("<input type=hidden id=id name=id value=\"$d[0]\">");
		echo("<input type=submit id=newd name=newd value=\"$I_SAVE\">");
		echo("</form>");
	}else{
		echo("<input type=hidden id=id name=id value=\"$d[0]\">");
		echo("<input type=hidden id=id2 name=id2 value=\"$d[0]\">");
		echo("<input type=submit id=chd name=chd value=\"$I_SAVE\">");
		echo("</form>");
		echo("<div class=frow><br /></div>");
		echo("<form method=post>");
		echo("<input type=hidden id=idd name=idd value=\"$d[0]\">");
		echo("<input  type=submit id=deld name=deld value=\"$I_DELDOC\">");
		echo("</form>");
	}
}


function i_doctable(){
	global $MA_SQL_RESULT,$I_NEWDOC,$I_DOCTABLE_TITLE,$I_PAGEROW,$I_FIRSTYEAR,
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
		if (isset($_POST['page'])){
			$page=(int)$_POST['page'];
			$first=$I_PAGEROW*$page;
		}else{
			$page=0;
			$first=0;
		}
		$last=false;
		if (sql_run("select count(*) from ik_doc;")){
			$r=$MA_SQL_RESULT[0];
			$odb=$r[0];
			$adb=$first+$I_PAGEROW;
			if ($adb>=$odb){
				$last=true;
			}
		}
		if (isset($_POST['year'])){
			$year=$_POST['year'];
		}else{
			$year=0;
		}
		$year=i_year($year);
		echo("<form method=post>");
		echo("<input type=hidden id=page name=page value=$page>");
		echo("<div class=frow>");
		echo("<div class=pcol2>");
		echo("<h3>$year</h3>");
		echo("</div>");
		echo("<div class=pcol1>");
		echo("<select style=\"width:20%;margin-right:20px;float:right;\" id=year name=year>");
		for($y=date('Y');$y>=$I_FIRSTYEAR;$y--){
			echo("<option value=$y>$y</option>");
		}
		echo("</select>");
		echo("</div>");
		echo("<div class=pcol2>");
		echo("<input type=submit id=yeargo name=yeargo value=\"$I_WORKDOC\">");
		echo("</div>");
		echo("</div>");
		echo("</form>");
		echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$I_SEARCH\">");
		echo("<center>");
		echo("<table class='df_table_full' id=ptable>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th0'>$I_DOCTABLE_TITLE[0]</th>");
		echo("<th class='df_th1'>$I_DOCTABLE_TITLE[1]</th>");
		echo("<th class='df_th2'>$I_DOCTABLE_TITLE[2]</th>");
		echo("<th class='df_th3'>$I_DOCTABLE_TITLE[3]</th>");
		echo("<th class='df_th4'>$I_DOCTABLE_TITLE[4]</th>");
		echo("</tr>");
		sql_run("select * from ik_doc where id like \"%$year%\" order by sorsz desc limit $first,$I_PAGEROW;");
		$dr=$MA_SQL_RESULT;
		$db=count($dr);
		for($i=0;$i<$db;$i++){
			$r=$dr[$i];
			echo("<tr class=df_tr>");
			$fn="$I_FILESTORE/$r[14]";
			echo("<td class='df_td'><a href=\"$fn\">$r[1]</a></td>");
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
			echo("<td class='df_td'>$r[9]</td>");
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
			echo("<input type=hidden id=page name=page value=$p>");
			echo("<input type=hidden id=year name=year value=$year>");
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
			echo("<input type=hidden id=year name=year value=$year>");
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
