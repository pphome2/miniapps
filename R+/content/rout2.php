<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #


function r_outst2($rid,$iid){
	global $MA_SQL_RESULT,
		$R_R_TEXT,$R_I_TEXT,$R_OUT_STAGE,$R_SELECT;

	echo("<h3>$R_OUT_STAGE[2] </h3><br />");
	$sqlc="select * from r_raktar where id=$rid;";
	$p="";
	if (sql_run($sqlc)){
		$dat=$MA_SQL_RESULT[0];
		$p=$dat[1];
		echo("<h3>$R_R_TEXT $dat[1]</h3>");
	}
	$sqlc="select * from r_cikk where id=$iid;";
	$c="";
	if (sql_run($sqlc)){
		$dat=$MA_SQL_RESULT[0];
		$c=$dat[3];
		echo("<h3>$R_I_TEXT $dat[3]</h3>");
	}
	r_outitem($rid,$iid);
}


function r_outitem($r,$c){
	global $MA_SQL_RESULT,$R_OUT_FIELDS,$MA_ADMINFILE,$R_OUT_NEWITEM,
			$R_SAVE,$R_OK,$R_ERROR,$R_OUT_RESTART,$R_OUT_TITLE_NEW,$R_OUT_NOITEM;

	$db=count($R_OUT_FIELDS);
	$title=$R_OUT_TITLE_NEW;
	$form=true;
	if (isset($_POST[0])){
		$form=false;
		$sqlc="select * from r_keszlet where cikk=$_POST[3] and rakt=$_POST[2];";
		sql_run($sqlc);
		echo($sqlc);
		if (count($MA_SQL_RESULT)>0){
			$kesz=$MA_SQL_RESULT;
			$da="'".$_POST[0]."'";
			$da=$da.",'".$_POST[1]."'";
			$da=$da.",'".$_POST[3]."'";
			$da=$da.",'".$_POST[4]."'";
			$da=$da.",'".$_POST[5]."'";
			$da=$da.",'".$_POST[7]."'";
			$da=$da.",'".$_POST[6]."'";
			$da=$da.",'".$_POST[2]."'";
			$sqlc="insert into r_kiad (id,dat,cikk,menny,biz,klt,megj,rakt) values ($da);";
			if (sql_run($sqlc)){
				$ok=true;
				mess_ok($R_OUT_TITLE_NEW.": ".$R_OK.".");
			}else{
				$ok=true;
				mess_error($R_OUT_TITLE_NEW.": ".$R_ERROR.".");
			}
			if ($ok){
				$du=$kesz[0];
				$m=intval($du[3])-intval($_POST[4]);
				$sqlc="update r_keszlet set id=$du[0],cikk=$du[1],rakt=$du[2],menny=$m,ukid=\"$_POST[1]\",ubev=\"$du[5]\",ear=$du[6] where id=$du[0];";
				echo($sqlc);
				if (sql_run($sqlc)){
					mess_ok($R_OUT_TITLE_NEW.": ".$R_OK.".");
				}else{
					mess_error($R_OUT_TITLE_NEW.": ".$R_ERROR.".");
				}
			}
		}else{
			mess_error($R_OUT_TITLE_NEW.": ".$R_OUT_NOITEM.".");
		}
		$line="";
		$da="'".$_POST[0]."'";
		for($i=1;$i<$db;$i++){
			$da=$da.", '".$_POST[$i]."'";
			$line=$line.$R_OUT_FIELDS[$i]." - ".$_POST[$i]."<br />";
		}
		echo("<br /><br />");
		echo($line);
		echo("<br /><br />");
	}
	if ($form){
		$d[0]=r_genid();
		$num=array(4);
		for($i=1;$i<$db;$i++){
			if(in_array($i,$num)){
				$d[$i]=0;
			}else{
				$d[$i]="";
			}
		}
		$d[1]=date('Y.m.d');
		$d[2]=$r;
		$d[3]=$c;
		#echo("<div class=spaceline></div>");
		#echo("<h3>$title</h3>");
		#echo("<div class=spaceline></div>");
		echo("<form id=1 name=1 method=post>");
		echo("<input type=hidden id=rid name=rid value='$r'>");
		echo("<input type=hidden id=iid name=iid value='$c'>");
		echo("<input type=hidden id=0 name=0 value='$d[0]'>");
		echo("<h3>$R_OUT_STAGE[2] </h3><br />");
		$rof=array(1,2,3);
		$num=array(4);
		$numscr="oninput=\"this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');\"";
		for($i=1;$i<$db-1;$i++){
			if (in_array($i,$rof)){
				$ro="readonly";
			}else{
				$ro="";
			}
			if (in_array($i,$num)){
				$s="oninput=\"this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');\"";
			}else{
				$s="";
			}
			echo("<div class=frow>");
			echo("<div class=fcol1>$R_OUT_FIELDS[$i]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<input type=text id=$i name=$i placeholder='$R_OUT_FIELDS[$i]' value='$d[$i]' $ro $s>");
			echo("</div>");
			echo("</div>");
		}
		echo("<div class=frow>");
		echo("<div class=fcol1>$R_OUT_FIELDS[$i]");
		echo("</div>");
		echo("<div class=fcol2>");
		$sqlc="select * from r_kolt;";
		sql_run($sqlc);
		echo("<select id=$i name=$i>");
		for($x=0;$x<count($MA_SQL_RESULT);$x++){
			$d=$MA_SQL_RESULT[$x];
			echo("<option value='$d[0]'>$d[1]</option>");
		}
		echo("</select>");
		echo("</div>");
		echo("</div>");
		echo("<div class=frow><br /></div>");
		echo("<input type=hidden id=id name=id value=\"$d[0]\">");
		echo("<input type=submit id=newi name=newi value=\"$R_SAVE\">");
		echo("</form>");
	}else{
		echo("<form id=2 name=2 method=post>");
		echo("<input type=hidden id=rid name=rid value=\"$r\">");
		echo("<input type=submit id=newb name=newb value=\"$R_OUT_NEWITEM\">");
		echo("</form>");
		echo("<form id=3 name=3 method=post>");
		echo("<input type=submit id=newb name=newb value=\"$R_OUT_RESTART\">");
		echo("</form>");
	}
}


?>
