<?php

// hibajegyek beállítása


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// jogosultság ellenőrzése
$ur=wdhd_user_right();
if (!in_array($ur,[0])){
  $l=wdhd_lang('Nem megfelelő jogosultság');
  wdhd_error($l);
  exit;
}

// admin script betöltés 
if (file_exists(__DIR__.'/wdhd_admin.css')){
  include(__DIR__.'/wdhd_admin.css');
}
if (file_exists(__DIR__.'/wdhd_admin.js')){
  include(__DIR__.'/wdhd_admin.js');
}


echo("<br /><br />");

// adatfeldolgozás
$table_name=$wpdb->prefix.$wdhd_table[2];
$table=true;

// törlés
if (isset($_POST['del'])){
  $w_id=$_POST['id'];
  $sql="DELETE FROM $table_name WHERE id=$w_id;";
  $r=$wpdb->query($sql);
  if ($r){
    $l=wdhd_lang('Törölve');
    wdhd_message($l);
  }else{
    $l=wdhd_lang('Hiba történt');
    wdhd_error($l);
  }
}

// módosítás
if (isset($_POST['mod'])){
  $w_id=$_POST['id'];
  $sql="SELECT * FROM $table_name WHERE id=$w_id;";
  $res=$wpdb->get_results($sql);
  if ($res){
    $r=$res[0];
    wdhd_tform($r);
  }else{
    $l=wdhd_lang('Hiba történt');
    wdhd_error($l);
  }
  $table=false;
}

// új felvitel
if (isset($_POST['new'])){
  wdhd_tformnew();
  $table=false;
}

// form-ból adat
if (isset($_POST['submit'])){
  // mehet gomb után
  if ((isset($_POST['id']))and($_POST['id']<>"")){
    // javítás
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
      $l=wdhd_lang('Módosítva');
      wdhd_message($l);
    }else{
      $l=wdhd_lang('Hiba történt');
      wdhd_error($l);
    }
  }else{
    // új adat
    $w_id="";
    $sql="INSERT INTO $table_name (t_time,t_intype,t_inname,t_indep,t_intel,t_inmail,t_text,t_plantime,";
    $sql=$sql."t_dep,t_worker,t_action,t_parts,t_hour,t_km,t_endtime,t_enduname) VALUES (";
    $sql=$sql."\"".$_POST['t_time']."\",";
    $sql=$sql."\"".$_POST['t_intype']."\",";
    $sql=$sql."\"".$_POST['t_inname']."\",";
    $sql=$sql."\"".$_POST['t_indep']."\",";
    $sql=$sql."\"".$_POST['t_intel']."\",";
    $sql=$sql."\"".$_POST['t_inmail']."\",";
    $sql=$sql."\"".$_POST['t_text']."\",";
    $sql=$sql."\"".$_POST['t_plantime']."\",";
    $sql=$sql."\"".$_POST['t_dep']."\",";
    $sql=$sql."\"".$_POST['t_worker']."\",";
    $sql=$sql."\"".$_POST['t_action']."\",";
    $sql=$sql."\"".$_POST['t_parts']."\",";
    $sql=$sql."\"".$_POST['t_hour']."\",";
    $sql=$sql."\"".$_POST['t_km']."\",";
    $sql=$sql."\"".$_POST['t_endtime']."\",";
    $sql=$sql."\"".$_POST['t_enduname']."\" ";
    $sql=$sql.");";
    $r=$wpdb->query($sql);
    if ($r){
      $l=wdhd_lang('Tárolva');
      wdhd_message($l);
    }else{
      $l=wdhd_lang('Hiba történt');
      wdhd_error($l);
    }
  }
}

if ($table){
  wdhd_ttable();
}

