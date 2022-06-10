<?php

 #
 # MiniApp - FileMan
 #
 # info: main folder copyright file
 #
 #

$cardnum=0;
$tablenum=0;

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


function namecheck($name){
    global $DF_NAMELENGTH;

    $name=substr($name,0,$DF_NAMELENGTH);
    return($name);
}


function filetheader(){
	global $DF_TABLEHEADER,$DF_COMPACTDIR,$tablenum;

    if ($DF_COMPACTDIR){
        if ($tablenum==0){
            echo("<table class='df_table_full'>");
	        echo("<tr class='df_trh'>");
    	    echo("<th class='df_th1'>$DF_TABLEHEADER[0]</th>");
    	    echo("<th class='df_th2'>$DF_TABLEHEADER[1]</th>");
        	echo("<th class='df_th2'>$DF_TABLEHEADER[2]</th>");
	        echo("</tr>");
	    }
    	$tablenum++;
    }else{
        echo("<table class='df_table_full'>");
        echo("<tr class='df_trh'>");
    	echo("<th class='df_th1'>$DF_TABLEHEADER[0]</th>");
    	echo("<th class='df_th2'>$DF_TABLEHEADER[1]</th>");
        echo("<th class='df_th2'>$DF_TABLEHEADER[2]</th>");
	    echo("</tr>");
    }
}


function filetfooter(){
	global $tablenum,$DF_COMPACTDIR;

    $tablenum--;
    if ($DF_COMPACTDIR){
        if ($tablenum==0){
            echo("</table>");
        }
    }else{
        echo("</table>");
    }
}


function filetable($entry){
	global $DF_FILEEXT,$DF_DOWNLOAD_TEXT,$DF_USE_FILEEXT,
			$D_EXCLUDEDIR;

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
				$en=namecheck($e);
				echo("<td class='df_td'><span class='df_tds'>[$fileext_name]</span> ");
				echo("<a href=\"$dir/$entry\" class='df_tda'>$en</a>");
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
}


function ftable($dir){
	global $cardnum;

	$cardnum++;
	$dn=basename($dir);
	$dn=namecheck($dn);
	echo('
		<div class="card">
		<div class="card-header" id="dfardheader'.$cardnum.'">
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topleftmenu1">
			'.$dn.'
		</span>
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topright" id="dfcardright'.$cardnum.'">
			&#65088;
		</span>
		</div>
		<div class="card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
	');
  	filetheader();
	filetable($dir);
	filetfooter();
	echo("</div>");
	echo("</div>");
}


function dirfiletable($dir){
	global $cardnum,$DF_EXCLUDEDIR,$DF_COMPACTDIR;

	$dirs=glob("$dir/*",GLOB_ONLYDIR);
	asort($dirs);
	foreach ($dirs as $entry) {
		$entryname=basename($entry);
		if (!in_array($entryname,$DF_EXCLUDEDIR)){
		    $cardnum++;
        	$entryname=namecheck($entryname);
	    	echo('
    			<div class="card">
  				<div class="card-header" id="dfardheader'.$cardnum.'">
		    	<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topleftmenu1">
	    			'.$entryname.'
    			</span>
  				<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topright" id="dfcardright'.$cardnum.'">
			    	&#65088;
		    	</span>
	    		</div>
    			<div class="card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
  			');
  			filetheader();
			filetable($entry);
			if (!$DF_COMPACTDIR){
            	filetfooter();
  	    		echo("</div>");
        		echo("</div>");
    		}
		}
		if ($DF_COMPACTDIR){
		    dirfiletablecompact($entry);
        	filetfooter();
        	echo("</div>");
            echo("</div>");
		}else{
		    dirfiletable($entry);
		}
	}
}


function dirfiletablecompact($dir){
	global $DF_EXCLUDEDIR;

	$dirs=glob("$dir/*",GLOB_ONLYDIR);
	asort($dirs);
	foreach ($dirs as $entry) {
		$entryname=basename($entry);
		if (!in_array($entryname,$DF_EXCLUDEDIR)){
			filetable($entry);
		}
        dirfiletablecompact($entry);
	}
}


?>
