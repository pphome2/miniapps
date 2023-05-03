<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #


function r_inst1($pid){
  global $MA_SQL_RESULT,$R_NEW_INAME,$R_INAME_TABLE_TITLE,$R_TOOMANYROW,
    $R_WORK_INAME,$R_SEARCH,$R_PAGEROW,$R_PAGE_LEFT,$R_PAGE_RIGHT,
    $R_IN_STAGE,$R_SELECT,$R_INAME_SEARCH;

  echo("<h3>$R_IN_STAGE[1] </h3><br />");
  $sqlc="";
  if (isset($_POST['sname'])){
    $sn=$_POST['sname'];
    if ($sn<>""){
      $sqlc="where nev like \"%$sn%\" or csz like \"%$sn%\" or vkod like \"%$sn%\"";
    }
  }else{
    $sn="";
  }
  echo("<form method=post>");
  echo("<div class=frow>");
  echo("<div class=pcol1>");
  echo("<input type=hidden id=pid name=pid value=\"$pid\">");
  echo("<input type=text id=sname name=sname placeholder=\"$R_INAME_SEARCH\" value=\"$sn\">");
  echo("</div>");
  echo("<div class=pcol2>");
  echo("<div style=\"width:90%;float:middle;\">");
  echo("<span style=\"color:transparent;\">?</span>");
  echo("</div>");
  echo("</div>");
  echo("<div class=pcol2>");
  echo("<input type=submit id=go name=go value=\"$R_WORK_INAME\">");
  echo("</div>");
  echo("</div>");
  echo("</form>");
  $page=0;
  $first=0;
  if (isset($_POST['page'])){
    $page=(int)$_POST['page'];
    $first=$R_PAGEROW*$page;
  }else{
  }
  $last=false;
  $odb=0;
  if (sql_run("select count(*) from r_cikk $sqlc;")){
    $r=$MA_SQL_RESULT[0];
    $odb=$r[0];
    $adb=$first+$R_PAGEROW;
    if ($adb>=$odb){
      $last=true;
    }
  }
  if ($odb>$R_PAGEROW){
    mess_error($R_TOOMANYROW." (".$odb.")");
  }
  echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$R_SEARCH\">");
  sql_run("select * from r_cikk $sqlc order by csz limit $first,$R_PAGEROW;");
  echo("<center>");
  echo("<table class='df_table_full' id=ptable>");
  echo("<tr class='df_trh'>");
  echo("<th class='df_th'>$R_INAME_TABLE_TITLE[0]</th>");
  echo("<th class='df_th1'>$R_INAME_TABLE_TITLE[1]</th>");
  echo("<th class='df_th1'>$R_INAME_TABLE_TITLE[2]</th>");
  echo("<th class='df_th'>$R_INAME_TABLE_TITLE[3]</th>");
  echo("<th class='df_th'>$R_SELECT</th>");
  echo("</tr>");
  $res=$MA_SQL_RESULT;
  $db=count($res);
  for($i=0;$i<$db;$i++){
    $r=$res[$i];
    echo("<tr class=df_tr>");
    echo("<td class='df_td'>$r[1]</td>");
    $sqlc="select * from r_kat where id=$r[2];";
    if (sql_run($sqlc)){
      $resx=$MA_SQL_RESULT[$i];
      echo("<td class='df_td'>$resx[2]</td>");
    }else{
      echo("<td class='df_td'>$r[2]</td>");
    }
    echo("<td class='df_td'>$r[3]</td>");
    echo("<td class='df_td'>$r[4]</td>");
    echo("<td class='df_td'>");
    echo("<center>");
    echo("<form method=post>");
    echo("<input type=hidden id=pid name=pid value=\"$pid\">");
    echo("<input type=hidden id=iid name=iid value=\"$r[0]\">");
    echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=chc name=chc value=\"$R_WORK_INAME\">");
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
    echo("<input type=hidden id=pid name=pid value=\"$pid\">");
    echo("<input type=submit id=p name=p value=\"$R_PAGE_LEFT\">");
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
  if (($db==$R_PAGEROW)and(!$last)){
    $p=$page+1;
    echo("<form method=post>");
    echo("<input type=hidden id=page name=page value=\"$p\">");
    echo("<input type=hidden id=pid name=pid value=\"$pid\">");
    echo("<input type=submit id=p name=p value=\"$R_PAGE_RIGHT\">");
    echo("</form>");
  }else{
    echo("<span style=\"color:transparent;\">?</span>");
  }
  echo("</div>");
  echo("</div>");
}




