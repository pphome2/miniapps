<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

echo("</div>");

if (($MA_ENABLE_COOKIES)and(!$MA_LOGGEDIN)and(!$MA_PRIVACY_PAGE)and(!$MA_SEARCH_PAGE)){
    echo("<p class=cookietext>$L_COOKIE_TEXT <a class=\"privacybutton\" href=\"$MA_PRIVACYFILE\">$L_PRIVACY_MENU</a></p>");
}

if (($MA_LOGGEDIN)and($MA_ENABLE_COOKIES)){
    echo("<footer>");
	echo("<li class=\"liright\">");
	echo("<a href=#
		onclick=\"document.cookie='$MA_COOKIE_PASSWORD=$L_LOGOUT; expires=Thu, 01 Jan 1970 00:00:00 UTC;';window.location = window.location.href;\">$L_LOGOUT</a>");
	echo("</li>");
    echo("<li class=\"liright\">");
    echo("<a href=\"$MA_PRIVACYFILE\" >$L_PRIVACY_MENU</a>");
    echo("</li>");
    echo("</footer>");

}

echo("</div>");
echo("</body>");
echo("</html>");

?>
