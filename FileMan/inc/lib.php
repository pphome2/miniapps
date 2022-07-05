<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #



# load plugins
function plugins(){
    global $MA_PLUGINS;

    for($i=0;$i<count($MA_PLUGINS);$i++){
        $fnx=basename($MA_PLUGINS[$i]);
        $fn=$MA_PLUGINS[$i].'/'.$fnx.'.php';
        if (file_exists($fn)){
            include($fn);
        }
        $fn=$MA_PLUGINS[$i].'/'.$fnx.'.css';
        if (file_exists($fn)){
            include($fn);
        }
        $fn=$MA_PLUGINS[$i].'/'.$fnx.'.js';
        if (file_exists($fn)){
            include($fn);
        }
    }
}


# load one plugin
function loadplugin($p){
    global $MA_PLUGIN_DIR;

    $fn=$MA_PLUGIN_DIR.'/'.$p.'/'.$p.'.php';
    if (file_exists($fn)){
        include($fn);
    }
    $fn=$MA_PLUGIN_DIR.'/'.$p.'/'.$p.'.css';
    if (file_exists($fn)){
        include($fn);
    }
    $fn=$MA_PLUGIN_DIR.'/'.$p.'/'.$p.'.js';
    if (file_exists($fn)){
        include($fn);
    }
}


# login from cookie or param
function login(){
	global $MA_LOGGEDIN,$MA_LOGIN_TIME,$MA_PASSWORD,$MA_ENABLE_COOKIES,$MA_COOKIE_PASSWORD,
			$MA_USER_PASS,$MA_ADMIN_PASS,$MA_ADMIN_USER,$MA_LOGIN_TIME,$MA_LOGIN_TIMEOUT,
			$MA_COOKIE_TIME,$MA_ENABLE_USERNAME,$MA_USERS_CRED,$MA_USER,$MA_USERS_ADMINUSERS,
			$MA_COOKIE_USER;

	$MA_LOGGEDIN=false;
	$MA_LOGIN_TIME=time();
	$MA_PASSWORD="";
	$MA_USER="";

	$db=count($MA_USERS_CRED);
	# cookie 
	# username support
	if ($MA_ENABLE_USERNAME){
		# username - cookie
		if ($MA_ENABLE_COOKIES){
			if (isset($_COOKIE[$MA_COOKIE_PASSWORD])){
			    $MA_PASSWORD=$_COOKIE[$MA_COOKIE_PASSWORD];
			}else{
			    $MA_PASSWORD="";
			}
			if (isset($_COOKIE[$MA_COOKIE_USER])){
			    $MA_USER=$_COOKIE[$MA_COOKIE_USER];
			}else{
			    $MA_USER="";
			}
			for ($i=0;$i<$db;$i++){
				if (($MA_USER==$MA_USERS_CRED[$i][0])and($MA_PASSWORD==$MA_USERS_CRED[$i][1])){
					$MA_LOGGEDIN=true;
				}
			}
		}else{
		}
		if (!$MA_LOGGEDIN){
			if ((isset($_POST["$MA_COOKIE_PASSWORD"]))and(isset($_POST["$MA_COOKIE_USER"]))){
				$MA_PASSWORD=$_POST["$MA_COOKIE_PASSWORD"];
				$MA_USER=$_POST["$MA_COOKIE_USER"];
				$MA_PASSWORD=vinput($MA_PASSWORD);
				$MA_USER=vinput($MA_USER);
				if (strlen($MA_PASSWORD)<30){
					$MA_PASSWORD=md5($MA_PASSWORD);
				}

				for ($i=0;$i<$db;$i++){
					if (($MA_USER==$MA_USERS_CRED[$i][0])and($MA_PASSWORD==$MA_USERS_CRED[$i][1])){
						$MA_LOGGEDIN=true;
					}
				}
				# login timeout
				if (isset($_POST["$MA_COOKIE_TIME"])){
					$outime=$_POST["$MA_COOKIE_TIME"];
					$outime=vinput($outime);
					$utime2=$MA_LOGIN_TIME-$outime;
					if ($utime2<$MA_LOGIN_TIMEOUT){
						$MA_LOGGEDIN=true;
					}else{
						$MA_LOGGEDIN=false;
					}
				}
			}
		}

	}else{
		if ($MA_ENABLE_COOKIES){
		    if (isset($_COOKIE[$MA_COOKIE_PASSWORD])){
			    $MA_PASSWORD=$_COOKIE[$MA_COOKIE_PASSWORD];
		    	for ($i=0;$i<$db;$i++){
	    			if ($MA_PASSWORD==$MA_USERS_CRED[$i][1]){
    					$MA_LOGGEDIN=true;
					    $MA_USER=$MA_USERS_CRED[$i][0];
				    }
				}
			}
		}else{
		}
		if (!$MA_LOGGEDIN){
			if (isset($_POST["$MA_COOKIE_PASSWORD"])){
				$MA_PASSWORD=$_POST["$MA_COOKIE_PASSWORD"];
				$MA_PASSWORD=vinput($MA_PASSWORD);
				if (strlen($MA_PASSWORD)<30){
					$MA_PASSWORD=md5($MA_PASSWORD);
				}

				for ($i=0;$i<$db;$i++){
					if ($MA_PASSWORD==$MA_USERS_CRED[$i][1]){
						$MA_LOGGEDIN=true;
						$MA_USER=$MA_USERS_CRED[$i][0];
					}
				}
				# login timeout
				if (isset($_POST["$MA_COOKIE_TIME"])){
					$outime=$_POST["$MA_COOKIE_TIME"];
					$outime=vinput($outime);
					$utime2=$MA_LOGIN_TIME-$outime;
					if ($utime2<$MA_LOGIN_TIMEOUT){
						$MA_LOGGEDIN=true;
					}else{
						$MA_LOGGEDIN=false;
					}
				}
			}
		}
	}

	if ($MA_ENABLE_COOKIES){
		# set cookie
		if ($MA_LOGGEDIN){
			#setcookie($MA_COOKIE_PASSWORD, $MA_PASSWORD, time()+$MA_LOGIN_TIMEOUT);
			#setcookie($MA_COOKIE_USER, $MA_USER, time()+$MA_LOGIN_TIMEOUT);
			setcookie($MA_COOKIE_PASSWORD, $MA_PASSWORD, ['expires'=>time()+$MA_LOGIN_TIMEOUT,'samesite'=>'Lax']);
			setcookie($MA_COOKIE_USER, $MA_USER, ['expires'=>time()+$MA_LOGIN_TIMEOUT,'samesite'=>'Lax']);
		}else{
			setcookie($MA_COOKIE_PASSWORD, "", time() - 3600);
			setcookie($MA_COOKIE_USER, "", time() - 3600);
		}
	}

	# admin
	if ($MA_LOGGEDIN){
		if (in_array($MA_USER,$MA_USERS_ADMINUSERS)){
			$MA_ADMIN_USER=true;
		}
	}

}