// adat form
function wdhd_tform($r){
  global $wdhd_ticket_type,$wdhd_user_name;

  wdhd_tpagehead();
  $page=$_POST['wpage'];
  $wun=wdhd_user_nicename();
  ?>
  <form action="<?php menu_page_url(__FILE__) ?>" method="post">
    <label for="name"><?php echo(wdhd_lang('Érkezési idő')); ?>:</label><br>
    <input type="text" id="t_time" name="t_time" class="inputline" value="<?php echo($r->t_time); ?>" readonly><br><br>
    <label for="name"><?php echo(wdhd_lang('Típus')); ?>:</label><br>
    <input type="text" id="t_intype" name="t_intype" class="inputline" value="<?php echo($r->t_intype); ?>"><br><br>
    <label for="name"><?php echo(wdhd_lang('Bejelentő')); ?>:</label><br>
    <input type="text" id="t_inname" name="t_inname" class="inputline" value="<?php echo($r->t_inname); ?>"><br><br>
    <label for="name"><?php echo(wdhd_lang('Csoport')); ?>:</label><br>
    <input type="text" id="t_indep" name="t_indep" class="inputline" value="<?php echo($r->t_indep); ?>"><br><br>
    <label for="name"><?php echo(wdhd_lang('Telefonszám')); ?>:</label><br>
    <input type="text" id="t_intel" name="t_intel" class="inputline" value="<?php echo($r->t_intel); ?>"><br><br>
    <label for="name"><?php echo(wdhd_lang('E-mail cím')); ?>:</label><br>
    <input type="text" id="t_inmail" name="t_inmail" class="inputline" value="<?php echo($r->t_inmail); ?>"><br><br>
    <span class=spaceholder></span>
    <label for="name"><?php echo(wdhd_lang('Leírás')); ?>:</label><br>
    <textarea id="t_text" name="t_text" class="inputline"><?php echo($r->t_text); ?></textarea><br><br>
    <span class=spaceholder></span>
    <label for="name"><?php echo(wdhd_lang('Tervezett befejezés')); ?>:</label><br>
    <input type="text" id="t_plantime" name="t_plantime" class="inputline" value="<?php echo($r->t_plantime); ?>"><br><br>
    <label for="name"><?php echo(wdhd_lang('Kijelölt feladat')); ?>:</label><br>
    <select id="t_dep" name="t_dep" class="inputline">
    <?php
      foreach($wdhd_ticket_type as $t){
        $s="";
        if ($r->t_dep===$t){
          $s="selected";
        }
        echo("<option value=\"$t\" $s>$t</option>");
      }
    ?>
    </select>
    <br><br>
    <label for="name"><?php echo(wdhd_lang('Munka kiadva')); ?>:</label><br>
    <input type="text" id="t_worker" name="t_worker" class="inputline" value="<?php echo($r->t_worker); ?>"><br><br>
    <span class=spaceholder></span>
    <label for="name"><?php echo(wdhd_lang('Elvégzett munka')); ?>:</label><br>
    <textarea id="t_action" name="t_action" class="inputline"><?php echo($r->t_action); ?></textarea><br><br>
    <span class=spaceholder></span>
    <label for="name"><?php echo(wdhd_lang('Felhasznált eszközök')); ?>:</label><br>
    <textarea id="t_parts" name="t_parts" class="inputline"><?php echo($r->t_parts); ?></textarea><br><br>
    <label for="name"><?php echo(wdhd_lang('Ráfordított munkaóra')); ?>:</label><br>
    <input type="text" id="t_hour" name="t_hour" class="inputline" value="<?php echo($r->t_hour); ?>"><br><br>
    <label for="name"><?php echo(wdhd_lang('Kiszállás (km)')); ?>:</label><br>
    <input type="text" id="t_km" name="t_km" class="inputline" value="<?php echo($r->t_km); ?>"><br><br>
    <label for="name"><?php echo(wdhd_lang('Bejelentés lezárva')); ?>:</label><br>
    <input type="text" id="t_endtime" name="t_endtime" class="inputline" value="<?php echo($r->t_endtime); ?>" readonly><br><br>
    <label for="name"><?php echo(wdhd_lang('Bejelentést lezárta')); ?>:</label><br>
    <input type="text" id="t_enduname" name="t_enduname" class="inputline" value="<?php echo($r->t_enduname); ?>" readonly><br><br>
    
    <input type="hidden" id="id" name="id" value="<?php echo($r->id); ?>">
    <input type="hidden" id="wpage" name="wpage" value="<?php echo($page); ?>">
    <br /><br />
    <input type="submit" class="button" id="s" name="s" value="<?php echo(wdhd_lang('Lezár')); ?>"
        onclick="
          getElementById('t_endtime').value='<?php echo(date('Y.m.d. H:m')); ?>';
          getElementById('t_enduname').value='<?php echo($wun); ?>';
          return false;">
    <br /><br />
    <input type="submit" class="button" id="submit" name="submit" value="<?php echo(wdhd_lang('Mehet')); ?>">
    <input type="submit" class="button" id="x" name="x" value="<?php echo(wdhd_lang('Mégse')); ?>">
  </form>
  <br /><br />
  <?php
}


