<?php

#
# File list for download from directory (insert iframe to webpage)
# (show text for files)
#
# 2019. WSWDTeam GPLv3
#
#


    $DF_LANG=array('Név','Dátum','Méret');
    $DF_DOWNLOAD_TEXT='Letöltés';
    $DF_FILEEXT=array('jpg','php');

    $DF_DIR='./dir';
    $DF_TEXTFILE_EXT='.txt';

    $DF_LINK_TARGET_NEW_WINDOW=false;
    $table=false;
    $dirnum=0;

?>

<!DOCTYPE HTM>
<html>
    <head>
	<title>DownloadFile</title>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="favicon.png">
	<link rel="icon" type="image/x-icon" href="favicon.png">
    </head>
<body>



<style type="text/css">
  .dl-content {
    margin:20px;
    padding:20px;
  }

  .df_table {
    width:90%;
  }

  .df_trh {
    background-color:lightblue;
  }

  .df_th1 {
    padding:5px;
    color:#a7a8a8;
    width:60%;
  }

  .df_th2 {
    padding:5px;
    color:#a7a8a8;
    width:20%;
  }

  .df_tr:nth-child(even){
    background-color:white;
  }

  .df_tr:nth-child(odd) {
    background-color:#f2f2f2;
  }

  .df_td {
    color:#808080;
    text-align:left;
    padding:10px;
  }

  .df_td2 {
    color:#808080;
    text-align:center;
  }

  .df_tds {
    color:red;
  }

  .df_tda {
    text-decoration:none;
    color:#808080;
  }

  .df_tda2 {
    text-decoration:none;
    color:red;
  }

  .df_table {
    width:90%;	Dátum	Méret
[JPG] test.jpg -
  }

  .df_trh {
    background-color:lightblue;
  }

  .df_th1 {
    padding:5px;
    color:#a7a8a8;
    width:60%;
  }

  .df_th2 {
    padding:5px;
    color:#a7a8a8;
    width:20%;
  }

  .df_tr:nth-child(even){
    background-color:white;
  }

  .df_tr:nth-child(odd) {
    background-color:#f2f2f2;
  }

  .df_td {
    color:#808080;
    text-align:left;
    padding:10px;
  }

  .df_td2 {
    color:#808080;
    text-align:center;
  }

  .df_tds {
    color:red;
  }

  .df_tda {
    text-decoration:none;
    color:#808080;
  }

  .df_tda2 {
    text-decoration:none;
    color:red;
  }

  .df-card-header {
    padding:5px;
    background-color:#2196F3;
    color:white;
    font-size:1.3em;
    cursor: default;
  }

  .df-card-body {
    padding:10px;
  }

  .df-topleftmenu1{
    text-decoration:bold;
	display: inline-block;
	vertical-align: middle;
    margin-top:5px;
    font-size:1em;
  }

  .df-topleftmenu1:before {
    content:'\2630';
    padding-right:10px;
    padding-left:10px;
    margin-bottom:5px;
    text-decoration:bold;
	display: inline-block;
	vertical-align: middle;
    font-size:1em;
  }

  .df-topright {
    text-decoration:none;
    position:absolute;
    right:10px;
    top:7px;
    font-size:1em;
    color:white;
  }

  .df_table_full {
    width:100%;
    padding:20px;
  }

  .df-card {
    position:relative;
    display:block;
    cursor:default;
    clear:both;
    margin-top:20px;
    margin-bottom:20px;
    box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
  }

  .df_tr:nth-child(even){
    background-color:white;
  }

  .df_tr:nth-child(odd) {
    background-color:#f2f2f2;
  }

</style>

<body>
<div class=dl-content>

<?php

function formatBytes($size, $precision=2){
    if($size < 0) {
        size=$size + PHP_INT_MAX + PHP_INT_MAX + 2;
    }
    $base=log($size, 1024);
    $suffixes=array('', 'K', 'M', 'G', 'T');
    return round(pow(1024,$base-floor($base)),$precision).' '.$suffixes[floor($base)];
}