# cookies or param
function setcss(){
	global $MA_ENABLE_COOKIES,$MA_STYLEINDEX,$MA_COOKIE_STYLE,$MA_CSS;

	if ($MA_ENABLE_COOKIES){
	    if (isset($_COOKIE[$MA_COOKIE_STYLE])){
    		$MA_STYLEINDEX=intval(vinput($_COOKIE[$MA_COOKIE_STYLE]));
		}
	}else{
		if (isset($_POST[$MA_COOKIE_STYLE])){
			$MA_STYLEINDEX=htmlspecialchars($_POST[$MA_COOKIE_STYLE]);
		}else{
			if (isset($_GET[$MA_COOKIE_STYLE])){
				$MA_STYLEINDEX=htmlspecialchars($_GET[$MA_COOKIE_STYLE]);
			}else{
			$MA_STYLEINDEX=0;
			}
		}
	}
	if ($MA_STYLEINDEX>count($MA_CSS)){
		$MA_STYLEINDEX=0;
	}
}



# page header
function page_header(){
	global $MA_HEADER,$MA_JS_BEGIN,$MA_CSS,$MA_STYLEINDEX,$MA_SITENAME,$MA_ROOT_HOME,
			$MA_ENABLE_COOKIES,$MA_ADMINFILE,$L_ROOTHOME,$MA_COOKIE_STYLE,$MA_SITE_HOME,
			$MA_MENU,$MA_MENU_FIELD,$MA_LOGGEDIN,$MA_COOKIE_PASSWORD,$L_LOGOUT,
			$MA_SEARCH_ICON_HREF,$MA_SEARCH_ICON_JS,$MA_SEARCHFILE,$MA_LOGOUT_IN_HEADER,
			$L_SITENAME,$MA_ADMIN_USER,$MA_ADMINMENU,$MA_ADMINMENU_FIELD,$MA_APPCSSFILE,
			$MA_ENABLE_HEADER,$MA_COOKIE_STYLE,$MA_SEARCH_PAGE,$MA_PRIVACY_PAGE,
            $MA_ENABLE_PRIVACY,$MA_ENABLE_PRINT,$MA_ENABLE_SEARCH,$MA_ENABLE_THEME,
            $MA_TITLE,$MA_BACKPAGE,$L_SITEHOME;


	if (file_exists("$MA_HEADER")){
		include("$MA_HEADER");
	}
	if (file_exists("$MA_JS_BEGIN")){
		include("$MA_JS_BEGIN");
	}
}


