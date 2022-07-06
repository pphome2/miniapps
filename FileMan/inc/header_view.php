<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

echo("<html>");

echo("<head>");
echo("<title>$MA_TITLE</title>");
echo("<meta charset=\"utf-8\" />");
echo("<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\" />");
echo("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />");
echo("<link rel=\"icon\" href=\"$MA_FAVICON\" />");
echo("<link rel=\"shortcut icon\" type=\"image/png\" href=\"$MA_FAVICON\" />");

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
echo("<div class=\"all-page\">");
echo("<header>");
echo("</header>");
echo("<div class=\"content\">");

?>
