<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// üzenet
function wswdteam_action_message($text="",$autohide=false){
  global $wswdteam_message_autohide;

  if (!$autohide){
    $autohide=$wswdteam_message_autohide;
  }
  $r="
    <div id=mid class=\"wswdokmessage\" onclick=\"this.style.display='none';\">
      ".$text."
    </div>";
  if ($autohide){
    $r=$r."
      <script>
        setTimeout(function(){
          document.getElementById('mid').style.display='none';
        }, 10000);
      </script>";
  }
  return($r);
}

// üzenet
function wswdteam_action_errormessage($text="",$autohide=false){
  global $wswdteam_message_autohide;

  if (!$autohide){
    $autohide=$wswdteam_message_autohide;
  }
  $r="
    <div id=mid class=\"wswderrormessage\" onclick=\"this.style.display='none';\">
      ".$text."
    </div>";
  if ($autohide){
    $r=$r."
      <script>
        setTimeout(function(){
          document.getElementById('mid').style.display='none';
        }, 10000);
      </script>";
  }
  return($r);
}




// notice-success – zöld bal keret - is-dismissible - x bezárás
function wswdteam_message($text="",$autohide=false){
  global $wswdteam_message_autohide;

  if (!$autohide){
    $autohide=$wswdteam_message_autohide;
  }
  echo("<div id=\"mid\" class=\"notice notice-success is-dismissible\"><p>");
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
  global $wswdteam_message_autohide;

  if (!$autohide){
    $autohide=$wswdteam_message_autohide;
  }
  echo("<div id=\"mid\" class=\"notice notice-error is-dismissible\"><p>");
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
  global $wswdteam_message_autohide;

  if (!$autohide){
    $autohide=$wswdteam_message_autohide;
  }
  echo("<div id=\"mid\" class=\"notice notice-warning is-dismissible\"><p>");
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
  global $wswdteam_message_autohide;

  if (!$autohide){
    $autohide=$wswdteam_message_autohide;
  }
  echo("<div id=\"mid\" class=\"notice notice-success is-dismissible\"><p>");
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
  global $wswdteam_message_autohide;

  if (!$autohide){
    $autohide=$wswdteam_message_autohide;
  }
  echo("<div id=\"mid\" class=\"notice notice-info is-dismissible\"><p>");
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

?>
