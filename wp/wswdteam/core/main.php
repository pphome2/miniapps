<?php

// main - vezérlés és adatbázis feladatok


//
function wswdteam_main_center($atts=[],$content=null,$tag=''){
  global $wpdb,$wswdteam_db_version,$wswdteam_table;

  $i=0;
  $content=$content.'<br />';
  foreach($atts as $k){
    $content=$content.' - '.$k.' '.$i;
    switch($k){
      case 'egy':
        $content=$content.' - egyes';
        break;
      case 'kettő':
        $content=$content.' - kettes';
        break;
    }
    $content=$content.'<br />';
    $i++;
  }
  $content='<b>shortcoded - '.$tag.'</b> '.$content;
  $table_name=$wpdb->prefix.$wswdteam_table;
 
  $content=$content.'<br /><br />SQL:<br /><br />';
  $sql="SELECT * FROM $table_name;";
  //$r=$wpdb->query($sql);
  $res=$wpdb->get_results($sql);
  $i=1;
  foreach($res as $t) {
    $content=$content."$i - ";
    $content=$content.$t->name;
    $content=$content.' - ';
    $content=$content.$t->text;
    $content=$content.'<br />';
    $i++;
  }

  return $content;
}


// adatbázis előkészítés
function wswdteam_db_init(){
  global $wpdb,$wswdteam_db_version,$wswdteam_table;

  $table_name=$wpdb->prefix.$wswdteam_table;
  $charset_collate=$wpdb->get_charset_collate();

  $sql="CREATE TABLE IF NOT EXISTS $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    name tinytext NOT NULL,
    text text NOT NULL,
    url varchar(55) DEFAULT '' NOT NULL,
    PRIMARY KEY  (id)
  ) $charset_collate;";

  $r=$wpdb->query($sql);
  add_option('jal_db_version', $wswdteam_db_version );
}

?>

