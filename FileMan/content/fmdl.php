<?php

 #
 # MiniApp - demo
 #
 # info: main folder copyright file
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

function formatBytes($size, $precision=2){
    if($size < 0) {
        $size=$size + PHP_INT_MAX + PHP_INT_MAX + 2;
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
						<div class="df-card-header" onclick="cardclose(dfcardbody'.$dirnum.',dfcardright'.$dirnum.')"id="dfardheader'.$dirnum.'">
							<span class="df-topleftmenu1">
								'.$entry.'
							</span>
							<span class="df-topright" id="dfcardright'.$dirnum.'">
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
							<div class="df-card-header" onclick="cardclose(dfcardbody'.$dirnum.',dfcardright'.$dirnum.')"id="dfardheader'.$dirnum.'">
							<span class="df-topleftmenu1">
								'.$entry.'
							</span>
							<span class="df-topright" id="dfcardright'.$dirnum.'">
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



?>