function r_inst0(){
  global $MA_SQL_RESULT,$R_NEW_PARTNER,$R_PARTNER_TABLE_TITLE,$R_TOOMANYROW,
      $R_WORK_PARTNER,$R_SEARCH,$R_PAGEROW,$R_PAGE_LEFT,$R_PAGE_RIGHT,
      $R_IN_STAGE,$R_SELECT,$R_PARTNER_SEARCH;

  echo("<h3>$R_IN_STAGE[0] </h3><br />");
  $sqlc="";
  if (isset($_POST['sname'])){
    $sn=$_POST['sname'];
    if ($sn<>""){
      $sqlc="where nev like \"%$sn%\"";
    }
  }else{
    $sn="";
  }
  echo("<form method=post>");
  echo("<div class=frow>");
  echo("<div class=pcol1>");
  echo("<input type=text id=sname name=sname placeholder=\"$R_PARTNER_SEARCH\" value=\"$sn\">");
  echo("</div>");
  echo("<div class=pcol2>");
  echo("<div style=\"width:90%;float:middle;\">");
  echo("<span style=\"color:transparent;\">?</span>");
  echo("</div>");
  echo("</div>");
  echo("<div class=pcol2>");
  echo("<input type=submit id=go name=go value=\"$R_WORK_PARTNER\">");
  echo("</div>");
  echo("</div>");
  echo("</form>");
  if (isset($_POST['page'])){
    $page=(int)$_POST['page'];
    $first=$R_PAGEROW*$page;
  }else{
    $page=0;
    $first=0;
  }
  $last=false;
  $odb=0;
  if (sql_run("select count(*) from r_partner $sqlc;")){
    $r=$MA_SQL_RESULT[0];
    $odb=$r[0];
    $adb=$first+$R_PAGEROW;
    if ($adb>=$odb){
      $last=true;
    }
  }
  if ($odb>$R_PAGEROW){
    mess_error($R_TOOMANYROW." (".$odb.")");
  }
  echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$R_SEARCH\">");
  sql_run("select * from r_partner $sqlc order by nev desc limit $first,$R_PAGEROW;");
  echo("<center>");
  echo("<table class='df_table_full' id=ptable>");
  echo("<tr class='df_trh'>");
  echo("<th class='df_th'>$R_PARTNER_TABLE_TITLE[0]</th>");
  echo("<th class='df_th'>$R_PARTNER_TABLE_TITLE[1]</th>");
  echo("<th class='df_th'>$R_PARTNER_TABLE_TITLE[2]</th>");
  echo("<th class='df_th0'>$R_PARTNER_TABLE_TITLE[3]</th>");
  echo("<th class='df_th0'>$R_PARTNER_TABLE_TITLE[4]</th>");
  echo("<th class='df_th0'>$R_SELECT</th>");
  echo("</tr>");
  $db=count($MA_SQL_RESULT);
  for($i=0;$i<$db;$i++){
    $r=$MA_SQL_RESULT[$i];
    echo("<tr class=df_tr>");
    echo("<td class='df_td'>$r[1]</td>");
    echo("<td class='df_td'>$r[4]</td>");
    echo("<td class='df_td'>$r[7]</td>");
    echo("<td class='df_td'>$r[8]</td>");
    echo("<td class='df_td'>$r[9]</td>");
    echo("<td class='df_td'>");
    echo("<center>");
    echo("<form method=post>");
    echo("<input type=hidden id=pid name=pid value=\"$r[0]\">");
    echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=chp name=chp value=\"$R_WORK_PARTNER\">");
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
    echo("<input type=submit id=p name=p value=\"$R_PAGE_LEFT\">");
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
    echo("<input type=submit id=p name=p value=\"$R_PAGE_RIGHT\">");
    echo("</form>");
  }else{
    echo("<span style=\"color:transparent;\">?</span>");
  }
  echo("</div>");
  echo("</div>");
}



function r_in(){
  $st=0;
  if (isset($_POST['pid'])){
    $pid=$_POST['pid'];
    $st++;
  }
  if (isset($_POST['iid'])){
    $iid=$_POST['iid'];
    $st++;
  }
  if (isset($_POST['newi'])){
    r_inst2($pid,$iid);
  }else{
    switch($st){
      case 0:
        r_inst0();
        break;
      case 1:
        r_inst1($pid);
        break;
      case 2:
        r_inst2($pid,$iid);
        break;
      default:
        break;
    }
  }
}

?>
