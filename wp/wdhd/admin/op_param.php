<?php

// paraméterek beállítása


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// admin script betöltés 
if (file_exists(__DIR__.'/wdhd_admin.css')){
  include(__DIR__.'/wdhd_admin.css');
}
if (file_exists(__DIR__.'/wdhd_admin.js')){
  include(__DIR__.'/wdhd_admin.js');
}


// jogosultság ellenőrzése
$ur=wdhd_user_right();
if (!in_array($ur,[0])){
  $l=wdhd_lang('Nem megfelelő jogosultság');
  wdhd_error($l);
  exit;
}


echo("<div class=wdhdspaceholder></div>");


// adatfeldolgozás
$table_name=$wpdb->prefix.$wdhd_table[0];

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
    $sql="INSERT INTO $table_name (name,text) VALUES ('$w_name','$w_text');";
    $r=$wpdb->query($sql);
    if ($r){
      $l=wdhd_lang('Tárolva');
      wdhd_message($l);
    }else{
      $l=wdhd_lang('Hiba történt');
      wdhd_error($l);
    }
  }
  wdhd_ptable();
  wdhd_pload();
  wdhd_pageload();
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
    wdhd_pform($w_id,$w_name,$w_text);
  }else{
    if (isset($_POST['new'])){
      // új adat gomb a táblából
      wdhd_pform();
    }else{
      wdhd_ptable();
      wdhd_pload();
      wdhd_pageload();
    }
  }
}


// adat form
function wdhd_pform($w_id="",$w_name="",$w_text=""){
  wdhd_ppagehead();
  if (isset($_POST['wpage'])){
    $page=$_POST['wpage'];
  }
  ?>
  <form action="<?php menu_page_url(__FILE__) ?>" method="post">
    <label for="name"><?php echo(wdhd_lang('Paraméter név')); ?>:</label><br>
    <input type="text" id="name" name="name" value="<?php echo($w_name); ?>"><br>
    <label for="text"><?php echo(wdhd_lang('Érték')); ?>:</label><br>
    <input type="text" id="text" name="text" value="<?php echo($w_text); ?>">
    <input type="hidden" id="id" name="id" value="<?php echo($w_id); ?>">
    <input type="hidden" id="wpage" name="wpage" value="<?php echo($page); ?>">
    <br /><br />
    <input type="submit" class="button" id="submit" name="submit" value="<?php echo(wdhd_lang('Mehet')); ?>">
    <input type="submit" class="button" id="x" name="x" value="<?php echo(wdhd_lang('Mégse')); ?>">
  </form>
  <br /><br />
  <?php
}


