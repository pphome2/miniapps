<?php

 #
 # MiniApp
 #
 # info: main folder copyright file
 #
 #



function m_partner(){
	global $M_PARTNER_FILE,$M_TABLE_PARTNER,$M_TABLE_JOB,$M_DEL,$M_NOFILE,
		$M_PARTNER_DEL,$M_PARTNER_NEW,$M_OK,$M_ERROR,$M_SUBMITBUTTON_TEXT,
		$M_PARTNER_NEWNAME;

	echo("<div class=content>");
	if (file_exists($M_PARTNER_FILE)){
		$f=file_get_contents($M_PARTNER_FILE, true);
		$d=explode(PHP_EOL,$f);
		sort($d);
		if (isset($_POST['cname'])){
			$n=$_POST['cname'];
			$out="";
			for($i=0;$i<count($d)-1;$i++){
				if($d[$i]<>$n){
					$out=$out.$d[$i].PHP_EOL;
				}
			}
			$fok=file_put_contents($M_PARTNER_FILE,$out);
			if ($fok){
				mess_ok($M_PARTNER_DEL.": ".$M_OK.".");
			}else{
				mess_error($M_PARTNER_DEL.": ".$M_ERROR.".");
			}
			$f=file_get_contents($M_PARTNER_FILE, true);
			$d=explode(PHP_EOL,$f);
		}
		if (isset($_POST['newname'])){
			$n=$_POST['newname'];
			$out=$f.$n.PHP_EOL;
			$fok=file_put_contents($M_PARTNER_FILE,$out);
			if ($fok){
				mess_ok($M_PARTNER_NEW.": ".$M_OK.".");
			}else{
				mess_error($M_PARTNER_NEW.": ".$M_ERROR.".");
			}
			$f=file_get_contents($M_PARTNER_FILE, true);
			$d=explode(PHP_EOL,$f);
		}
		echo("<form  name=ti id=ti method='post' enctype='multipart/form-data'>");
		echo("<div class=frow>");
		echo("<div class=fcol1>$M_PARTNER_NEWNAME");
		echo("</div>");
		echo("<div class=fcol2>");
		echo("<input type=text name=newname id=newname placeholder='$M_PARTNER_NEWNAME'>");
		echo("</div>");
		echo("</div>");
		echo("<input type='submit' value='$M_SUBMITBUTTON_TEXT' name='sub,itnew'>");
		echo("</form>");
		echo("<div class=spaceline></div>");
		echo("<center>");
		echo("<table class='df_table_full'>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th8'>$M_TABLE_PARTNER</th>");
		echo("<th class='df_th1'>$M_TABLE_JOB</th>");
		echo("</tr>");
		for($i=0;$i<count($d)-1;$i++){
			echo("<tr class='df_tr'>");
			echo("<td class='df_tdx4'>$d[$i]</td>");
			echo("<td class='df_tda2'>");
			echo("<form  name=t$i id=t$i method='post' enctype='multipart/form-data'>");
			echo("<input type=hidden name=cname id=cname value='$d[$i]'>");
			echo("<input class='' type='submit' value='$M_DEL' name='submitname'>");
			echo("</form>");
			echo("</td>");
			echo("</tr>");
		}
		echo("</table>");
		echo("</center>");
	}else{
		mess_error("!!!");
		echo($M_NOFILE);
	}
	echo("</div>");
	button_go();
}



function m_cargo(){
	global $M_CARGO_FILE,$M_TABLE_CARGO,$M_TABLE_JOB,$M_DEL,$M_NOFILE,
		$M_CARGO_DEL,$M_CARGO_NEW,$M_OK,$M_ERROR,$M_SUBMITBUTTON_TEXT,
		$M_CARGO_NEWNAME;

	echo("<div class=content>");
	if (file_exists($M_CARGO_FILE)){
		$f=file_get_contents($M_CARGO_FILE, true);
		$d=explode(PHP_EOL,$f);
		sort($d);
		if (isset($_POST['cname'])){
			$n=$_POST['cname'];
			$out="";
			for($i=0;$i<count($d)-1;$i++){
				if($d[$i]<>$n){
					$out=$out.$d[$i].PHP_EOL;
				}
			}
			$fok=file_put_contents($M_CARGO_FILE,$out);
			if ($fok){
				mess_ok($M_CARGO_DEL.": ".$M_OK.".");
			}else{
				mess_error($M_CARGO_DEL.": ".$M_ERROR.".");
			}
			$f=file_get_contents($M_CARGO_FILE, true);
			$d=explode(PHP_EOL,$f);
		}
		if (isset($_POST['newname'])){
			$n=$_POST['newname'];
			$out=$f.$n.PHP_EOL;
			$fok=file_put_contents($M_CARGO_FILE,$out);
			if ($fok){
				mess_ok($M_CARGO_NEW.": ".$M_OK.".");
			}else{
				mess_error($M_CARGO_NEW.": ".$M_ERROR.".");
			}
			$f=file_get_contents($M_CARGO_FILE, true);
			$d=explode(PHP_EOL,$f);
		}
		echo("<form  name=ti id=ti method='post' enctype='multipart/form-data'>");
		echo("<div class=frow>");
		echo("<div class=fcol1>$M_CARGO_NEWNAME");
		echo("</div>");
		echo("<div class=fcol2>");
		echo("<input type=text name=newname id=newname placeholder='$M_CARGO_NEWNAME'>");
		echo("</div>");
		echo("</div>");
		echo("<input type='submit' value='$M_SUBMITBUTTON_TEXT' name='sub,itnew'>");
		echo("</form>");
		echo("<div class=spaceline></div>");
		echo("<center>");
		echo("<table class='df_table_full'>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th8'>$M_TABLE_CARGO</th>");
		echo("<th class='df_th1'>$M_TABLE_JOB</th>");
		echo("</tr>");
		for($i=0;$i<count($d)-1;$i++){
			echo("<tr class='df_tr'>");
			echo("<td class='df_tdx4'>$d[$i]</td>");
			echo("<td class='df_tda2'>");
			echo("<form  name=t$i id=t$i method='post' enctype='multipart/form-data'>");
			echo("<input type=hidden name=cname id=cname value='$d[$i]'>");
			echo("<input class='' type='submit' value='$M_DEL' name='submitname'>");
			echo("</form>");
			echo("</td>");
			echo("</tr>");
		}
		echo("</table>");
		echo("</center>");
	}else{
		mess_error("!!!");
		echo($M_NOFILE);
	}
	echo("</div>");
	button_go();
}


?>
