<?php

 #
 # Imagge Show
 #
 # info: main folder copyright file
 #
 #

function searchpage(){
	echo("search page");
}

	
function privacypage(){
	echo("privacy page");
}

function printpage(){
	echo("print page");
}

function main(){
	global $IS_FULLSCREENBUTTTONTEXT;

	#echo("<div style='display:nowne;' id=fsbutton onclick=fullscreen(this)>Teljes képernyő</div>");
	echo("<div class='btn' id=fsbutton onclick=fullscreen(this)>$IS_FULLSCREENBUTTTONTEXT</div>");
	if (isset($_GET['i'])){
		$d=$_GET['i'];
		if (isset($_GET['n'])){
			$n=$_GET['n'];
		}else{
			$n=0;
		}
		showimage($d,$n);
	}else{
		menu();
	}
}

function menu(){
	global $IS_HEADTEXT,$IS_DIR,$IS_IMGEXT;

	echo("<div class=addr>$IS_HEADTEXT</div>");
	echo("<br /><br />");
	echo("<div class=row100>");
	echo("<div class=col2>");
	$logo="";
	$i=0;
	$f=dirlist($IS_DIR);
	foreach ($f as $v){
		$ext=pathinfo($v,PATHINFO_EXTENSION);
		if (!in_array($ext,$IS_IMGEXT)){
			$cl="c".$i;
			$i++;
			$k=0;
			$fs=dirlist("$IS_DIR/$v");
			foreach ($fs as $vs){
				$sext = pathinfo($vs, PATHINFO_EXTENSION);
				if (!in_array($sext,$IS_IMGEXT)){
					$k++;
				}
			}
			if ($k==0){
				echo("<a class=btn href='?i=$v'>$v</a>");
			}else{
				echo("<div class=btn onclick=col(\"$cl\")>$v</div>");
			}
			echo("<div class=colcont id=$cl>");
			foreach ($fs as $vs){
				$sext=pathinfo($vs,PATHINFO_EXTENSION);
				if (!in_array($sext,$IS_IMGEXT)){
					echo("<a class= btn2 href='?i=$v/$vs'>");
					echo("$vs");
					echo("</a><br />");
				}
			}
			echo("</div>");
		}else{
			$logo="$IS_DIR/$v";
		}
	}
	echo("</div>");
	echo("<div class=col2 style='text-align:center;'>");
	echo("<img class=limg src=$logo>");
	echo("</div>");
	echo("</div>");
}



function showimage($dir,$num){
	global $IS_DIR,$IS_BACKPAGE,$IS_IMGEXT,$IS_IMGNUM,$IS_TEXTEXTENSION;

	$adir=$dir;
	$dir=$IS_DIR."/".$dir;
	#echo("$dir");
	$f=dirlist($dir);
	$img=array();
	$i=0;
	foreach ($f as $v){
		$sext=pathinfo($v,PATHINFO_EXTENSION);
		if (in_array($sext,$IS_IMGEXT)){
			$img[$i]="$dir/$v";
			$i++;
		}
	}
	if ($num>0){
		if ($num>(count($img)-1)){
			$num=count($img)-1;
		}
	}else{
		$num=0;
	}
	echo("<style>body {background-color:black; !important;}</style>");
	echo("<div class=row>");
	echo("<div class=col3 style='text-align:left;'>");
	echo("<a class=backbtn href='?'>$IS_BACKPAGE</a>");
	echo("</div>");
	echo("<div class=col3>");
	echo("<pre> </pre>");
	echo("</div>");
	echo("<div class=col3 style='text-align:right;!important;'>");
	$iall=$i*1;
	$iakt=$num+1;
	echo("$iall $IS_IMGNUM: $iakt");
	echo("</div>");
	echo("</div>");
	echo("<hr />");
	echo("<div class=row>");
	echo("<div class=col10>");
	$nu=$num-1;
	$hr="?i=".$adir."&n=".$nu;
	echo("<a href=$hr class=larrow>&#8592;</a>");
	echo("</div>");
	echo("<div class=col80>");
	echo("<img class=fullimg src='$img[$num]'>");
	echo("</div>");
	echo("<div class=col10>");
	$nu=$num+1;
	$hr="?i=".$adir."&n=".$nu;
	echo("<a href=$hr class=rarrow> &#8594; </a>");
	echo("</div>");
	echo("<div>");
	echo("<div class=row></div>");
	if (file_exists($img[$num].$IS_TEXTEXTENSION)){
		$fc=file_get_contents($img[$num].$IS_TEXTEXTENSION);
		echo("<div class=imgtext>$fc</div>");
	}

}

?>
