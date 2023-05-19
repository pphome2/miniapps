<?php

 #
 # Dokumentum
 #
 # info: main folder copyright file
 #
 #



function d_docdel(){
  global $D_DOC_TITLE_DEL,$D_OK,$D_ERROR;

    if (isset($_POST['idd'])){
      $id=$_POST['idd'];
      $sqlc="delete from d_doc where id=$id;";
      #echo($sqlc);
      if (sql_run($sqlc)){
        mess_ok($D_DOC_TITLE_DEL.": ".$D_OK.".");
      }else{
        mess_error($D_DOC_TITLE_DEL.": ".$D_ERROR.".");
      }
    }
}



function d_docdata($new){
  global $MA_SQL_RESULT,$D_DOC_FIELDS,$MA_ADMINFILE,
      $D_SAVE,$D_DOC_TITLE_NEW,$D_DOC_TITLE_CHANGE,
      $D_OK,$D_ERROR,$D_DOC_DEL,$D_FILESTORE,
      $D_FILESTORE,$D_FILECOUNTLIMIT;

  $db=count($D_DOC_FIELDS);
  if ($new){
    $title=$D_DOC_TITLE_NEW;
    if (isset($_POST['0'])){
      $da="'".$_POST[0]."'";
      for($i=1;$i<$db;$i++){
        $t=$_POST[$i];
        $da=$da.", \"$t\"";
      }
      $sqlc="insert into d_doc (id,datum,partner,indul,lejar,leiras,fajl) values ($da);";
      if (sql_run($sqlc)){
        mess_ok($D_DOC_TITLE_NEW.": ".$D_OK.".");
      }else{
        mess_error($D_DOC_TITLE_NEW.": ".$D_ERROR.".");
      }
    }
    $d[0]=date('YmdHis');
    for($i=1;$i<$db;$i++){
      $d[$i]="";
    }
    $d[1]=date('Y-m-d');
    $d[3]=date('Y-m-d');
    $d[4]=date('Y-m-d');
    if(isset($_POST['fname'])){
      $d[6]=$_POST['fname'];
      $d[6]=substr($d[6],strlen($D_FILESTORE)+1,strlen($d[6]));
    }
  }else{
    $title=$D_DOC_TITLE_CHANGE;
    if (isset($_POST['id'])){
      if (isset($_POST['id2'])){
        $id2=$_POST['id2'];
        $sqlc="update d_doc set";
        $sqlc=$sqlc." id = ".$_POST[0].", ";
        $t=$_POST[1];
        $sqlc=$sqlc." datum = \"$t\", ";
        $t=$_POST[2];
        $sqlc=$sqlc." partner = \"$t\", ";
        $t=$_POST[3];
        $sqlc=$sqlc." indul = \"$t\", ";
        $t=$_POST[4];
        $sqlc=$sqlc." lejar = \"$t\", ";
        $t=$_POST[5];
        $sqlc=$sqlc." leiras = \"$t\", ";
        $t=$_POST[6];
        $sqlc=$sqlc." fajl = \"$t\" ";
        $sqlc=$sqlc." where id=$id2;";
        if (sql_run($sqlc)){
          mess_ok($D_DOC_TITLE_CHANGE.": ".$D_OK.".");
        }else{
          mess_error($D_DOC_TITLE_CHANGE.": ".$D_ERROR.".");
        }
      }
      $id=$_POST['id'];
      $sqlc="select * from d_doc where id=$id;";
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
      }
    }
  }
  echo("<div class=spaceline></div>");
  echo("<h3>$title</h3>");
  echo("<div class=spaceline></div>");
  $datum=date('Y-m-d');
  echo("<form method=post>");
  echo("<input type=hidden id=0 name=0 value=\"$d[0]\">");
  echo("<div class=frow>");
  echo("<div class=fcol1>$D_DOC_FIELDS[1]");
  echo("</div>");
  echo("<div class=fcol2>");
  echo("<input type=date id=1 name=1 placeholder=\"$datum\" value=\"$d[1]\" readonly>");
  echo("</div>");
  echo("</div>");
  echo("<div class=frow>");
  echo("<div class=fcol1>$D_DOC_FIELDS[2]");
  echo("</div>");
  echo("<div class=fcol2>");
  echo("<input type=text id=2 name=2 placeholder=\"$D_DOC_FIELDS[2]\" value=\"$d[2]\">");
  echo("</div>");
  echo("</div>");
  echo("<div class=frow>");
  echo("<div class=fcol1>$D_DOC_FIELDS[3]");
  echo("</div>");
  echo("<div class=fcol2>");
  echo("<input type=date id=3 name=3 placeholder=\"$datum\" value=\"$d[3]\">");
  echo("</div>");
  echo("</div>");
  echo("<div class=frow>");
  echo("<div class=fcol1>$D_DOC_FIELDS[4]");
  echo("</div>");
  echo("<div class=fcol2>");
  echo("<input type=date id=4 name=4 placeholder=\"$datum\" value=\"$d[4]\">");
  echo("</div>");
  echo("</div>");
  echo("<div class=frow>");
  echo("<div class=fcol1>$D_DOC_FIELDS[5]");
  echo("</div>");
  echo("<div class=fcol2>");
  echo("<textarea rows=5 id=5 name=5>$d[5]</textarea>");
  echo("</div>");
  echo("</div>");
  echo("<div class=frow>");
  echo("<div class=fcol1>$D_DOC_FIELDS[6]");
  echo("</div>");
  echo("<div class=fcol2>");
  $fl=glob("$D_FILESTORE/*.pdf");
  usort($fl,function($a,$b){
    return filemtime($b)-filemtime($a);
  });
  $dbl=count($fl);
  if ($dbl>$D_FILECOUNTLIMIT){
    $dbl=$D_FILECOUNTLIMIT;
  };
  echo("<select id=6 name=6>");
  #echo("<option value=\"\"></option>");
  if ($d[6]<>""){
    echo("<option value=\"$d[6]\" selected>$d[6]</option>");
  }else{
    echo("<option value=\"\"></option>");
  }
  for($j=0;$j<$dbl;$j++){
    $fn=explode("/",$fl[$j]);
    if (substr($fn[1],0,1)<>"."){
      if ($d[6]===$fn[1]){
        $sel="selected";
      }else{
        $sel="";
      }
      echo("<option value=\"$fn[1]\" $sel>$fn[1]</option>");
    }
  }
  echo("</select>");
  echo("</div>");
  echo("</div>");
  echo("<div class=frow><br /></div>");
  if ($new){
    echo("<input type=hidden id=id name=id value=\"$d[0]\">");
    echo("<input type=submit id=newd name=newd value=\"$D_SAVE\">");
    echo("</form>");
  }else{
    echo("<input type=hidden id=id name=id value=\"$d[0]\">");
    echo("<input type=hidden id=id2 name=id2 value=\"$d[0]\">");
    echo("<input type=submit id=chd name=chd value=\"$D_SAVE\">");
    echo("</form>");
    echo("<div class=frow><br /></div>");
    echo("<form method=post>");
    echo("<input type=hidden id=idd name=idd value=\"$d[0]\">");
    echo("<input  type=submit id=deld name=deld value=\"$D_DOC_DEL\">");
    echo("</form>");
  }
}


