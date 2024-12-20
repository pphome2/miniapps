<?php

// app

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


function wdhd_service($l="",$urole=999){
  global $wdhd_user_role_list,$wpdb,$wdhd_table,$wdhd_pagerow,$wdhd_user_name,
         $wdhd_print_page,$wdhd_developer_mode;


  $table_name=$wpdb->prefix.$wdhd_table[2];
  $li=wdhd_lang("Bejelentkezve");
  $wun=wdhd_user_nicename();
  $c="$li: <b>$wun</b>.<br />";
  if (!in_array($urole,[0])){
    $l=wdhd_lang('Nem megfelelő jogosultság');
    $c=$c.wdhd_action_errormessage($l);
  }else{
    if (isset($_POST['fgo'])){
      $id=$_POST['id'];
      $sql="SELECT * FROM $table_name WHERE id='$id';";
      $res=$wpdb->get_results($sql);
      $c=wdhd_service_form($res[0],$c,$wun);
    }else{
      if (isset($_POST['close'])){
        $w_id=$_POST['id'];
        $sql="UPDATE $table_name SET t_time=\"".$_POST['t_time']."\",";
        $sql=$sql."t_intype=\"".$_POST['t_intype']."\",";
        $sql=$sql."t_inname=\"".$_POST['t_inname']."\",";
        $sql=$sql."t_indep=\"".$_POST['t_indep']."\",";
        $sql=$sql."t_intel=\"".$_POST['t_intel']."\",";
        $sql=$sql."t_inmail=\"".$_POST['t_inmail']."\",";
        $sql=$sql."t_text=\"".$_POST['t_text']."\",";
        $sql=$sql."t_plantime=\"".$_POST['t_plantime']."\",";
        $sql=$sql."t_dep=\"".$_POST['t_dep']."\",";
        $sql=$sql."t_worker=\"".$_POST['t_worker']."\",";
        $sql=$sql."t_action=\"".$_POST['t_action']."\",";
        $sql=$sql."t_parts=\"".$_POST['t_parts']."\",";
        $sql=$sql."t_hour=\"".$_POST['t_hour']."\",";
        $sql=$sql."t_km=\"".$_POST['t_km']."\",";
        $sql=$sql."t_endtime=\"".$_POST['t_endtime']."\",";
        $sql=$sql."t_enduname=\"".$_POST['t_enduname']."\" ";
        $sql=$sql."WHERE id=".$w_id.";";
        $r=$wpdb->query($sql);
        if ($r){
          $l=wdhd_lang('Módosítva').".";
          $c=$c.wdhd_action_message($l);
        }else{
          $l=wdhd_lang('Hiba történt').".";
          $c=$c.wdhd_action_errormessage($l);
        }
      }
      $li=wdhd_lang("Kiadott bejelentések");
      $c=$c."<br />$li: <b>$wun</b> ($wdhd_user_role_list[$urole])<br /><br />";
      $sql="SELECT COUNT(*) FROM $table_name WHERE t_worker='$wun';";
      $db=$wpdb->get_var($sql);
      if (isset($_POST['wpage'])){
        $page=$_POST['wpage'];
        if ($page<1){
          $page=1;
        }
        if ($db<($page*$wdhd_pagerow)){
          if ($db<(($page-1)*$wdhd_pagerow)){
            $page=1;
          }
        }
      }else{
        $page=1;
      }
      $i=($page-1)*$wdhd_pagerow;
      $c=$c."
      <br />
      <br />
      <table class=\"wdhdtable\">
        <thead>
	      <tr>
	        <th scope=\"col\" id=\"t1\" class=\"wdhdcell\" style=\"width:30%;\">".wdhd_lang('Idő')."</th>
  	        <th scope=\"col\" id=\"t3\" class=\"wdhdcell\" style=\"width:35%;\">".wdhd_lang('Állapot')."</th>
	        <th scope=\"col\" id=\"t4\" class=\"wdhdcell\" style=\"width:25%;\">".wdhd_lang('Folyamat')."</th>
	        <th scope=\"col\" id=\"t4\" class=\"wdhdcell\">".wdhd_lang('Lezár')."</th>
	      </tr>
        </thead>
        <tbody id=\"the-list\">
        ";
      $sql="SELECT * FROM $table_name WHERE t_worker='$wun' ORDER BY id DESC LIMIT $i,$wdhd_pagerow;";
      $res=$wpdb->get_results($sql);
      if (count($res)<>0){
        $ij=1;
        foreach($res as $t) {
	      $c=$c."<tr id=\"post-$i\">";
	      $c=$c."<td class=\"wdhdcell\">";
	      $c=$c."<input type=\"submit\" onclick=\"
	            if (getElementById('plusdata$ij').style.display=='block'){
	              getElementById('plusdata$ij').style.display='none';
	              this.value='+';
	            }else{
	            getElementById('plusdata$ij').style.display='block';  
	            this.value='-';
	            };return false;\" value=\"+\">";
          $c=$c."<span class=wdhdplus>$t->t_time</span>";
	      $c=$c."<span id=\"plusdata$ij\" class=\"wdhdsecbox\" onclick=\"this.style.display='none';\">";
          $c=$c."<b>".wdhd_lang("Típus").":</b> $t->t_intype<br />";
	      $c=$c."<b>".wdhd_lang("Ügyfél").":</b> $t->t_inname<br />";
          $u=get_user_by('login',$t->t_inname);
          if($u){
            //$tx=str_replace("\n\n","",$u->description)."";
            //$c=$c.str_replace("\n","<br />",$tx)."<br />";
            $c=$c.str_replace("\n","<br />",$u->description)."<br />";
            $c=$c.$u->user_email."<br />";
          }
	      $c=$c."<b>".wdhd_lang("Csoport").":</b> $t->t_indep<br />";
  	      $c=$c."<b>".wdhd_lang("Telefonszám").":</b> $t->t_intel<br />";
	      $c=$c."<b>".wdhd_lang("E-mail").":</b> $t->t_inmail<br />";
  	      $c=$c."<b>".wdhd_lang("Leírás").":</b> $t->t_text<br />";
	      $c=$c."<b>".wdhd_lang("Tervezett befejezés").":</b> $t->t_plantime<br />";
	      $c=$c."<b>".wdhd_lang("Feladat").":</b> $t->t_dep<br />";
	      $c=$c."<b>".wdhd_lang("Munka kiadva").":</b> $t->t_worker<br />";
	      $c=$c."<b>".wdhd_lang("Elvégzett munka").":</b> $t->t_action<br />";
	      $c=$c."<b>".wdhd_lang("Felhasznált eszközök").":</b> $t->t_parts<br />";
	      $c=$c."<b>".wdhd_lang("Mukaóra").":</b> $t->t_hour<br />";
	      $c=$c."<b>".wdhd_lang("Kiszállás (km)").":</b> $t->t_km<br />";
	      $c=$c."<b>".wdhd_lang("Bejelentés lezárva").":</b> $t->t_endtime<br />";
	      $c=$c."<b>".wdhd_lang("Bejelentést lezárta").":</b> $t->t_enduname<br />";
	      if (($t->t_endtime<>"")or($wdhd_developer_mode)){
	        $fn=plugin_dir_url( __FILE__ ).$wdhd_print_page;
            $u=get_user_by('login',$t->t_inname);
            if($u){
              $ur=$u->description;
            }else{
              $ur=wdhd_lang("Nincs megadva").".";
            }
            $c=$c."<br /><form id=$ij action=\"".$fn."\" target=\"_blank\" method=\"post\">";
            $data[0]=wdhd_get_param("cím");
            $data[1]=$ur;
            $i=2;
            foreach($t as $tt){
              $data[$i]=$tt;
              $i++;
            }
            $r=wdhd_workpage($data);
            $c=$c."<input id=\"0\" name=\"0\" type=hidden value=\"$r\">";
            $c=$c."<input type=submit id=\"1\" class=\"wdhdtablebutton\" value=\"".wdhd_lang("Munkalap")."\">";
            $c=$c."</form>";
          }
	      $c=$c."</span>";
	      $c=$c."</td>";
	      if ($t->t_endtime<>""){
	        $state=wdhd_lang("Lezárva");
	        $state2=$state;
	        $state=$state.": $t->t_endtime";
	      }else{
	        $state2=wdhd_lang("Nyitott").".";
	        if ($t->t_plantime<>""){
	          $state=wdhd_lang("Tervezve").": ".$t->t_plabtime;
	        }else{
	          $state=wdhd_lang("Nincs még tervezve").".";
	        }
	      }
	      $c=$c."<td class=\"wdhdcell\">$state</td>";
	      $c=$c."<td class=\"wdhdcell\">$state2</td>";
	      $c=$c."<td class=\"wdhdcell\">";
	      if ($t->t_endtime==""){
            $c=$c."<form action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
            $c=$c."<input id=id name=id type=hidden value=\"$t->id\">";
            $c=$c."<input id=wpage name=wpage type=hidden value=\"$page\">";
            $c=$c."<input id=fgo name=fgo type=submit class=\"wdhdtablebutton\" value=\"+\">";
            #$c=$c."<input id=fgo name=fgo type=submit class=\"wdhdtablebutton\" value=".wdhd_lang("Lezár").">";
            $c=$c."</form>";
	      }else{
	      }
	      $c=$c."</td>";
	      $c=$c."</tr>";
          $ij++;
        }
      }
      $c=$c."</tbody>";
      //$c=$c."<tfoot>";
      //$c=$c."</tfoot>";
      $c=$c."</table>";
      $c=$c.wdhd_pager($db,$wdhd_pagerow,$page,"wpage",true);
      $c=$c."<br />";
      $c=$c."<br />";
    }
  }
  return($c);
}


