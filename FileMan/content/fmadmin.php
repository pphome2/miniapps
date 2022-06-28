<?php

 #
 # MiniApp - FileMan
 #
 # info: main folder copyright file
 #
 #

function fm_admin(){
	global $DF_DIR,$DF_FILEDIR,$DF_UPFILE,$DF_NEWDIR,$DF_DELDIR,$DF_DIRNAME,
			$DF_BUTTON_TEXT,$DF_SECTIONCREATE,$DF_OK,$DF_ERROR,$DF_SECTIONDELETE,
			$DF_SECTIONUPFILE,$DF_SECTIONDELFILE,$DF_TEXT_EXT;

	if (isset($_POST['submitnew'])){
		$fns=vinput($_POST['new']);
		if ($fns<>""){
			$fn=$DF_DIR."/".$fns;
			#$fn=dirnametostore($fn);
			if (mkdir($fn)){
				mess_ok($DF_SECTIONCREATE.": ".$DF_OK.".");
			}else{
				mess_error($DF_SECTIONCREATE.": (".$fns.") ".$DF_ERROR.".");
			}
		}
	}

	if (isset($_POST['submitdel'])){
		$fns=vinput($_POST['del']);
		if ($fns<>""){
			$fn=$DF_DIR."/".$fns;
			if (is_dir($fn)){
				$f=scandir($fn);
				$db=count($f);
				for($i=0;$i<$db;$i++){
					if (($f[$i]<>".")and($f[$i]<>"..")){
						$fnx=$fn."/".$f[$i];
						if (file_exists($fnx)){
							unlink($fnx);
						}
					}
				}

			}
			if (rmdir($fn)){
				mess_ok($DF_SECTIONDELETE.": ".$DF_OK.".");
			}else{
				mess_error($DF_SECTIONDELETE.": (".$fns.") ".$DF_ERROR.".");
			}
		}
	}

	if (isset($_POST['submitup'])){
		$fns=vinput($_POST['dirn']);
		$filen=basename($_FILES["filename"]["name"]);
		if ($fns<>""){
			$tfile=$DF_DIR."/".$fns."/".$filen;
			$txtfile=$DF_DIR."/".$fns."/".$filen.$DF_TEXT_EXT;
		}else{
			$tfile=$DF_DIR."/".$filen;
			$txtfile=$DF_DIR."/".$filen.$DF_TEXT_EXT;
		}
		$ok=true;
		if (file_exists($tfile)){
		    unlink($tfile);
		}
		if (move_uploaded_file($_FILES["filename"]["tmp_name"], $tfile)) {
			$ok=true;
		} else {
			$ok=false;
		}
		if ($ok){
			mess_ok($DF_SECTIONUPFILE.": ".$DF_OK.".");
		}else{
			mess_error($DF_SECTIONUPFILE.": (".$fns.") ".$DF_ERROR.".");
		}
		$txt=vinput($_POST['texta']);
		if ($txt<>""){
		    file_put_contents($txtfile,$txt);
		}
	}
}

	if (isset($_POST['submitdelfile'])){
		$fns=vinput($_POST['delfile']);
		if ($fns<>""){
			if (unlink($fns)){
				mess_ok($DF_SECTIONDELFILE.": ".$DF_OK.".");
			}else{
				mess_error($DF_SECTIONDELFILE.": (".$fns.") ".$DF_ERROR.".");
			}
		}
	}

?>
