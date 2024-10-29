<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// lapozó admin felületen
function wswdteam_pager_admin($db=0,$row=0,$apage=0,$formid=""){
  if ($db>$row){
    echo("<div class=\"pagerlineadmin\"><span class=\"pagerlineadmin2\">");
    //$op=round(($db/$row),0);
    $op=ceil($db/$row);
    if (($apage<>1)and($op>1)){
      $i=$apage-1;
      echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
      echo("<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"1\">");
      echo("<input type=\"submit\" id=\"x\" name=\"x\" class=\"button\" value=\"".wswdteam_lang("Első")."\">");
      echo("</form>");
      echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
      echo("<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">");
      echo("<input type=\"submit\" id=\"x\" name=\"x\" class=\"button\" value=\"&lt;&lt;\">");
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
          echo(" <span class=\"pagerdots\">...</span>");
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
      echo("<input type=\"submit\" id=\"x\" name=\"x\" class=\"button\" value=\"&gt;&gt;\">");
      echo("</form>");
      echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
      echo("<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$op\">");
      echo("<input type=\"submit\" id=\"x\" name=\"x\" class=\"button\" value=\"".wswdteam_lang("Utolsó")."\">");
      echo("</form>");
    }
    echo("</span></div>");
  }
}


// lapozó felhasználói felületen
function wswdteam_pager($db=0,$row=0,$apage=0,$formid=""){
  $content="";
  if ($db>$row){
    $content=$content."<br /><br />";
    $content=$content."<div class=\"pagerline\">";
    $op=ceil($db/$row);
    if (($apage<>1)and($op>1)){
      $i=$apage-1;
      $content=$content."<form class=\"pagerform\" action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
      $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"1\">";
      $content=$content."<input class=\"pagerbutton\" type=\"submit\" id=\"x\" name=\"x\" value=\"".wswdteam_lang("Első")."\">";
      $content=$content."</form>";
      $content=$content."<form class=\"pagerform\" action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
      $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">";
      $content=$content."<input class=\"pagerbutton\" type=\"submit\" id=\"x\" name=\"x\" value=\"&lt;&lt;\">";
      $content=$content."</form>";
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
          $content=$content." <span class=\"pagerdots\">...</span>";
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
      $content=$content."<form class=\"pagerform\" action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
      $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">";
      if ($apage==$i){
        $content=$content."<input class=\"pagerbutton\" type=\"submit\" id=\"x$i\" name=\"x\" value=\"$i\">";
        $content=$content."<script>document.getElementById(\"x$i\").disabled=true</script>";
      }else{
        $content=$content."<input class=\"pagerbutton\" type=\"submit\" id=\"x$i\" name=\"x\" value=\"$i\">";
      }
      $content=$content."</form>";
    }
    if ($endl){
      $content=$content." <span style=\"padding-right:10px;\">...</span>";
    }
    if (($apage<$op)and($op>1)){
      $i=$apage+1;
      $content=$content."<form class=\"pagerform\" action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
      $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">";
      $content=$content."<input class=\"pagerbutton\" type=\"submit\" id=\"x\" name=\"x\" value=\"&gt;&gt;\">";
      $content=$content."</form>";
      $content=$content."<form class=\"pagerform\" action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
      $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$op\">";
      $content=$content."<input class=\"pagerbutton\" type=\"submit\" id=\"x\" name=\"x\" value=\"".wswdteam_lang("Utolsó")."\">";
      $content=$content."</form>";
    }
    $content=$content."</span></disv>";
  }
  return($content);
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
function wswdteam_lang($text='',$dot=true){
  global $WSWDTEAM_LANG_STR,$wswdteam_lang_new;

  if (isset($WSWDTEAM_LANG_STR)and(isset($WSWDTEAM_LANG_STR[$text]))){
    $line=$WSWDTEAM_LANG_STR[$text];
  }else{
    if ($dot){
      $line=$text;
    }else{
      $line='.'.$text.'.';
    }
    $wswdteam_lang_new[$text]=strip_tags($text);
  }
  $line=strip_tags($line);
  return($line);
}

// új fordítandók kiírása
function wswdteam_lang_newlines(){
  global $wswdteam_lang_new,$wswdteam_developer_mode;

  if ($wswdteam_developer_mode){
    if (count($wswdteam_lang_new)>0){
      echo("<br /><br />");
      foreach($wswdteam_lang_new as $l){
        echo("'".$l."' => '".$l."',<br />");
      }
      echo("<br /><br />");
    }
  }
}

?>
