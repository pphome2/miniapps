<?php

// paraméterek beállítása


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// jogosultság ellenőrzése
$ur=wswdteam_user_right();
if (!in_array($ur,[0])){
  $l=wswdteam_lang('Nem megfelelő jogosultság');
  wswdteam_error($l);
  exit;
}


// admin script betöltés 
if (file_exists(__DIR__.'/wswdteam_admin.css')){
  include(__DIR__.'/wswdteam_admin.css');
}
if (file_exists(__DIR__.'/wswdteam_admin.js')){
  include(__DIR__.'/wswdteam_admin.js');
}



echo("<div class=wswdspaceholder></div>");

// adatfeldolgozás
$table_name=$wpdb->prefix.$wswdteam_table[0];

// törlés
if (isset($_POST['del'])){
  $w_id=$_POST['id'];
  $sql="DELETE FROM $table_name WHERE id=$w_id;";
  $r=$wpdb->query($sql);
  if ($r){
    $l=wswdteam_lang('Törölve');
    wswdteam_message($l);
  }else{
    $l=wswdteam_lang('Hiba történt');
    wswdteam_error($l);
  }
}

// form-ból adat
if (isset($_POST['submit'])){
  // mehet gomb után
  $w_name=$_POST['name'];
  $w_text=$_POST['text'];
  if ((isset($_POST['id']))and($_POST['id']<>"")){
    // javítás
    $w_id=$_POST['id'];
    $sql="UPDATE $table_name SET name='$w_name',text='$w_text' WHERE id=$w_id;";
    $r=$wpdb->query($sql);
    $l=wswdteam_lang('Módosítva');
    wswdteam_message($l);
  }else{
    // új adat
    $w_id="";
    $sql="INSERT INTO $table_name (name,text) VALUES ('$w_name','$w_text');";
    $r=$wpdb->query($sql);
    if ($r){
      $l=wswdteam_lang('Tárolva');
      wswdteam_message($l);
    }else{
      $l=wswdteam_lang('Hiba történt');
      wswdteam_error($l);
    }
  }
}else{
  // tábla vagy táblából adat
  if (isset($_POST['m'])){
    // táblából adat javításra
    if (isset($_POST['id'])){
      $w_id=$_POST['id'];
    }else{
      $w_id="";
    }
    $w_name=$_POST['name'];
    $w_text=$_POST['text'];
    wswdteam_pform($w_id,$w_name,$w_text);
  }else{
  }
}


// főbb funkciók
if (isset($_POST['new'])){
  // új adat gomb a táblából
  wswdteam_pform();
}else{
  wswdteam_ptable();
}
wswdteam_pload();
wswdteam_pageload();
wswdteam_admin_backup();


function wswdteam_admin_backup(){
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
  echo("<h2>".wswdteam_lang('Adatmentés - visszaállítás')."</h2>");
  echo("<span class=wswdteamspaceholder></span>");
  wswdteam_backup();
}


// adat form
function wswdteam_pform($w_id="",$w_name="",$w_text=""){
  wswdteam_ppagehead();
  if (isset($_POST['wpage'])){
    $page=$_POST['wpage'];
  }
  ?>
  <form action="<?php menu_page_url(__FILE__) ?>" method="post">
    <label for="name"><?php echo(wswdteam_lang('Paraméter név')); ?>:</label><br>
    <input type="text" id="name" name="name" value="<?php echo($w_name); ?>"><br>
    <label for="text"><?php echo(wswdteam_lang('Érték')); ?>:</label><br>
    <input type="text" id="text" name="text" value="<?php echo($w_text); ?>">
    <input type="hidden" id="id" name="id" value="<?php echo($w_id); ?>">
    <input type="hidden" id="wpage" name="wpage" value="<?php echo($page); ?>">
    <br /><br />
    <input type="submit" class="button" id="submit" name="submit" value="<?php echo(wswdteam_lang('Mehet')); ?>">
    <input type="submit" class="button" id="x" name="x" value="<?php echo(wswdteam_lang('Mégse')); ?>">
  </form>
  <br /><br />
  <?php
}


