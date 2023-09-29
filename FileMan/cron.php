<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

# /etc/cron.d/gk fájlba: (# nélkül)
# 0 0 * * * root php /var/www/html/.../cron.php

if (isset($_SERVER['SERVER_NAME'])){
    echo(date("Y. m. d"));
}else{

    $sdir=realpath(dirname(__FILE__));

    # load config and language file
    if (!isset($MA_CONFIG_DIR)){
        if (file_exists("$sdir/config/config.php")){
	    include("$sdir/config/config.php");
        }
    }

    for ($i=0;$i<count($MA_LIB);$i++){
	    if (file_exists("$sdir/$MA_INCLUDE_DIR/$MA_LIB[$i]")){
		    include("$sdir/$MA_INCLUDE_DIR/$MA_LIB[$i]");
	    }
    }

    # local app files
    if (file_exists("$sdir/$MA_CONTENT_DIR/$MA_APPFILE[0]")){
	    include("$sdir/$MA_CONTENT_DIR/$MA_APPFILE[0]");
    }
    for ($i=0;$i<count($MA_APPFILE);$i++){
	    if (file_exists("$sdir/$MA_CONTENT_DIR/$MA_APPFILE[$i]")){
		    include("$sdir/$MA_CONTENT_DIR/$MA_APPFILE[$i]");
	    }
    }

    # prepare system
    #plugins();

    if (function_exists("cron")){
        cron();
    }

    # end local app file

    # page end
}

?>
