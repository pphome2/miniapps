<?php

 #
 # GK
 #
 # info: main folder copyright file
 #
 #

function gk_genid(){
	$id=date('YmdHis');
	return($id);
}



function gk_del(){
	global $GK_TITLE_DEL,$GK_OK,$GK_ERROR;

	if (isset($_POST['idd'])){
		$id=$_POST['idd'];
		$sqlc="delete from gk_data where id=$id;";
		#echo($sqlc);
		if (sql_run($sqlc)){
			mess_ok($GK_TITLE_DEL.": ".$GK_OK.".");
		}else{
			mess_error($GK_TITLE_DEL.": ".$GK_ERROR.".");
		}
	}
}



function gk_alldata($new){
	global $MA_SQL_RESULT,$GK_FIELDS,$MA_ADMINFILE,
			$GK_SAVE,$GK_TITLE_NEW,$GK_TITLE_CHANGE,
			$GK_OK,$GK_ERROR,$GK_DEL,$MA_USERNAME;

	$db=count($GK_FIELDS);
	$form=true;
	if ($new){
		$title=$GK_TITLE_NEW;
		if (isset($_POST['0'])){
			$form=false;
			$num=array(7,9,10,11,14);
			$da="'".$_POST[0]."'";
			for($i=1;$i<$db;$i++){
			    if (in_array($i,$num)){
			        if ($_POST[$i]<>""){
				        $da=$da.", ".$_POST[$i];
				    }else{
				        $da=$da.", 0";
				    }
                }else{
				    $da=$da.", \"".$_POST[$i]."\"";
				}
			}
			$sqlc="insert into gk_data (id,model,rsz,tip,gyev,forg,muszerv,km,tulaj,besz,vcsperkm,vcskm,vcsdat,olajdat,olajkm,megj,felh) values ($da);";
			#echo($sqlc);
			if (sql_run($sqlc)){
				mess_ok($GK_TITLE_NEW.": ".$GK_OK.".");
			}else{
				mess_error($GK_TITLE_NEW.": ".$GK_ERROR.".");
			}
		}
		$d[0]=gk_genid();
		$d[1]=date('Y.m.d');
		for($i=2;$i<$db;$i++){
			$d[$i]="";
		}
	}else{
		$title=$GK_TITLE_CHANGE;
		if (isset($_POST['id'])){
			$id=$_POST['id'];
		    if (isset($_POST[0])){
    			$form=false;
	    		$sqlc="update gk_data set";
		    	$sqlc=$sqlc." id = ".$_POST[0].", ";
			    $sqlc=$sqlc." model = \"$_POST[1]\", ";
      			$sqlc=$sqlc." rsz = \"$_POST[2]\", ";
	    		$sqlc=$sqlc." tip = \"$_POST[3]\", ";
		    	$sqlc=$sqlc." gyev = \"$_POST[4]\", ";
			    $sqlc=$sqlc." forg = \"$_POST[5]\", ";
    			$sqlc=$sqlc." muszerv = \"$_POST[6]\", ";
	    		$szam=intval($_POST[7]);
		    	$sqlc=$sqlc." km = $szam, ";
			    $sqlc=$sqlc." tulaj = \"$_POST[8]\", ";
    			$sqlc=$sqlc." besz = \"$_POST[9]\", ";
	    		$szam=intval($_POST[10]);
		    	$sqlc=$sqlc." vcsperkm = $szam, ";
			    $szam=intval($_POST[11]);
    			$sqlc=$sqlc." vcskm = $szam, ";
	    		$sqlc=$sqlc." vcsdat = \"$_POST[12]\", ";
		    	$sqlc=$sqlc." olajdat = \"$_POST[13]\", ";
			    $szam=intval($_POST[14]);
    			$sqlc=$sqlc." olajkm = $szam, ";
	    		$sqlc=$sqlc." megj = \"$_POST[15]\", ";
	    		$sqlc=$sqlc." felh = \"$_POST[16]\" ";
		    	$sqlc=$sqlc." where id=$id;";
			    #echo($sqlc);
    			if (sql_run($sqlc)){
	    			mess_ok($GK_TITLE_CHANGE.": ".$GK_OK.".");
		    	}else{
			    	mess_error($GK_TITLE_CHANGE.": ".$GK_ERROR.".");
			    }
			}
		    $sqlc="select * from gk_data where id=$id;";
		    #echo($sqlc);
		    if (sql_run($sqlc)){
			    $r=$MA_SQL_RESULT[0];
			    for($i=0;$i<$db;$i++){
				    $d[$i]=$r[$i];
			    }
			}
		}else{
			$d[0]=gk_genid();
			for($i=1;$i<$db;$i++){
				$d[$i]="";
			}
		}
	}
	if ($form){
		echo("<div class=spaceline></div>");
		echo("<h3>$title</h3>");
		echo("<div class=spaceline></div>");
		echo("<form method=post>");
		echo("<input type=hidden id=0 name=0 value=\"$d[0]\">");
		$dat=array(5,6,12,13);
		$ro=array(1);
		$num=array(7,9,10,11,14);
		for($i=1;$i<$db-2;$i++){
			echo("<div class=frow>");
			echo("<div class=fcol1>$GK_FIELDS[$i]");
			echo("</div>");
			echo("<div class=fcol2>");
			$ronly="";
			if (in_array($i,$ro)){
				$ronly="readonly";
			}
			if (in_array($i,$dat)){
				echo("<input type=date id=$i name=$i placeholder=\"$GK_FIELDS[$i]\" value=\"$d[$i]\" $ronly>");
			}else{
			    if (in_array($i,$num)){
				    echo("<input type=text id=$i name=$i placeholder=\"0\" value=\"$d[$i]\" $ronly>");
			    }else{
				    echo("<input type=text id=$i name=$i placeholder=\"$GK_FIELDS[$i]\" value=\"$d[$i]\" $ronly>");
				}
			}
			echo("</div>");
			echo("</div>");
		}
		echo("<div class=frow>");
		echo("<div class=fcol1>$GK_FIELDS[$i]");
		echo("</div>");
		echo("<div class=fcol2>");
		echo("<textarea rows=10 id=$i name=$i>$d[$i]</textarea>");
		echo("</div>");
		echo("</div>");
		$i++;
		echo("<input type=hidden id=$i name=$i value=\"$MA_USERNAME\">");
		echo("<div class=frow><br /></div>");
		if ($new){
			echo("<input type=hidden id=id name=id value=\"$d[0]\">");
			echo("<input type=submit id=newt name=newt value=\"$GK_SAVE\">");
			echo("</form>");
		}else{
			echo("<input type=hidden id=id name=id value=\"$d[0]\">");
			echo("<input type=hidden id=id2 name=id2 value=\"$d[0]\">");
			echo("<input type=submit id=cht name=cht value=\"$GK_SAVE\">");
			echo("</form>");
			echo("<div class=frow><br /></div>");
			echo("<form method=post>");
			echo("<input type=hidden id=idd name=idd value=\"$d[0]\">");
			echo("<input  type=submit id=delt name=delt value=\"$GK_DEL\">");
			echo("</form>");
		}
		return(false);
	}
	return(true);
}


