<?php

 #
 # MiniApp - FileMan
 #
 # info: main folder copyright file
 #
 #

$cardnum=0;

function fm_dl(){
	global $DF_DIR;

	ftable($DF_DIR);
	dirfiletable($DF_DIR);
}


function formatBytes($size, $precision=2){
    if($size < 0) {
        $size=$size + PHP_INT_MAX + PHP_INT_MAX + 2;
    }
    $base=log($size, 1024);
    $suffixes=array('', 'K', 'M', 'G', 'T');
    return round(pow(1024,$base-floor($base)),$precision).' '.$suffixes[floor($base)];
}


function filetable($entry){
	global $DF_FILEEXT,$DF_LANG,$DF_DOWNLOAD_TEXT,$DF_USE_FILEEXT;

	echo("<table class='df_table_full'>");
	echo("<tr class='df_trh'>");
	echo("<th class='df_th1'>$DF_LANG[0]</th>");
	echo("<th class='df_th2'>$DF_LANG[1]</th>");
	echo("<th class='df_th2'>$DF_LANG[2]</th>");
	echo("</tr>");
	$files=scandir($entry);
	asort($files);
	foreach ($files as $e){
		if (($e!=".") && ($e!="..") && !is_dir($entry.'/'.$e)){
			echo("<tr class='df_tr'>");
			$fe=explode('.',$e);
			$i=count($fe)-1;
			$fileext_name=$fe[$i];
			$ok=false;
			if ($DF_USE_FILEEXT){
				if (in_array($fileext_name,$DF_FILEEXT)){
					$ok=true;
				}
			}else{
				$ok=true;
			}
			if ($ok){
				$fileext_name=strtoupper($fileext_name);
				echo("<td class='df_td'><span class='df_tds'>[$fileext_name]</span> ");
				echo("<a href=\"$dir/$entry\" class='df_tda'>$e</a>");
				echo(" - <a href=\"$entry/$e\" download class='df_tda2' onclick='delrow(this);'>$DF_DOWNLOAD_TEXT</a>");
				echo("</td>");
				$m=filectime($entry.'/'.$e);
				$m=gmdate("Y.m.d", $m);
				echo("<td class='df_td2'>$m</td>");
				$m=filesize($entry.'/'.$e);
				$m=formatBytes($m);
				echo("<td class='df_td2'>$m</td>");
				echo("</tr>");
			}
		}
	}
	echo("</table>");
	echo("</center>");
}


function ftable($dir){
	global $cardnum;

	$cardnum++;
	$dn=basename($dir);
	echo('
		<div class="df-card">
		<div class="df-card-header" id="dfardheader'.$cardnum.'">
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="df-topleftmenu1">
			'.$dn.'
		</span>
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="df-topright" id="dfcardright'.$cardnum.'">
			+
		</span>
		</div>
		<div class="df-card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
	');
	filetable($dir);
	echo("</div>");
	echo("</div>");
}


function dirfiletable($dir){
	global $cardnum;

	$dirs=glob("$dir/*",GLOB_ONLYDIR);
	asort($dirs);
	foreach ($dirs as $entry) {
		$cardnum++;
		$entryname=basename($entry);
		echo('
			<div class="df-card">
			<div class="df-card-header" id="dfardheader'.$cardnum.'">
			<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="df-topleftmenu1">
				'.$entryname.'
			</span>
			<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="df-topright" id="dfcardright'.$cardnum.'">
				+
			</span>
			</div>
			<div class="df-card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
		');
		filetable($entry);
		echo("</div>");
		echo("</div>");
		dirfiletable($entry);
	}
}


?>
