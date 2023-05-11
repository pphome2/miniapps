<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #



# cookie system start
function startcookies($n="",$d="",$td=0){
	setcookienames();
	setcookies($n,$d,$td);
	getcookies($n,$d,$td);
}


# load, get cookies
function getcookies($n="",$d="",$td=0){
	global $MA_COOKIES;

	$d="";
	if ($n<>""){
		if (isset($_COOKIE['$n'])){
			$d=$_COOKIE['$n'];
		}
	}else{
		$cdb=count($MA_COOKIES);
		for($i=0;$i<$cdb;$i++){
			$ac=$MA_COOKIES[$i];
			$acname=$ac[0];
			if(isset($_COOKIE[$acname])) {
				$acdata=$_COOKIE[$acname];
			}else{
				$acdata="";
			}
			if (isset($ac[2])){
				$acd=$ac[2];
			}else{
				$acd=0;
			}
			$MA_COOKIES[$i]=array($acname,$acdata,$acd);
		}
	}
	return($d);
}


# store cookie
function setcookies($n="",$d="",$td=0){
	global $MA_COOKIES;

	if ($n<>""){
		setcookie($n,$d,time()+(86400*$td),"/");
	}else{
		$cdb=count($MA_COOKIES);
		for($i=0;$i<$cdb;$i++){
			$ac=$MA_COOKIES[$i];
			$n=$ac[0];
			if (isset($_POST['$n'])){
				$d=$_POST['$n'];
				$ac[2]=$d;
				$td=$ac[3];
				$MA_COOKIES[$i]=array($n,$d,$td);
				#86400=1nap
				setcookie($n,$d,time()+(86400*$td),"/");
			}
		}
	}
}


# cookie names settings
function setcookienames(){
    global $MA_CODENAME,$MA_COOKIE_STYLE,$MA_COOKIE_LOGIN;

    $MA_COOKIE_STYLE=$MA_CODENAME."-".$MA_COOKIE_STYLE;
    $MA_COOKIE_LOGIN=$MA_CODENAME."-".$MA_COOKIE_LOGIN;
}


# cookie names settings
function setcookienamesfromdir(){
    global $MA_CODENAME,$MA_COOKIE_STYLE,$MA_COOKIE_LOGIN;

    $p=explode('/',(dirname(__FILE__)));
    if (count($p)>=2){
        $px=$p[count($p)-2];
    }else{
        $px="";
    }
    $MA_COOKIE_STYLE=$px."-".$MA_COOKIE_STYLE;
    $MA_COOKIE_LOGIN=$px."-".$MA_COOKIE_LOGIN;
}


# preivois page
function refererpage(){
    $mainp=basename($_SERVER['REQUEST_URI']);
    if (isset($_POST['referer'])){
        $mainp=$_POST['referer'];
    }
    return($mainp);
}


# load plugins
function plugins(){
    global $MA_PLUGINS,$MA_PLUGIN_DIR;

    for($i=0;$i<count($MA_PLUGINS);$i++){
        $fnx=basename($MA_PLUGINS[$i]);
        $fn="$MA_PLUGIN_DIR/$MA_PLUGINS[$i]/$fnx".'.php';
        if (file_exists($fn)){
            include($fn);
        }
        $fn="$MA_PLUGIN_DIR/$MA_PLUGINS[$i]/$fnx".'.css';
        if (file_exists($fn)){
            include($fn);
        }
        $fn="$MA_PLUGIN_DIR/$MA_PLUGINS[$i]/$fnx".'.js';
        if (file_exists($fn)){
            include($fn);
        }
    }
}


# load one plugin
function loadplugin($p){
    global $MA_PLUGINS,$MA_PLUGIN_DIR;

    $fn="$MA_PLUGIN_DIR/$p/$p".'.php';
    if (file_exists($fn)){
        include($fn);
    }
    $fn="$MA_PLUGIN_DIR/$p/$p".'.css';
    if (file_exists($fn)){
        include($fn);
    }
    $fn="$MA_PLUGIN_DIR/$p/$p".'.js';
    if (file_exists($fn)){
        include($fn);
    }
}



# cookies or param
function setcss(){
	global $MA_STYLEINDEX,$MA_COOKIE_STYLE,$MA_CSS;

    if (isset($_COOKIE[$MA_COOKIE_STYLE])){
   		$MA_STYLEINDEX=intval(vinput($_COOKIE[$MA_COOKIE_STYLE]));
	}
	if ($MA_STYLEINDEX>count($MA_CSS)){
		$MA_STYLEINDEX=0;
	}
}



# login from cookie or param
function login(){
	global $MA_LOGGEDIN,$MA_COOKIE_LOGIN,
			$MA_ADMIN_USER,$MA_ENABLE_USERNAME,
			$MA_USERS_CRED,$MA_USERS_ADMINUSERS,
			$MA_COOKIE_PASS,$MA_COOKIE_USER,
			$MA_USERNAME;

	$MA_LOGGEDIN=false;
	$pass="";
	$user="";

	$db=count($MA_USERS_CRED);
	if (isset($_COOKIE[$MA_COOKIE_LOGIN])){
        $user=$_COOKIE[$MA_COOKIE_LOGIN];
   		for ($i=0;$i<$db;$i++){
    		if ($user==$MA_USERS_CRED[$i][0]){
	    		$MA_LOGGEDIN=true;
		    }
	    }
	}
	if (!$MA_LOGGEDIN){
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
	    $MA_USERNAME=$user;
		#setcookie($MA_COOKIE_LOGIN, $user, ['expires'=>time()+6000,'samesite'=>'Strict']);
		setcookie($MA_COOKIE_LOGIN, $user, ['expires'=>0,'samesite'=>'Strict']);
		#setcookie($MA_COOKIE_LOGIN, $user, ['expires'=>strtotime("+1 day"),'samesite'=>'Strict']);
	}else{
		setcookie($MA_COOKIE_LOGIN, "", ['expires'=>-1,'samesite'=>'Strict']);
	}

	# admin
	if ($MA_LOGGEDIN){
		if (in_array($user,$MA_USERS_ADMINUSERS)){
			$MA_ADMIN_USER=true;
		}
	}
}


# logout: cookie delete
function logout(){
	global $MA_LOGGEDIN,$MA_COOKIE_LOGIN,$L_LOGOUT;

	$MA_LOGGEDIN=false;
	#setcookie($MA_COOKIE_LOGIN, "", time() - 3600);
    echo("<script>
        document.cookie='$MA_COOKIE_LOGIN=$L_LOGOUT; expires=Thu, 01 Jan 1970 00:00:00 UTC;samesite=Strict;';
        </script>");
}


?>
