<?php

// app

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


function wdhd_ticket($l="",$urole=999){
  global $wpdb,$wdhd_table,$wdhd_pagerow,$wdhd_user_name;

  $l=wdhd_lang("Bejelentkezve");
  $wun=wdhd_user_nicename();
  $c="$l: <b>$wun</b>.<br /><br />";
  $l=wdhd_lang("felhasználó bejelentései");
  $c=$c."<b>$wun</b> $l.<br />";
  $table_name=$wpdb->prefix.$wdhd_table[2];
  $sql="SELECT COUNT(*) FROM $table_name WHERE t_inname='$wun';";
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
	    <th scope=\"col\" id=\"t1\" class=\"wdhdcell\" style=\"width:33%;\">".wdhd_lang('Idő')."</th>
	    <th scope=\"col\" id=\"t3\" class=\"wdhdcell\" style=\"width:33%;\">".wdhd_lang('Állapot')."</th>
	    <th scope=\"col\" id=\"t4\" class=\"wdhdcell\">".wdhd_lang('Folyamat')."</th>
	  </tr>
    </thead>
    <tbody id=\"the-list\">
    ";
  $sql="SELECT * FROM $table_name WHERE t_inname='$wun' ORDER BY id DESC LIMIT $i,$wdhd_pagerow;";
  $res=$wpdb->get_results($sql);
  if (count($res)<>0){
    $ij=1;
    foreach($res as $t) {
	  $c=$c."<tr id=\"post-$i\">";
	  $c=$c."<td class=\"wdhdcell\">";
	  $c=$c."<input type=\"submit\" onclick=\"
	        if (getElementById('plusdata$i').style.display=='block'){
	          getElementById('plusdata$i').style.display='none';
	          this.value='+';
	        }else{
	        getElementById('plusdata$i').style.display='block';  
	        this.value='-';
	        };return false;\" value=\"+\">";
      $c=$c."<span class=plus>$t->t_time</span>";
	  $c=$c."<span id=\"plusdata$i\" class=\"secbox\" onclick=\"this.style.display='none';\">";
      $c=$c."<b>".wdhd_lang("Típus").":</b> $t->t_intype<br />";
	  $c=$c."<b>".wdhd_lang("Csoport").":</b> $t->t_indep<br />";
	  $c=$c."<b>".wdhd_lang("Telefonszám").":</b> $t->t_intel<br />";
	  $c=$c."<b>".wdhd_lang("E-mail").":</b> $t->t_inmail<br />";
	  $c=$c."<b>".wdhd_lang("Leírás").":</b> $t->t_text<br />";
	  $c=$c."<b>".wdhd_lang("Tervezett befejezés").":</b> $t->t_plantime<br />";
	  $c=$c."</span>";
	  $c=$c."</td>";
	  if ($t->t_endtime<>""){
	    $state=wdhd_lang("Lezárva");
	    $state2=$state;
	    $state=$state.": ".$t->t_endtime;
	  }else{
	    $state=wdhd_lang("Nyitott");
	    if ($t->t_plantime<>""){
	      $state2=wdhd_lang("Tervezve")." - $t->t_plantime";
	    }else{
	      if ($t->t_worker<>""){
	        $state2=wdhd_lang("Folyamatban");
	      }else{
	        $state2=wdhd_lang("Beérkezett");
	      }
	    }
      }
	  $c=$c."<td class=\"wdhdcell\">$state</td>";
	  $c=$c."<td class=\"wdhdcell\">$state2</td>";
	  $c=$c."</tr>";
      $ij++;
    }
  }
  $c=$c."</tbody>";
  //$c=$c."<tfoot>";
  //$c=$c."<tr>";
  //$c=$c."<th scope=\"col\" id=\"t1\" class=\"manage-column\">".wdhd_lang('Idő')."</th>";
  //$c=$c."<th scope=\"col\" id=\"t3\" class=\"manage-column\">".wdhd_lang('Állapot')."</th>";
  //$c=$c."<th scope=\"col\" id=\"t4\" class=\"manage-column\">".wdhd_lang('Javít / Töröl')."</th>";
  //$c=$c."</tr>";
  //$c=$c."</tfoot>";
  $c=$c."</table>";
  $c=$c.wdhd_pager($db,$wdhd_pagerow,$page,"wpage",true);
  $c=$c."<br />";
  $c=$c."<br />";

  return($c);
}


?>
