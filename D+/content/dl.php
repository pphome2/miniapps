<?php

 #
 # Dokumentum
 #
 # info: main folder copyright file
 #
 #



function d_lists(){
  global $D_LISTS,$D_LISTCODE,$D_GO,$MA_SQL_RESULT,$D_SITE;

  $listall=true;
  if (isset($_POST['lcode'])){
    switch ($_POST['lcode']){
      case $D_LISTCODE[0]:
        $listall=false;
        d_listlive($D_LISTS[0]);
        break;
      default:
        $listall=true;
        break;
    }
  }
  if ($listall){
    echo("<div class=frow>");
    echo("<div class=colx1></div>");
    echo("<div class=colx2>");
    echo("<div class=spaceline></div>");

    echo("<h3>$D_LISTS[0]</h3>");
    echo("<form method=post>");
    echo("<input type=hidden id=lcode name=lcode value=\"$D_LISTCODE[0]\">");
    echo("<input type=submit id=x name=x value=\"$D_GO\">");
    echo("</form>");
    echo("<div class=spaceline></div>");



    echo("</div>");
    echo("<div class=colx1></div>");
    echo("</div>");
  }
}



?>
