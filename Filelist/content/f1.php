<?php

 #
 # Fájlok
 #
 # info: main folder copyright file
 #
 #



function f_table(){
  global $MA_USERNAME,$F_FILESTORE,$F_FILECOUNTLIMIT,$F_PAGEROW,$F_USER_FILE_RIGHTS,$F_OK,
      $F_ERROR,$F_SAVE,$F_SEARCH,$F_GO,$F_PAGE_RIGHT,$F_PAGE_LEFT,$F_BACK,
      $F_TABLE_TITLE,$F_NOCONFIG,$F_WELCOME_TEXT,$F_FILTER,$F_SEARCHSTRING;

  #echo("<h3>".$F_WELCOME_TEXT.$MA_USERNAME.".</h3>");
  for($i=0;$i<count($F_USER_FILE_RIGHTS);$i++){
    if($MA_USERNAME===$F_USER_FILE_RIGHTS[$i][0]){
      $ri=$F_USER_FILE_RIGHTS[$i][1];
    }
  }
  $dnx=$F_FILESTORE;
  if(isset($ri)){
      if (isset($_POST['dname'])){
          $dn=$_POST['dname'];
          if (is_dir($dn)){
              $F_FILESTORE=$dn;
          }
      }
      echo("<div class=frow>");
      echo("<form id=00 method=post>");
        echo("<input type=hidden id=dname name=dname value=\"$F_FILESTORE\">");
      echo("<div class=pcol1>");
        echo("<input type=text id=searchn name=searchn placeholder=\"$F_SEARCH\" value=\"\">");
      echo("</div>");
      echo("<div class=pcol2>");
    echo("<span style=\"color:transparent;\">?</span>");
      echo("</div>");
      echo("<div class=pcol2>");
      echo("<input class='tbutton' type=submit id=ssubmit name=ssubmit value=\"$F_SEARCH\">");
      echo("</div>");
        echo("</form>");
      echo("</div>");
      if (isset($_POST['searchn'])){
          $F_SEARCHSTRING=strtoupper($_POST['searchn']);
      }
    $fl=array();
    $w=0;
    for($i=0;$i<count($ri);$i++){
      #$flx=glob("$F_FILESTORE/*$ri[$i]*.pdf");
      $flx=glob("$F_FILESTORE/$ri[$i]*");
      for($k=0;$k<count($flx);$k++){
          if (str_contains(strtoupper($flx[$k]),$F_SEARCHSTRING)){
            $fl=$fl+array("$w"=>"$flx[$k]");
            $w++;
            if($w===$F_FILECOUNTLIMIT){
              $k=count($flx);
              $i=count($ri);
            }
        }
      }
    }
      $fdb=count($fl);
    if (isset($_POST['page'])){
      $page=(int)$_POST['page'];
      $first=$F_PAGEROW*$page;
    }else{
      $page=0;
      $first=0;
    }
    $last=false;
    $adb=$first+$F_PAGEROW;
    if ($adb>=$fdb){
      $last=true;
    }
    $dnl=explode("/",$F_FILESTORE);
    if (count($dnl)>1){
            $dn=$dnx;
        $dnl[0]="/";
        for($i=0;$i<count($dnl)-1;$i++){
            if ($dnl[$i]<>""){
                if ($dnl[$i]<>"/"){
                    $dn=$dn."/".$dnl[$i];
                }
                echo("<span style=\"float:left;\">");
                echo("<form id=$i method=post>");
                  echo("<input type=hidden id=dname name=dname value=\"$dn\">");
                  echo("<input class='tbutton' style=\"width:auto;padding:10px;margin:10px;\" type=submit id=dnamego name=dnamego value=\"$dnl[$i]\">");
                echo("</form>");
                echo("</span>");
            }
        }
    }
    echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$F_FILTER\">");
    echo("<center>");
    echo("<table class='df_table_full' id=ptable>");
    echo("<tr class='df_trh'>");
    echo("<th class='df_th'>$F_TABLE_TITLE[0]</th>");
    echo("<th class='df_th2'>$F_TABLE_TITLE[1]</th>");
    echo("<th class='df_th2'>$F_TABLE_TITLE[2]</th>");
    echo("</tr>");
    $row=0;
    for($i=0;$i<$fdb;$i++){
      if(($i>=$first)and($i<($first+$F_PAGEROW))){
        $row++;
        echo("<tr class=df_tr>");
        $fn=substr($fl[$i],strlen($F_FILESTORE)+1,strlen($fl[$i]));
        $fnl="./".$fl[$i];
        if (is_dir("$F_FILESTORE/$fn")){
            echo("<td class='df_td'>$fn</td>");
            echo("<td class='df_td'><center>-</center></td>");
            echo("<td class='df_td'>");
            echo("<center>");
              echo("<form id=10$i method=post>");
              echo("<input type=hidden id=dname name=dname value=\"$F_FILESTORE/$fn\">");
              echo("<input class='tbutton' style=\"width:30%;padding:0px;margin:0px;\" type=submit id=dnamego name=dnamego value=\"$F_GO\">");
            echo("</form>");
            echo("</td>");
        }else{
            echo("<td class='df_td'>$fn</td>");
            $fd=date ("Y.m.d. H:i:s.", filemtime("$fnl"));
            echo("<td class='df_td'><center>$fd</center></td>");
            echo("<td class='df_td'>");
            echo("<center>");
            echo("<a href=\"$fl[$i]\"><input class='tbutton' style=\"width:30%;padding:0px;margin:0px;\" type=submit value=\"$F_GO\"></a>");
            echo("</td>");
        }
        echo("</tr>");
      }
    }
    echo("</table>");

    echo("<div class=frow>");
    echo("<div class=pcol2>");
    if (($page>0)and($first>0)){
      echo("<form method=post>");
      $p=$page-1;
          echo("<input type=hidden id=dname name=dname value=\"$F_FILESTORE\">");
      echo("<input type=hidden id=page name=page value=\"$p\">");
      echo("<input type=submit id=p name=p value=\"$F_PAGE_LEFT\">");
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
    if (($row==$F_PAGEROW)and(!$last)){
      $p=$page+1;
      echo("<form method=post>");
          echo("<input type=hidden id=dname name=dname value=\"$F_FILESTORE\">");
      echo("<input type=hidden id=page name=page value=\"$p\">");
      echo("<input type=submit id=p name=p value=\"$F_PAGE_RIGHT\">");
      echo("</form>");
    }else{
      echo("<span style=\"color:transparent;\">?</span>");
    }
    echo("</div>");;
    echo("</div>");
  }else{
    mess_error("$MA_USERNAME: $F_NOCONFIG");
  }
}


?>
