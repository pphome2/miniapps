<?php

 #
 # MiniApp - FileMan
 #
 # info: main folder copyright file
 #
 #


function searchpage(){
	global $DF_TITLE,$DF_BUTTON_TEXT,$DF_SEARCH_TEXT,$MA_LOGGEDIN;

	echo("<header><h3>$DF_TITLE</h3></header>");
	echo("<div class=spaceline></div>");
	echo("<div class=contentbox>");
	if ($MA_LOGGEDIN){
    	echo("<form method='post' enctype='multipart/form-data'>");
	    echo("<input type=text name='search' id='search' placeholder='$DF_SEARCH_TEXT' autofocus />");
    	echo("<input type='submit' value='$DF_BUTTON_TEXT' name='submitsearch' />");
	    echo("</form>");
	    echo("<div class=spaceline></div>");
    	if (isset($_POST['submitsearch'])){
	    	$st=vinput($_POST['search']);
    	    echo("<div class=content>");
    		echo($DF_SEARCH_TEXT.": $st");
	        echo("</div>");
    	}
    }else{
    }
    echo("</div>");
}


function privacypage(){
	global $DF_TITLE,$DF_PRIVACY_FILE;

	echo("<header><h3>$DF_TITLE</h3></header>");
	echo("<div class=spaceline></div>");
	if (file_exists($DF_PRIVACY_FILE)){
	    echo("<div class=contentbox>");
	    if ($file=fopen($DF_PRIVACY_FILE, "r")) {
            while(!feof($file)) {
                $line=fgets($file);
        	    echo($line."<br />");
            }
            fclose($file);
        }
	    echo("</div>");
	}
	echo("<div class=spaceline></div>");
}


function printpage(){
	global $DF_TITLE;

	echo("<header><h3>$DF_TITLE</h3></header>");
}


function fm_header(){
	global $DF_TITLE;

	echo("<header><h3>$DF_TITLE</h3></header>");
}


function fm_header_view(){
	global $DF_TITLE_VIEW;

	echo("<header><h3>$DF_TITLE_VIEW</h3></header>");
}


function fm_footer(){
	echo("<footer></footer>");
}


function fm_data(){
	fm_admin();
	echo("<div class=spaceline></div>");
	echo("<div class=row100>");
	echo("<div class=col3-2>");
	echo("<div class=box>");
	fm_dl();
	echo("</div>");
	echo("</div>");
	echo("<div class=col3-1>");
	echo("<div class=box>");
	fm_up();
	echo("</div>");
	echo("</div>");
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function fm_view(){
	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	fm_dl();
	echo("</div>");
	echo("<div class=spaceline></div>");
}

function main(){
    loadplugin("table");
    loadplugin("cards");
	fm_header();
	fm_data();
	fm_footer();
}

function view(){
    loadplugin("table");
    loadplugin("cards");
	fm_header_view();
	fm_view();
	fm_footer();
}


?>
