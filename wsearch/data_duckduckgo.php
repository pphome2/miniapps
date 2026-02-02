<?php

#
# WSearch
#

# DuckDuckGo engine


$SEARCH_ENGINE = "https://html.duckduckgo.com/html/?q=";
#$SEARCH_ENGINE = "https://google.com/?q=";
#$SEARCH_ENGINE = "https://www.bing.com/search?q=";


function data_engine($query ="",$block="",$url="",$desc="") {
  global $SEARCH_ENGINE;
  
  $data=array();
  if ($query<>"") {
    $query=str_replace(" ","+",$query);
    $url=$SEARCH_ENGINE.$query;
    $html=file($url);
    echo($url."<br /><br />");
    $datanum=0;
    foreach($html as $lineNumber => $line) {
      if (str_contains($line,"<div class=\"result results_links results_links_deep web-result \">")) {
        $datanum++;
      }
      echo "Sor " . ($lineNumber + 1) . ": " . htmlspecialchars($line) . "<br>";
      $data[$datanum]=$data[$datanum].$line;
    }
    echo($datanum);
    foreach($data as $lineNumber => $line) {
      preg_match('/href=["\'](.*?)["\']/i', $line, $match);
      $link = $match[1] ?? '';
      if (strpos("/?",$link)>0) {
        echo " - ".$link."<br />";
      }
        echo " - ".$link."<br />";
      #echo "Sor " . ($lineNumber + 1) . ": " . htmlspecialchars($line) . "<br>";
    }
  }
}


?>

