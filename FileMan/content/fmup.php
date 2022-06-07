<?php

 #
 # MiniApp - FileMan
 #
 # info: main folder copyright file
 #
 #

function fm_up(){
	global $DF_DIR,$DF_FILEDIR,$DF_UPFILE,$DF_NEWDIR,$DF_DELDIR,$DF_DIRNAME,
			$DF_BUTTON_TEXT,$DF_SECTIONCREATE,$DF_OK,$DF_ERROR,$DF_SECTIONDELETE,
			$DF_SECTIONUPFILE,$DF_SECTIONDELFILE,$DF_DELFILE;

	echo("$DF_FILEDIR");
	$cardnum=1000;

	$cardnum++;
	echo('
		<div class="df-card">
		<div class="df-card-header" id="dfardheader'.$cardnum.'">
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="df-topleftmenu1">
			'.$DF_UPFILE.'
		</span>
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="df-topright" id="dfcardright'.$cardnum.'">
			+
		</span>
		</div>
		<div class="df-card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
	');
	echo($DF_SECTIONUPFILE);
	echo("<form  method='post' enctype='multipart/form-data'>");
	echo("<select name='dirn' id='dirn'>");
	echo("<option>");
	$dirs=glob("$DF_DIR/*",GLOB_ONLYDIR);
	$db=count($dirs);
	for ($i=0;$i<$db;$i++){
		$tn=explode("/",$dirs[$i]);
		$le=count($tn)-1;
		if ($tn[$le]<>""){
			echo("<option>$tn[$le]");
		}
	}
	echo("</select>");
	echo("<input type='file' name='filename' id='filename'>");
	echo("<input type='submit' value='$DF_BUTTON_TEXT' name='submitup'>");
	echo("</form>");
	echo("</div>");
	echo("</div>");

	$cardnum++;
	echo('
		<div class="df-card">
		<div class="df-card-header" id="dfardheader'.$cardnum.'">
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="df-topleftmenu1">
			'.$DF_NEWDIR.'
		</span>
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="df-topright" id="dfcardright'.$cardnum.'">
			+
		</span>
		</div>
		<div class="df-card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
	');
	echo("<form  method='post' enctype='multipart/form-data'>");
	echo("<input type='text' name='new' id='new' placeholder='$DF_DIRNAME' autofocus>");
	echo("<input type='submit' value='$DF_BUTTON_TEXT' name='submitnew'>");
	echo("</form>");
	echo("</div>");
	echo("</div>");

	$cardnum++;
	echo('
		<div class="df-card">
		<div class="df-card-header" id="dfardheader'.$cardnum.'">
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="df-topleftmenu1">
			'.$DF_DELDIR.'
		</span>
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="df-topright" id="dfcardright'.$cardnum.'">
			+
		</span>
		</div>
		<div class="df-card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
	');
	echo($DF_SECTIONDELETE);
	echo("<form  method='post' enctype='multipart/form-data'>");
	echo("<select name='del' id='del'>");
	$dirs=glob("$DF_DIR/*",GLOB_ONLYDIR);
	$db=count($dirs);
	for ($i=0;$i<$db;$i++){
		$tn=explode("/",$dirs[$i]);
		$le=count($tn)-1;
		if ($tn[$le]<>""){
			echo("<option>$tn[$le]");
		}
	}
	echo("</select>");
	echo("<input type='submit' value='$DF_BUTTON_TEXT' name='submitdel'>");
	echo("</form>");
	echo("</div>");
	echo("</div>");

	$cardnum++;
	echo('
		<div class="df-card">
		<div class="df-card-header" id="dfardheader'.$cardnum.'">
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="df-topleftmenu1">
			'.$DF_DELFILE.'
		</span>
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="df-topright" id="dfcardright'.$cardnum.'">
			+
		</span>
		</div>
		<div class="df-card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
	');
	echo($DF_SECTIONDELFILE);
	echo("<form  method='post' enctype='multipart/form-data'>");
	echo("<select name='delfile' id='delfile'>");
	fm_dirs($DF_DIR);
	echo("</select>");
	echo("<input type='submit' value='$DF_BUTTON_TEXT' name='submitdelfile'>");
	echo("</form>");
	echo("</div>");
	echo("</div>");

}

function fm_dirs($dir){
	$filelist=scandir($dir);
	asort($filelist);
	$db=count($filelist);
	for ($i=0;$i<$db;$i++){
		if (is_dir($filelist[$i])){
			if (($filelist[$i]<>".")and($filelist[$i]<>"..")){
				$dir2=$dir."/".$filelist[$i];
				fm_dirs($dir2);
			}
		}else{
			$fn=$dir."/".$filelist[$i];
			echo("<option>$fn");
		}
	}
}

?>