// adat form
function wdhd_service_form($r,$c,$wun){
  global $wdhd_ticket_type,$wdhd_user_name;

  $page=$_POST['wpage'];
  $date=date('Y.m.d. H:m');
  if ($r->t_plantime==""){
    $pt=$date;
  }else{
    $pt=$r->t_plantime;
  }
  $c=$c."</br>
      <form action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">
      <table class=wtable>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Idő")."</td>
          <td class=wtd><input id=t_time name=t_time class=\"wdhdinputtext\" readonly type=text value=\"$r->t_time\"></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Típus")."</td>
          <td class=wtd><input id=t_intype name=t_intype class=\"wdhdinputtext\" readonly type=text value=\"$r->t_intype\"></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Név")."</td>
          <td class=wtd><input id=t_inname name=t_inname class=\"wdhdinputtext\" readonly type=text value=\"$r->t_inname\"></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Csoport")."</td>
          <td class=wtd><input id=t_indep name=t_indep class=\"wdhdinputtext\" readonly type=text value=\"$r->t_indep\"></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("E-mail")."</td>
          <td class=wtd><input id=t_inmail name=t_inmail class=\"wdhdinputtext\" readonly type=text value=\"$r->t_inmail\"></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Telefonszám")."</td>
          <td class=wtd><input id=t_intel name=t_intel class=wdhdinputtext readonly type=text value=\"$r->t_intel\"></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Részletes leírás")."</td>
          <td class=wtd><textarea id=t_text name=t_text class=wdhdinputtexta readonly rows=10 >$r->t_text</textarea></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Tervezett befejezés")."</td>
          <td class=wtd><input type=\"text\" id=\"t_plantime\" name=\"t_plantime\" class=\"wdhdinputtext\" value=\"$pt\"></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Kijelölt feladat")."</td>
          <td class=wtd><input type=\"text\" id=\"t_dep\" name=\"t_dep\" class=\"wdhdinputtext\" readonly value=\"$r->t_dep\"></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Munka kiadva")."</td>
          <td class=wtd><input type=\"text\" id=\"t_worker\" name=\"t_worker\" class=\"wdhdinputtext\" readonly value=\"$r->t_worker\"></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Elvégzett munka")."</td>
          <td class=wtd><textarea id=t_action name=t_action class=wdhdinputtexta rows=10 placeholder=\"".wdhd_lang("Elvégzett munka")."\">$r->t_action</textarea></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Felhasznált eszközök")."</td>
          <td class=wtd><textarea id=t_parts name=t_parts class=wdhdinputtexta rows=10 placeholder=\"".wdhd_lang("Felhasznált eszközök")."\">$r->t_parts</textarea></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Ráfordított munkaóra")."</td>
          <td class=wtd><input type=\"hour\" id=\"t_hour\" name=\"t_hour\" class=\"wdhdinputtext\" value=\"$r->t_hour\"></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Kiszállás (km)")."</td>
          <td class=wtd><input type=\"text\" id=\"t_km\" name=\"t_km\" class=\"wdhdinputtext\" value=\"$r->t_km\"></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Bejelentés lezárva")."</td>
          <td class=wtd><input type=\"text\" id=\"t_endtime\" name=\"t_endtime\" class=\"wdhdinputtext\" readonly value=\"\"></td>
        </tr>
        <tr class=wtr>
          <td class=inputlabel>".wdhd_lang("Bejelentést lezárta")."</td>
          <td class=wtd><input type=\"text\" id=\"t_enduname\" name=\"t_enduname\" class=\"wdhdinputtext\" readonly value=\"\"></td>
        </tr>
        </table>
        <br /><br />
        <input type=\"hidden\" id=\"id\" name=\"id\" value=\"$r->id\">
        <input type=\"hidden\" id=\"wpage\" name=\"wpage\" value=\"$page\">
        <table style=\"width:100%\">
        <tr>
        <td style=\"width:33%;padding:10px;\">
        <input type=\"submit\" class=\"wdhdsubmitbutton\" id=\"tclose\" name=\"tclose\" value=\"".wdhd_lang("Lezár")."\"
          onclick=\"
          getElementById('t_plantime').readOnly=true;
          getElementById('t_endtime').value='".date('Y.m.d. H:m')."';
          getElementById('t_enduname').value='".$wun."';
          return false;\"
        >
        </td>
        <td style=\"width:33%;padding:10px;\">
        <input type=\"submit\" class=\"wdhdsubmitbutton\" id=\"close\" name=\"close\" value=\"".wdhd_lang("Mentés")."\">
        </td>
        <td style=\"padding:10px\">
        <input type=\"submit\" class=\"wdhdsubmitbutton\" id=\"end\" name=\"end\" value=\"".wdhd_lang("Mégse")."\">
        </td></tr>
        </table>
        </form>
        <br /><br />";
  return($c);
}


