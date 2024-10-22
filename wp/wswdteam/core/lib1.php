<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// lapozó
function wswdteam_pager($db=0,$row=0,$apage=0,$formid=""){
  echo("<div style=\"width:99%;\"><span style=\"float:right;\">");
  $op=round(($db/$row),0);
  if (($apage<>1)and($op>1)){
    $i=$apage-1;
    echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"1\">");
    echo("<input type=\"submit\" id=\"x\" name=\"x\" class=\"button\" value=\"".wswdteam_lang("Első")."\">");
    echo("</form>");
    echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">");
    echo("<input type=\"submit\" id=\"x\" name=\"x\" class=\"button\" value=\"<<\">");
    echo("</form>");
  }
  $endl=false;
  $l1=1;
  $l2=$op;
  if ($op>9){
    $l1=$apage-4;
    $l2=$apage+4;
    if ($l1<1){
      $l1=1;
      $l2=9;
    }else{
      if ($l1>1){
        echo(" <span style=\"padding-right:10px;\">...</span>");
      }
    }
    if ($l2>=$op){
      $l2=$op;
      //$l1=$op-9;
    }else{
      $endl=true;
    }
    if (($l2-$l1)<9){
      $l1=$l2-8;
    }
  }else{
    $l1=1;
    $l2=$op;
  }
  for($i=$l1;$i<=$l2;$i++){
    echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">");
    if ($apage==$i){
      echo("<input type=\"submit\" id=\"x$i\" name=\"x\" class=\"activepage button\" value=\"$i\">");
      echo("<script>document.getElementById(\"x$i\").disabled=true</script>");
    }else{
      echo("<input type=\"submit\" id=\"x$i\" name=\"x\" class=\"button\" value=\"$i\">");
    }
    echo("</form>");
  }
  if ($endl){
    echo(" <span style=\"padding-right:10px;\">...</span>");
  }
  if (($apage<$op)and($op>1)){
    $i=$apage+1;
    echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">");
    echo("<input type=\"submit\" id=\"x\" name=\"x\" class=\"button\" value=\">>\">");
    echo("</form>");
    echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$op\">");
    echo("<input type=\"submit\" id=\"x\" name=\"x\" class=\"button\" value=\"".wswdteam_lang("Utolsó")."\">");
    echo("</form>");
  }
  echo("</span></div>");
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