# page footer
function page_footer(){
	global $MA_JS_END,$MA_FOOTER,$MA_ADMINFILE,$MA_LOGIN_TIMEOUT,$MA_COOKIE_STYLE,$MA_STYLEINDEX,
			$MA_COPYRIGHT,$MA_CSS,$MA_ENABLE_COOKIES,$MA_COOKIE_STYLE,$L_THEME,$MA_PRIVACYFILE,
			$L_PRIVACY_MENU,$MA_LOGGEDIN,$MA_COOKIE_PASSWORD,$L_LOGOUT,$L_COOKIE_TEXT,
			$MA_PRIVACY_PAGE,$MA_ENABLE_FOOTER,$MA_STYLEPARAM_NAME,$MA_SEARCH_PAGE,
            $MA_ENABLE_PRIVACY,$MA_ENABLE_PRINT,$MA_ENABLE_SEARCH,$MA_ENABLE_THEME;

	if (file_exists("$MA_JS_END")){
		include("$MA_JS_END");
	}
	if (file_exists("$MA_FOOTER")){
		include("$MA_FOOTER");
	}
}


# page header view
function page_header_view(){
	global $MA_HEADER_VIEW,$MA_JS_BEGIN,$MA_CSS,$MA_STYLEINDEX,$MA_SITENAME,$MA_ROOT_HOME,
			$MA_ENABLE_COOKIES,$MA_ADMINFILE,$L_ROOTHOME,$MA_COOKIE_STYLE,$MA_SITE_HOME,
			$MA_MENU,$MA_MENU_FIELD,$MA_LOGGEDIN,$MA_COOKIE_PASSWORD,$L_LOGOUT,
			$MA_SEARCH_ICON_HREF,$MA_SEARCH_ICON_JS,$MA_SEARCHFILE,$MA_LOGOUT_IN_HEADER,
			$L_SITENAME,$MA_ADMIN_USER,$MA_ADMINMENU,$MA_ADMINMENU_FIELD,$MA_APPCSSFILE,
			$MA_ENABLE_HEADER,$MA_COOKIE_STYLE,$MA_PRIVACY_PAGE,$MA_SEARCH_PAGE,
			$MA_ENABLE_LOGIN_VIEW,$MA_ENABLE_PRIVACY,$MA_ENABLE_PRINT,$MA_ENABLE_SEARCH,
			$MA_ENABLE_THEME,$MA_TITLE,$MA_BACKPAGE,$L_SITEHOME;

	if (file_exists("$MA_HEADER_VIEW")){
		include("$MA_HEADER_VIEW");
	}
	if (file_exists("$MA_JS_BEGIN")){
		include("$MA_JS_BEGIN");
	}
}


# page footer
function page_footer_view(){
	global $MA_JS_END,$MA_FOOTER_VIEW,$MA_ADMINFILE,$MA_LOGIN_TIMEOUT,$MA_COOKIE_STYLE,$MA_STYLEINDEX,
			$MA_COPYRIGHT,$MA_CSS,$MA_ENABLE_COOKIES,$MA_COOKIE_STYLE,$L_THEME,$MA_PRIVACYFILE,
			$L_PRIVACY_MENU,$MA_LOGGEDIN,$MA_COOKIE_PASSWORD,$L_LOGOUT,$L_COOKIE_TEXT,
			$MA_PRIVACY_PAGE,$MA_ENABLE_FOOTER,$MA_STYLEPARAM_NAME,$MA_SEARCH_PAGE,
			$MA_ENABLE_LOGIN_VIEW,
            $MA_ENABLE_PRIVACY,$MA_ENABLE_PRINT,$MA_ENABLE_SEARCH,$MA_ENABLE_THEME;

	if (file_exists("$MA_JS_END")){
		include("$MA_JS_END");
	}
	if (file_exists("$MA_FOOTER_VIEW")){
		include("$MA_FOOTER_VIEW");
	}
}


# check valid md5 string
function checkmd5($md5=''){
	if(empty($md5)){
		return false;
	}
	return preg_match('/^[a-f0-9]{32}$/', $md5);
}


# functions
function vinput($d) {
	$d=trim($d);
	$d=stripslashes($d);
	$d=strip_tags($d);
	$d=htmlspecialchars($d);
	return $d;
}


function vinputtags($d) {
	$d=trim($d);
	$d=stripslashes($d);
	$d=htmlspecialchars($d);
	return $d;
}



function dirlist($dir) {
	global $MA_CONFIG_DIR;

	$result=array();
	$cdir=scandir($dir);
	foreach ($cdir as $key => $value){
		if (!in_array($value,array(".","..",$MA_CONFIG_DIR))){
			$result[]=$value;
		}
	}
	return $result;
}



function mobiledevice(){
	global $MA_MOBILE;

	$useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|
			fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|
			mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|
			pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|
			windows ce|xda|xiino/i',$useragent)||
			preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|
			ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|
			r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|
			ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|
			dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|
			fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|
			p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|
			go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|
			jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|
			50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|
			ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|
			n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|
			nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|
			phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|
			\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|
			sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|
			sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|
			t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|
			m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|
			vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |
			nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
		$MA_MOBILE=true;
	}else{
	}
}


?>
