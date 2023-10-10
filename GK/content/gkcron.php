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
      echo("\n- ".$r[0]." ");
        #$ddiff=abs(strtotime($today)-strtotime($r[6]));
        $ddiff=abs(strtotime($r[6])-strtotime($today));
        $dday=floor($ddiff/(60*60*24));
        if (in_array($dday,$GK_MAIL_DAY)or($dday<0)){
            $rd=date("Y.m.d.",strtotime($r[6]));
            $msg=$msg."$r[2] $r[3] $rd - $GK_MAIL_MSG[0] $dday\n";
        }
      echo(" ".$dday);
        $ddiff=strtotime($r[12])-strtotime($today);
        $dday=floor($ddiff/(60*60*24));
        if (in_array($dday,$GK_MAIL_DAY)or($dday<0)){
            $d=date("Y.m.d.",strtotime($r[12]));
            $msg=$msg."$r[2] $r[3] $d - $GK_MAIL_MSG[1] $dday\n";
        }
      echo(" ".$dday);
        $ddiff=strtotime($r[13])-strtotime($today);
        $dday=floor($ddiff/(60*60*24));
        if (in_array($dday,$GK_MAIL_DAY)or($dday<0)){
            $d=date("Y.m.d.",strtotime($r[13]));
            $msg=$msg."$r[2] $r[3] $d - $GK_MAIL_MSG[2] $dday\n";
        }
      echo(" ".$dday);
  }
  if ($msg<>""){
      echo("\n\n".$L_SITENAME."\n\n".$msg."\n ---> ".$umail."\n\n");
      $msg="\n".$L_SITENAME."\n\n".$msg."\n";
        mail("$umail","$L_SITENAME","$msg");
  }
}


?>
