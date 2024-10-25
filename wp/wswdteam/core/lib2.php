<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// bejegyzések listája
function wswdteam_postlist($cat=""){
  $content="";
  if ($cat<>""){
    if (isset($_POST['postid'])){
    }else{
      $catid=get_cat_ID($cat);
      $args=array('category'         => $catid,
		          'orderby'          => 'date',
		          'order'            => 'DESC',
		          'post_type'        => 'post'
		          );
      $posts=get_posts($args);
      if (count($posts)){
        $i=0;
        foreach($posts as $p){
		  setup_postdata($p);
  		  $content=$content."<a href=\"".get_permalink($p)."\">".$p->post_title."</a><br /><br />";
          $i++;
        }
	    wp_reset_postdata();
      }
    }
  }
  return($content);
}


// bejegyzések listája és megjelenítése
function wswdteam_postlist_view($cat=""){
  $content="";
  if ($cat<>""){
    if (isset($_POST['postid'])){
      $pid=$_POST['postid'];
      $p=get_post($pid);
  		  $content=$content."<br />";
  	  $content=$content."<a href=\"\" class=\"wbutton\">".wswdteam_lang("Vissza")."</a>";
  	  $content=$content."<br /><br />";
  	  $content=$content."<h2>".$p->post_title."</h2>";
  	  $content=$content."<br /><br />";
      $content=$content.$p->post_content;
  	  $content=$content."<br /><br /><br />";
  	  $content=$content."<a href=\"\" class=\"wbutton\">".wswdteam_lang("Vissza")."</a>";
  	  $content=$content."<br /><br />";
    }else{
      $catid=get_cat_ID($cat);
      $args=array('category'         => $catid,
		          'orderby'          => 'date',
		          'order'            => 'DESC',
		          'post_type'        => 'post'
		          );
      $posts=get_posts($args);
      if (count($posts)){
        $i=0;
        foreach($posts as $p){
		  setup_postdata($p);
	      $content=$content."<form action=\"".menu_page_url(__FILE__)."\" method=\"post\">";
          $content=$content."<input type=\"hidden\" id=\"postid\" name=\"postid\" value=\"$p->ID\">";
          $content=$content."<input type=\"submit\" id=\"s$i\" name=\"s$i\" value=\"$p->post_title\" style=\"display:none;\">";
  	      $content=$content."<a href=\"\" class=\"wbutton2\" onclick=\"this.closest('form').submit();return false;\">".$p->post_title."</a>";
  		  $content=$content."</form>";
  	      $content=$content."<br />";
          $i++;
        }
	    wp_reset_postdata();
      }
    }
  }
  return($content);
}


?>