function d_doc(){
  global $MA_SQL_RESULT,$D_NEW,$D_DOC_TABLE,$D_GO,$D_DB,
      $D_NEXT,$D_SEARCH_TEXT,$D_PAGEROW,$D_FIRSTYEAR,
      $D_PAGE_LEFT,$D_PAGE_RIGHT,$D_FILESTORE,
      $D_PARTNER_SEARCH;

  $ptable=true;
  if (isset($_POST['newd'])){
    $ptable=false;
    d_docdata(true);
  }
  if (isset($_POST['deld'])){
    d_docdel();
  }
  if (isset($_POST['chd'])){
    $ptable=false;
    d_docdata(false);
  }
  if ($ptable){
    if(isset($_POST['spn'])){
      $spn=$_POST['spn'];
      $spartner=" and partner like \"%$spn%\"";
    }else{
      $spn="";
      $spartner="";
    }
    if(isset($_POST['year'])){
      $year=$_POST['year'];
    }else{
      $year=date('Y');
    }
    $year=d_year($year);
    if (isset($_POST['page'])){
      $page=(int)$_POST['page'];
      $first=$D_PAGEROW*$page;
    }else{
      $page=0;
      $first=0;
    }
    $last=false;
    if (sql_run("select count(*) from d_doc where id like \"%$year%\" $spartner;")){
      $r=$MA_SQL_RESULT[0];
      $odb=$r[0];
      $adb=$first+$D_PAGEROW;
      if ($adb>=$odb){
        $last=true;
      }
    }
    echo("<form method=post>");
    echo("<input type=hidden id=page name=page value=$page>");
    echo("<div class=frow>");
    echo("<div class=pcol2>");
    echo("<h3>$year ( $odb $D_DB )</h3>");
    echo("</div>");
    echo("<div class=pcol1>");
    echo("<select style=\"width:20%;margin-right:20px;float:right;\" id=year name=year>");
    for($y=date('Y');$y>=$D_FIRSTYEAR;$y--){
      echo("<option value=\"$y\">$y</option>");
    }
    echo("</select>");
    echo("</div>");
    echo("<div class=pcol2>");
    echo("<input type=submit id=yeargo name=yeargo value=\"$D_GO\">");
    echo("</div>");
    echo("</div>");
    echo("</form>");
    echo("<form method=post>");
    echo("<div class=frow>");
    echo("<div class=pcol1>");
    echo("<input type=text id=spn name=spn placeholder=\"$D_PARTNER_SEARCH\" value=\"$spn\">");
    echo("</div>");
    echo("<div class=pcol2>");
    echo("<div style=\"width:90%;float:middle;\">");
    echo("<span style=\"color:transparent;\">?</span>");
    echo("</div>");
    echo("</div>");
    echo("<div class=pcol2>");
    echo("<input type=submit id=go name=go value=\"$D_NEXT\">");
    echo("</div>");
    echo("</div>");
    echo("<form method=post>");
    echo("<input type=submit id=newd name=newd value=\"$D_NEW\">");
    echo("</form>");
    echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$D_SEARCH_TEXT\">");
    sql_run("select * from d_doc where datum like \"%$year%\" $spartner order by datum limit $first,$D_PAGEROW;");
    echo("<center>");
    echo("<table class='df_table_full' id=ptable>");
    echo("<tr class='df_trh'>");
    echo("<th class='df_th0'>$D_DOC_TABLE[0]</th>");
    echo("<th class='df_th'>$D_DOC_TABLE[1]</th>");
    echo("<th class='df_th0'>$D_DOC_TABLE[2]</th>");
    echo("<th class='df_th0'>$D_DOC_TABLE[3]</th>");
    echo("<th class='df_th0'>$D_DOC_TABLE[4]</th>");
    echo("</tr>");
    $db=count($MA_SQL_RESULT);
    for($i=0;$i<$db;$i++){
      $r=$MA_SQL_RESULT[$i];
      echo("<tr class=df_tr>");
      if ($r[1]<>""){
        $r[1]=strtotime($r[1]);
        $r[1]=date('Y. m. d.',$r[1]);
      }
      $fn="$D_FILESTORE/$r[6]";
      if (!file_exists("$fn")){;
      }
      echo("<td class='df_td'><a href=\"$fn\">$r[1]</a></td>");
      echo("<td class='df_td'>$r[2]</td>");
      if ($r[3]<>""){
        $r[3]=strtotime($r[3]);
        $r[3]=date('Y. m. d.',$r[3]);
      }
      echo("<td class='df_td'>$r[3]</td>");
      if ($r[4]<>""){
        $r[4]=strtotime($r[4]);
        $r[4]=date('Y. m. d.',$r[4]);
      }
      echo("<td class='df_td'>$r[4]</td>");
      echo("<td class='df_td'>");
      echo("<center>");
      echo("<form method=post>");
      echo("<input type=hidden id=id name=id value=\"$r[0]\">");
      echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=chd name=chd value=\"$D_NEXT\">");
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
      echo("<input type=hidden id=year name=íear value=\"$íear\">");
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
      echo("<input type=hidden id=year name=íear value=\"$íear\">");
      echo("<input type=submit id=p name=p value=\"$D_PAGE_RIGHT\">");
      echo("</form>");
    }else{
      echo("<span style=\"color:transparent;\">?</span>");
    }
    echo("</div>");
    echo("</div>");
  }
}


?>
