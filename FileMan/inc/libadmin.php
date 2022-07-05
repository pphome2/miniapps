<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


function setcookienames(){
    global $MA_COOKIE_STYLE,$MA_COOKIE_USER,$MA_COOKIE_PASSWORD,$MA_COOKIE_TIME;

    $p=explode('/',(dirname(__FILE__)));
    if (count($p)>=2){
        $px=$p[count($p)-2];
    }else{
        $px="";
    }
    $MA_COOKIE_STYLE=$px."st";
    $MA_COOKIE_USER=$px."u";
    $MA_COOKIE_PASSWORD=$px."p";
    $MA_COOKIE_TIME=$px."lt";
}

?>
