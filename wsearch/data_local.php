<?php

#
# WSearch
#

# lokális keresés engine


# keresés

function data_engine($query="",$page=0,$itemperpage=20){
  #$data=array(array());
  $data=array(array("","",""));
  if ($query<>""){
    for($i=0;$i<$itemperpage;$i++){
      $data[$i]=array("","","");
      $data[$i][0]="$i";
      $data[$i][1]="www.$i.hu";
      $data[$i][2]="Ez egy szöveges találat.";
    }
  }
  return($data);
}


# MI válasz

function data_ai($query=""){
  return("MI által generált válasz.");
}

?>

