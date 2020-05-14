<?php

#
# File list from directory (insert with iframe to webpage)
#
# 2019. WSWDTeam GPLv3
#
#


	$FL_LANG=array('Név','Dátum','Méret');
	$FL_FILEEXT=array('php','jpg');

	$FL_DIR='.';

	$FL_LINK_TARGET_NEW_WINDOW=false;
?>


<style type="text/css">
  .fl_table {
    width:90%;
  }
  
  .fl_trh {
    background-color:lightblue;
  }
  
  .fl_th1 {
    padding:5px;
    color:#a7a8a8;
    width:60%;
  }
  
  .fl_th2 {
    padding:5px;
    color:#a7a8a8;
    width:20%;
  }
  
  .fl_tr:nth-child(even){
    background-color:white;
  }

  .fl_tr:nth-child(odd) {
    background-color:#f2f2f2;
  }
  
  .fl_td {
    color:#808080;
    text-align:left;
  } 
  
  .fl_td2 {
    color:#808080;
    text-align:center;
  }
  
  .fl_tds {
    color:red;
  }
  
  .fl_tda {
    text-decoration:none;
    color:#808080;'
  }


</style>


<?php

function formatBytes($size, $precision=2){
	if($size < 0) {
		size=$size + PHP_INT_MAX + PHP_INT_MAX + 2;
	}
	$base=log($size, 1024);
	$suffixes=array('', 'K', 'M', 'G', 'T');   
	return round(pow(1024,$base-floor($base)),$precision).' '.$suffixes[floor($base)];
}


if ($FL_LINK_TARGET_NEW_WINDOW){
	$target="_blank";
}else{
	$target="";
}

echo("<center>");
echo("<table class='fl_table'>");
echo("<tr class='fl_trh'>");
echo("<th class='fl_th1'>$FL_LANG[0]</th>");
echo("<th class='fl_th2'>$FL_LANG[1]</th>");
echo("<th class='fl_th2'>$FL_LANG[2]</th>");
echo("</tr>");


$files=scandir($FL_DIR);
asort($files);
foreach ($files as $entry) {
	if ($entry!="." && $entry!="..") {
		$fileext=explode('.',$entry);
		$fileext_name=$fileext[count($fileext)-1];
		$fileext_name2='.'.$fileext_name;
		if ((in_array($fileext_name, $FL_FILEEXT))or(in_array($fileext_name2, $FL_FILEEXT))){
			echo("<tr class='fl_tr'>");
			$fileext_name=strtoupper($fileext_name);
			echo("<td class='fl_td'><span class='fl_tds'>[$fileext_name]</span> ");
			echo("<a href='$FL_DIR/$entry' target='$target' class='fl_tda'>$entry</a></td>");
			$m=filectime($FL_DIR.'/'.$entry);
			$m=gmdate("Y.m.d", $m);
			echo("<td class='fl_td2'>$m</td>");
			$m=filesize($FL_DIR.'/'.$entry);
			$m=formatBytes($m);
			echo("<td class='fl_td2'>$m</td>");
			echo("</tr>");
		}
	}
}

echo("</table>");
echo("</center>");

?>



