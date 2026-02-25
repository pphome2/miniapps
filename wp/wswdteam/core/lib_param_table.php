<?php

// paraméterek beállítása


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}





// adat form
function wswdteam_param_form_app($w_id="",$w_name="",$w_text=""){
  wswdteam_param_pagehead_app();
  echo("<br />");
  echo("<h2>".wswdteam_lang('Új paraméter')."</h2>");
  echo("<br />");
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



// adatbeérkezés
function wswdteam_param_formdata_app($name=""){
  echo("<div class=wswdteamspaceholder></div>");
  // adatfeldolgozás
  $data=wswdteam_get_option($name);
  // törlés
  if (isset($_POST['del'])){
    $w_id=$_POST['id'];
    if (is_array($data)){
      unset($data[$w_id]);
    }
    $r=wswdteam_save_option($data,$name);
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
    if (!isset($data[$w_name])||($data[$w_name]!=$w_text)){
      $data[$w_name]=$w_text;
      $r=wswdteam_save_option($data,$name);
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
      wswdteam_param_form_app($w_id,$w_name,$w_text);
    }else{
    }
  }
}



//fejléc
function wswdteam_param_pagehead_app($name=""){
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



// paraméteradat tábla
function wswdteam_param_table_app($name=""){
  global $wswdteam_pagerow;

  wswdteam_param_pagehead_app();
  $data=wswdteam_get_option($name);
  $page=1;
  if (is_array($data)){
    $db=count($data);
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
  }
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
  if (is_array($data)){
    $i=1;
    foreach($data as $s=>$d) {
    	echo("<tr id=\"post-$i\">");
    	echo("<td class=\"columnn-title\" data-colname=\"c$i\">$s</td>");
    	if (in_array($d,["true","false"])){
    	  $tl=wswdteam_lang($d);
    	}else{
    	  $tl=$d;
    	}
	    echo("<td class=\"columnn-title\" data-colname=\"c$i\">$tl</td>");
    	echo("<td class=\"columnn-title\" data-colname=\"c$i\">");
	    echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
	    echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$s\">");
	    echo("<input type=\"hidden\" id=\"name\" name=\"name\" value=\"$s\">");
	    echo("<input type=\"hidden\" id=\"text\" name=\"text\" value=\"$d\">");
	    echo("<input type=\"hidden\" id=\"wpage\" name=\"wpage\" value=\"$page\">");
      echo("<input type=\"submit\" id=\"m\" name=\"m\" class=\"button\" value=\"+\">");
    	echo("</form>");
	    echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
	    echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$s\">");
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
	    <th scope="col" id="title" class="manage-column"><?php echo(wswdteam_lang('Paraméter név')); ?></th>
	    <th scope="col" id="author" class="manage-column"><?php echo(wswdteam_lang('Érték')); ?></th>
	    <th scope="col" id="tags" class="manage-column"><?php echo(wswdteam_lang('Művelet')); ?></th>
	  </tr>
    </tfoot>
  </table>
  </div>

  <?php
  if (is_array($data)){
    echo("<br />");
    wswdteam_pager_admin($db,$wswdteam_pagerow,$page,"wpage");
  }
  echo("<span class=wswdteamspaceholder></span>");
}




?>
