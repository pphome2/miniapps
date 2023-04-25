<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #


function i_search(){
  global $MA_SQL_RESULT,$I_LISTTABLE_TITLE,$I_FILESTORE,$I_DOWNLOAD,
      $I_SEPARATOR,$I_DOWNLOAD_FILE,$I_DOC_FIELDS,$I_DOWNLOADTEXT,
      $I_PAGEROW,$I_PAGE_LEFT,$I_PAGE_RIGHT,$I_BACK,$I_SEARCH_TEXT,
      $L_SEARCH,$I_SEARCH_LABEL,$I_WORKDOC,$MA_ADMINFILE,$I_BANK;

  echo("<h3>$I_SEARCH_TEXT</h3>");
  if (isset($_POST['s'])){
    $sqlc="";
    if ($_POST[0]<>""){
      $sqlc="szsz like \"$_POST[0]%\"";
    }
    if ($_POST[1]<>""){
      if (sql_run("select * from ik_partner where nev like \"$_POST[1]%\";")){
        $r=$MA_SQL_RESULT[0];
        $pid=$r[0];
        if ($sqlc===""){
          $sqlc="partner=$pid";
        }else{
          $sqlc=$sqlc." and partner=$pid";
        }
      }
    }
    if ($sqlc<>""){
      $sqlc=$sqlc." and ";
    }
    if ($_POST[2]<>""){
      $sqlc=$sqlc."bank=\"$_POST[2]\"";
    }
    if ($sqlc<>""){
      $sqlc=$sqlc." and ";
    }
    $d1=$_POST[3];
    $d2=$_POST[4];
    $sqlc=$sqlc." datum between \"$d1\" and \"$d2\"";
    #echo("$sqlc");
    if (isset($_POST['f'])){
      i_exporttable($sqlc);
    }else{
      echo("<form method=post>");
      echo("<input type=hidden id=0 name=0 value=\"$_POST[0]\">");
      echo("<input type=hidden id=1 name=1 value=\"$_POST[1]\">");
      echo("<input type=hidden id=2 name=2 value=\"$_POST[2]\">");
      echo("<input type=hidden id=3 name=3 value=\"$_POST[3]\">");
      echo("<input type=hidden id=f name=f value=\"f\">");
      echo("<input class='button' type=submit id=s name=s value=\"$I_DOWNLOAD\">");
      echo("</form>");
      if (isset($_POST['page'])){
          $page=(int)$_POST['page'];
          $first=$I_PAGEROW*$page;
      }else{
        $page=0;
        $first=0;
      }
      $last=false;
      if (sql_run("select count(*) from ik_doc where ".$sqlc.";")){
        $r=$MA_SQL_RESULT[0];
        $odb=$r[0];
        $adb=$first+$I_PAGEROW;
        if ($adb>=$odb){
          $last=true;
        }
      }
      echo("<center>");
      echo("<table class='df_table_full' id=ptable>");
      echo("<tr class='df_trh'>");
      echo("<th class='df_th0'>$I_LISTTABLE_TITLE[0]</th>");
      echo("<th class='df_th0'>$I_LISTTABLE_TITLE[1]</th>");
      echo("<th class='df_th'>$I_LISTTABLE_TITLE[2]</th>");
      echo("<th class='df_th0'>$I_LISTTABLE_TITLE[3]</th>");
      echo("<th class='df_th0'>$I_LISTTABLE_TITLE[4]</th>");
      echo("<th class='df_th0'>$I_LISTTABLE_TITLE[5]</th>");
      echo("<th class='df_th0'>$I_LISTTABLE_TITLE[6]</th>");
      echo("<th class='df_th0'>$I_LISTTABLE_TITLE[7]</th>");
      echo("</tr>");
      $sqlc="select * from ik_doc where $sqlc order by id desc limit $first,$I_PAGEROW;";
      sql_run($sqlc);
      $dr=$MA_SQL_RESULT;
      $db=count($dr);
      for($i=0;$i<$db;$i++){
        $r=$dr[$i];
        echo("<tr class=df_tr>");
        $fn="$I_FILESTORE/$r[15]";
        echo("<td class='df_td'><a href=\"$fn\">$r[1]</a></td>");
        echo("<td class='df_td'>$r[3]</td>");
        $sqlc="select * from ik_partner where id=$r[4];";
        if (sql_run($sqlc)){
          $pd=$MA_SQL_RESULT[0];
          $r[4]=$pd[1];
        }
        echo("<td class='df_td'>$r[4]</td>");
        $sqlc="select * from ik_cat;";
        sql_run($sqlc);
        $dbl=count($MA_SQL_RESULT);
        for($j=0;$j<$dbl;$j++){
          $cl=$MA_SQL_RESULT[$j];
          if ($r[7]==$cl[0]){
            $r[7]=$cl[2];
          }
        }
        echo("<td class='df_td'>$r[7]</td>");
        if ($r[9]<>""){
          $r[9]=strtotime($r[9]);
          $r[9]=date('Y. m. d.',$r[9]);
        }
        echo("<td class='df_td'>$r[9]</td>");
        if ($r[11]<>""){
          $r[11]=strtotime($r[11]);
          $r[11]=date('Y. m. d.',$r[11]);
        }
        echo("<td class='df_td'>$r[11]</td>");
        if ($r[10]<>""){
          $r[10]=strtotime($r[10]);
          $r[10]=date('Y. m. d.',$r[10]);
        }
        echo("<td class='df_td'>$r[10]</td>");
        echo("<td class='df_td'>");
        echo("<center>");
        echo("<form method=post action=$MA_ADMINFILE>");
        echo("<input type=hidden id=id name=id value=\"$r[0]\">");
        echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=chd name=chd value=\"$I_WORKDOC\">");
        echo("</form>");
        echo("</td>");
        echo("</tr>");
      }
      echo("</table>");
      echo("<div class=spaceline></div>");
      echo("<div class=frow>");
      echo("<div class=pcol2>");
      if (($page>0)and($first>0)){
        echo("<form method=post>");
        $p=$page-1;
        echo("<input type=hidden id=page name=page value=$p>");
        echo("<input type=hidden id=lcode name=lcode value=\"$lcode\">");
        echo("<input type=submit id=p name=p value=\"$I_PAGE_LEFT\">");
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
        echo("<input type=hidden id=page name=page value=$p>");
        echo("<input type=hidden id=lcode name=lcode value=\"$lcode\">");
        echo("<input type=submit id=p name=p value=\"$I_PAGE_RIGHT\">");
        echo("</form>");
      }else{
        echo("<span style=\"color:transparent;\">?</span>");
      }
      echo("</div>");
      echo("</div>");
    }
  }else{
    $year=i_year();
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    echo("<form method=post>");
    echo("<div class=frow>");
    echo("<div class=fcol1>$I_SEARCH_LABEL[0]");
    echo("</div>");
    echo("<div class=fcol2>");
    echo("<input type=text id=0 name=0 placeholder='$I_SEARCH_LABEL[0]' value=''>");
    echo("</div>");
    echo("</div>");
    echo("<div class=frow>");
    echo("<div class=fcol1>$I_SEARCH_LABEL[1]");
    echo("</div>");
    echo("<div class=fcol2>");
    echo("<input type=text id=1 name=1 placeholder='$I_SEARCH_LABEL[1]' value=''>");
    echo("</div>");
    echo("</div>");
    echo("<div class=frow>");
    echo("<div class=fcol1>$I_SEARCH_LABEL[2]");
    echo("</div>");
    echo("<div class=fcol2>");
    echo("<select id=2 name=2>");
    echo("<option value=\"\"></option>");
    $dbl=count($I_BANK);
    for($j=0;$j<$dbl;$j++){
      echo("<option value=\"$I_BANK[$j]\">$I_BANK[$j]</option>");
    }
    echo("</select>");
    echo("</div>");
    echo("</div>");
    echo("<div class=frow>");
    echo("<div class=fcol1>$I_SEARCH_LABEL[3]");
    echo("</div>");
    echo("<div class=fcol2>");
    echo("<input type=date id=3 name=3 placeholder='$I_SEARCH_LABEL[3]' value='$year-01-01'>");
    echo("</div>");
    echo("</div>");
    echo("<div class=frow>");
    echo("<div class=fcol1>$I_SEARCH_LABEL[4]");
    echo("</div>");
    echo("<div class=fcol2>");
    echo("<input type=date id=4 name=4 placeholder='$I_SEARCH_LABEL[4]' value='$year-12-31'>");
    echo("</div>");
    echo("</div>");
    echo("<div class=frow><br /></div>");
    echo("<input type=submit id=s name=s value=\"$L_SEARCH\">");
    echo("</form>");
  }
}



?>
