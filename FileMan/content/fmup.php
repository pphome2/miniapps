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
	cards_new($DF_UPFILE);
	echo($DF_SECTIONUPFILE);
	echo("<form method='post' enctype='multipart/form-data'>");
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
	echo("<textarea name='texta' id='texta'></textarea>");
	echo("<input type='submit' value='$DF_BUTTON_TEXT' name='submitup'>");
	echo("</form>");
	cards_close();

	$cardnum++;
	cards_new($DF_NEWDIR);
	echo("<form  method='post' enctype='multipart/form-data'>");
	echo("<input type='text' name='new' id='new' placeholder='$DF_DIRNAME' autofocus>");
	echo("<input type='submit' value='$DF_BUTTON_TEXT' name='submitnew'>");
	echo("</form>");
	cards_close();

	$cardnum++;
	cards_new($DF_DELDIR);
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
	cards_close();

	$cardnum++;
	cards_new($DF_DELFILE);
	echo($DF_SECTIONDELFILE);
	echo("<form  method='post' enctype='multipart/form-data'>");
	echo("<select name='delfile' id='delfile'>");
	fm_dirs($DF_DIR);
	echo("</select>");
	echo("<input type='submit' value='$DF_BUTTON_TEXT' name='submitdelfile'>");
	echo("</form>");
	cards_close();

}

function fm_dirs($dir){
	global $DF_EXCLUDEDIR,$DF_NAMELENGTH,$DF_TEXT_EXT;

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
                    $ext=substr($fnd,strlen($fnd)-strlen($DF_TEXT_EXT),strlen($DF_TEXT_EXT));
                    if ($ext<>$DF_TEXT_EXT){
					    echo("<option value=$fn>$fnd</option>");
					}
				}else{
					fm_dirs($fn);
				}
			}
		}
	}
}

?>
