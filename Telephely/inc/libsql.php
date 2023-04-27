<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


# formázás
function sqlinput($d){
  $d=trim($d);
  $d=stripslashes($d);
  $d=strip_tags($d);
  #$d=htmlspecialchars($d);
  return($d);
}


# sql parancs futtatása az sql szerveren
function sql_run($sqlcomm="",$html=false){
  global $MA_SQL_SERVER,$MA_SQL_DB,$MA_SQL_USER,$MA_SQL_PASS,$MA_SQL_ERROR,
    $MA_SQL_RESULT,$MA_SQL_ERROR_ECHO;

  $ret=false;
  if (function_exists('mysqli_connect')){
    if ($sqlcomm<>""){
      if (!$html){
      $sqlcomm=sqlinput($sqlcomm);
      }
      $MA_SQL_ERROR="";
      $MA_SQL_RESULT=array();
      $sqllink=mysqli_connect("$MA_SQL_SERVER","$MA_SQL_USER","$MA_SQL_PASS","$MA_SQL_DB");
      $MA_SQL_ERROR=mysqli_error($sqllink);
      if ($MA_SQL_ERROR===""){
        $result=mysqli_query($sqllink,$sqlcomm);
        $MA_SQL_ERROR=mysqli_error($sqllink);
        if ($MA_SQL_ERROR===""){
          if (!is_bool($result)){
            if ($MA_SQL_ERROR===""){
              $i=0;
              while($row=mysqli_fetch_row($result)){
                $MA_SQL_RESULT[$i]=$row;
                $i++;
              }
              $ret=true;
            }
          }else{
              $MA_SQL_ERROR=mysqli_error($sqllink);
              $ret=$result;
          }
        }
        mysqli_close($sqllink);
      }
    }
  }
  if (($MA_SQL_ERROR<>"")and($MA_SQL_ERROR_ECHO)){
  echo("$sqlcomm\n");
    echo("$MA_SQL_ERROR\n");
  }
  return($ret);
}


# többszörös utasítás futtatása SQL szerveren
function sql_multi_run($sqlcomm=""){
  global $MA_SQL_SERVER,$MA_SQL_DB,$MA_SQL_USER,$MA_SQL_PASS,$MA_SQL_ERROR,$MA_SQL_RESULT;

  if (function_exists("mysqli_connect")){
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
  }else{
    return(false);
  }
}


# sql kapcsolat tesztelése

function sql_test(){
  global $MA_SQL_RESULT,$MA_SQL_ERROR;

  $sqlc="show databases;";
  if (sql_run($sqlc)){
  echo("<br />SQL: $sqlc<br /><br />");
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

  $sqlfile="";
  if (file_exists("$MA_CONFIG_DIR/$MA_SQL_FILE")){
      $sqlfile="$MA_CONFIG_DIR/$MA_SQL_FILE";
  }else{
      if (file_exists("$MA_SQL_FILE")){
          $sqlfile="$MA_SQL_FILE";
      }
  }
  if ($sqlfile<>""){
    $line=file_get_contents("$sqlfile");
    $lines=explode(PHP_EOL,$line);
    $db=count($lines);
    $sqlc="";
    foreach ($lines as $v) {
      if (($v<>"")and(substr($v,0,1)<>"#")){
        $sqlc=$sqlc." ".$v;
        if (substr($v,strlen($v)-1,1)==";"){
          $sqlc=$sqlc."\n";
        }
      }
    }
    sql_multi_run($sqlc);
  }
}


?>
