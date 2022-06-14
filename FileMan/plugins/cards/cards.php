<?php

 #
 # MiniApp - Cards plugin
 #
 # info: main folder copyright file
 #
 #

$cardnum=0;

function cards_new($title){
    global $cardnum;

    $cardnum++;
	echo('
		<div class="card">
		<div class="card-header" id="dfardheader'.$cardnum.'">
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topleftmenu1">
			'.$title.'
		</span>
		<span onclick="cardclose(dfcardbody'.$cardnum.',dfcardright'.$cardnum.')" class="topright" id="dfcardright'.$cardnum.'">
			&#65088;
		</span>
		</div>
		<div class="card-body" id="dfcardbody'.$cardnum.'" style="display:none;">
	');
}

function cards_close(){
    echo("</div>");
    echo("</div>");
}


?>
