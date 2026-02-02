<?php

#
# WSearch keret
#


if (file_exists("./config.php")) {
  include("./config.php");
}

if ((count($_GET) > 0) or (count($_POST) > 0)) {
  if (file_exists("./search.php")) {
    include("./search.php");
  }
} else {
  if (file_exists("./main.php")) {
    include("./main.php");
  }
}


?>


