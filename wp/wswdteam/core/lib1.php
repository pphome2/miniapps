<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// notice-success – zöld bal keret - is-dismissible - x bezárás
function wswdteam_message($text="",$autohide=false){
  if ($autohide){
    echo("<div id=\"mid\" class=\"notice notice-success autohide\"><p>");
  }else{
    echo("<div id=\"mid\" class=\"notice notice-success is-dismissible\"><p>");
  }
  echo(_e($text,'wswdteam-dom'));
  echo("</p></div>");
  if ($autohide){
    ?>
    <script>
      setTimeout(function(){
        document.getElementById('mid').style.display='none';
      }, 10000);
    </script>
    <?php
  }
}

// notice-error – vörös bal keret
function wswdteam_error($text="",$autohide=false){
  if ($autohide){
    echo("<div id=\"mid\" class=\"notice notice-error autohide\"><p>");
  }else{
    echo("<div id=\"mid\" class=\"notice notice-error is-dismissible\"><p>");
  }
  echo(_e($text,'wswdteam-dom'));
  echo("</p></div>");
  if ($autohide){
    ?>
    <script>
      setTimeout(function(){
        document.getElementById('mid').style.display='none';
      }, 10000);
    </script>
    <?php
  }
}

// notice-warning– sárga bal keret
function wswdteam_warning($text="",$autohide=false){
  if ($autohide){
    echo("<div id=\"mid\" class=\"notice notice-warning autohide\"><p>");
  }else{
    echo("<div id=\"mid\" class=\"notice notice-warning is-dismissible\"><p>");
  }
  echo(_e($text,'wswdteam-dom'));
  echo("</p></div>");
  if ($autohide){
    ?>
    <script>
      setTimeout(function(){
        document.getElementById('mid').style.display='none';
      }, 10000);
    </script>
    <?php
  }
}

// notice-success – zöld bal keret
function wswdteam_success($text="",$autohide=false){
  if ($autohide){
    echo("<div id=\"mid\" class=\"notice notice-success autohide\"><p>");
  }else{
    echo("<div id=\"mid\" class=\"notice notice-success is-dismissible\"><p>");
  }
  echo(_e($text,'wswdteam-dom'));
  echo("</p></div>");
  if ($autohide){
    ?>
    <script>
      setTimeout(function(){
        document.getElementById('mid').style.display='none';
      }, 10000);
    </script>
    <?php
  }
}

// notice-info – kék bal keret
function wswdteam_info($text="",$autohide=false){
  if ($autohide){
    echo("<div id=\"mid\" class=\"notice notice-info autohide\"><p>");
  }else{
    echo("<div id=\"mid\" class=\"notice notice-info is-dismissible\"><p>");
  }
  echo(_e($text,'wswdteam-dom'));
  echo("</p></div>");
  if ($autohide){
    ?>
    <script>
      setTimeout(function(){
        document.getElementById('mid').style.display='none';
      }, 10000);
    </script>
    <?php
  }
}

// fordítás
function wswdteam_lang($text=''){
  global $WSWDTEAM_LANG_STR;

  if (isset($WSWDTEAM_LANG_STR)and(isset($WSWDTEAM_LANG_STR[$text]))){
    $line=$WSWDTEAM_LANG_STR[$text];
  }else{
    $line='.'.$text.'.';
  }
  $line=strip_tags($line);
  return($line);
}

?>

