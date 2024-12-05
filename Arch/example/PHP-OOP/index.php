
<html>
<head>
<title>PHP OOP test</title>

<?php

include("class_lib.php");

?>


</head>
<body>


<?php

  $lajos=new person();
  $misi=new person();
  $mocsi=new person("Kicsi Mocsi");

  $lajos->set_name("Igaz Lajos");
  $misi->set_name("Nemigaz Mihály");

  echo("Teljes név (lajos): ".$lajos->get_name());
  echo("<br />");
  echo("Teljes név (misi): ".$misi->get_name());
  echo("<br />");
  echo("Teljes név (mocsi): ".$mocsi->get_name());

  echo("<br />");
  echo("<br />");

  echo("Public változó elérése: ".$misi->name);   // elerheto, ha public vagy var
  // echo("Protected változó elérése: ".$misi->pro); // php error
  // echo("Private változó elérése: ".$misi->pri);   // php error

  // echo("Teljes név (lajos): ".$lajos->get_priv_name()); // php error
  // echo("Teljes név (lajos): ".$lajos->get_prot_name()); // php error
  echo("<br />");
  echo("<br />");
  echo("Teljes név (lajos): ".$lajos->get_pub_name());

  echo("<br />");
  echo("<br />");
  echo("<br />");
  echo("<br />");
  echo("Öröklõdés");
  echo("<br />");
  echo("<br />");

  $ujpest=new manyperson("Úlpest Imre");
  echo("Teljes név (ujpest): ".$ujpest->get_pub_name());
  echo("<br />");
  $ujpest->set_name("NagyonUjpest Imre");
  echo("Teljes név (ujpest): ".$ujpest->get_protpub_name());
  echo("<br />");


?>


</body>
</html>