// munkalap
function wdhd_workpage($data){
  $r="";

  $r=$r."<center>";
  $r=$r."<h1>Munkalap</h1>";

  $r=$r."<span class=wdhdspaceholder></span>";
  $r=$r."<table style=\"width:60%;border: 2px solid;align:\">";
  $r=$r."<tr>";
  $r=$r."<td style=\"padding:1em;width:50%;border: 2px solid;vertical-align:top;\">";
  $t=explode(PHP_EOL,$data[0]);
  foreach($t as $tt){
    $r=$r."$tt <br />";
  }
  $r=$r."</td>";
  $r=$r."<td style=\"padding:1em;width:50%;border: 2px solid;vertical-align:top;\">";
  $t=explode(PHP_EOL,$data[1]);
  foreach($t as $tt){
    $r=$r."$tt <br />";
  }
  $r=$r."</td>";
  $r=$r."</tr>";

  $r=$r."<tr>";
  $r=$r."<td style=\"padding:1em;width:50%;border: 2px solid;valign:top;vertical-align:top;\">";
  $r=$r."<b>Bejelentés</b><br /><br />";
  $r=$r."Bejelentés ideje: ".$data[3]."<br />";
  $r=$r."Bejelentő: ".$data[5]."<br />";
  $r=$r."Telefonszám: ".$data[7]."<br />";
  $r=$r."E-mail: ".$data[8]."<br />";
  $r=$r."Részletes leírás: <br />".$data[9]."<br />";
  $r=$r."</td>";
  $r=$r."<td style=\"padding:1em;width:50%;border: 2px solid;vertical-align:top;vertical-align:top;\">";
  $r=$r."<b>Elvégzett munka</b><br /><br />";
  $r=$r."Kijelölt feladat: ".$data[11]."<br />";
  $r=$r."Elvégzett feladat: <br />".$data[13]."<br />";
  $r=$r."Felhasznált alkatrészek: ".$data[14]."<br />";
  $r=$r."Munkaidő (óra): ".$data[15]."<br />";
  $r=$r."Kiszállás (km): ".$data[16]."<br />";
  $r=$r."</td>";
  $r=$r."</tr>";

  #$r=$r."<tr>";
  #$r=$r."<td style=\"padding:1em;width:50%;border: 1px solid;\">";
  #foreach($_POST as $k=>$v){
  #  $r=$r."$k = $v <br />";
  #}
  #$r=$r."</td>";
  #$r=$r."</tr>";

  $r=$r."<tr>";
  $r=$r."<td style=\"padding:1em;width:50%;border: 2px solid;\">";
  $r=$r."Munkalap készült: ".date('Y.m.d. H:m');
  $r=$r."</td>";
  $r=$r."<td style=\"padding:1em;width:50%;border: 2px solid;\">";
  $r=$r."Munkavégzés befejezése: ".$data[17]." (".$data[18].")";
  $r=$r."</td>";
  $r=$r."</tr>";
  $r=$r."<tr>";
  $r=$r."<td style=\"padding:1em;width:50%;border: 2px solid;text-align:center;\">";
  $r=$r."<br /><br /><br />";
  $r=$r."____________________________________________<br />";
  $r=$r."Megrendelő aláírása";
  $r=$r."</td>";
  $r=$r."<td style=\"padding:1em;width:50%;border: 2px solid;text-align:center;\">";
  $r=$r."<br /><br /><br />";
  $r=$r."____________________________________________<br />";
  $r=$r."Munkát végzők aláírása";
  $r=$r."</td>";
  $r=$r."</tr>";
  $r=$r."</table>";
  $r=$r."<span class=wdhdspaceholder></span>";

  $r=$r."</center>";

  $r=htmlentities($r);
  return($r);
}

?>
