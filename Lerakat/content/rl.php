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
				r_listbev($R_LISTS[0]);
				break;
			case $R_LISTCODE[1]:
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
		echo("<form id=$i name=$i method=post>");
		echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[0]\">");
		echo("<input type=submit id=x name=x value=\"$R_GO\">");
		echo("</form>");
		echo("<div class=spaceline></div>");

		echo("<h3>$R_LISTS[1]</h3>");
		echo("<form id=$i name=$i method=post>");
		echo("<input type=hidden id=lcode name=lcode value=\"$R_LISTCODE[1]\">");
		echo("<input type=submit id=x name=x value=\"$R_GO\">");
		echo("</form>");
		echo("<div class=spaceline></div>");

		echo("</div>");
		echo("<div class=colx1></div>");
		echo("</div>");
	}
}


?>
