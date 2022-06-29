<?php

 #
 # MiniApp - FileMan
 #
 # info: main folder copyright file
 #
 #


$tablenum=0;
$cardnum=0;

function fm_dl(){
	global $DF_DIR;

	ftable($DF_DIR);
	dirfiletable($DF_DIR);
}


function formatbytes($size, $precision=2){
    if($size < 0) {
        $size=$size + PHP_INT_MAX + PHP_INT_MAX + 2;
    }
    $base=log($size, 1024);
    $suffixes=array('b', 'Kb', 'Mb', 'Gb', 'Tb');
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
            table_new($DF_TABLEHEADER);
	    }
    	$tablenum++;
    }else{
        table_new($DF_TABLEHEADER);
    }
}


function filetfooter(){
	global $tablenum,$DF_COMPACTDIR;

    $tablenum--;
    if ($DF_COMPACTDIR){
        if ($tablenum==0){
            table_close();
        }
    }else{
        table_close();
    }
}


function filetable($entry){
	global $DF_FILEEXT,$DF_DOWNLOAD_TEXT,$DF_USE_FILEEXT,
			$DF_EXCLUDEDIR,$DF_TEXT_EXT;

	$files=scandir($entry);
	asort($files);
	foreach ($files as $e){
		if (($e!=".") && ($e!="..") && !is_dir($entry.'/'.$e)){
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
				$td[0]="<span class='df_tds'>[$fileext_name]</span> ";
				$td[0]=$td[0]."<a href=\"$entry\" class='df_tda'>$en</a>";
				$td[0]=$td[0]." - <a href=\"$entry/$e\" download class='df_tda2' onclick='delrow(this);'>$DF_DOWNLOAD_TEXT</a>";
				$txt=$entry.'/'.$e.$DF_TEXT_EXT;
				if (file_exists($txt)){
				    $td[0]=$td[0]."<br />";
				    $td[0]=$td[0]."<br />";
				    $txtcont=file_get_contents($txt);
				    $td[0]=$td[0].$txtcont;
				}
				$m=filectime($entry.'/'.$e);
				$m=gmdate("Y.m.d", $m);
				$td[1]="$m";
				$m=filesize($entry.'/'.$e);
				$m=formatbytes($m);
				$td[2]="$m";
				table_tr($td);
			}
		}
	}
}


function ftable($dir){
	$dn=basename($dir);
	$dn=namecheck($dn);
	cards_new($dn);
  	filetheader();
	filetable($dir);
	filetfooter();
	cards_close();
}


function dirfiletable($dir){
	global $DF_EXCLUDEDIR,$DF_COMPACTDIR,$cardnum;

	$dirs=glob("$dir/*",GLOB_ONLYDIR);
	asort($dirs);
	foreach ($dirs as $entry) {
		$entryname=basename($entry);
		if (!in_array($entryname,$DF_EXCLUDEDIR)){
		    $cardnum++;
        	$entryname=namecheck($entryname);
        	cards_new($entryname);
  			filetheader();
			filetable($entry);
			if (!$DF_COMPACTDIR){
            	filetfooter();
            	cards_close();
    		}
		}
		if ($DF_COMPACTDIR){
		    dirfiletablecompact($entry);
        	filetfooter();
        	cards_close();
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
