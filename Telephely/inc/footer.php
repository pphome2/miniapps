<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

echo("</div>");

$nextstyle=$MA_STYLEINDEX+1;
if ($nextstyle>(count($MA_CSS)-1)){
	$nextstyle=0;
}

if ((!$MA_LOGGEDIN)and(!$MA_PRIVACY_PAGE)and(!$MA_SEARCH_PAGE)and($MA_ENABLE_PRIVACY)){
    echo("<p class=cookietext>$L_COOKIE_TEXT <a class=\"privacybutton\" href=\"$MA_PRIVACYFILE\">$L_PRIVACY_MENU</a></p>");
}

if ($MA_ENABLE_FOOTER){
    echo("<footer>");
    echo("<ul class=\"sidenav\">");
	echo("<li class=\"padleft\">$MA_COPYRIGHT</li>");
	if (($MA_LOGGEDIN)and(!$MA_PRIVACY_PAGE)and(!$MA_SEARCH_PAGE)){
    	echo("<li class=\"liright\">");
		echo("<a href=#
			onclick=\"document.cookie='$MA_COOKIE_LOGIN=$L_LOGOUT; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
			window.history.replaceState(null, null, window.location.pathname);window.location = window.location.href;\">
			$L_LOGOUT</a>");
    	echo("</li>");
	}
	if ($MA_ENABLE_THEME){
        echo("<li class=\"liright\">");
  		echo("<a href=\"\" onclick=\"document.cookie='$MA_COOKIE_STYLE=$nextstyle;samesite=Strict;' \">$L_THEME</a>");
        echo("</li>");
    }
    if ((!$MA_PRIVACY_PAGE)and(!$MA_SEARCH_PAGE)and($MA_ENABLE_PRIVACY)){
        echo("<li class=\"liright\">");
	 	echo("<a href=\"$MA_PRIVACYFILE\" >$L_PRIVACY_MENU</a>");
        echo("</li>");
    }

	echo("</ul>");
    echo("</footer>");

}
echo("</div>");
echo("</body>");
echo("</html>");

?>
