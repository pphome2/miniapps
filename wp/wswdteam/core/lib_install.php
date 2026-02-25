<?php

// teelpítési függvények




// teljes paraméterkezelés
function wswdteam_install_admin(){
  wswdteam_post_load();
  wswdteam_page_load();
}



// teljes paraméterkezelés
function wswdteam_install_admin_app($name,$dir1,$dir2){
  wswdteam_post_load_app($dir1);
  wswdteam_page_load_app($dir2);
}





// bejegyzések betöltése könyvtárból
function wswdteam_post_load_app($dir="",$loc=""){
  echo("<span class=wswdteamspaceholder></span>");
  echo("<h2>".wswdteam_lang('Bejegyzés feltöltés - Frissítés utáni feladat')."</h2>");
  echo("<br />");
  echo(wswdteam_lang('A modul txt mappájából a bejegyzések betöltése a kiválasztott kategóriába'.'.'));
  echo("<span class=wswdteamspaceholder></span>");
  $md=$dir."/".$loc;
  if (isset($_POST['submit'])&&(isset($_POST['cid']))){
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
    //echo("<input type=\"submit\" id=\"postload\" name=\"postload\" class=\"button\" value=\"".wswdteam_lang('Mehet')."\">");
    submit_button();
	echo("</form>");
  }
  echo("<span class=wswdteamspaceholder></span>");
}



// lapok betöltése könyvtárból
function wswdteam_page_load_app($dir="",$loc=""){
  echo("<span class=wswdteamspaceholder></span>");
  echo("<h2>".wswdteam_lang('Lapok feltöltés - Frissítés utáni feladat')."</h2>");
  echo("<span class=wswdteamspaceholder></span>");
  echo(wswdteam_lang('A modul txt mappájából a lapok betöltése').'.');
  echo("<br />");
  echo(wswdteam_lang('A feltöltött lapok elérését (a menükben) ellenőrizni kell'.'.'));
  echo("<span class=wswdteamspaceholder></span>");
  $md=$dir."/".$loc;
  if (isset($_POST['submit'])&&(!isset($_POST['cid']))){
    $nav_menus=get_posts(array(
                        'post_type'=>'wp_navigation',
                        'post_status'=>'publish',
                        'numberposts'=>1
    ));
    $menu_slug='header-navigacio';
    $nav_menu=get_page_by_path($menu_slug,OBJECT,'wp_navigation');
    if (!$nav_menu){
      $menu_data = array(
            'post_title'   => 'main_nav',
            'post_name'    => $menu_slug,
            'post_status'  => 'publish',
            'post_type'    => 'wp_navigation',
            'post_content' => ''
      );
      wp_insert_post($menu_data);
      $nav_menus=get_posts(array(
                          'post_type'=>'wp_navigation',
                          'post_status'=>'publish',
                          'numberposts'=>1
      ));
      $nav_menu=get_page_by_path($menu_slug,OBJECT,'wp_navigation');
    }
    $updated="";
    if (!$nav_menu){
      //$updated=$nav_menu->post_content;
    }
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
        $pos=strpos($l,'-');
        if ($pos!==false) {
          // A $pos + 1 azért kell, hogy magát a kötőjelet már ne tegye bele
          $l=substr($l,$pos+1);
        }
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
        $pid2=wp_insert_post($np, true);
        $mid = (int) $pid2;
        $pos=strpos($l,'-');
        if ($pos!==false) {
          // A $pos + 1 azért kell, hogy magát a kötőjelet már ne tegye bele
          $l=substr($l,$pos+1);
        }
        $ml  = esc_attr($l);
        $mu  = esc_url(get_permalink($mid));
        // A blokk-alapú menüpont pontos szintaxisa (figyelj a szóközökre!)
        $open  = '<' . '!-- wp:navigation-link ';
        $close = ' /--' . '>'; // A WordPress /-- sorrendet használ a végén!
        // Fontos: A JSON-ben a vesszők után NE legyen szóköz, mert a parser néha háklis rá
        $json_data = '{"label":"' . $ml . '","type":"page","id":' . $mid . ',"url":"' . $mu . '","kind":"post-type"}';
        $new_menu_item = $open . $json_data . $close;
        // Frissítés előtt ellenőrizzük, hogy ne legyen üres a tartalom
        //$current_content = !empty($nav_menu->post_content) ? trim($nav_menu->post_content) : '';
        $updated=$updated."\n".$new_menu_item;
        echo("$l<br />");
      }
    }
    if ($nav_menu){
      wp_update_post(array(
            'ID'           => $nav_menu->ID,
            'post_content' => $updated
      ));
    }
    echo("<br />");
    wswdteam_message("A lapok tárolása megtörtént");
  }else{
    echo("<br />");
    echo(wswdteam_lang('Feltőlthető lapok').":");
    echo("<br />");
    echo("<br />");
    $fl=scandir($md);
    foreach($fl as $l){
      $d=$md."/".$l;
      if (!in_array($l,array(".",".."))){
        echo("$l<br />");
      }
    }
    echo("<span class=wswdteamspaceholder></span>");
	  echo("<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">");
    //echo("<input type=\"submit\" id=\"pageload\" name=\"pageload\" class=\"button\" value=\"".wswdteam_lang('Feltöltés')."\">");
    submit_button();
  	echo("</form>");
  }
  echo("<span class=wswdteamspaceholder></span>");
}




?>
