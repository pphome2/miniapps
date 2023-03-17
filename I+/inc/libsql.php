<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


# sql parancs futtatása az sql szerveren

function sql_run($sqlcomm="",$inst=false){
  global $MA_SQL_SERVER,$MA_SQL_DB,$MA_SQL_USER,$MA_SQL_PASS,$MA_SQL_ERROR,$MA_SQL_RESULT;

  if ($sqlcomm<>""){
    $MA_SQL_RESULT=array();
    $sqllink=mysqli_connect("$MA_SQL_SERVER","$MA_SQL_USER","$MA_SQL_PASS","$MA_SQL_DB");
    $MA_SQL_ERROR=mysqli_error($sqllink);
    if ($MA_SQL_ERROR===""){
      $result=mysqli_query($sqllink,$sqlcomm);
      $MA_SQL_ERROR=mysqli_error($sqllink);
      if (!$inst){
        if (($MA_SQL_ERROR==="")and($result)){
          if (mysqli_num_rows($result)>0) {
            $i=0;
            while($row=mysqli_fetch_row($result)){
              $MA_SQL_RESULT[$i]=$row;
              $i++;
            }
          }
        }
      }
      mysqli_close($sqllink);
    }
    if ($MA_SQL_ERROR===""){
      return(true);
    }else{
      return(false);
    }
  }else{
    return(false);
  }
}


# többszörös utasítás futtatása SQL szerveren

function sql_multi_run($sqlcomm=""){
  global $MA_SQL_SERVER,$MA_SQL_DB,$MA_SQL_USER,$MA_SQL_PASS,$MA_SQL_ERROR,$MA_SQL_RESULT;

  if ($sqlcomm<>""){
    $sqllink=mysqli_connect("$MA_SQL_SERVER","$MA_SQL_USER","$MA_SQL_PASS","$MA_SQL_DB");
    $MA_SQL_ERROR=mysqli_error($sqllink);
    if ($MA_SQL_ERROR===""){
      $result=mysqli_multi_query($sqllink,$sqlcomm);
      $MA_SQL_ERROR=mysqli_error($sqllink);
      mysqli_close($sqllink);
    }
    if ($MA_SQL_ERROR===""){
      return(true);
    }else{
      return(false);
    }
  }else{
    return(false);
  }
}


# sql kapcsolat tesztelése

function sql_test(){
  global $MA_SQL_RESULT,$MA_SQL_ERROR;

  $sqlc="show databases;";
  echo("<br />SQL: $sqlc<br /><br />");
  if (sql_run($sqlc)){
    $db=count($MA_SQL_RESULT);
    echo("DB: $db<br /><br />");
    for ($i=0;$i<$db;$i++){
      $d=$MA_SQL_RESULT[$i];
      echo($d[0]."<br />");
    }
  }else{
    echo("Error: ".$MA_SQL_ERROR);
  }
}


# sql adatbázis, táblák létrehozása

function sql_install(){
  global $MA_CONFIG_DIR,$MA_SQL_FILE;

  if (file_exists("$MA_CONFIG_DIR/$MA_SQL_FILE")){
    $line=file_get_contents("$MA_CONFIG_DIR/$MA_SQL_FILE");
    $lines=explode(PHP_EOL,$line);
    $db=count($lines);
    $sqlc="";
    foreach ($lines as $v) {
      if (($v<>"")and(substr($v,0,1)<>"#")){
        $sqlc=$sqlc." ".$v;
        if (substr($v,strlen($v)-1,1)==";"){
          #sql_run($sqlc,true);
          #$sqlc="";
          $sqlc=$sqlc."\n";
        }
      }
    }
    #echo($sqlc);
    sql_multi_run($sqlc);
  }
}


?>
