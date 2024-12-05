
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
  $misi->set_name("Nemigaz Mih�ly");

  echo("Teljes n�v (lajos): ".$lajos->get_name());
  echo("<br />");
  echo("Teljes n�v (misi): ".$misi->get_name());
  echo("<br />");
  echo("Teljes n�v (mocsi): ".$mocsi->get_name());

  echo("<br />");
  echo("<br />");

  echo("Public v�ltoz� el�r�se: ".$misi->name);   // elerheto, ha public vagy var
  // echo("Protected v�ltoz� el�r�se: ".$misi->pro); // php error
  // echo("Private v�ltoz� el�r�se: ".$misi->pri);   // php error

  // echo("Teljes n�v (lajos): ".$lajos->get_priv_name()); // php error
  // echo("Teljes n�v (lajos): ".$lajos->get_prot_name()); // php error
  echo("<br />");
  echo("<br />");
  echo("Teljes n�v (lajos): ".$lajos->get_pub_name());

  echo("<br />");
  echo("<br />");
  echo("<br />");
  echo("<br />");
  echo("�r�kl�d�s");
  echo("<br />");
  echo("<br />");

  $ujpest=new manyperson("�lpest Imre");
  echo("Teljes n�v (ujpest): ".$ujpest->get_pub_name());
  echo("<br />");
  $ujpest->set_name("NagyonUjpest Imre");
  echo("Teljes n�v (ujpest): ".$ujpest->get_protpub_name());
  echo("<br />");


?>


</body>
</html>