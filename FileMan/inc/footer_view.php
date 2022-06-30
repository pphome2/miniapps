<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

echo("</div>");

if (($MA_ENABLE_COOKIES)and(!$MA_LOGGEDIN)and(!$MA_PRIVACY_PAGE)and(!$MA_SEARCH_PAGE)){
    if ($MA_ENABLE_LOGIN_VIEW){
        echo("<p class=cookietext>$L_COOKIE_TEXT <a class=\"privacybutton\" href=\"$MA_PRIVACYFILE\">$L_PRIVACY_MENU</a></p>");
    }
}

if (($MA_LOGGEDIN)and($MA_ENABLE_COOKIES)){
    $color="";
    if (!$MA_ENABLE_FOOTER_VIEW){
        $color="footerbutton";
    }
    echo("<footer class=footerv>");
	echo("<li class=\"liright\">");
	echo("<a class=$color href=#
		onclick=\"document.cookie='$MA_COOKIE_PASSWORD=$L_LOGOUT; expires=Thu, 01 Jan 1970 00:00:00 UTC;';window.location = window.location.href;\">$L_LOGOUT</a>");
	echo("</li>");
    echo("<li class=\"liright\">");
    echo("<a class=$color href=\"$MA_PRIVACYFILE\" >$L_PRIVACY_MENU</a>");
    echo("</li>");
    echo("</footer>");

}

echo("</div>");
echo("</body>");
echo("</html>");

?>
