<?php

// app

echo("<center>");
echo("<h1>Munkalap</h1>");

echo("<span class=wdhdspaceholder></span>");
echo("<table style=\"width:60%;border: 2px solid;align:\">");
echo("<tr>");
echo("<td style=\"padding:1em;width:50%;border: 2px solid;vertical-align:top;\">");
$t=explode(PHP_EOL,$_POST['0']);
foreach($t as $tt){
  echo "$tt <br />";
}
echo("</td>");
echo("<td style=\"padding:1em;width:50%;border: 2px solid;vertical-align:top;\">");
$t=explode(PHP_EOL,$_POST['1']);
foreach($t as $tt){
  echo "$tt <br />";
}
echo("</td>");
echo("</tr>");

echo("<tr>");
echo("<td style=\"padding:1em;width:50%;border: 2px solid;valign:top;vertical-align:top;\">");
echo("<b>Bejelentés</b><br /><br />");
echo("Bejelentés ideje: ".$_POST['3']."<br />");
echo("Bejelentő: ".$_POST['5']."<br />");
echo("Telefonszám: ".$_POST['7']."<br />");
echo("E-mail: ".$_POST['8']."<br />");
echo("Részletes leírás: <br />".$_POST['9']."<br />");
echo("</td>");
echo("<td style=\"padding:1em;width:50%;border: 2px solid;vertical-align:top;vertical-align:top;\">");
echo("<b>Elvégzett munka</b><br /><br />");
echo("Kijelölt feladat: ".$_POST['11']."<br />");
echo("Elvégzett feladat: <br />".$_POST['13']."<br />");
echo("Felhasznált alkatrészek: ".$_POST['14']."<br />");
echo("Munkaidő (óra): ".$_POST['15']."<br />");
echo("Kiszállás (km): ".$_POST['16']."<br />");
echo("</td>");
echo("</tr>");

#echo("<tr>");
#echo("<td style=\"padding:1em;width:50%;border: 1px solid;\">");
#foreach($_POST as $k=>$v){
#  echo "$k = $v <br />";
#}
#echo("</td>");
#echo("</tr>");

echo("<tr>");
echo("<td style=\"padding:1em;width:50%;border: 2px solid;\">");
echo("Munkalap készült: ".date('Y.m.d. H:m'));
echo("</td>");
echo("<td style=\"padding:1em;width:50%;border: 2px solid;\">");
echo("Munkavégzés befejezése: ".$_POST['17']." (".$_POST['18'].")");
echo("</td>");
echo("</tr>");
echo("<tr>");
echo("<td style=\"padding:1em;width:50%;border: 2px solid;text-align:center;\">");
echo("<br /><br /><br />");
echo("____________________________________________<br />");
echo("Megrendelő aláírása");
echo("</td>");
echo("<td style=\"padding:1em;width:50%;border: 2px solid;text-align:center;\">");
echo("<br /><br /><br />");
echo("____________________________________________<br />");
echo("Munkát végzők aláírása");
echo("</td>");
echo("</tr>");
echo("</table>");
echo("<span class=wdhdspaceholder></span>");

echo("</center>");

?>
