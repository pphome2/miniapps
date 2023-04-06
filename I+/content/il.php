<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #



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
					$sqlc="select * from ik_cat where id=$id;";
					if (sql_run($sqlc)){
						$r=$MA_SQL_RESULT[0];
						$n=$I_LISTS[2].": ".$r[2];
					}else{
						$n=$I_LISTS[2];
					}
					$sqlc="kat = $id";
					i_listtable($I_LISTCODE[2],$sqlc,$n);
				}
				break;
			case $I_LISTCODE[3]:
				$listall=false;
				if (isset($_POST['id'])){
					$id=$_POST['id'];
					$sqlc="telep = \"$id\"";
					$n=$I_LISTS[3].": $id";
					i_listtable($I_LISTCODE[3],$sqlc,$n);
				}
				break;
			case $I_LISTCODE[4]:
				$listall=false;
				$sqlc="atad = \"\"";
				i_listtable($I_LISTCODE[4],$sqlc,$I_LISTS[4]);
				break;
			case $I_LISTCODE[5]:
				$listall=false;
				i_lpartner();
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
				if ($r[2]<>""){
					echo("<option value=\"$r[0]\">$r[2]</option>");
				}
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

		echo("<h3>$I_LISTS[4]</h3>");
		echo("<form id=$i name=$i method=post>");
		echo("<input type=hidden id=lcode name=lcode value=\"$I_LISTCODE[4]\">");
		echo("<input type=submit id=x name=x value=\"$I_GO\">");
		echo("</form>");
		echo("<div class=spaceline></div>");

		echo("<h3>$I_LISTS[5]</h3>");
		echo("<form id=$i name=$i method=post>");
		echo("<input type=hidden id=lcode name=lcode value=\"$I_LISTCODE[5]\">");
		echo("<input type=submit id=x name=x value=\"$I_GO\">");
		echo("</form>");
		echo("<div class=spaceline></div>");

		echo("</div>");
		echo("<div class=colx1></div>");
		echo("</div>");
	}
}


?>
