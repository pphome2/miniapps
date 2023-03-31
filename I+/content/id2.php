<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #



function i_docdel(){
	global $I_DOCTITLE_DEL,$I_OK,$I_ERROR;

		if (isset($_POST['idd'])){
			$id=$_POST['idd'];
			$sqlc="delete from ik_doc where id=$id;";
			#echo($sqlc);
			if (sql_run($sqlc)){
				mess_ok($I_DOCTITLE_DEL.": ".$I_OK.".");
			}else{
				mess_error($I_DOCTITLE_DEL.": ".$I_ERROR.".");
			}
		}
}



function i_docdata($new){
	global $MA_SQL_RESULT,$I_DOC_FIELDS,$MA_ADMINFILE,$I_FILEFROMSCANNER,
			$I_SAVE,$I_DOCTITLE_NEW,$I_DOCTITLE_CHANGE,
			$I_OK,$I_ERROR,$I_DELDOC,$I_DOCFROMPARTNER,
			$I_MONEYTYPE,$I_SITE,$I_FILESTORE,$I_FILECOUNTLIMIT;

	$db=count($I_DOC_FIELDS);
	if ($new){
		if (isset($_POST['0'])){
			i_genid($_POST['1']);
			if (!is_numeric($_POST[5])){
				$_POST[5]=0;
			}
			if (substr($_POST[15],0,strlen($I_FILEFROMSCANNER))===$I_FILEFROMSCANNER){
				$sqlc="select * from ik_partner where id=$_POST[4];";
				if (sql_run($sqlc)){
					$d=$MA_SQL_RESULT[0];
					$fn=date('Ymd')." - ".$d[1]." ".date('His').".pdf";
                    $f1=$I_FILESTORE."/".$_POST[15];
                    $f2=$I_FILESTORE."/".$fn;
                    if (!rename("$f1","$f2")){
                      $fn=$_POST[15];
                    }
				}else{
					$fn=$_POST[15];
				}
			}else{
				$fn=$_POST[15];
			}
			$sqlc="insert into ik_doc (id,sorsz,datum,szsz,partner,ossz,pnem,kat,kiall,fhat,fiz,atad,telep,bank,megj,fajl) ";
			$sqlc=$sqlc."values ('$_POST[0]','$_POST[1]','$_POST[2]','$_POST[3]',$_POST[4],$_POST[5],'$_POST[6]',$_POST[7],";
			$sqlc=$sqlc."'$_POST[8]','$_POST[9]','$_POST[10]','$_POST[11]','$_POST[12]','$_POST[13]','$_POST[14]','$fn');";
			#echo($sqlc);
			if (sql_run($sqlc)){
				mess_ok($I_DOCTITLE_NEW.": ".$I_OK.".");
			}else{
				mess_error($I_DOCTITLE_NEW.": ".$I_ERROR.".");
			}
		}
		$d[0]=date('YmdHis');
		$d[1]=i_genid();
		for($i=2;$i<$db;$i++){
			$d[$i]="";
		}
		$d[2]=date('Y-m-d');
		$d[4]=$_POST[4];
		$d[5]=0;
		echo("<h3>$I_DOCTITLE_NEW<h3>");
		if (isset($_POST['ndid'])){
			$idp=$_POST['ndid'];
			$sqlc="select * from ik_partner where id=$idp;";
			if (sql_run($sqlc)){
				$dp=$MA_SQL_RESULT[0];
				echo("<h3>$I_DOCFROMPARTNER $dp[1]</h3>");
				$d[4]=$idp;
			}
		}
	}else{
		echo("<h3>$I_DOCTITLE_CHANGE</h3>");
		if (isset($_POST['id'])){
			if (isset($_POST['id2'])){
				if (substr($_POST[15],0,strlen($I_FILEFROMSCANNER))===$I_FILEFROMSCANNER){
					$sqlc="select * from ik_partner where id=$_POST[4];";
					if (sql_run($sqlc)){
						$d=$MA_SQL_RESULT[0];
					    $fn=date('Ymd')." - ".$d[1]." ".date('His').".pdf";
                        $f1=$I_FILESTORE."/".$_POST[15];
                        $f2=$I_FILESTORE."/".$fn;
                        if (!rename("$f1","$f2")){
                          $fn=$_POST[15];
                        }
					}else{
						$fn=$_POST[15];
					}
				}else{
					$fn=$_POST[15];
				}
				$id2=$_POST['id2'];
				$sqlc="update ik_doc set";
				$sqlc=$sqlc." id = ".$_POST[0].", ";
				$sqlc=$sqlc." sorsz = \"$_POST[1]\", ";
				$sqlc=$sqlc." datum = \"$_POST[2]\", ";
				$sqlc=$sqlc." szsz = \"$_POST[3]\", ";
				$sqlc=$sqlc." partner = $_POST[4], ";
				if (!is_numeric($_POST[5])){
					$sqlc=$sqlc." ossz = 0, ";
				}else{
					$sqlc=$sqlc." ossz = $_POST[5], ";
				}
				$sqlc=$sqlc." pnem = \"$_POST[6]\", ";
				$sqlc=$sqlc." kat = $_POST[7], ";
				$sqlc=$sqlc." kiall = \"$_POST[8]\", ";
				$sqlc=$sqlc." fhat = \"$_POST[9]\", ";
				$sqlc=$sqlc." fiz = \"$_POST[10]\", ";
				$sqlc=$sqlc." atad = \"$_POST[11]\", ";
				$sqlc=$sqlc." telep = \"$_POST[12]\", ";
				$sqlc=$sqlc." bank = \"$_POST[13]\", ";
				$sqlc=$sqlc." megj = \"$_POST[14]\", ";
				$sqlc=$sqlc." fajl = \"$fn\" ";
				$sqlc=$sqlc." where id=$id2;";
				if (sql_run($sqlc)){
					mess_ok($I_DOCTITLE_CHANGE.": ".$I_OK.".");
				}else{
					mess_error($I_DOCTITLE_CHANGE.": ".$I_ERROR.".");
				}
			}
			$id=$_POST['id'];
			$sqlc="select * from ik_doc where id=$id;";
			if (sql_run($sqlc)){
				$r=$MA_SQL_RESULT[0];
				for($i=0;$i<$db;$i++){
					$d[$i]=$r[$i];
				}
			}else{
				$d[0]=date('YmdHis');
				for($i=1;$i<$db;$i++){
					$d[$i]="";
				}
				$d[2]=date('Y-m-d');
				echo($d[2]);
			}
			$sqlc="select * from ik_partner where id=$d[4];";
			if (sql_run($sqlc)){
				$dp=$MA_SQL_RESULT[0];
				echo("<h3>$I_DOCFROMPARTNER $dp[1]</h3>");
			}
		}
	}
	echo("<div class=spaceline></div>");
	echo("<form method=post>");
	echo("<input type=hidden id=0 name=0 value='$d[0]'>");
	$dat=array(2,8,9,10,11);
	$self=array(6,7,12,15);
	$rof=array(1,4);
	for($i=1;$i<$db;$i++){
		echo("<div class=frow>");
		echo("<div class=fcol1>$I_DOC_FIELDS[$i]");
		echo("</div>");
		echo("<div class=fcol2>");
		if (in_array($i,$self)){
			if ($i===6){
				echo("<select id=$i name=$i>");
				echo("<option value=\"\"></option>");
				$dbl=count($I_MONEYTYPE);
				for($j=0;$j<$dbl;$j++){
					if ($d[$i]===$I_MONEYTYPE[$j]){
						$sel="selected";
					}else{
						$sel="";
					}
					echo("<option value=\"$I_MONEYTYPE[$j]\" $sel>$I_MONEYTYPE[$j]</option>");
				}
				echo("</select>");
			}
			if ($i===7){
				echo("<select id=$i name=$i>");
				#echo("<option value=\"\"></option>");
				$sqlc="select * from ik_cat order by kod;";
				sql_run($sqlc);
				$dbl=count($MA_SQL_RESULT);
				for($j=0;$j<$dbl;$j++){
					$cl=$MA_SQL_RESULT[$j];
					if ($d[$i]==$cl[0]){
						$sel="selected";
					}else{
						$sel="";
					}
					echo("<option value=\"$cl[0]\" $sel>$cl[2]</option>");
				}
				echo("</select>");
			}
			if ($i===12){
				echo("<select id=$i name=$i>");
				echo("<option value=\"\"></option>");
				$dbl=count($I_SITE);
				for($j=0;$j<$dbl;$j++){
					if ($d[$i]===$I_SITE[$j]){
						$sel="selected";
					}else{
						$sel="";
					}
					echo("<option value=\"$I_SITE[$j]\" $sel>$I_SITE[$j]</option>");
				}
				echo("</select>");
			}
			if ($i===15){
				echo("<select id=$i name=$i>");
				echo("<option value=\"\"></option>");
				#echo("<option value=\"$d[$i]\">$d[$i]</option>");
				#$fl=scandir($I_FILESTORE);
				$fl=glob("$I_FILESTORE/*.pdf");
				usort($fl,function($a,$b){
					return filemtime($b)-filemtime($a);
				});
				$dbl=count($fl);
				if ($db1>$I_FILECOUNTLIMIT){
					$db1=$I_FILECOUNTLIMIT;
				}
				for($j=0;$j<$dbl;$j++){
					$fn=explode("/",$fl[$j]);
					if (substr($fn[1],0,1)<>"."){
						if ($d[$i]===$fn[1]){
							$sel="selected";
						}else{
							$sel="";
						}
						echo("<option value=\"$fn[1]\" $sel>$fn[1]</option>");
					}
				}
				echo("</select>");
			}
		}else{
			if (in_array($i,$rof)){
				$ro="readonly";
			}else{
				$ro="";
			}
			if (in_array($i,$dat)){
				echo("<input type=date id=$i name=$i placeholder='$I_DOC_FIELDS[$i]' value='$d[$i]' $ro>");
			}else{
				echo("<input type=text id=$i name=$i placeholder='$I_DOC_FIELDS[$i]' value='$d[$i]' $ro>");
			}
		}
		echo("</div>");
		echo("</div>");
	}
	echo("<div class=frow><br /></div>");
	if ($new){
		echo("<input type=hidden id=id name=id value=\"$d[0]\">");
		echo("<input type=submit id=newd name=newd value=\"$I_SAVE\">");
		echo("</form>");
	}else{
		echo("<input type=hidden id=id name=id value=\"$d[0]\">");
		echo("<input type=hidden id=id2 name=id2 value=\"$d[0]\">");
		echo("<input type=submit id=chd name=chd value=\"$I_SAVE\">");
		echo("</form>");
		echo("<div class=frow><br /></div>");
		echo("<form method=post>");
		echo("<input type=hidden id=idd name=idd value=\"$d[0]\">");
		echo("<input  type=submit id=deld name=deld value=\"$I_DELDOC\">");
		echo("</form>");
	}
}


?>
