<?php

header("Content-Type: text/html; charset=iso-8859-2");


$db=0;
foreach ($_GET as $key => $data) {
  if ($data<>""){
    $dtk[$db]=$key;
    $dte[$db]=$data;
    $db+=1;
  }
}
    
switch ($dte[$db-1]){
  case "11":
    $vissza="Dell;FSC;Albacomp;HP";
    break;
  case "12":
    $vissza="HP;Canon;Epson";
    break;
  case "13":
    $vissza="LG;HP;Albacomp;Samsung";
    break;
  case "14":
    $vissza="Logitech;Genius";
    break;
  case "15":
    $vissza="Logitech;Genius;Chicony";
    break;
  case "16":
    $vissza="Logitech;Genius;Creative";
    break;
  case "21":
    $vissza="Nokia;SonyEriksson;Samsung;LG";
    break;
  case "22":
    $vissza="Canon";
    break;
  case "23":
    $vissza="Canon;Xerox";
    break;
  default:
    $vissza="Válasszon terméket";
    break;
}
                                                           
echo($vissza);

?>