function gk_gktable(){
	global $MA_SQL_RESULT,$GK_NEW,$GK_TABLE_TITLE,$MA_USERNAME,
			$GK_WORK,$GK_SEARCH,$GK_PAGEROW,$GK_PAGE_LEFT,$GK_PAGE_RIGHT;

	$ptable=true;
	if (isset($_POST['newt'])){
		$ptable=gk_alldata(true);
	}
	if (isset($_POST['delt'])){
		gk_del();
	}
	if (isset($_POST['cht'])){
		$ptable=gk_alldata(false);
	}
	if ($ptable){
		if (isset($_POST['page'])){
			$page=(int)$_POST['page'];
			$first=$GK_PAGEROW*$page;
		}else{
			$page=0;
			$first=0;
		}
		$last=false;
		if (sql_run("select count(*) from gk_data where felh=\"$MA_USERNAME\";")){
			$r=$MA_SQL_RESULT[0];
			$odb=$r[0];
			$adb=$first+$GK_PAGEROW;
			if ($adb>=$odb){
				$last=true;
			}
		}
		echo("<form method=post>");
		echo("<input type=submit id=newt name=newt value=\"$GK_NEW\">");
		echo("</form>");
		echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$GK_SEARCH\">");
		sql_run("select * from gk_data where felh=\"$MA_USERNAME\" order by model desc limit $first,$GK_PAGEROW;");
		echo("<center>");
		echo("<table class='df_table_full' id=ptable>");
		echo("<tr class='df_trh'>");
		echo("<th class='df_th'>$GK_TABLE_TITLE[0]</th>");
		echo("<th class='df_th'>$GK_TABLE_TITLE[1]</th>");
		echo("<th class='df_th'>$GK_TABLE_TITLE[2]</th>");
		echo("<th class='df_th'>$GK_TABLE_TITLE[3]</th>");
		echo("<th class='df_th'>$GK_TABLE_TITLE[4]</th>");
		echo("<th class='df_th'>$GK_TABLE_TITLE[5]</th>");
		echo("</tr>");
		$db=count($MA_SQL_RESULT);
		for($i=0;$i<$db;$i++){
			$r=$MA_SQL_RESULT[$i];
			echo("<tr class=df_tr>");
			echo("<td class='df_td'>$r[2]</td>");
			echo("<td class='df_td'>$r[3]</td>");
			echo("<td class='df_td'>$r[6]</td>");
			echo("<td class='df_td'>$r[12]</td>");
			echo("<td class='df_td'>$r[13]</td>");
			echo("<td class='df_td'>");
			echo("<center>");
			echo("<form method=post>");
			echo("<input type=hidden id=id name=id value=\"$r[0]\">");
			echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=cht name=cht value=\"$GK_WORK\">");
			echo("</form>");
			echo("</td>");
			echo("</tr>");
		}
		echo("</table>");
		echo("<div class=frow>");
		echo("<div class=pcol2>");
		if (($page>0)and($first>0)){
			echo("<form method=post>");
			$p=$page-1;
			echo("<input type=hidden id=page name=page value=\"$p\">");
			echo("<input type=submit id=p name=p value=\"$GK_PAGE_LEFT\">");
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
		if (($db==$I_PAGEROW)and(!$last)){
			$p=$page+1;
			echo("<form method=post>");
			echo("<input type=hidden id=page name=page value=\"$p\">");
			echo("<input type=submit id=p name=p value=\"$GK_PAGE_RIGHT\">");
			echo("</form>");
		}else{
			echo("<span style=\"color:transparent;\">?</span>");
		}
		echo("</div>");
		echo("</div>");
	}
}




function gk_table(){
    gk_gktable();
}


?>