// adat form
function wdhd_tformnew(){
  global $wdhd_ticket_type;

  wdhd_tpagehead();
  $page=$_POST['wpage'];
  ?>
  <form action="<?php menu_page_url(__FILE__) ?>" method="post">
    <label for="name"><?php echo(wdhd_lang('Érkezési idő')); ?>:</label><br>
    <input type="text" id="t_time" name="t_time" class="inputline" value="<?php date('Y.m.d. H:m'); ?>" readonly><br><br>
    <label for="name"><?php echo(wdhd_lang('Típus')); ?>:</label><br>
    <input type="text" id="t_intype" name="t_intype" class="inputline" value=""><br><br>
    <label for="name"><?php echo(wdhd_lang('Bejelentő')); ?>:</label><br>
    <input type="text" id="t_inname" name="t_inname" class="inputline" value=""><br><br>
    <label for="name"><?php echo(wdhd_lang('Csoport')); ?>:</label><br>
    <input type="text" id="t_indep" name="t_indep" class="inputline" value=""><br><br>
    <label for="name"><?php echo(wdhd_lang('Telefonszám')); ?>:</label><br>
    <input type="text" id="t_intel" name="t_intel" class="inputline" value=""><br><br>
    <label for="name"><?php echo(wdhd_lang('E-mail cím')); ?>:</label><br>
    <input type="text" id="t_inmail" name="t_inmail" class="inputline" value=""><br><br>
    <span class=spaceholder></span>
    <label for="name"><?php echo(wdhd_lang('Leírás')); ?>:</label><br>
    <textarea id="t_text" name="t_text" class="inputline"></textarea><br>
    <span class=spaceholder></span>
    <label for="name"><?php echo(wdhd_lang('Tervezett befejezés')); ?>:</label><br>
    <input type="text" id="t_plantime" name="t_plantime" class="inputline" value=""><br><br>
    <label for="name"><?php echo(wdhd_lang('Kijelölt feladat')); ?>:</label><br>
    <select id="t_dep" name="t_dep" class="inputline">
    <?php
      foreach($wdhd_ticket_type as $t){
        echo("<option value=\"$t\">$t</option>");
      }
    ?>
    </select>
    <br><br>
    <label for="name"><?php echo(wdhd_lang('Munka kiadva')); ?>:</label><br>
    <input type="text" id="t_worker" name="t_worker" class="inputline" value=""><br><br>
    <span class=spaceholder></span>
    <label for="name"><?php echo(wdhd_lang('Elvégzett munka')); ?>:</label><br>
    <textarea id="t_action" name="t_action" class="inputline"></textarea><br><br>
    <span class=spaceholder></span>
    <label for="name"><?php echo(wdhd_lang('Felhasznált eszközök')); ?>:</label><br>
    <input type="text" id="t_parts" name="t_parts" class="inputline" value=""><br><br>
    <label for="name"><?php echo(wdhd_lang('Ráfordított munkaóra')); ?>:</label><br>
    <input type="text" id="t_hour" name="t_hour" class="inputline" value=""><br><br>
    <label for="name"><?php echo(wdhd_lang('Kiszállás (km)')); ?>:</label><br>
    <input type="text" id="t_km" name="t_km" class="inputline" value=""><br><br>
    <label for="name"><?php echo(wdhd_lang('Bejelentés lezárva')); ?>:</label><br>
    <input type="text" id="t_endtime" name="t_endtime" class="inputline" value=""><br><br>
    <label for="name"><?php echo(wdhd_lang('Bejelentést lezárta')); ?>:</label><br>
    <input type="text" id="t_enduname" name="t_enduname" class="inputline" value=""><br><br>
    
    <input type="hidden" id="wpage" name="wpage" value="<?php echo($page); ?>">
    <br /><br />
    <input type="submit" class="button" id="submit" name="submit" value="<?php echo(wdhd_lang('Mehet')); ?>">
    <input type="submit" class="button" id="x" name="x" value="<?php echo(wdhd_lang('Mégse')); ?>">
  </form>
  <br /><br />
  <?php
}


