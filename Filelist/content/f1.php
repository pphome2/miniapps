<?php

 #
 # Fájlok
 #
 # info: main folder copyright file
 #
 #


function f_table(){
	global $MA_USERNAME,$F_FILESTORE,$F_FILECOUNTLIMIT,$F_PAGEROW,$F_USER_FILE_RIGHTS,$F_OK,
			$F_ERROR,$F_SAVE,$F_SEARCH,$F_GO,$F_PAGE_RIGHT,$F_PAGE_LEFT,$F_BACK,
			$F_TABLE_TITLE,$F_NOCONFIG,$F_WELCOME_TEXT;

	echo("<h3>".$F_WELCOME_TEXT.$MA_USERNAME.".</h3>");
	for($i=0;$i<count($F_USER_FILE_RIGHTS);$i++){
		if($MA_USERNAME===$F_USER_FILE_RIGHTS[$i][0]){
			$ri=$F_USER_FILE_RIGHTS[$i][1];
		}
	}
	if(isset($ri)){
		$fl=array();
		$w=0;
		for($i=0;$i<count($ri);$i++){
			$flx=glob("$F_FILESTORE/*$ri[$i]*.pdf");
			for($k=0;$k<count($flx);$k++){
				$fl=$fl+array("$w"=>"$flx[$k]");
				$w++;
				if($w===$F_FILECOUNTLIMIT){
					$k=count($flx);
					$i=count($ri);
				}
			}
		}
		$fdb=count($fl);
		if (isset($_POST['page'])){
			$page=(int)$_POST['page'];
			$first=$F_PAGEROW*$page;
		}else{
			$page=0;
			$first=0;
		}
		$last=false;
		$adb=$first+$F_PAGEROW;
		if ($adb>=$fdb){
			$last=true;
		}
		echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$F_SEARCH\">");
		echo("<center>");
		echo("<table class='df_table_full' id=ptable>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th'>$F_TABLE_TITLE[0]</th>");
		echo("<th class='df_th1'>$F_TABLE_TITLE[1]</th>");
		echo("</tr>");
		$row=0;
		for($i=0;$i<$fdb;$i++){
			if(($i>=$first)and($i<($first+$F_PAGEROW))){
				$row++;
				echo("<tr class=df_tr>");
				$fn=substr($fl[$i],strlen($F_FILESTORE)+1,strlen($fl[$i]));
				echo("<td class='df_td'>$fn</td>");
				echo("<td class='df_td'>");
				echo("<center>");
				echo("<a href=\"$fl[$i]\"><input class='tbutton' style=\"width:30%;padding:0px;margin:0px;\" type=submit value=\"$F_GO\"></a>");
				echo("</td>");
				echo("</tr>");
			}
		}
		echo("</table>");

		echo("<div class=frow>");
		echo("<div class=pcol2>");
		if (($page>0)and($first>0)){
			echo("<form method=post>");
			$p=$page-1;
			echo("<input type=hidden id=page name=page value=$p>");
			echo("<input type=submit id=p name=p value=\"$F_PAGE_LEFT\">");
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
		if (($row==$F_PAGEROW)and(!$last)){
			$p=$page+1;
			echo("<form method=post>");
			echo("<input type=hidden id=page name=page value=$p>");
			echo("<input type=submit id=p name=p value=\"$F_PAGE_RIGHT\">");
			echo("</form>");
		}else{
			echo("<span style=\"color:transparent;\">?</span>");
		}
		echo("</div>");;
		echo("</div>");
	}else{
		mess_error("$MA_USERNAME: $F_NOCONFIG");
	}
}


?>