function filetable($dir){
	global $DF_FILEEXT,$DF_LANG,$DF_TEXTFILE_EXT,$DF_DOWNLOAD_TEXT,$DF_LANG,$table,$dirnum;

	$files=scandir($dir);
	asort($files);
	$fdb=0;
	$dirnum++;
	foreach ($files as $entry) {
		if ($entry!="." && $entry!=".." && $entry!="lost+found") {
			$dirn=$dir.'/'.$entry;
			if (is_dir($dirn)){
				echo('
					<div class="df-card">
						<div class="df-card-header" id="dfardheader'.$dirnum.'">
							<span onclick="cardclose(dfcardbody'.$dirnum.',dfcardright'.$dirnum.')" class="df-topleftmenu1">
								'.$entry.'
							</span>
							<span onclick="cardclose(dfcardbody'.$dirnum.',dfcardright'.$dirnum.')" class="df-topright" id="dfcardright'.$dirnum.'">
								+
							</span>
						</div>
						<div class="df-card-body" id="dfcardbody'.$dirnum.'" style="display:none;">
				');
				echo("<table class='df_table_full'>");
				echo("<tr class='df_trh'>");
				echo("<th class='df_th1'>$DF_LANG[0]</th>");
				echo("<th class='df_th2'>$DF_LANG[1]</th>");
				echo("<th class='df_th2'>$DF_LANG[2]</th>");
				echo("</tr>");
				$table=true;
				filetable($dirn);
				$table=false;
			}else{
				if (!$table){
					$dn=explode('/',$dir);
					$s=count($dn)-1;
					$dirx=$dn[$s];
					echo('
						<div class="df-card">
							<div class=df-card-header>
								<span onclick="cardclose(dfcardbody'.$dirnum.',dfcardright'.$dirnum.')" class="df-topleftmenu1">
								'.$entry.'
							</span>
							<span onclick="cardclose(dfcardbody'.$dirnum.',dfcardright'.$dirnum.')" class="df-topright" id="dfcardright'.$dirnum.'">
								+
							</span>
							</div>
							<div class="df-card-body" id="dfcardbody'.$dirnum.'" style="display:none;">
					');
					echo("<table class='df_table_full'>");
					echo("<tr class='df_trh'>");
					echo("<th class='df_th1'>$DF_LANG[0]</th>");
					echo("<th class='df_th2'>$DF_LANG[1]</th>");
					echo("<th class='df_th2'>$DF_LANG[2]</th>");
					echo("</tr>");
					$table=true;
				}
			}
			$fileext=explode('.',$entry);
			$fileext_name=$fileext[count($fileext)-1];
			$fileext_name2='.'.$fileext_name;
			if ((in_array($fileext_name, $DF_FILEEXT))or(in_array($fileext_name2, $DF_FILEEXT))){
				echo("<tr class='df_tr'>");
				$fileext_name=strtoupper($fileext_name);
				echo("<td class='df_td'><span class='df_tds'>[$fileext_name]</span> ");
				echo("<a href='$dir/$entry' target='$target' class='df_tda'>$entry</a>");
				echo(" - <a href='$dir/$entry' download class='df_tda2' onclick='delrow(this);'>$DF_DOWNLOAD_TEXT</a>");
				$entry2=$dir.'/'.$entry.$DF_TEXTFILE_EXT;
				if (file_exists($entry2)){
					echo("<br />");
					include($entry2);
				}
				echo("</td>");
				$m=filectime($dir.'/'.$entry);
				$m=gmdate("Y.m.d", $m);
				echo("<td class='df_td2'>$m</td>");
				$m=filesize($dir.'/'.$entry);
				$m=formatBytes($m);
				echo("<td class='df_td2'>$m</td>");
				echo("</tr>");
			}
		}
	}
	if ($table){
		echo("</table>");
		echo("</center>");
		echo("</div>");
		echo("</div>");
	}

}


if ($DF_LINK_TARGET_NEW_WINDOW){
    $target="_blank";
}else{
    $target="";
}


filetable($DF_DIR);


?>

</div>

<script>
    function delrow(obj){
		obj2=obj.parentNode;
		obj2.parentNode.style.display='none';
    }

	function cardclose(th,th2){
		if (th.style.display=='none'){
			th.style.display='block';
			th2.innerHTML=' -- ';
		} else {
			th.style.display='none';
			th2.innerHTML=' + ';
		}
	}
</script>


</body>
</html>
