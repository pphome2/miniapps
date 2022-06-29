<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

echo("<html>");

echo("<head>");
echo("<title>$MA_SITENAME $L_SITENAME</title>");
echo("<meta charset=\"utf-8\" />");
echo("<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\" />");
echo("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />");
echo("<link rel=\"icon\" href=\"favicon.png\" />");
echo("<link rel=\"shortcut icon\" type=\"image/png\" href=\"favicon.png\" />");

echo("<style>");
if (file_exists($MA_CSS[$MA_STYLEINDEX])){
    include("$MA_CSS[$MA_STYLEINDEX]");
}
if (file_exists($MA_APPCSSFILE)){
    include("$MA_APPCSSFILE");
}
echo("</style>");

echo("</head>");

echo("<body>");

echo("<div class=all-page>");

if ($MA_ENABLE_HEADER){
    echo("<header>");
    echo("<div class=\"menu\">");
    echo("<ul class=\"sidenav\">");

	#if (count($_GET)>0){
	#	echo("<li><a onclick=\"window.history.back();\">&#8592;</a></li>");
	#}
	if ($L_SITEHOME<>""){
		echo("<li><a class=\"active\" href=\"$MA_SITE_HOME\">$L_SITEHOME</a></li>");
	}
	if ($MA_ENABLE_COOKIES){
		echo("<li><a href=\"$MA_ADMINFILE\">$L_MTHOME</a></li>");
	}

	if ($MA_LOGGEDIN){
		if (count($MA_MENU)>0){
			$db=count($MA_MENU);
			for ($i=0;$i<$db;$i++){
				echo("<li><a href=\"?$MA_MENU_FIELD=".$MA_MENU[$i][1]."\">".$MA_MENU[$i][0]."</a></li>");
			}
		}
		if ($MA_ADMIN_USER){
			if (count($MA_ADMINMENU)>0){
				$db=count($MA_ADMINMENU);
				for ($i=0;$i<$db;$i++){
					echo("<li><a href=\"?$MA_ADMINMENU_FIELD=".$MA_ADMINMENU[$i][1]."\">".$MA_ADMINMENU[$i][0]."</a></li>");
				}
			}
		}

		echo("<li class=\"liright\">");
		if (!empty($MA_SEARCH_ICON_HREF)){
		    echo("<a href=\"$MA_SEARCH_ICON_HREF\" onclick=\"$MA_SEARCH_ICON_JS\">");
		}else{
		    echo("<a href=\"$MA_SEARCHFILE\" onclick=\"$MA_SEARCH_ICON_JS\">");
		}
		echo("<div class=\"search_icon\">&#9740;</div>");
		echo("</a>");
		echo("</li>");

		if ($MA_LOGOUT_IN_HEADER){
        	if ((!$MA_PRIVACY_PAGE)and(!$MA_SEARCH_PAGE)){
		    	echo("<li class=\"liright\">");
			    echo("<a href=#
				    onclick=\"document.cookie='$MA_COOKIE_PASSWORD=$L_LOGOUT; expires=Thu, 01 Jan 1970 00:00:00 UTC;';window.location = window.location.href;\">$L_LOGOUT</a>");
    			echo("</li>");
	    	}
	    }
	}
    echo("</ul>");
    echo("</div>");
    echo("</header>");
}

echo("<div class=\"content\">");

?>
