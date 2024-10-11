<?php

// functions

// notice-error – red left border
// notice-warning– yellow/orange left border
// notice-success – green left border
// notice-info – blue left border
// optionally use is-dismissible
function wswdteam_message($text=""){
  echo("<div class=\"notice notice-success is-dismissible\"><p>");
  echo(_e($text,'sample-text-domain'));
  echo("</p></div>");
}

function wswdteam_error($text=""){
  echo("<div class=\"notice notice-error is-dismissible\"><p>");
  echo(_e($text,'sample-text-domain'));
  echo("</p></div>");
}

function wswdteam_warning($text=""){
  echo("<div class=\"notice notice-warning is-dismissible\"><p>");
  echo(_e($text,'sample-text-domain'));
  echo("</p></div>");
}

function wswdteam_success($text=""){
  echo("<div class=\"notice notice-success is-dismissible\"><p>");
  echo(_e($text,'sample-text-domain'));
  echo("</p></div>");
}

function wswdteam_info($text=""){
  echo("<div class=\"notice notice-info is-dismissible\"><p>");
  echo(_e($text,'sample-text-domain'));
  echo("</p></div>");
}



?>

