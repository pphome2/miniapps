<?php

 #
 # MiniApp
 #
 # info: main folder copyright file
 #
 #


function m_print(){
	global $M_TODAY_FILE,$M_SEPARATOR,$M_ID_FIELD,
		$M_PRINT_TEXT,$M_WNAME,$M_OWNER,$first;

	echo("<div style='font-size:1em;'>");
	echo("<div class=spaceline></div>");
	echo("<div><br /></div>");
	echo("<div><br /></div>");
	echo("<div><br /></div>");
	echo("<div><br /></div>");
	$f=file_get_contents($M_TODAY_FILE, true);
	$d=explode(PHP_EOL,$f);
	$id=$_GET[$M_ID_FIELD];
	$ok=0;
	for($i=0;$i<count($d)-1;$i++){
		$dr=explode($M_SEPARATOR,$d[$i]);
		if ($dr[0]==$id){
			$ok=$i;
			$data=$dr;
		}
	}
	echo("<div style='width:100%;text-align:right;'><b>$M_PRINT_TEXT[0]: $id</b></div>");
	echo("<div><br /></div>");
	echo("<div><br /></div>");
	echo("<center><h1>$data[3] - $M_PRINT_TEXT[1]</h1></center>");
	echo("<div><br /></div>");
	echo("<div style='width:100%;text-align:right;'>$M_PRINT_TEXT[2]: <b>$data[1]</b></div>");
	echo("<div style='width:100%;text-align:right;'>$M_PRINT_TEXT[3]: <b>$data[2]</b></div>");
	echo("<div><br /></div>");
	echo("<div><br /></div>");
	echo("<div style='width:100%;text-align:left;'><b>$M_PRINT_TEXT[4]: $M_OWNER</b></div>");
	echo("<div><br /></div>");
	echo("<div><br /></div>");
	echo("<hr style='width:100%;'>");
	echo("<div><br /></div>");
	echo("<div style='width:100%;text-align:left;'>$M_PRINT_TEXT[5]: <b>$data[4]</b></div>");
	echo("<div><br /></div>");
	echo("<div style='width:100%;text-align:left;'>$M_PRINT_TEXT[6]: $data[5]</div>");
	echo("<div style='width:100%;text-align:left;'>$M_PRINT_TEXT[7]: $data[6]</div>");
	echo("<div><br /></div>");
	echo("<div style='width:100%;text-align:left;'>$M_PRINT_TEXT[8]: $data[12]</div>");
	echo("<div><br /></div>");
	echo("<hr style='width:100%;'>");
	echo("<div><br /></div>");
	echo("<div style='width:100%;text-align:center;'><b>$M_PRINT_TEXT[9]</b></div>");
	echo("<div style='width:100%;text-align:left;'>$M_PRINT_TEXT[10]: $data[11] $M_WNAME</div>");
	echo("<div style='width:100%;text-align:left;'>$M_PRINT_TEXT[11]: $data[10] $M_WNAME</div>");
	echo("<div><br /></div>");
	$s1=str_replace(',', '.', $data[11]);
	$s2=str_replace(',', '.', $data[10]);
	$s3=$s1-$s2;
	$cargo=str_replace('.', ',', $s3);
	echo("<div style='width:100%;text-align:left;'>$M_PRINT_TEXT[12]: $cargo $M_WNAME</div>");
	echo("<div><br /></div>");
	echo("<hr style='width:100%;'>");
	echo("<div><br /></div>");
	echo("<div style='width:100%;text-align:center;'><b>$M_PRINT_TEXT[13]</b></div>");
	echo("<div style='width:100%;text-align:left;'>$data[7]</div>");
	echo("<div style='width:100%;text-align:left;'>$data[8]</div>");
	echo("<div style='width:100%;text-align:left;'>$data[9]</div>");
	echo("<div><br /></div>");
	echo("<hr style='width:100%;'>");
	echo("<div><br /></div>");
	echo("<div style='width:100%;text-align:center;'>$M_PRINT_TEXT[14]: $cargo $M_WNAME</div>");
	echo("<div><br /></div>");
	echo("<hr style='width:100%;'>");
	echo("<div><br /></div>");
	echo("<div><br /></div>");
	echo("<div><br /></div>");
	echo("<div><br /></div>");
	echo("<div><br /></div>");
	echo("<div><br /></div>");
	echo("<div style='width:100%;'>");
	echo("<div style='width:50%;float:left;text-align:center'>");
	echo("------------------------------------------<br />");
	echo("$M_PRINT_TEXT[15]");
	echo("</div>");
	echo("<div style='width:50%;float:left;text-align:center'>");
	echo("------------------------------------------<br />");
	echo("$M_PRINT_TEXT[16]");
	echo("</div>");
	echo("</div>");
	echo("</div>");
	if ($first){
		#echo("<div><br /></div>");
		#echo("<div><br /></div>");
		#echo("<div><br /></div>");
		#echo("<div><br /></div>");
		#echo("<hr style='width:100%;'>");
		#echo("<div><br /></div>");
		#echo("<div><br /></div>");
	}
}


?>
