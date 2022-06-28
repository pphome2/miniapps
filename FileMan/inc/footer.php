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

if (($MA_ENABLE_COOKIES)and(!$MA_LOGGEDIN)and(!$MA_PRIVACY_PAGE)){
    echo("<p class=cookietext>$L_COOKIE_TEXT <a class=\"privacybutton\" href=\"$MA_PRIVACY\">$L_PRIVACY_MENU</a></p>");
}

if ($MA_ENABLE_FOOTER){
    echo("<footer>");
    echo("<ul class=\"sidenav\">");
	echo("<li class=\"padleft\">$MA_COPYRIGHT</li>");
    if ($MA_ENABLE_COOKIES){
        echo("<li class=\"liright\">");
		echo("<a href=\"\" onclick=\"document.cookie='$MA_COOKIE_STYLE=$nextstyle;samesite=Lax;' \">$L_THEME</a>");
        echo("</li>");
        echo("<li class=\"liright\">");
		echo("<a href=\"$MA_PRIVACY\">$L_PRIVACY_MENU</a>");
        echo("</li>");
    }else{
        echo("<li class=\"liright\">");
		echo("<a href=\"$MA_ADMINFILE?$MA_STYLEPARAM_NAME=$nextstyle\">$L_THEME</a>");
        echo("</li>");
        echo("<li class=\"liright\">");
		echo("<a href=\"$MA_PRIVACYFILE?$MA_STYLEPARAM_NAME=$MA_STYLEINDEX\" >$L_PRIVACY_MENU</a>");
        echo("</li>");
    }
	echo("<li class=\"liright\">");

	if ($MA_LOGGEDIN){
		echo("<a href=#
			onclick=\"document.cookie='$MA_COOKIE_PASSWORD=$L_LOGOUT; expires=Thu, 01 Jan 1970 00:00:00 UTC;';window.location = window.location.href;\">$L_LOGOUT</a>");
	}

	echo("</li>");
	echo("</ul>");
    echo("</footer>");

}
echo("</div>");
echo("</body>");
echo("</html>");

?>
