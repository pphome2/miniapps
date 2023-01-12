<?php

 #
 # MiniApp
 #
 # info: main folder copyright file
 #
 #


function m_table(){
	if (isset($_POST['submitcode'])){
		m_close();
	}else{
		if (isset($_POST['submitprint'])){
			m_print();
		}else{
			m_table2();
		}
	}
}



function m_close(){
	global $M_TODAY_FILE,$M_CARGO_FILE,$M_PARTNER_FILE,$M_SEPARATOR,$M_NEW,
		$M_SUBMITBUTTON_TEXT,$M_CLOSECAR,$M_CLOSEDATA,$M_OK,$M_ERROR;

	echo("<div class=content>");
	$f=file_get_contents($M_TODAY_FILE, true);
	$d=explode(PHP_EOL,$f);
	$f2=file_get_contents($M_CARGO_FILE, true);
	$cargo=explode(PHP_EOL,$f2);
	sort($cargo);
	$f3=file_get_contents($M_PARTNER_FILE, true);
	$partner=explode(PHP_EOL,$f3);
	sort($partner);
	$id=$_POST['id'];
	$ok=0;
	for($i=0;$i<count($d)-1;$i++){
		$dr=explode($M_SEPARATOR,$d[$i]);
		if ($dr[0]==$id){
			$ok=$i;
			$data=$dr;
		}
	}
	if ($i<>0){
		if (isset($_POST['br'])){
			$data[2]=$_POST['tt'];
			$data[4]=$_POST['partner'];
			$data[5]=$_POST['rsz'];
			$data[6]=$_POST['rszp'];
			$data[7]=$_POST['aru1'];
			$data[8]=$_POST['aru2'];
			$data[9]=$_POST['aru3'];
			$data[10]=$_POST['ur'];
			if ($data[10]==""){
				$data[10]="0";
			}
			$data[11]=$_POST['br'];
			if ($data[11]==""){
				$data[11]="0";
			}
			$data[12]=$_POST['meg'];
			for ($i=0;$i<count($data);$i++){
				echo("$M_NEW[$i] - $data[$i] <br />");
			}
			echo("<div class=spaceline></div>");
			$d[$ok]="";
			for($i=0;$i<count($data);$i++){
				$d[$ok]=$d[$ok].$data[$i].$M_SEPARATOR;
			}
			$out="";
			for($i=0;$i<count($d)-1;$i++){
				$out=$out.$d[$i].PHP_EOL;
			}
			$fok=file_put_contents($M_TODAY_FILE,$out);
			if ($fok){
				mess_ok($M_CLOSEDATA.": ".$M_OK.".");
			}else{
				mess_error($M_CLOSEDATA.": ".$M_ERROR.".");
			}
		}else{
			echo($M_CLOSECAR);
			echo("<div class=spaceline></div>");
			echo($data[1]."<br />");
			echo($data[3]."<br />");
			echo("<div class=spaceline></div>");
			echo("<form  method='post' enctype='multipart/form-data'>");
			$date=date('Y. m. d. H:i');
			echo("<div class=frow>");
			echo("<input type=hidden name=id id=id value='$id' readonly>");
			echo("<div class=fcol1>$M_NEW[2]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<input type=text name=tt id=tt placeholder='' value='$date' readonly>");
			echo("</div>");
			echo("</div>");
			echo("<div class=frow>");
			echo("<div class=fcol1>$M_NEW[4]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<select name='partner' id='partner'>");
			$db=count($partner)-1;
			for ($i=0;$i<$db;$i++){
				if ("$partner[$i]"==="$data[4]"){
					$sel="selected";
				}else{
					$sel="";
				}
				echo("<option $sel>$partner[$i]</option>");
			}
			echo("</select>");
			echo("</div>");
			echo("</div>");
			echo("<div class=frow>");
			echo("<div class=fcol1>$M_NEW[5]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<input type=text name=rsz id=rsz placeholder='$data[5]' value='$data[5]'>");
			echo("</div>");
			echo("</div>");
			echo("<div class=frow>");
			echo("<div class=fcol1>$M_NEW[6]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<input type=text name= rszp id=rszp placeholder='$data[6]' value='$data[6]'>");
			echo("</div>");
			echo("</div>");
			echo("<div class=frow>");
			echo("<div class=fcol1>$M_NEW[7]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<select name='aru1' id='aru1'>");
			$db=count($cargo)-1;
			for ($i=0;$i<$db;$i++){
				if ("$cargo[$i]"==="$data[7]"){
					$sel="selected";
				}else{
					$sel="";
				}
				echo("<option $sel>$cargo[$i]</option>");
			}
			echo("</select>");
			echo("</div>");
			echo("</div>");
			echo("<div class=frow>");
			echo("<div class=fcol1>$M_NEW[8]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<select name='aru2' id='aru2'>");
			$db=count($cargo)-1;
			for ($i=0;$i<$db;$i++){
				if ("$cargo[$i]"==="$data[8]"){
					$sel="selected";
				}else{
					$sel="";
				}
				echo("<option $sel>$cargo[$i]</option>");
			}
			echo("</select>");
			echo("</div>");
			echo("</div>");
			echo("<div class=frow>");
			echo("<div class=fcol1>$M_NEW[9]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<select name='aru3' id='aru3'>");
			$db=count($cargo)-1;
			for ($i=0;$i<$db;$i++){
				if ("$cargo[$i]"=="$data[9]"){
					$sel="selected";
				}else{
					$sel="";
				}
				echo("<option $sel>$cargo[$i]</option>");
			}
			echo("</select>");
			echo("</div>");
			echo("</div>");
			echo("<div class=frow>");
			echo("<div class=fcol1>$M_NEW[10]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<input type=text name=ur id=ur placeholder='$M_NEW[10]' value='$data[10]'>");
			echo("</div>");
			echo("</div>");
			echo("<div class=frow>");
			echo("<div class=fcol1>$M_NEW[11]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<input type=text name=br id=br placeholder='$M_NEW[11]' value='$data[11]'>");
			echo("</div>");
			echo("</div>");
			echo("<div class=frow>");
			echo("<div class=fcol1>$M_NEW[12]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<input type=text name=meg id=meg placeholder='$M_NEW[12]' value='$data[12]'>");
			echo("</div>");
			echo("</div>");
			echo("<input type='submit' value='$M_SUBMITBUTTON_TEXT' name='submitcode'>");
			echo("</form>");
		}
	}else{
		mess_error("!!!");
	}
	button_go();
	echo("</div>");
}



