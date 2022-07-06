<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


# load config and language file
if (!isset($MA_CONFIG_DIR)){
    if (file_exists("config/config.php")){
	    include("config/config.php");
    }
    if (file_exists("$MA_CONFIG_DIR/$MA_LANGFILE")){
	    include("$MA_CONFIG_DIR/$MA_LANGFILE");
    }
}

echo($MA_DOCTYPE);

for ($i=0;$i<count($MA_LIB);$i++){
	if (file_exists("$MA_LIB[$i]")){
		include("$MA_LIB[$i]");
	}
}

# load local app file
for ($i=0;$i<count($MA_APPFILE);$i++){
	if (file_exists($MA_APPFILE[$i])){
		include($MA_APPFILE[$i]);
	}
}

#setcookienames();
plugins();

# css setting
setcss();

# login
if ($MA_ENABLE_LOGIN){
    login();
}else{
	$MA_LOGGEDIN=true;
}

# build page: header
page_header();

if ($MA_LOGGEDIN){
	# user/admin menu start
	if (isset($_GET["$MA_MENU_FIELD"])){
		$param=$_GET["$MA_MENU_FIELD"];
   		if (function_exists($param)){
    		$param();
    	}else{
		    if (function_exists("main")){
			    main();
		    }
		}
	}else{
	    if (function_exists("main")){
		    main();
	    }
	}

}else{
	if ($MA_ENABLE_LOGIN){
		login_form();
	}
}

# end local app file


# page end
page_footer();

?>
