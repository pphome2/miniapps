<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #



function r_search(){
  global $R_SEARCH_TITLE,$R_SEARCH_LABEL,$R_SEARCH_BUTTON,$R_PAGEROW,
      $R_SEARCH_TABLE_TITLE,$R_TOOMANYITEM,$R_NOITEM,
      $MA_SQL_RESULT;

  echo("<h3>$R_SEARCH_TITLE</h3>");
  $cn="";
  if (isset($_POST['s'])){
    $cn=$_POST[0];
  }
  echo("<div class=spaceline></div>");
  echo("<div class=spaceline></div>");
  echo("<form method=post>");
  echo("<div class=frow>");
  echo("<div class=pcol1>");
  echo("<input type=text id=0 name=0 placeholder=\"$R_SEARCH_LABEL[0]\" value=\"$cn\">");
  echo("</div>");
  echo("<div class=pcol2>");
  echo("<div style=\"width:90%;float:middle;\">");
  echo("<span style=\"color:transparent;\">?</span>");
  echo("</div>");
  echo("</div>");
  echo("<div class=pcol2>");
  echo("<input type=submit id=s name=s value=\"$R_SEARCH_BUTTON\">");
  echo("</div>");
  echo("</div>");
  echo("</form>");
  if ($cn<>""){
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    $sqlc="where nev like \"%$cn%\" or csz like \"%$cn%\" or vkod like \"%$cn%\"";
    sql_run("select * from r_cikk $sqlc order by nev limit 0,$R_PAGEROW;");
    $res=$MA_SQL_RESULT;
    $db=count($res);
    if ($db>0){
      echo("<table class='df_table_full' id=ptable>");
      echo("<tr class='df_trh'>");
      echo("<th class='df_th'>$R_SEARCH_TABLE_TITLE[0]</th>");
      echo("<th class='df_th'>$R_SEARCH_TABLE_TITLE[1]</th>");
      echo("<th class='df_th'>$R_SEARCH_TABLE_TITLE[2]</th>");
      echo("<th class='df_th'>$R_SEARCH_TABLE_TITLE[3]</th>");
      echo("<th class='df_th'>$R_SEARCH_TABLE_TITLE[4]</th>");
      echo("<th class='df_th'>$R_SEARCH_TABLE_TITLE[5]</th>");
      echo("<th class='df_th'>$R_SEARCH_TABLE_TITLE[6]</th>");
      echo("</tr>");
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
        $sqlc="select * from r_keszlet where cikk=$r[0];";
        if (sql_run($sqlc)){
          $resk=$MA_SQL_RESULT;
          $resdb=count($resk);
          echo("<td class='df_td'>");
          for($l=0;$l<$resdb;$l++){
            $resi=$resk[$l];
            if (sql_run("select nev from r_raktar where id=$resi[2]")){
              $rrak=$MA_SQL_RESULT[0];
              $resi[2]=$rrak[0];
            }
            echo("$resi[2]<br />");
          }
          echo("</td>");
          echo("<td class='df_td'>");
          for($l=0;$l<$resdb;$l++){
            $resi=$resk[$l];
            echo("$resi[3]<br />");
          }
          echo("</td>");
          echo("<td class='df_td'>");
          for($l=0;$l<$resdb;$l++){
            $resi=$resk[$l];
            echo("$resi[7]<br />");
          }
          echo("</td>");
        }
      }
      echo("</table>");
      if ($db===$R_PAGEROW){
        mess_error($R_TOOMANYITEM);
      }
    }else{
      mess_error($R_NOITEM);
    }
  }
}


?>