// adat tábla
function wdhd_ttable(){
  global $wpdb,$wdhd_table,$wdhd_pagerow;

  wdhd_tpagehead();
  $table_name=$wpdb->prefix.$wdhd_table[2];
  $sql="SELECT COUNT(*) FROM $table_name";
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
  //echo($db." - ".$page." - ".$i." - ".$wdhd_pagerow);
  ?>
  <br />
  <form action="<?php menu_page_url(__FILE__) ?>" method="post">
    <input type="hidden" id="wpage" name="wpage" value="<?php echo($page); ?>">
    <input type="submit" class="button" id="new" name="new" value="<?php echo(wdhd_lang('Új')); ?>">
  </form>
  <br />
  <br />
  <div style="width:99%">
  <table class="wp-list-table widefat fixed striped table-view-list">
    <thead>
	  <tr>
	    <th scope="col" id="t1" class="manage-column" style="width:35%;"><?php echo(wdhd_lang('Idő')); ?></th>
	    <th scope="col" id="t2" class="manage-column" style="width:35%;"><?php echo(wdhd_lang('Bejelentő')); ?></th>
	    <th scope="col" id="t3" class="manage-column" style="width:20%;"><?php echo(wdhd_lang('Állapot')); ?></th>
	    <th scope="col" id="t4" class="manage-column"><?php echo(wdhd_lang('Javít / Töröl')); ?></th>
	  </tr>
    </thead>
    <tbody id="the-list">
  <?php
  $sql="SELECT * FROM $table_name ORDER BY id DESC LIMIT $i,$wdhd_pagerow;";
  $res=$wpdb->get_results($sql);
  if (count($res)<>0){
    $i=1;
    foreach($res as $t) {
	  echo("<tr id=\"post-$i\">");
	  echo("<td class=\"columnn-title\" data-colname=\"c$i\">");
	  echo("<span class=button onclick=\"
	        if (getElementById('plusdata$i').style.display=='block'){
	          getElementById('plusdata$i').style.display='none';
	          this.innerHTML='+';
	        }else{
	          getElementById('plusdata$i').style.display='block';
	          this.innerHTML='-';
	        }\">+</span>");
  	  echo("<span class=plus>$t->t_time</span>");
	  echo("<span id=\"plusdata$i\" style=\"display:none;\" onclick=\"this.style.display='none';\">");
	  echo("<b>".wdhd_lang("Típus").":</b> $t->t_intype<br />");
	  echo("<b>".wdhd_lang("Bejelentő").":</b> $t->t_inname<br />");
	  echo("<b>".wdhd_lang("Csoport").":</b> $t->t_indep<br />");
	  echo("<b>".wdhd_lang("Telefonszám").":</b> $t->t_intel<br />");
	  echo("<b>".wdhd_lang("E-mail").":</b> $t->t_inmail<br />");
	  echo("<b>".wdhd_lang("Leírás").":</b> $t->t_text<br />");
	  echo("<b>".wdhd_lang("Tervezett befejezés").":</b> $t->t_plantime<br />");
	  echo("<b>".wdhd_lang("Feladat").":</b> $t->t_dep<br />");
	  echo("<b>".wdhd_lang("Munka kiadva").":</b> $t->t_worker<br />");
	  echo("<b>".wdhd_lang("Elvégzett munka").":</b> $t->t_action<br />");
	  echo("<b>".wdhd_lang("Felhasznált eszközök").":</b> $t->t_parts<br />");
	  echo("<b>".wdhd_lang("Mukaóra").":</b> $t->t_hour<br />");
	  echo("<b>".wdhd_lang("Kiszállás (km)").":</b> $t->t_km<br />");
	  echo("<b>".wdhd_lang("Bejelentés lezárva").":</b> $t->t_endtime<br />");
	  echo("<b>".wdhd_lang("Bejelentést lezárta").":</b> $t->t_enduname<br />");
	  echo("</span>");
	  echo("</td>");
	  echo("<td class=\"columnn-title\" data-colname=\"c$i\">$t->t_inname</td>");
 	  if ($t->t_endtime<>""){
	    $state=wdhd_lang("Lezárva")." - ".$t->t_endtime;
	  }else{
	    $state=wdhd_lang("Nyitott");
	  }
	  echo("<td class=\"columnn-title\" data-colname=\"c$i\">$state</td>");
	  echo("<td class=\"columnn-title\" data-colname=\"c$i\">");
	  echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
	  echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$t->id\">");
	  echo("<input type=\"hidden\" id=\"wpage\" name=\"wpage\" value=\"$page\">");
      echo("<input type=\"submit\" id=\"mod\" name=\"mod\" class=\"button\" value=\"+\">");
	  echo("</form>");
	  echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
	  echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$t->id\">");
	  echo("<input type=\"hidden\" id=\"wpage\" name=\"wpage\" value=\"$page\">");
      echo("<input type=\"submit\" id=\"del\" name=\"del\" class=\"button\" value=\"-\">");
	  echo("</form>");
	  echo("</td>");
	  echo("</tr>");
      $i++;
    }
  }
  ?>
  </tbody>
    <tfoot>
	  <tr>
	    <th scope="col" id="t1" class="manage-column"><?php echo(wdhd_lang('Idő')); ?></th>
	    <th scope="col" id="t2" class="manage-column"><?php echo(wdhd_lang('Bejelentő')); ?></th>
	    <th scope="col" id="t3" class="manage-column"><?php echo(wdhd_lang('Állapot')); ?></th>
	    <th scope="col" id="t4" class="manage-column"><?php echo(wdhd_lang('Javít / Töröl')); ?></th>
	  </tr>
    </tfoot>
  </table>
  </div>

  <?php
  echo("<br />");
  wdhd_pager_admin($db,$wdhd_pagerow,$page,"wpage");
  echo("<br />");
  echo("<br />");
}


//fejléc
function wdhd_tpagehead(){
  echo("<br />");
  echo("<h1>".wdhd_lang('Bejelentések/feladatok listája')."</h1>");
  echo("<br />");
  echo(wdhd_lang('Bejelentések kezelése').".");
  echo("<br />");
  echo("<br />");
  echo("<br />");
}


// új nyelvi elemek kiírása
wdhd_lang_newlines();



?>
