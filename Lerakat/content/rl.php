<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #



function r_list(){
	global$R_LISTS,$R_LISTCODE,$R_GO,$MA_SQL_RESULT,$R_SITE;

	$listall=true;
	if (isset($_POST['lcode'])){
		switch ($_POST['lcode']){
			case $R_LISTCODE[0]:
				$listall=false;
				r_listin($R_LISTS[0]);
				break;
			case $R_LISTCODE[1]:
				$listall=false;
				r_listout($R_LISTS[1]);
				break;
			case $R_LISTCODE[2]:
				$listall=false;
				r_store($R_LISTS[2]);
				break;
			case $R_LISTCODE[3]:
				$listall=false;
				r_calcout($R_LISTS[3]);
				break;
			case $R_LISTCODE[4]:
				$listall=false;
				r_outklt($R_LISTS[4]);
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

		echo("<h3>$R_LISTS[0]</h3>");
		echo("<form method=post>");
		echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[0]\">");
		echo("<input type=submit id=x name=x value=\"$R_GO\">");
		echo("</form>");
		echo("<div class=spaceline></div>");

		echo("<h3>$R_LISTS[1]</h3>");
		echo("<form method=post>");
		echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[1]\">");
		echo("<input type=submit id=x name=x value=\"$R_GO\">");
		echo("</form>");
		echo("<div class=spaceline></div>");

		echo("<h3>$R_LISTS[2]</h3>");
		echo("<form method=post>");
		$sqlc="select * from r_raktar;";
		sql_run($sqlc);
		echo("<select id=r name=r>");
		for($x=0;$x<count($MA_SQL_RESULT);$x++){
			$d=$MA_SQL_RESULT[$x];
			echo("<option value='$d[0]'>$d[1]</option>");
		}
		echo("</select>");
		echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[2]\">");
		echo("<input type=submit id=x name=x value=\"$R_GO\">");
		echo("</form>");
		echo("<div class=spaceline></div>");

		echo("<h3>$R_LISTS[3]</h3>");
		echo("<form method=post>");
		echo("<input type=date id=date name=date min=2023-01 value=2023-01>");
		echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[3]\">");
		echo("<input type=submit id=x name=x value=\"$R_GO\">");
		echo("</form>");
		echo("<div class=spaceline></div>");

		echo("<h3>$R_LISTS[4]</h3>");
		echo("<form method=post>");
		echo("<input type=date id=date name=date min=2023-01 value=2023-01>");
		$sqlc="select * from r_kolt;";
		sql_run($sqlc);
		echo("<select id=klt name=klt>");
		for($x=0;$x<count($MA_SQL_RESULT);$x++){
			$d=$MA_SQL_RESULT[$x];
			echo("<option value='$d[0]'>$d[1]</option>");
		}
		echo("</select>");
		echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[4]\">");
		echo("<input type=submit id=x name=x value=\"$R_GO\">");
		echo("</form>");
		echo("<div class=spaceline></div>");

		echo("</div>");
		echo("<div class=colx1></div>");
		echo("</div>");
	}
}


?>
