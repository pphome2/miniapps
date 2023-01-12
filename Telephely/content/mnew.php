<?php

 #
 # MiniApp
 #
 # info: main folder copyright file
 #
 #


function m_new(){
	global $M_PARTNER_FILE,$M_CARGO_FILE,$M_TODAY_FILE,$M_DATA_DIR,$M_NEW,
		$M_SUBMITBUTTON_TEXT,$M_NEWCAR,$M_NEWDATA,$M_OK,$M_ERROR,
		$M_DIRECTION,$M_SEPARATOR;

	$dd=$M_DATA_DIR."/".date('Y');
	if (!is_dir($dd)){
		mkdir($dd);
	}
	$f=file_get_contents($M_TODAY_FILE, true);
	$today=explode(PHP_EOL,$f);

	# új adatsor felvétele
	$ok=false;
	if (isset($_POST['submitnew'])){
		$date=date('Y. m. d. H:i');
		$new=date('YmdHis').$M_SEPARATOR;
		$new=$new."$date".$M_SEPARATOR;
		$new=$new.$_POST['tt'].$M_SEPARATOR;
		$new=$new.$_POST['ir'].$M_SEPARATOR;
		$new=$new.$_POST['partner'].$M_SEPARATOR;
		$new=$new.$_POST['rsz'].$M_SEPARATOR;
		$new=$new.$_POST['rszp'].$M_SEPARATOR;
		$new=$new.$_POST['aru1'].$M_SEPARATOR;
		$new=$new.$_POST['aru2'].$M_SEPARATOR;
		$new=$new.$_POST['aru3'].$M_SEPARATOR;
		$new=$new.$_POST['ur'].$M_SEPARATOR;
		$new=$new.$_POST['br'].$M_SEPARATOR;
		$new=$new.$_POST['meg'];
		$today[count($today)-1]=$new;
		$out="";
		for($i=0;$i<count($today);$i++){
			$out=$out.$today[$i].PHP_EOL;
		}
		$ok=file_put_contents($M_TODAY_FILE,$out);
		if ($ok){
			mess_ok($M_NEWDATA.": ".$M_OK.".");
		}else{
			mess_error($M_NEWDATA.": ".$M_ERROR.".");
		}
	}

	# új adatform
	$f=file_get_contents($M_PARTNER_FILE, true);
	$partner=explode(PHP_EOL,$f);
	sort($partner);
	$f=file_get_contents($M_CARGO_FILE, true);
	$cargo=explode(PHP_EOL,$f);
	sort($cargo);
	echo($M_NEWCAR);
	echo("<div class=content>");
	echo("<form  method='post' enctype='multipart/form-data'>");
	$date=date('Y. m. d. H:i');
	echo("<div class=frow>");
	echo("<div class=fcol1>$M_NEW[1]");
	echo("</div>");
	echo("<div class=fcol2>");
	echo("<input type=text name=lt id=lt placeholder='$date' value='$date' readonly>");
	echo("</div>");
	echo("</div>");
	echo("<div class=frow>");
	echo("<div class=fcol1>$M_NEW[2]");
	echo("</div>");
	echo("<div class=fcol2>");
	echo("<input type=text name=tt id=tt placeholder='' value='' readonly>");
	echo("</div>");
	echo("</div>");
	echo("<div class=frow>");
	echo("<div class=fcol1>$M_NEW[3]");
	echo("</div>");
	echo("<div class=fcol2>");
	echo("<select name='ir' id='ir'>");
	$db=count($M_DIRECTION);
	for ($i=0;$i<$db;$i++){
		echo("<option>$M_DIRECTION[$i]</option>");
	}
	echo("</select>");
	echo("</div>");
	echo("</div>");
	echo("<div class=frow>");
	echo("<div class=fcol1>$M_NEW[4]");
	echo("</div>");
	echo("<div class=fcol2>");
	echo("<select name='partner' id='partner'>");
	$db=count($partner)-1;
	echo("<option></option>");
	for ($i=0;$i<$db;$i++){
		echo("<option>$partner[$i]</option>");
	}
	echo("</select>");
	echo("</div>");
	echo("</div>");
	echo("<div class=frow>");
	echo("<div class=fcol1>$M_NEW[5]");
	echo("</div>");
	echo("<div class=fcol2>");
	echo("<input type=text name=rsz id=rsz placeholder='$M_NEW[5]'>");
	echo("</div>");
	echo("</div>");
	echo("<div class=frow>");
	echo("<div class=fcol1>$M_NEW[6]");
	echo("</div>");
	echo("<div class=fcol2>");
	echo("<input type=text name= rszp id=rszp placeholder='$M_NEW[6]'>");
	echo("</div>");
	echo("</div>");
	echo("<div class=frow>");
	echo("<div class=fcol1>$M_NEW[7]");
	echo("</div>");
	echo("<div class=fcol2>");
	echo("<select name='aru1' id='aru1'>");
	$db=count($cargo)-1;
	for ($i=0;$i<$db;$i++){
		echo("<option>$cargo[$i]</option>");
	}
	echo("</select>");
	echo("</div>");
	echo("</div>");
	echo("<div class=frow>");
	echo("<div class=fcol1>$M_NEW[8]");
	echo("</div>");
	echo("<div class=fcol2>");
	echo("<select name='aru2' id='aru2'>");
	$db=count($cargo)-1;
	for ($i=0;$i<$db;$i++){
		echo("<option>$cargo[$i]</option>");
	}
	echo("</select>");
	echo("</div>");
	echo("</div>");
	echo("<div class=frow>");
	echo("<div class=fcol1>$M_NEW[9]");
	echo("</div>");
	echo("<div class=fcol2>");
	echo("<select name='aru3' id='aru3'>");
	$db=count($cargo)-1;
	for ($i=0;$i<$db;$i++){
		echo("<option>$cargo[$i]</option>");
	}
	echo("</select>");
	echo("</div>");
	echo("</div>");
	echo("<div class=frow>");
	echo("<div class=fcol1>$M_NEW[10]");
	echo("</div>");
	echo("<div class=fcol2>");
	echo("<input type=text name=ur id=ur placeholder='$M_NEW[10]'>");
	echo("</div>");
	echo("</div>");
	echo("<div class=frow>");
	echo("<div class=fcol1>$M_NEW[11]");
	echo("</div>");
	echo("<div class=fcol2>");
	echo("<input type=text name=br id=br placeholder='$M_NEW[11]'>");
	echo("</div>");
	echo("</div>");
	echo("<div class=frow>");
	echo("<div class=fcol1>$M_NEW[12]");
	echo("</div>");
	echo("<div class=fcol2>");
	echo("<input type=text name=meg id=meg placeholder='$M_NEW[12]'>");
	echo("</div>");
	echo("</div>");
	echo("<input type='submit' value='$M_SUBMITBUTTON_TEXT' name='submitnew'>");
	echo("</form>");
	button_go();

	echo("</div>");
}


?>
