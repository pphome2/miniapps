<?php

 #
 # Dokumentum
 #
 # info: main folder copyright file
 #
 #



function d_newdoc(){
	global $MA_SQL_RESULT,$D_NEW,$D_DOC_TABLE,$D_GO,$D_DB,$MA_ADMINFILE,
			$D_NEXT,$D_SEARCH_TEXT,$D_PAGEROW,$D_DOC_NEWFILE,
			$D_PAGE_LEFT,$D_PAGE_RIGHT,$D_FILESTORE,$D_DOC_FILETABLE;

	$fl=glob("$D_FILESTORE/*.pdf");
	usort($fl,function($a,$b){
		return filemtime($b)-filemtime($a);
	});
	$db=count($fl);
	if (isset($_POST['page'])){
		$page=(int)$_POST['page'];
		$first=$D_PAGEROW*$page;
	}else{
		$page=0;
		$first=0;
	}
	$last=false;
	$adb=$first+$D_PAGEROW;
	if ($adb>=$db){
		$last=true;
	}
	echo("<form method=post>");
	echo("<input type=hidden id=page name=page value=$page>");
	echo("<h3>$D_DOC_NEWFILE</h3>");
	echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$D_SEARCH_TEXT\">");
	echo("<center>");
	echo("<table class='df_table_full' id=ptable>");
	echo("<tr class='df_trh'>");
	echo("<th class='df_th'>$D_DOC_FILETABLE[0]</th>");
	echo("<th class='df_th0'>$D_DOC_FILETABLE[1]</th>");
	echo("</tr>");
	for($i=0;$i<$db;$i++){
		echo("<tr class='df_tr'>");
		$fn=substr($fl[$i],strlen($D_FILESTORE)+1,strlen($fl[$i]));
		$fd=filemtime($fl[$i]);
		$fd=date('Y.m.d',$fd);
		echo("<td class='df_td'><a class=doclink href=\"$fl[$i]\">[ $fd ]</a> - $fn</td>");
		echo("<td class='df_td'>");
		echo("<center>");
		echo("<form action=$MA_ADMINFILE method=post>");
		echo("<input type=hidden id=fname name=fname value=\"$fl[$i]\">");
		echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=newd name=newd value=\"$D_NEXT\">");
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
		echo("<input type=submit id=p name=p value=\"$D_PAGE_LEFT\">");
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
	if (($db==$D_PAGEROW)and(!$last)){
		$p=$page+1;
		echo("<form method=post>");
		echo("<input type=hidden id=page name=page value=\"$p\">");
		echo("<input type=submit id=p name=p value=\"$D_PAGE_RIGHT\">");
		echo("</form>");
	}else{
		echo("<span style=\"color:transparent;\">?</span>");
	}
	echo("</div>");
	echo("</div>");
}



?>