function m_table2(){
	global $M_TODAY_FILE,$M_TABLE_TITLE,$M_DEL,$M_CLOSE,$M_SEPARATOR,
		$M_NOFILE,$M_INCAR,$M_OUTCAR,$M_PRINT,$M_ID_FIELD,$MA_PRINTFILE;

	echo("<div class=content>");
	if (file_exists($M_TODAY_FILE)){
		$f=file_get_contents($M_TODAY_FILE, true);
		$d=explode(PHP_EOL,$f);
		$incar=0;
		for($i=0;$i<count($d)-1;$i++){
			$dr=explode($M_SEPARATOR,$d[$i]);
			if ($dr[2]==""){
				$incar++;
			}
		}
		echo("$M_INCAR: $incar");
		echo("<div class=spaceline></div>");
		echo("<center>");
		echo("<table class='df_table_full'>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th2'>$M_TABLE_TITLE[0]</th>");
		echo("<th class='df_th3'>$M_TABLE_TITLE[1]</th>");
		echo("<th class='df_th1'>$M_TABLE_TITLE[2]</th>");
		echo("<th class='df_th0'>$M_TABLE_TITLE[3]</th>");
		echo("</tr>");
		for($i=0;$i<count($d)-1;$i++){
			$dr=explode($M_SEPARATOR,$d[$i]);
			echo("<tr class='df_tr'>");
			if ($dr[2]==""){
				echo("<td class='df_tdx4'>$dr[1]</td>");
			}else{
				echo("<td class='df_tdx4'>$dr[1] / $dr[2]</td>");
			}
			echo("<td class='df_tdx4'>$dr[5]</td>");
			echo("<td class='df_tdx3'>$dr[4]</td>");
			if ($dr[2]==""){
				echo("<form name=t$i id=t$i method='post' enctype='multipart/form-data'>");
				echo("<input type=hidden name=id id=id value=$dr[0]>");
				echo("<td class='df_tda2'>");
				echo("<input class='' type='submit' value='$M_CLOSE' name='submitcode'>");
				echo("</td>");
				echo("</form>");
			}else{
				#echo("<form name=t$i id=t$i method='post' enctype='multipart/form-data'>");
				#echo("<input type=hidden name=id id=id value=$dr[0]>");
				#echo("<td class='df_tda2'>");
				#echo("<input class='' type='submit' value='$M_PRINT' name='submitprint'>");
				#echo("</td>");
				#echo("</form>");
				#echo("<td class='df_tda3'>$M_OUTCAR</td>");
				echo("<td class='df_tda3'><a href=$MA_PRINTFILE?$M_ID_FIELD=$dr[0]>$M_PRINT</a></td>");
			}
			echo("</tr>");
		}
		echo("</table>");
		echo("</center>");
	}else{
		#mess_error("!!!");
		echo($M_NOFILE);
	}
	echo("</div>");
}



?>