// adat tábla
function wdhd_ptable(){
  global $wpdb,$wdhd_table,$wdhd_pagerow;

  wdhd_ppagehead();
  $table_name=$wpdb->prefix.$wdhd_table[0];
  $sql="select count(*) from $table_name";
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
	    <th scope="col" id="title" class="manage-column" style="width:45%;"><?php echo(wdhd_lang('Paraméter név')); ?></th>
	    <th scope="col" id="author" class="manage-column" style="width:45%;"><?php echo(wdhd_lang('Érték')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wdhd_lang('Javít/Töröl')); ?></th>
	  </tr>
    </thead>
    <tbody id="the-list">
  <?php
  $sql="SELECT * FROM $table_name limit $i,$wdhd_pagerow;";
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
	    <th scope="col" id="title" class="manage-column"><?php echo(wdhd_lang('Paraméter név')); ?></th>
	    <th scope="col" id="author" class="manage-column"><?php echo(wdhd_lang('Érték')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wdhd_lang('Művelet')); ?></th>
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
function wdhd_ppagehead(){
  echo("<br />");
  echo("<h1>".wdhd_lang('Egyéb beállítások')."</h1>");
  echo("<br />");
  echo(wdhd_lang('Működési paraméterek, alapadatok kezelése').'.');
  echo("<br />");
  echo(wdhd_lang('A beállítások megváltoztatása hibás működést eredményezhet').'.');
  echo("<br />");
  echo("<br />");
  echo("<br />");
  echo("<h2>".wdhd_lang('Paraméterek')."</h2>");
  echo("<br />");
  echo("<br />");
}


// bejegyzések betöltése könyvtárból
function wdhd_pload(){
  global $wdhd_dir_post,$wdhd_locale;

  echo("<br />");
  echo("<br />");
  echo("<br />");
  echo("<h2>".wdhd_lang('Bejegyzés feltöltés - Frissítés utáni feladat')."</h2>");
  echo("<br />");
  echo(wdhd_lang('A modul txt mappájából a bejegyzések betöltése a kiválasztott kategóriába').'.');
  echo("<br />");
  echo("<br />");
  $md=dirname(dirname(__FILE__)).$wdhd_dir_post."/".$wdhd_locale;
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
                    'post_date'=>date('Y-m-d h:i:s'),
                    );
        }else{
          $np=array('post_title'=>$l,
                    'post_content'=>$ct,
                    'post_status'=>'publish',
                    'post_author'=>1,
                    'post_category'=>array($cid),
                    'post_date'=>date('Y-m-d h:i:s'),
                    );
        }
        $pid=wp_insert_post($np, true);
      }
    }
    echo("<br />");
    wdhd_message("A feltöltés megtörtént");
  }else{
    //$l=wp_list_categories(array('orderby' => 'name'));
    $c=get_categories(array('orderby'=>'name','order'=>'ASC','hide_empty'=>false));
	echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<label for=\"cid\">".wdhd_lang('Kategória').":</label><br>");
    echo("<select id=\"cid\" name=\"cid\">");
    foreach($c as $l){
      echo("<option value=\"$l->term_id\">".$l->name."</option>");
    }
    echo("</select><br />");
    echo("<label for=\"cdir\">".wdhd_lang('Mappa').":</label><br>");
    echo("<select id=\"cdir\" name=\"cdir\">");
    $fl=scandir($md);
    foreach($fl as $l){
      $d=$md."/".$l;
      if ((is_dir($d))and(!in_array($l,array(".","..")))){
        echo("<option value=\"$l\">".$l."</option>");
      }
    }
    echo("</select>");
    echo("<br />");
    echo("<br />");
    echo("<input type=\"submit\" id=\"postload\" name=\"postload\" class=\"button\" value=\"".wdhd_lang('Mehet')."\">");
	echo("</form>");
  }
  echo("<br />");
  echo("<br />");
}



// lapok betöltése könyvtárból
function wdhd_pageload(){
  global $wdhd_dir_page,$wdhd_locale;

  echo("<br />");
  echo("<br />");
  echo("<br />");
  echo("<h2>".wdhd_lang('Lapok feltöltés - Frissítés utáni feladat')."</h2>");
  echo("<br />");
  echo("<br />");
  echo(wdhd_lang('A modul txt mappájából a lapk betöltése').'.');
  echo("<br />");
  echo(wdhd_lang('A feltöltött lapok elérését (a menükben) ellenőrizni kell').'.');
  echo("<br />");
  echo("<br />");
  $md=dirname(dirname(__FILE__)).$wdhd_dir_page."/".$wdhd_locale;
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
                    'post_date'=>date('Y-m-d h:i:s'),
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
                    'post_date'=>date('Y-m-d h:i:s'), 
                    'post_name'=>strtolower(str_replace(' ','-',trim($l)))
                    );
        }
        $pid=wp_insert_post($np, true);
        echo("$l<br />");
      }
    }
    echo("<br />");
    wdhd_message("A lapok tárolása megtörtént");
  }else{
    echo("<br />");
    echo(wdhd_lang('Feltőlthető lapok').":");
    echo("<br />");
    echo("<br />");
    $fl=scandir($md);
    foreach($fl as $l){
      $d=$md."/".$l;
      if (!in_array($l,array(".",".."))){
        echo("$l<br />");
      }
    }
    echo("<br />");
    echo("<br />");
	echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    echo("<input type=\"submit\" id=\"pageload\" name=\"pageload\" class=\"button\" value=\"".wdhd_lang('Feltöltés')."\">");
	echo("</form>");
  }
  echo("<br />");
  echo("<br />");
}


// új nyelvi elemek kiírása
echo(wdhd_lang_newlines());


?>
