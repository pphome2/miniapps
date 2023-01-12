<?php

 #
 # MiniApp
 #
 # info: main folder copyright file
 #
 #



function m_archiv(){
	global $M_DATA_DIR,$M_ARCHIV_TITLE,$M_ID_FIELD,$M_SEPARATOR,$M_NEW,
		$M_ARCHIV_TABLE_TITLE,$M_ARCHIV_TABLE_RTITLE,$M_ARCHIV_COM,
		$M_TABLE_JOB,$M_PRINT,$M_ID_FIELD,$MA_PRINTFILE;

	echo("<div class=content>");
	echo($M_ARCHIV_TITLE);
	if (isset($_GET[$M_ID_FIELD])){
		$id=$_GET[$M_ID_FIELD];
		$f=file_get_contents($id, true);
		$d=explode(PHP_EOL,$f);
		$ok=0;
		$d1=explode("/",$id);
		$d2=$d1[count($d1)-1];
		$dat=substr($d2,0,4).". ".substr($d2,4,2).". ".substr($d2,6,2).".";
		echo("<div><center><h2>$dat</h2></center></div>");
		echo("<center>");
		for($i=0;$i<count($d)-1;$i++){
			echo("<div class=content>");
			echo("<table class='df_table_full'>");
			echo("<tr class='df_trh'>");
			echo("<th class='df_th1'>$M_ARCHIV_TABLE_RTITLE[0]</th>");
			echo("<th class='df_th1'>$M_ARCHIV_TABLE_RTITLE[1]</th>");
			echo("</tr>");
			$dr=explode($M_SEPARATOR,$d[$i]);
			echo("<br />");
			for($j=0;$j<count($M_NEW);$j++){
				echo("<tr class='df_tr'>");
				echo("<td class='df_td2'>$M_NEW[$j]</td>");
				echo("<td class='df_td2'>$dr[$j]</td>");
				echo("</tr>");
			}
			echo("<tr class='df_tr'>");
			echo("<td class='df_td2'>$M_TABLE_JOB</td>");
			echo("<td class='df_tda3'><a href=$MA_PRINTFILE?$M_ID_FIELD=$dr[0]>$M_PRINT</a></td>");
			echo("</tr>");
			echo("</table>");
			echo("</div>");
		}
		button_back();
	}else{
		$da=array(".","..");
		$url=$_SERVER['REQUEST_URI']."&".$M_ID_FIELD."=";
		$md=scandir($M_DATA_DIR,SCANDIR_SORT_DESCENDING);
		echo("<div class=content>");
		for ($i=0;$i<count($md);$i++){
			if ((is_dir($M_DATA_DIR."/".$md[$i]))and(!in_array($md[$i],$da))){
				echo("<div><center><h2>$md[$i]</h2></center></div><br />");
				$sd=scandir($M_DATA_DIR."/".$md[$i],SCANDIR_SORT_DESCENDING);
				echo("<center>");
				echo("<table class='df_table_full'>");
				echo("<tr class='df_trh'>");
				echo("<th class='df_th8'>$M_ARCHIV_TABLE_TITLE[0]</th>");
				echo("<th class='df_th3'>$M_ARCHIV_TABLE_TITLE[1]</th>");
				echo("</tr>");
				for ($j=0;$j<count($sd);$j++){
					if (!in_array($sd[$j],$da)){
						$url2=$url.$M_DATA_DIR."/".$md[$i]."/".$sd[$j];
						$dat=substr($sd[$j],0,4).". ".substr($sd[$j],4,2).". ".substr($sd[$j],6,2).".";
						echo("<tr class='df_tr'>");
						echo("<td class='df_td2'>$dat</td>");
						echo("<td class='df_td2'><a href=$url2>$M_ARCHIV_COM</td>");
						echo("</tr>");
					}
				}
				echo("</table>");
			}
		}
		button_go();
		echo("</div>");
	}
	echo("</div>");
}


?>
