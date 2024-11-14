<?php

// segéd függvényel

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// bejegyzések listája
function wdhd_postlist($cat=""){
  global $wdhd_pagerow;

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
        $db=count($posts);
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
        $l=($page-1)*$wdhd_pagerow;
        $i=0;
        foreach($posts as $p){
          if (($i>=$l)and($i<($l+$wdhd_pagerow))){
		    setup_postdata($p);
  	        $content=$content."<a href=\"".get_permalink($p)."\" class=\"wdhdwbutton2\">".$p->post_title."</a>";
  		    $content=$content."<br /><br />";
  		  }
          $i++;
        }
	    wp_reset_postdata();
	    $content=$content.wdhd_pager($db,$wdhd_pagerow,$page,"wpage");
      }
    }
  }
  return($content);
}


// bejegyzések listája és megjelenítése
function wdhd_postlist_view($cat=""){
  global $wdhd_pagerow;

  $content="";
  if ($cat<>""){
    if (isset($_POST['postid'])){
      $pid=$_POST['postid'];
      $p=get_post($pid);
  	  $content=$content."<br />";
  	  $content=$content."<a href=\"\" class=\"wdhdwbutton\">".wdhd_lang("Vissza")."</a>";
  	  $content=$content."<br /><br />";
  	  $content=$content."<h2>".$p->post_title."</h2>";
  	  $content=$content."<br /><br />";
      $content=$content.$p->post_content;
  	  $content=$content."<br /><br /><br />";
  	  $content=$content."<a href=\"\" class=\"wdhdwbutton\">".wdhd_lang("Vissza")."</a>";
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
        $db=count($posts);
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
        $l=($page-1)*$wdhd_pagerow;
        $i=0;
        foreach($posts as $p){
          if (($i>=$l)and($i<($l+$wdhd_pagerow))){
		    setup_postdata($p);
	        $content=$content."<form action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
            $content=$content."<input type=\"hidden\" id=\"postid\" name=\"postid\" value=\"$p->ID\">";
            $content=$content."<input type=\"submit\" id=\"s$i\" name=\"s$i\" value=\"$p->post_title\" style=\"display:none;\">";
  	        $content=$content."<a href=\"\" class=\"wdhdwbutton2\" onclick=\"this.closest('form').submit();return false;\">".$p->post_title."</a>";
  		    $content=$content."</form>";
  	        $content=$content."<br />";
  	      }
          $i++;
        }
	    wp_reset_postdata();
	    $content=$content.wdhd_pager($db,$wdhd_pagerow,$page,"wpage");
      }
    }
  }
  return($content);
}


?>
