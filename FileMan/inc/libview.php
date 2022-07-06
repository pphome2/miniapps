<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


# preivois page
function refererpage(){
    $mainp=basename($_SERVER['HTTP_REFERER']);
    if (isset($_POST['referer'])){
        $mainp=$_POST['referer'];
    }
    return($mainp);
}


# search in site
function searchview($title="",$button="",$search=""){
    $rp=refererpage();
	echo("<header><h3>$title</h3></header>");
	echo("<div class=spaceline></div>");
	echo("<div class=contentbox>");
   	echo("<form method='post' enctype='multipart/form-data'>");
    echo("<input type=text name='search' id='search' placeholder='$search' autofocus />");
    echo("<input type=hidden name='referer' id='referer' value='$rp' />");
   	echo("<input type='submit' value='$button' name='submitsearch' />");
    echo("</form>");
    echo("<div class=spaceline></div>");
   	if (isset($_POST['submitsearch'])){
    	$st=vinput($_POST['search']);
   	    echo("<div class=content>");
   		echo($search.": $st");
        echo("</div>");
   	}
    echo("</div>");
}


# privacy file view
function privacyview($title="",$pfile=""){
    global $L_PRIVACY_HEADER;

    if ($title=""){
        $title=$L_PRIVACY_HEADER;
    }
	echo("<header><h3>$title</h3></header>");
	echo("<div class=spaceline></div>");
	if (file_exists($pfile)){
	    echo("<div class=contentbox>");
	    if ($file=fopen($pfile, "r")) {
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


# backpage button
function button_back(){
	global $L_BACKPAGE;

	echo("<div class=\"spaceline\"></div>");
	echo("<div class=insidecontent><a onclick=\"window.history.back();\"><input type=submit id=submitar name=submitar value=$L_BACKPAGE></a></div>");
	echo("<div class=\"spaceline\"></div>");
}

# backpage button with logout
function button_back_logout(){
	global $L_BACKPAGE,$MA_COOKIE_PASSWORD,$L_LOGOUT;

    echo("<script>");
	echo("document.cookie='$MA_COOKIE_PASSWORD=$L_LOGOUT; expires=Thu, 01 Jan 1970 00:00:00 UTC;';");
    echo("</script>");
	echo("<div class=\"spaceline\"></div>");
	echo("<div class=insidecontent>
	    <a onclick=\"document.cookie='$MA_COOKIE_PASSWORD=$L_LOGOUT; expires=Thu, 01 Jan 1970 00:00:00 UTC;';window.history.back();\">
	    <input type=submit id=submitar name=submitar value=$L_BACKPAGE></a></div>");
	echo("<div class=\"spaceline\"></div>");
}


# print button
function button_print(){
	global $L_PRINT,$MA_PRINTFILE;

	echo("<div class=\"spaceline\"></div>");
	echo("<div class=insidecontent><a href=$MA_PRINFILE><input type=submit id=submitar name=submitar value=$L_PRINT></a></div>");
	echo("<div class=\"spaceline\"></div>");
}



# messages functions
function mess_error($m){
	echo('
		<div class="message_error" name="esysmessage" id="esysmessage">
			<div onclick="this.parentElement.style.display=\'none\'" class="ttoprightclose">
				<p class="insidecontent">'.$m.'</p>
			</div>
		</div>
	');
}


function mess_ok($m){
	echo('
		<div class="message_ok" name="osysmessage" id="osysmessage">
			<div onclick="this.parentElement.style.display=\'none\'" class="ttoprightclose">
				<p class="insidecontent">'.$m.'</p>
			</div>
		</div>
	');
}


function mess_info($m){
	echo('
		<div class="message_info" name="isysmessage" id="isysmessage">
			<div onclick="this.parentElement.style.display=\'none\'" class="ttoprightclose">
				<p class="insidecontent">'.$m.'</p>
			</div>
		</div>
	');
}

function mess_warning($m){
	echo('
		<div class="message_warning" name="wsysmessage" id="wsysmessage">
			<div onclick="this.parentElement.style.display=\'none\'" class="ttoprightclose">
				<p class="insidecontent">'.$m.'</p>
			</div>
		</div>
	');
}


# login box
function login_form(){
	global $MA_COOKIE_STYLE,$MA_STYLEINDEX,$L_PASSWORD,$MA_COOKIE_PASS,
	        $L_BUTTON_NEXT,$MA_ENABLE_USERNAME,
			$MA_USERS,$L_USERNAME,$L_PASS,$MA_COOKIE_USER,$L_USER,$L_PASSWORD;

	echo("<div class=spaceline100></div>");
	echo("<div class=row100>");
	echo("<div class=col4><br /></div>");
	echo("<div class=col2>");
	echo("<form  method='post' enctype='multipart/form-data'>");
	if ($MA_ENABLE_USERNAME){
		echo("	<input type='text' name='$MA_COOKIE_USER' id='$MA_COOKIE_USER' placeholder='$L_USER' autofocus>");
		echo("	<input type='password' name='$MA_COOKIE_PASS' id='$MA_COOKIE_PASS' placeholder='$L_PASSWORD'>");	
	}else{
		echo("	$L_PASS:");
		echo("	<input type='password' name='$MA_COOKIE_PASS' id='$MA_COOKIE_PASS' autofocus>");
	}
	echo("	<div class=spaceline></div>");
	echo("	<input type='submit' value='$L_BUTTON_NEXT' name='submit'>");
	echo("</form>");
	echo("</div>");
	echo("<div class=col4><br /></div>");
	echo("</div>");
	echo("<div class=spaceline></div>");
}


?>
