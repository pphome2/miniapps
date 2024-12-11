<?php

// hibák kiírása
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$L_TITLE="Install";
$L_PAGE_ADDRESS="Telepítés";
$L_PAGE_1="Szükséges adatok megadása";
$L_PAGE_2="Folyamat";
$L_SQL_SRV="Adatbázis szerver";
$L_SQL_DB="Adatbázis neve";
$L_SQL_USER="Felhasználónév";
$L_SQL_PW="Jelszó";
$L_SQL_GO="Mehet";
$L_SQL_TABLE_PRE="Adattáblák elő";
$L_SQL_PHASE_1="SQL ellenőrzés";
$L_SQL_PHASE_2="2";
$L_SQL_PHASE_3="3";
$L_PHASE_1="Fájl kicsomagolva";
$L_PHASE_2="Fájl kicsomagolva";
$L_PHASE_3="Rendrakás. Átmeneti fájlok törölve";
$L_END="Telepítés befejezve.";
$L_NEXT="Tovább";
$L_ERROR="Hiba történt. Hibaüzenet:";

// fej
echo("<!DOCTYPE html>");
echo("<head>");
echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />");
echo("<title>$L_TITLE</title>");
echo("<style>");
?>
  body{
    background-color:lightgray;
  }
  .box{
    margin-left:25%;
    margin-top:5%;
    width:50%;
    background-color:white;
    border:1px solid gray;
    border-radius:10px;
    padding:30px;
    box-shadow: 10px 10px 10px 10px gray;
  }
  form, .buttonbox{
    margin-left:20%;
    margin-right:20%;
    align:center;
  }
  input{
    width:100%;
  }
  .placeholder{
    max-height:2em;
    height:2em;
    display:block;
  }
<?php
echo("</style>");
echo("</head>");
echo("<html>");
echo("<body>");
echo("<div class=box>");

// fájlok felderítése
echo("<h1>$L_PAGE_ADDRESS</h1>");
echo("<span class=placeholder></span>");


// fájl elérések ellenőrzése
$ok1=false;
$ok2=false;
$md=dirname(__FILE__);
$fl=scandir($md);
foreach($fl as $l){
  $ext=pathinfo($l,PATHINFO_EXTENSION);
  switch($ext){
    case "sql":
      $ok1=true;
      break;
    case "gz":
      $ok2=true;
      break;
  }
}

if ($ok1 and $ok2){
  $ok=false;
  if (isset($_POST['db'])){
    $sqlsrv=$_POST['0'];
    if ($sqlsrv===""){
      $sqlsrv="localhost";
    }
    $sqldb=$_POST['1'];
    $sqluser=$_POST['2'];
    $sqlpw=$_POST['3'];
    $sqlpre=$_POST['4'];
    try{
      $sqlconn=new mysqli($sqlsrv,$sqluser,$sqlpw,$sqldb);
      $ok=true;
      mysqli_close($sqlconn);
    } catch(Exception $e){
      echo("$L_ERROR ".$e->getMessage());
      echo("<span class=placeholder></span>");
    }
  }

  // adatbekérés
  if (!$ok){
    echo("<h2>$L_PAGE_1</h2>");
    echo("<span class=placeholder></span>");
    inst_form();
  }else{
    echo("<h2>$L_PAGE_2</h2>");
    echo("<span class=placeholder></span>");
    inst_files();
  }
}else{
  echo("$L_ERROR");
  echo("<span class=placeholder></span>");
}



