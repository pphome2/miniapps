<?php

 #
 # GK
 #
 # info: main folder copyright file
 #
 #


function gk_cron(){
    global $MA_SQL_RESULT,$GK_USER_MAIL,$L_SITENAME,$GK_MAIL_DAY,$GK_MAIL_MSG;

    $msg="";
    $udb=count($GK_USER_MAIL);
    $today=date('Y-m-d');
    $do=date_create($today);
    sql_run("select * from gk_data order by model desc;");
	$db=count($MA_SQL_RESULT);
	for($i=0;$i<$db;$i++){
	    $r=$MA_SQL_RESULT[$i];
	    for($k=0;$k<$udb;$k++){
	        $n=$GK_USER_MAIL[$k];
	        if ($n[0]===$r[16]){
	            $umail=$n[1];
	            $k=$udb;
	        }
	    }
        $ddiff=abs(strtotime($today) - strtotime($r[6]));
        $dday=floor($ddiff/(60*60*24));
        if ($dday==$GK_MAIL_DAY){
            $rd=date("Y.m.d",strtotime($r[6]));
            $msg="$r[2] $r[3] $rd - $GK_MAIL_MSG[0] $dday\n";
        }
        $ddiff=abs(strtotime($today) - strtotime($r[12]));
        $dday=floor($ddiff/(60*60*24));
        if ($dday==$GK_MAIL_DAY){
            $msg="$r[2] $r[3] $r[12] - $GK_MAIL_MSG[1] $dday\n";
        }
        $ddiff=abs(strtotime($today) - strtotime($r[13]));
        $dday=floor($ddiff/(60*60*24));
        if ($dday==$GK_MAIL_DAY){
            $msg="$r[2] $r[3] $r[13] - $GK_MAIL_MSG[2] $dday\n";
        }
	    #echo($L_SITENAME." ".$r[0]." - ".$umail."\n");
	}
	if ($msg<>""){
	    echo($msg);
        #mail("$umail","$L_SITENAME","tesztelve cron.");
	}
    #mail("$umail","$L_SITENAME","tesztelve cron.");
}


?>
