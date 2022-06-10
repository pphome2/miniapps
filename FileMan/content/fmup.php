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
			$DF_SECTIONUPFILE,$DF_SECTIONDELFILE,$DF_DELFILE,$DF_EXCLUDEDIR,
			$DF_FILESELECT;

	echo("$DF_FILEDIR");
	$cardnum=1000;

	$cardnum++;
	echo('
		<div class="card">
		<div class="card-header" id="dfardheader'.$cardnum.'">
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topleftmenu1">
			'.$DF_UPFILE.'
		</span>
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topright" id="dfcardright'.$cardnum.'">
			&#65088;
		</span>
		</div>
		<div class="card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
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
		if (($tn[$le]<>"")and(!in_array($tn[$le],$DF_EXCLUDEDIR))){
			echo("<option>$tn[$le]</option>");
		}
	}
	echo("</select>");
	#echo("<input type='file' name='filename' id='filename'>");
	echo("<div class='upload-btn-wrapper'>");
	echo("<input type='file' name=filename id=filename  />");
	echo("<label for=fileupload class='upload-btn'>$DF_FILESELECT</label>");
	echo("</div>");
	echo("<input type='submit' value='$DF_BUTTON_TEXT' name='submitup'>");
	echo("</form>");
	echo("</div>");
	echo("</div>");

	$cardnum++;
	echo('
		<div class="card">
		<div class="card-header" id="dfardheader'.$cardnum.'">
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topleftmenu1">
			'.$DF_NEWDIR.'
		</span>
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topright" id="dfcardright'.$cardnum.'">
			&#65088;
		</span>
		</div>
		<div class="card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
	');
	echo("<form  method='post' enctype='multipart/form-data'>");
	echo("<input type='text' name='new' id='new' placeholder='$DF_DIRNAME' autofocus>");
	echo("<input type='submit' value='$DF_BUTTON_TEXT' name='submitnew'>");
	echo("</form>");
	echo("</div>");
	echo("</div>");

	$cardnum++;
	echo('
		<div class="card">
		<div class="card-header" id="dfardheader'.$cardnum.'">
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topleftmenu1">
			'.$DF_DELDIR.'
		</span>
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topright" id="dfcardright'.$cardnum.'">
			&#65088;
		</span>
		</div>
		<div class="card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
	');
	echo($DF_SECTIONDELETE);
	echo("<form  method='post' enctype='multipart/form-data'>");
	echo("<select name='del' id='del'>");
	$dirs=glob("$DF_DIR/*",GLOB_ONLYDIR);
	$db=count($dirs);
	for ($i=0;$i<$db;$i++){
		$tn=explode("/",$dirs[$i]);
		$le=count($tn)-1;
		if (($tn[$le]<>"")and(!in_array($tn[$le],$DF_EXCLUDEDIR))){
			echo("<option>$tn[$le]</option>");
		}
	}
	echo("</select>");
	echo("<input type='submit' value='$DF_BUTTON_TEXT' name='submitdel'>");
	echo("</form>");
	echo("</div>");
	echo("</div>");

	$cardnum++;
	echo('
		<div class="card">
		<div class="card-header" id="dfardheader'.$cardnum.'">
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topleftmenu1">
			'.$DF_DELFILE.'
		</span>
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topright" id="dfcardright'.$cardnum.'">
			&#65088;
		</span>
		</div>
		<div class="card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
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
	global $DF_EXCLUDEDIR,$DF_NAMELENGTH;

	$filelist=scandir($dir);
	asort($filelist);
	$db=count($filelist);
	for ($i=0;$i<$db;$i++){
		if (is_dir($filelist[$i])){
			if (($filelist[$i]<>".")and($filelist[$i]<>"..")
				and(!in_array($filelist[$i],$DF_EXCLUDEDIR))){
				$dir2=$dir."/".$filelist[$i];
				fm_dirs($dir2);
			}
		}else{
			if (!in_array($filelist[$i],$DF_EXCLUDEDIR)){
				$fn=$dir."/".$filelist[$i];
				if (!is_dir($fn)){
				    if (strlen($fn)>$DF_NAMELENGTH){
                        $fndn=basename($fn);
                        $fnd=substr($fn,0,$DF_NAMELENGTH)." ... ".substr($fndn,0,$DF_NAMELENGTH);
                    }else{
                        $fnd=$fn;
                    }
					echo("<option value=$fn>$fnd</option>");
				}else{
					fm_dirs($fn);
				}
			}
		}
	}
}

?>
