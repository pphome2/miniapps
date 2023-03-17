<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


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


# cookie names settings
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
