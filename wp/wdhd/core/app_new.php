<?php

// app

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// új hibajegy felvétele
function wdhd_new($l="",$urole=999){
  global $wpdb,$wdhd_table;

  $cuser=wp_get_current_user();
  //$username=$cuser->user_login;
  //$c=$cuser->user_nicename." . ".$cuser->user_email;
  $c="";
  if (isset($_POST['fgo'])){
    $table_name=$wpdb->prefix.$wdhd_table[2];
    $t0=$_POST['fd'];
    $t1=$_POST['fn'];
    $t2=$_POST['fe'];
    $t3=$_POST['ft'];
    $t4=$_POST['f0'];
    $sql="INSERT INTO $table_name (t_time,t_inname,t_inmail,t_intel,t_text) VALUES ('$t0','$t1','$t2','$t3','$t4');";
    $x=$wpdb->query($sql);
    if ($x){
      $l=wdhd_lang("Mentés sikerült");
      $c=wdhd_action_message($l.".");
    }else{
      $l=wdhd_lang("Mentés nem sikerült");
      $c=wdhd_action_errormessage($l.".");
    }
  }else{
    $c="";
  }
  $d=date('Y.m.d. H:m');
  $c=$c."
      <form action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">
      <table class=wtable>
        <tr>
          <td class=inputlabel>".wdhd_lang("Idő")."</td>
          <td><input id=fd name=fd class=\"inputtext readonly\"  type=text value=\"".$d."\"></td>
        </tr>
        <tr>
          <td class=inputlabel>".wdhd_lang("Név")."</td>
          <td><input id=fn name=fn class=\"inputtext readonly\"  type=text value=\"".$cuser->user_nicename."\"></td>
        </tr>
        <tr>
          <td class=inputlabel>".wdhd_lang("E-mail")."</td>
          <td><input id=fe name=fe class=\"inputtext readonly\" type=text value=\"".$cuser->user_email."\"></td>
        </tr>
        <tr>
          <td class=inputlabel>".wdhd_lang("Telefonszám")."</td>
          <td><input id=ft name=ft class=inputtext type=text value=\"\" placeholder=\"".wdhd_lang("Telefonszám")."\"></td>
        </tr>
        <tr>
          <td class=inputlabel>".wdhd_lang("Részletes leírás")."</td>
          <td><textarea id=f0 name=f0 class=inputtexta rows=10 placeholder=\"".wdhd_lang("Részletes leírás")."\"></textarea></td>
        </tr>
      </table>
      <span class=spaceholder></span>
  	  <input id=fgo name=fgo type=submit class=\"submitbutton\" value=".wdhd_lang("Mehet").">
      <span class=spaceholder></span>
      </form>
  ";
  return($c);
}

?>
