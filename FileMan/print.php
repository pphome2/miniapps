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


for ($i=0;$i<count($MA_LIB);$i++){
	if (file_exists("$MA_LIB[$i]")){
		include("$MA_LIB[$i]");
	}
}


$MA_NOPAGE=true;

# build page
#page_header_view();
if (file_exists($MA_CSSPRINT)){
    echo("<style>");
    include("$MA_CSSPRINT");
    echo("</style>");
}
echo("<body onclick=\"window.close();\">");

# load local app file
for ($i=0;$i<count($MA_APPFILE);$i++){
	if (file_exists("$MA_APPFILE[$i]")){
		include("$MA_APPFILE[$i]");
	}
}

if (function_exists("printpage")){
	printpage();
}

# end

echo("<script>window.print();</script>");

#page_footer_view();

?>
