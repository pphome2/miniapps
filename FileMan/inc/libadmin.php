<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


function setcookienames(){
    global $MA_COOKIE_STYLE,$MA_COOKIE_LOGIN;

    $p=explode('/',(dirname(__FILE__)));
    if (count($p)>=2){
        $px=$p[count($p)-2];
    }else{
        $px="";
    }
    $MA_COOKIE_STYLE=$px."st";
    $MA_COOKIE_LOGIN=$px."l";
}



# login from cookie or param
function login(){
	global $MA_LOGGEDIN,$MA_COOKIE_LOGIN,
			$MA_ADMIN_USER,$MA_ENABLE_USERNAME,
			$MA_USERS_CRED,$MA_USERS_ADMINUSERS,
			$MA_COOKIE_PASS,$MA_COOKIE_USER;

	$MA_LOGGEDIN=false;
	$pass="";
	$user="";

	$db=count($MA_USERS_CRED);
	if (isset($_COOKIE[$MA_COOKIE_LOGIN])){
	    $MA_LOGGEDIN=true;
	    $user=$_COOKIE[$MA_COOKIE_LOGIN];
	}else{
		if (isset($_POST["$MA_COOKIE_PASS"])){
			$pass=$_POST["$MA_COOKIE_PASS"];
			$pass=vinput($pass);
			if ($pass<>""){
				$pass=md5($pass);
			}
		}
		if (isset($_POST["$MA_COOKIE_USER"])){
			$user=$_POST["$MA_COOKIE_USER"];
			$user=vinput($user);
		}
		for ($i=0;$i<$db;$i++){
        	if ($MA_ENABLE_USERNAME){
	    		if (($user==$MA_USERS_CRED[$i][0])and($pass==$MA_USERS_CRED[$i][1])){
		    		$MA_LOGGEDIN=true;
			    }
			}else{
	    		if ($pass==$MA_USERS_CRED[$i][1]){
	    		    $user=$MA_USERS_CRED[$i][0];
		    		$MA_LOGGEDIN=true;
			    }
			}
		}
	}
	# set cookie
	if ($MA_LOGGEDIN){
		#setcookie($MA_COOKIE_LOGIN, $user, ['expires'=>time()+6000,'samesite'=>'Strict']);
		setcookie($MA_COOKIE_LOGIN, $user, ['expires'=>0,'samesite'=>'Strict']);
		#setcookie($MA_COOKIE_LOGIN, $user, ['expires'=>strtotime("+1 day"),'samesite'=>'Strict']);
	}else{
		setcookie($MA_COOKIE_LOGIN, "", time() - 3600);
	}

	# admin
	if ($MA_LOGGEDIN){
		if (in_array($user,$MA_USERS_ADMINUSERS)){
			$MA_ADMIN_USER=true;
		}
	}
}


?>
