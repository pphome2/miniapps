<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


if ($L_SITENAME<>""){
  $MA_TITLE=$MA_TITLE." - ".$L_SITENAME;
}

echo($MA_DOCTYPE);
echo("<html>");

echo("<head>");
echo("<title>$MA_TITLE</title>");
echo("<meta charset=\"utf-8\" />");
echo("<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\" />");
echo("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />");
echo("<link rel=\"icon\" href=\"$MA_FAVICON\" />");
echo("<link rel=\"shortcut icon\" type=\"image/png\" href=\"$MA_FAVICON\" />");

echo("<style>");
if ($MA_ENABLE_SYSTEM_CSS){
  if (file_exists("$MA_INCLUDE_DIR/$MA_CSS[$MA_STYLEINDEX]")){
    include("$MA_INCLUDE_DIR/$MA_CSS[$MA_STYLEINDEX]");
  }else{
    if (file_exists("$MA_INCLUDE_DIR/$MA_CSS[0]")){
      include("$MA_INCLUDE_DIR/$MA_CSS[0]");
    }
  }
}

if ((isset($MA_APPCSSFILE[$MA_STYLEINDEX])) and (file_exists("$MA_CONTENT_DIR/$MA_APPCSSFILE[$MA_STYLEINDEX]"))){
  include("$MA_CONTENT_DIR/$MA_APPCSSFILE[$MA_STYLEINDEX]");
  echo("$MA_CONTENT_DIR/$MA_APPCSSFILE[$MA_STYLEINDEX]");
}else{
  if ((isset($MA_APPCSSFILE[0]) and (file_exists("$MA_CONTENT_DIR/$MA_APPCSSFILE[0]")))){
    include("$MA_CONTENT_DIR/$MA_APPCSSFILE[0]");
  }
}
echo("</style>");
echo("</head>");

echo("<body>");
echo("<div class=all-page>");

if ($MA_ENABLE_HEADER){
  echo("<header>");
  echo("<div class=\"menu\">");
  echo("<ul class=\"sidenav\">");
  if ($MA_BACKPAGE){
    echo("<li><a onclick=\"window.history.back();\" href=\"\">&#8592;</a></li>");
  }
  if ($MA_ROOT_HOME<>""){
    if ($L_ROOTHOME<>""){
      echo("<li><a class=\"active\" href=\"$MA_ROOT_HOME\">$L_ROOTHOME</a></li>");
    }else{
      echo("<li><a class=\"active\" href=\"$MA_ROOT_HOME\">$MA_ROOTNAME</a></li>");
    }
  }

  if ($MA_SITE_HOME<>""){
    $MA_ADMINFILE=$MA_SITE_HOME;
  }
  $mp=1000;
  if (isset($_GET[$MA_MENU_FIELD])){
	$mp=array_search($_GET[$MA_MENU_FIELD],$MA_MENUCODE);
  }
  if ($mp==1000){
	if ($L_SITEHOME<>""){
  	  echo("<li><a class=actmenu href=\"$MA_ADMINFILE\">$L_SITEHOME</a></li>");
	}else{
  	  echo("<li><a class=actmenu href=\"$MA_ADMINFILE\">$MA_SITENAME</a></li>");
	}
  }else{
	if ($L_SITEHOME<>""){
  	  echo("<li><a href=\"$MA_ADMINFILE\">$L_SITEHOME</a></li>");
	}else{
  	  echo("<li><a href=\"$MA_ADMINFILE\">$MA_SITENAME</a></li>");
	}
  }

  if ($MA_LOGGEDIN){
    if ($MA_ADMIN_USER){
      if (count($MA_ADMINMENU)>0){
        $db=count($MA_ADMINMENU);
        for ($i=0;$i<$db;$i++){
		  if ($i==$mp){
        	echo("<li><a class=actmenu href=\"?$MA_MENU_FIELD=".$MA_ADMINMENU[$i][1]."\">".$MA_ADMINMENU[$i][0]."</a></li>");
		  }else{
        	echo("<li><a href=\"?$MA_MENU_FIELD=".$MA_ADMINMENU[$i][1]."\">".$MA_ADMINMENU[$i][0]."</a></li>");
          }
        }
      }
    }else{
      if (count($MA_MENU)>0){
        $db=count($MA_MENU);
        for ($i=0;$i<$db;$i++){
      	  if ($mp==$i){
        	echo("<li><a class=actmenu href=\"?$MA_MENU_FIELD=".$MA_MENU[$i][1]."\">".$MA_MENU[$i][0]."</a></li>");
      	  }else{
        	echo("<li><a href=\"?$MA_MENU_FIELD=".$MA_MENU[$i][1]."\">".$MA_MENU[$i][0]."</a></li>");
          }
        }
      }
    }

    if (($MA_ENABLE_SEARCH)and(!$MA_PRIVACY_PAGE)){
      echo("<li class=\"liright\">");
      echo("<a href=\"$MA_SEARCHFILE\">");
      echo("<div class=\"search_icon\">&#9740;</div>");
      echo("</a>");
      echo("</li>");
    }

    if ($MA_LOGOUT_IN_HEADER){
      if ((!$MA_PRIVACY_PAGE)and(!$MA_SEARCH_PAGE)){
        echo("<li class=\"liright\">");
        echo("<a href=#
          onclick=\"document.cookie='$MA_COOKIE_LOGIN=$L_LOGOUT; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
          window.history.replaceState(null, null, window.location.pathname);window.location = window.location.href;\">
          $L_LOGOUT</a>");
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
