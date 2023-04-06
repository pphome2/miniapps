<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #


function r_st2($pid,$iid){
	global $MA_SQL_RESULT,
		$R_P_TEXT,$R_I_TEXT,$R_IN_STAGE,$R_SELECT;

	echo("<h3>$R_IN_STAGE[2] </h3><br />");
	$sqlc="select * from r_partner where id=$pid;";
	$p="";
	if (sql_run($sqlc)){
		$dat=$MA_SQL_RESULT[0];
		echo("<h3>$R_P_TEXT $dat[1]</h3>");
		$p=$dat[1];
	}
	$sqlc="select * from r_cikk where id=$iid;";
	$c="";
	if (sql_run($sqlc)){
		$dat=$MA_SQL_RESULT[0];
		echo("<h3>$R_I_TEXT $dat[3]</h3>");
		$c=$dat[3];
	}
	r_initem($pid,$iid,$p,$c);
}


function r_initem($p,$c,$pn,$cn){
	global $MA_SQL_RESULT,$R_IN_FIELDS,$MA_ADMINFILE,
			$R_SAVE,$R_IN_TITLE_NEW,$R_IN_TITLE_CHANGE,
			$R_OK,$R_ERROR,$R_DEL_IN,$R_IN_NEWITEM,$R_IN_RESTART;

	$db=count($R_IN_FIELDS);
	$title=$R_IN_TITLE_NEW;
	$form=true;
	if (isset($_POST['0'])){
		$form=false;
		$line="";
		$da="'".$_POST[0]."'";
		for($i=1;$i<$db;$i++){
			$da=$da.", '".$_POST[$i]."'";
			$line=$line.$R_IN_FIELDS[$i]." - ".$_POST[$i]."<br />";
		}
		$sqlc="insert into r_bev (id,dat,besz,cikk,menny,ear,ertek,biz,megj,megr) values ($da);";
		if (sql_run($sqlc)){
			mess_ok($R_IN_TITLE_NEW.": ".$R_OK.".");
		}else{
			mess_error($R_IN_TITLE_NEW.": ".$R_ERROR.".");
		}
		echo("<br /><br />");
		echo($line);
		echo("<br /><br />");
	}
	if ($form){
		$d[0]=r_genid();
		$num=array(4,5,6);
		for($i=1;$i<$db;$i++){
			if(in_array($i,$num)){
				$d[$i]=0;
			}else{
				$d[$i]="";
			}
		}
		$d[1]=date('Y.m.d');
		$d[2]=$p;
		$d[3]=$c;
		echo("<div class=spaceline></div>");
		echo("<h3>$title</h3>");
		echo("<div class=spaceline></div>");
		echo("<form id=1 name=1 method=post>");
		echo("<input type=hidden id=pid name=pid value='$p'>");
		echo("<input type=hidden id=iid name=iid value='$c'>");
		echo("<input type=hidden id=0 name=0 value='$d[0]'>");
		$rof=array(1,2,3);
		$num=array(4,5,6);
		$numscr="oninput=\"this.value = this.value.replace(/[^0-9.,]/g, '').replace(/(\..*?)\..*/g, '$1');\"";
		for($i=1;$i<$db;$i++){
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
			echo("<div class=fcol1>$R_IN_FIELDS[$i]");
			echo("</div>");
			echo("<div class=fcol2>");
			echo("<input type=text id=$i name=$i placeholder='$R_IN_FIELDS[$i]' value='$d[$i]' $ro $s>");
			echo("</div>");
			echo("</div>");
		}
		echo("<div class=frow><br /></div>");
		echo("<input type=hidden id=id name=id value=\"$d[0]\">");
		echo("<input type=submit id=newi name=newi value=\"$R_SAVE\">");
		echo("</form>");
	}else{
		echo("<form id=2 name=2 method=post>");
		echo("<input type=hidden id=pid name=pid value=\"$p\">");
		echo("<input type=submit id=newb name=newb value=\"$R_IN_NEWITEM\">");
		echo("</form>");
		echo("<form id=3 name=3 method=post>");
		echo("<input type=submit id=newb name=newb value=\"$R_IN_RESTART\">");
		echo("</form>");
	}
}


?>