// adat tábla
function wswdteam_ptable(){
  global $wpdb,$wswdteam_table,$wswdteam_pagerow;

  wswdteam_ppagehead();
  $table_name=$wpdb->prefix.$wswdteam_table[0];
  $sql="select count(*) from $table_name";
  $db=$wpdb->get_var($sql);
  if (isset($_POST['wpage'])){
    $page=$_POST['wpage'];
    if ($page<1){
      $page=1;
    }
    if ($db<($page*$wswdteam_pagerow)){
      if ($db<(($page-1)*$wswdteam_pagerow)){
        $page=1;
      }
    }
  }else{
    $page=1;
  }
  $i=($page-1)*$wswdteam_pagerow;
  //echo($db." - ".$page." - ".$i." - ".$wswdteam_pagerow);
  ?>
  <br />
  <form action="<?php menu_page_url(__FILE__) ?>" method="post">
    <input type="hidden" id="wpage" name="wpage" value="<?php echo($page); ?>">
    <input type="submit" class="button" id="new" name="new" value="<?php echo(wswdteam_lang('Új')); ?>">
  </form>
  <br />
  <br />
  <div style="width:99%">
  <table class="wp-list-table widefat fixed striped table-view-list">
    <thead>
	  <tr>
	    <th scope="col" id="title" class="manage-column" style="width:45%;"><?php echo(wswdteam_lang('Paraméter név')); ?></th>
	    <th scope="col" id="author" class="manage-column" style="width:45%;"><?php echo(wswdteam_lang('Érték')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Javít/Töröl')); ?></th>
	  </tr>
    </thead>
    <tbody id="the-list">
  <?php
  $sql="SELECT * FROM $table_name limit $i,$wswdteam_pagerow;";
  $res=$wpdb->get_results($sql);
  $i=1;
  foreach($res as $t) {
	echo("<tr id=\"post-$i\">");
	echo("<td class=\"columnn-title\" data-colname=\"c$i\">$t->name</td>");
	echo("<td class=\"columnn-title\" data-colname=\"c$i\">$t->text</td>");
	echo("<td class=\"columnn-title\" data-colname=\"c$i\">");
	echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
	echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$t->id\">");
	echo("<input type=\"hidden\" id=\"name\" name=\"name\" value=\"$t->name\">");
	echo("<input type=\"hidden\" id=\"text\" name=\"text\" value=\"$t->text\">");
	echo("<input type=\"hidden\" id=\"wpage\" name=\"wpage\" value=\"$page\">");
    echo("<input type=\"submit\" id=\"m\" name=\"m\" class=\"button\" value=\"+\">");
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
  ?>
  </tbody>
    <tfoot>
	  <tr>
	    <th scope="col" id="title" class="manage-column"><?php echo(wswdteam_lang('Paraméter név')); ?></th>
	    <th scope="col" id="author" class="manage-column"><?php echo(wswdteam_lang('Érték')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Művelet')); ?></th>
	  </tr>
    </tfoot>
  </table>
  </div>

  <?php
  echo("<br />");
  wswdteam_pager_admin($db,$wswdteam_pagerow,$page,"wpage");
  echo("<span class=wswdteamspaceholder></span>");
}


//fejléc
function wswdteam_ppagehead(){
  echo("<br />");
  echo("<h1>".wswdteam_lang('Egyéb beállítások')."</h1>");
  echo("<br />");
  echo(wswdteam_lang('Működési paraméterek, alapadatok kezelése'));
  echo("<br />");
  echo(wswdteam_lang('A beállítások megváltoztatása hibás működést eredményezhet').'.');
  echo("<span class=wswdteamspaceholder></span>");
  echo("<h2>".wswdteam_lang('Paraméterek')."</h2>");
  echo("<span class=wswdteamspaceholder></span>");
}


// bejegyzések betöltése könyvtárból
function wswdteam_pload(){
  global $wswdteam_dir_post,$wswdteam_locale;

  echo("<span class=wswdteamspaceholder></span>");
  echo("<h2>".wswdteam_lang('Bejegyzés feltöltés - Frissítés utáni feladat')."</h2>");
  echo("<br />");
  echo(wswdteam_lang('A modul txt mappájából a bejegyzések betöltése a kiválasztott kategóriába'.'.'));
  echo("<span class=wswdteamspaceholder></span>");
  $md=dirname(dirname(__FILE__)).$wswdteam_dir_post."/".$wswdteam_locale;
  if (isset($_POST['postload'])){
    $md=$md."/".$_POST['cdir'];
    $fl=scandir($md);
    $cid=(int)$_POST['cid'];
    foreach($fl as $l){
      $d=$md."/".$l;
      if ((!is_dir($d))and(!in_array($l,array(".","..")))){
        $args=array('category'=>$cid,
	  	            'orderby'=>'date',
		            'order'=>'DESC',
		            'post_type'=>'post'
		            );
        $posts=get_posts($args);
        $pid='';
        foreach($posts as $p){
		  setup_postdata($p);
		  if (($p->post_title===$l)and($p->post_category=$cid)){
		    //wp_delete_post($p->ID);
		    $pid=$p->ID;
		  }
		}
	    wp_reset_postdata();
        $ct=file_get_contents($d);
        if ($pid<>''){
          $np=array('ID'=>$pid,
                    'post_title'=>$l,
                    'post_content'=>$ct,
                    'post_status'=>'publish',
                    'post_author'=>1,
                    'post_category'=>array($cid),
                    'post_date'=>date('Y-m-d h:m:s'),
                    );
        }else{
          $np=array('post_title'=>$l,
                    'post_content'=>$ct,
                    'post_status'=>'publish',
                    'post_author'=>1,
                    'post_category'=>array($cid),
                    'post_date'=>date('Y-m-d h:m:s'),
                    );
        }
        $pid=wp_insert_post($np, true);
      }
    }
    wswdteam_message("A feltöltés megtörtént");
  }else{
    //$l=wp_list_categories(array('orderby' => 'name'));
    $c=get_categories( array('orderby'=>'name','order'=>'ASC','hide_empty'=>false));
	echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<label for=\"cid\">".wswdteam_lang('Kategória').":</label><br>");
    echo("<select id=\"cid\" name=\"cid\">");
    foreach($c as $l){
      echo("<option value=\"$l->term_id\">".$l->name."</option>");
    }
    echo("</select><br />");
    echo("<label for=\"cdir\">".wswdteam_lang('Mappa').":</label><br>");
    echo("<select id=\"cdir\" name=\"cdir\">");
    $fl=scandir($md);
    foreach($fl as $l){
      $d=$md."/".$l;
      if ((is_dir($d))and(!in_array($l,array(".","..")))){
        echo("<option value=\"$l\">".$l."</option>");
      }
    }
    echo("</select>");
    echo("<span class=wswdteamspaceholder></span>");
    echo("<input type=\"submit\" id=\"postload\" name=\"postload\" class=\"button\" value=\"".wswdteam_lang('Mehet')."\">");
	echo("</form>");
  }
  echo("<span class=wswdteamspaceholder></span>");
}



// lapok betöltése könyvtárból
function wswdteam_pageload(){
  global $wswdteam_dir_page,$wswdteam_locale;

  echo("<span class=wswdteamspaceholder></span>");
  echo("<h2>".wswdteam_lang('Lapok feltöltés - Frissítés utáni feladat')."</h2>");
  echo("<span class=wswdteamspaceholder></span>");
  echo(wswdteam_lang('A modul txt mappájából a lapok betöltése').'.');
  echo("<br />");
  echo(wswdteam_lang('A feltöltött lapok elérését (a menükben) ellenőrizni kell'.'.'));
  echo("<span class=wswdteamspaceholder></span>");
  $md=dirname(dirname(__FILE__)).$wswdteam_dir_page."/".$wswdteam_locale;
  if (isset($_POST['pageload'])){
    $fl=scandir($md);
    foreach($fl as $l){
      $d=$md."/".$l;
      if (!in_array($l,array(".",".."))){
        $args=array('orderby'=>'date',
		            'order'=>'DESC',
		            'post_type'=>'page'
		            );
        $posts=get_posts($args);
        $pid='';
        foreach($posts as $p){
		  setup_postdata($p);
		  if ($p->post_title===$l){
		    //wp_delete_post($p->ID);
		    $pid=$p->ID;
		  }
		}
	    wp_reset_postdata();
        $ct=file_get_contents($d);
        if ($pid<>''){
          $np=array('ID'=>$pid,
                    'post_title'=>$l,
                    'ping_status'=>'close',
                    'comment_status'=>'close',
                    'post_content'=>$ct,
                    'post_status'=>'publish',
                    'post_type'=>'page',
                    'post_author'=>1,
                    'post_date'=>date('Y-m-d h:m:s'),                  
                    'post_name'=>strtolower(str_replace(' ','-',trim($l)))
                    );
        }else{
          $np=array('post_title'=>$l,
                    'ping_status'=>'close',
                    'comment_status'=>'close',
                    'post_content'=>$ct,
                    'post_status'=>'publish',
                    'post_type'=>'page',
                    'post_author'=>1,
                    'post_date'=>date('Y-m-d h:m:s'),                  
                    'post_name'=>strtolower(str_replace(' ','-',trim($l)))
                    );
        }
        $pid=wp_insert_post($np, true);
        echo("$l<br />");
      }
    }
    wswdteam_message("A lapok tárolása megtörtént");
  }else{
    echo("<br />");
    echo(wswdteam_lang('Feltőlthető lapok').":");
    echo("<span class=wswdteamspaceholder></span>");
    $fl=scandir($md);
    foreach($fl as $l){
      $d=$md."/".$l;
      if (!in_array($l,array(".",".."))){
        echo("$l<br />");
      }
    }
    echo("<span class=wswdteamspaceholder></span>");
	echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=\"submit\" id=\"pageload\" name=\"pageload\" class=\"button\" value=\"".wswdteam_lang('Feltöltés')."\">");
	echo("</form>");
  }
  echo("<span class=wswdteamspaceholder></span>");
}


// új nyelvi elemek kiírása
echo(wswdteam_lang_newlines());


?>
