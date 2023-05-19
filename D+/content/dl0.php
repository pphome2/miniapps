<?php

 #
 # Dokumentum
 #
 # info: main folder copyright file
 #
 #



function d_listlive($title=""){
  global $MA_SQL_RESULT,$D_DOC_TABLE,$D_GO,
      $D_NEXT,$D_SEARCH_TEXT,$D_PAGEROW,
      $D_PAGE_LEFT,$D_PAGE_RIGHT,$D_BACK,
      $D_PARTNER_SEARCH,$D_LISTCODE,
      $D_DOWNLOAD,$D_DOWNLOADTEXT,
      $D_DOC_TABLE_FIELDS,$MA_DOWNLOADFILE;

  echo("<h3>$title</h3>");
  $date=date('Y-m-d');
  $sqlc=" datum < \"$date\" or datum = \"\"  ";
  #echo($sqlc);
  if (isset($_POST['download'])){
    sql_run("select * from d_doc where $sqlc order by datum;");
    echo("<div class=frow>");
    echo("<div class=colx1></div>");
    echo("<div class=colx2>");
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    echo("$D_DOWNLOADTEXT");
    $dload="";
    $db=count($D_DOC_TABLE_FIELDS);
    for($i=0;$i<$db;$i++){
      $dload=$dload.$D_DOC_TABLE_FIELDS[$i].";";
    }
    $dload=$dload.PHP_EOL;
    $data=$MA_SQL_RESULT;
    $db=count($data);
    for($i=0;$i<$db;$i++){
      $r=$data[$i];
      $dload=$dload.$r[1].";";
      $dload=$dload.$r[2].";";
      $dload=$dload.$r[3].";";
      $dload=$dload.$r[4].";";
      $dload=$dload.$r[5].";";
      $dload=$dload.$r[6].";";
      $dload=$dload.PHP_EOL;
    }
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    echo("<form method=post action=$MA_DOWNLOADFILE>");
    echo("<input type=hidden id=lcode name=lcode value=\"$lcode\">");
    echo("<input type=hidden id=f name=f value=\"$dload\">");
    echo("<input class='button' type=submit id=x name=x value=\"$D_DOWNLOAD\">");
    echo("</form>");
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    echo("<input class='button' type=submit id=x name=x value=\"$D_BACK\" onclick=\"history.back();\">");
    echo("</div>");
    echo("<div class=colx1></div>");
    echo("</div>");
  }else{
    if (isset($_POST['page'])){
      $page=(int)$_POST['page'];
      $first=$D_PAGEROW*$page;
    }else{
      $page=0;
      $first=0;
    }
    $last=false;
    if (sql_run("select count(*) from d_doc where id like \"%$year%\";")){
      $r=$MA_SQL_RESULT[0];
      $odb=$r[0];
      $adb=$first+$D_PAGEROW;
      if ($adb>=$odb){
        $last=true;
      }
    }
    sql_run("select * from d_doc where $sqlc order by datum limit $first,$D_PAGEROW;");
    echo("<form method=post>");
    echo("<input type=hidden id=lcode name=lcode value=\"$D_LISTCODE[0]\">");
    echo("<input type=submit id=download name=download value=\"$D_DOWNLOAD\">");
    echo("</form>");
    echo("<table class='df_table_full' id=ptable>");
    echo("<tr class='df_trh'>");
    echo("<th class='df_th0'>$D_DOC_TABLE[0]</th>");
    echo("<th class='df_th'>$D_DOC_TABLE[1]</th>");
    echo("<th class='df_th0'>$D_DOC_TABLE[2]</th>");
    echo("<th class='df_th0'>$D_DOC_TABLE[3]</th>");
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