// fájlok feldolgozása
function inst_files(){
  global $L_END,$L_NEXT,$L_PHASE_1,$L_PHASE_2,$L_PHASE_3,$L_ERROR,
         $sqlsrv,$sqluser,$sqlpw,$sqldb;

  $md=dirname(__FILE__);
  $fl=scandir($md);
  foreach($fl as $l){
    $ext=pathinfo($l,PATHINFO_EXTENSION);
    switch($ext){
      case "sql":
          $fn=$md."/".$l;
          $sqlfile=$md."/".$l;
          if (file_exists($sqlfile)){
            $sqlconn=new mysqli($sqlsrv,$sqluser,$sqlpw,$sqldb);
            inst_sql($sqlfile,$sqlconn);
            mysqli_close($sqlconn);
          }
          echo("<br />");
        break;
      case "gz":
        try{
          // decompress
          $fn=$md."/".$l;
          $tarfile=$md."/".pathinfo($l,PATHINFO_FILENAME);
          if (file_exists($tarfile)){
            unlink($tarfile);
          }
          echo("- $L_PHASE_1 (gz).<br />");
          $p=new PharData($fn);
          $p->decompress();
          // kicsomagolás
          $fn=$md."/".$tarfile.".tar";
          echo("- $L_PHASE_2 (tar).<br />");
          $phar=new PharData($tarfile);
          $phar->extractTo($md,null,true);
          // törlés
          echo("- $L_PHASE_3.<br />");
          if (file_exists($tarfile)){
            unlink($tarfile);
          }
        }catch(Exception $e){
          echo("$L_ERROR ".$e->getMessage());
        }
        break;
      case "tar":
        try{
          $fn=$md."/".$l;
          unlink($fn);
        }catch(Exception $e){
          echo("$L_ERROR ".$e->getMessage());
        }
        break;
    }
  }
  // láb
  echo("<span class=placeholder></span>");
  echo($L_END);
  echo("<span class=placeholder></span>");
  $dn=dirname($_SERVER['REQUEST_URI']);
  //echo($dn."<br /><br />");
  if (file_exists("index.php")){
      echo("<div class=buttonbox><a href=\"index.php\"><input type=submit value=\"$L_NEXT\"></a></div>");
  }else{
    if (file_exists("index.html")){
      echo("<div class=buttonbox><a href=\"index.html\"><input type=submit value=\"$L_NEXT\"></a></div>");
    }
  }
}



// sql feldolgozás
function inst_sql($sqlfile="",$sqlconn){
  global $L_SQL_PHASE_1,$L_SQL_PHASE_2,$L_SQL_PHASE_3,$sqlsrv,$sqldb,$sqlpre,$sqlpw,$sqluser;

  if (file_exists($sqlfile)){
    echo("- $L_SQL_PHASE_1.<br />");
    if ($sqlpre===""){
      $sqlpre=substr($_SERVER['HTTP_HOST'],0,3)."_";
    }
    $sql="";
    foreach(file($sqlfile) as $line){
      $line=str_replace(PHP_EOL,'',$line);
      $sql=$sql." ".$line;
      if (substr($line,-1)===";"){
        //echo("X<br /><br />");
        // pre csere
        // domain csere
        try{
          if ($r=$sqlconn->query($sql)){
          }
        }catch(Exception $e){
          echo($sql." - ".$e->getMessage()."<br />");
        }
        $sql="";
      }
    }
    echo("- $L_SQL_PHASE_2.<br />");
    echo("- $L_SQL_PHASE_3.<br />");
  }
}



// adatbekérés
function inst_form(){
  global $L_SQL_DB,$L_SQL_GO,$L_SQL_PW,$L_SQL_SRV,$L_SQL_TABLE_PRE,$L_SQL_USER;

  echo("<form id=db0 method=\"post\">");
  echo("<label for=\"0\">$L_SQL_SRV:</label><br>");
  echo("<input type=\"text\" id=\"0\" name=\"0\" placeholder=\"".$L_SQL_SRV."\"><br>");
  echo("<br />");
  echo("<label for=\"1\">$L_SQL_DB:</label><br>");
  echo("<input type=\"text\" id=\"1\" name=\"1\" placeholder=\"".$L_SQL_DB."\"><br>");
  echo("<br />");
  echo("<label for=\"2\">$L_SQL_USER:</label><br>");
  echo("<input type=\"text\" id=\"2\" name=\"2\" placeholder=\"".$L_SQL_USER."\"><br>");
  echo("<br />");
  echo("<label for=\"3\">$L_SQL_PW:</label><br>");
  echo("<input type=\"password\" id=\"3\" name=\"3\" value=\"\"><br>");
  echo("<br />");
  $pre=substr($_SERVER['HTTP_HOST'],0,3)."_";
  echo("<label for=\"4\">$L_SQL_TABLE_PRE:</label><br>");
  echo("<input type=\"text\" id=\"4\" name=\"4\" value=\"".$pre."\"><br>");
  echo("<br /><br />");
  echo("<input type=submit id=\"db\" name=\"db\" value=\"".$L_SQL_GO."\">");
  echo("</form>");
}

echo("</div>");
echo("</body></html>");

?>
