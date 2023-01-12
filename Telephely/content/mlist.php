<?php

 #
 # MiniApp
 #
 # info: main folder copyright file
 #
 #


function m_list(){
	global $M_LIST_TYPE,$M_LIST_TYPETITLE,$M_LIST_DATE_1,$M_LIST_DATE_2,
			$M_SUBMITBUTTON_TEXT,$M_DATA_DIR,$M_SEPARATOR,$M_LIST_TABLE;

	echo("<div class=content>");
	if (isset($_POST['submitdate'])){
		$d1=intval(str_replace("-","",$_POST['d1']));
		$d2=intval(str_replace("-","",$_POST['d2']));
		$ty=$_POST['type'];
		$dx1=substr($d1,0,4).". ".substr($d1,4,2).". ".substr($d1,6,2).".";
		$dx2=substr($d2,0,4).". ".substr($d2,4,2).". ".substr($d2,6,2).".";
		echo("$ty ($dx1 - $dx2)");
		$dy=$M_DATA_DIR."/".date('Y');
		$md=scandir($dy,SCANDIR_SORT_DESCENDING);
		$store=array();
		$j=0;
		for ($i=0;$i<count($md);$i++){
			if ((intval($md[$i])>=$d1)and(intval($md[$i])<=$d2)){
				$dat=substr($md[$i],0,4).". ".substr($md[$i],4,2).". ".substr($md[$i],6,2).".";
				#echo($dat." + $dy/$md[$i]</br>");
				$f=file_get_contents("$dy/$md[$i]",true);
				$d=explode(PHP_EOL,$f);
				$ok=0;
				for($k=0;$k<count($d)-1;$k++){
					$dr=explode($M_SEPARATOR,$d[$k]);
					#$store[$j]=array("$dr[0]","$dr[1]","$dr[2]","$dr[3]","$dr[4]",
					#				"$dr[5]","$dr[6]","$dr[7]","$dr[8]","$dr[9]",
					#				"$dr[10]","$dr[11]","$dr[12]");
					$store[$j]=$dr;
					echo("");
					$j++;
				}
			}
		}
		switch ($ty){
			case $M_LIST_TYPE[0]:
				$col1=array_column($store,'4');
				$col2=array_column($store,'7');
				array_multisort($col1,SORT_ASC,$col2,SORT_ASC,$store);
				$part="";
				for($i=0;$i<$j;$i++){
					$n=$store[$i];
					if ($part!=$n[4]){
						if ($part!=""){
							echo("</table>");
						}
						$part=$n[4];
						echo("<div class=spaceline></div>");
						echo("<table class='df_table_full'>");
						echo("<tr class='df_trh'>");
						echo("<th class='df_th1'>$part</th>");
						echo("<th class='df_th4'>$M_LIST_TABLE[0]</th>");
						echo("<th class='df_th4'>$M_LIST_TABLE[3]</th>");
						echo("<th class='df_th4'>$M_LIST_TABLE[2]</th>");
						echo("<th class='df_th4'>$M_LIST_TABLE[4]</th>");
						echo("</tr>");
					}
					$s1=str_replace(',', '.', $n[11]);
					$s2=str_replace(',', '.', $n[10]);
					$s3=$s1-$s2;
					$c=str_replace('.', ',', $s3);
					echo("<tr class='df_tr'>");
					echo("<td class='df_td2'>$n[0]</td>");
					echo("<td class='df_td2'>$n[2]</td>");
					echo("<td class='df_td2'>$n[5]</td>");
					echo("<td class='df_td2'>$n[7]</td>");
					echo("<td class='df_td2'>$c</td>");
					echo("</tr>");
				}
				if ($part!=""){
					echo("</table>");
				}
				break;
			case $M_LIST_TYPE[1]:
				$col1=array_column($store,'7');
				$col2=array_column($store,'4');
				array_multisort($col1,SORT_ASC,$col2,SORT_ASC,$store);
				$part="";
				for($i=0;$i<$j;$i++){
					$n=$store[$i];
					if ($part!=$n[7]){
						if ($part!=""){
							echo("</table>");
						}
						$part=$n[7];
						echo("<div class=spaceline></div>");
						echo("<table class='df_table_full'>");
						echo("<tr class='df_trh'>");
						echo("<th class='df_th4'>$part</th>");
						echo("<th class='df_th4'>$M_LIST_TABLE[0]</th>");
						echo("<th class='df_th1'>$M_LIST_TABLE[1]</th>");
						echo("<th class='df_th4'>$M_LIST_TABLE[3]</th>");
						echo("<th class=''>$M_LIST_TABLE[4]</th>");
						echo("</tr>");
					}
					$s1=str_replace(',', '.', $n[11]);
					$s2=str_replace(',', '.', $n[10]);
					$s3=$s1-$s2;
					$c=str_replace('.', ',', $s3);
					echo("<tr class='df_tr'>");
					echo("<td class='df_td2'>$n[0]</td>");
					echo("<td class='df_td2'>$n[2]</td>");
					echo("<td class='df_td2'>$n[4]</td>");
					echo("<td class='df_td2'>$n[5]</td>");
					echo("<td class='df_td2'>$c</td>");
					echo("</tr>");
				}
				if ($part!=""){
					echo("</table>");
				}
				break;
		}
	}else{
		$datety=date('Y').'-01-01';
		$date=date('Y-m-d');
		echo("<form  method='post' enctype='multipart/form-data'>");
		echo("<div class=frow>");
		echo("<div class=fcol1>$M_LIST_DATE_1");
		echo("</div>");
		echo("<div class=fcol2>");
		echo("<input type=date name=d1 id=d1 placeholder='$date' value='$date' min='$datety' max='$date' required");
		echo("</div>");
		echo("</div>");
		echo("<div class=frow>");
		echo("<div class=fcol1>$M_LIST_DATE_2");
		echo("</div>");
		echo("<div class=fcol2>");
		echo("<input type=date name=d2 id=d2 placeholder='$date' value='$date' min='$datety' max='$date' required>");
		echo("</div>");
		echo("</div>");
		echo("<div class=frow>");
		echo("<div class=fcol1>$M_LIST_TYPETITLE");
		echo("</div>");
		echo("<div class=fcol2>");
		echo("<select name='type' id='type'>");
		$db=count($M_LIST_TYPE);
		for ($i=$db-1;$i>=0;$i--){
			echo("<option>$M_LIST_TYPE[$i]</option>");
		}
		echo("</select>");
		echo("</div>");
		echo("</div>");
		echo("</div>");
		echo("<input type='submit' value='$M_SUBMITBUTTON_TEXT' name='submitdate'>");
		echo("</form>");
		button_go();
	}
	echo("</div>");
}


?>
