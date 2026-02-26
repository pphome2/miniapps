<?php

// option menu


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}



echo("<span class=wswdteamspaceholder></span>");

// adatfeldolgozás
//$table_name=$wpdb->prefix.$wswdteam_table[0];
// if (isset($_POST['submit'])){}


// fejrész
wswdteam_upagehead();

// bálllítások érkezése
wswdteam_postdata();

//adatok
wswdteam_datatable();


function wswdteam_postdata(){
  global $wswdteam_maintenance_mode,$wswdteam_developer_mode,$wswdteam_dark_mode;

  if (isset($_POST['submit'])){
    $param=wswdteam_get_option();
    if (isset($_POST['maintenance'])){
      $param['wswdteam_maintenance_mode']='true';
      $wswdteam_maintenance_mode=true;
    }else{
      $param['wswdteam_maintenance_mode']='false';
      $wswdteam_maintenance_mode=false;
    }
    if (isset($_POST['developer'])){
      $param['wswdteam_developer_mode']='true';
      $wswdteam_developer_mode=true;
    }else{
      $param['wswdteam_developer_mode']='false';
      $wswdteam_developer_mode=false;
    }
    if (isset($_POST['darkmode'])){
      $param['wswdteam_dark_mode']='true';
      $wswdteam_darkmode_mode=true;
    }else{
      $param['wswdteam_dark_mode']='false';
      $wswdteam_dark_mode=false;
    }
    wswdteam_save_option($param);
    //echo('<script type="text/javascript">location.reload();</script>');
  }
}


// adattábla
function wswdteam_datatable(){
  global $wswdteam_options;

  // META TESZT
  //$t=array("nev"=>"senki","adat"=>"valami");
  //wswdteam_save_metadata($t);
  //$t2=wswdteam_get_metadata();
  //if ($t2){}
  //  echo($t2["nev"]);
  //}else{
  //  echo("HIBA");
  //}
  //wswdteam_delete_metadata();

  echo("<span class=wswdteamspaceholder></span>");
  echo("<b>".wswdteam_lang("Rendszer paraméterek").":</b>");
  echo("<span class=wswdteamspaceholder></span>");
  $ver=get_option($wswdteam_options[0],'0');
  echo($wswdteam_options[0]." - ".$ver);
  echo("<br />");
  $ver=get_option($wswdteam_options[1],'0');
  echo($wswdteam_options[1]." - ".$ver);
  echo("<span class=wswdteamspaceholder></span>");
  echo("<b>".wswdteam_lang("Alkalmazás paraméterek").":</b>");
  echo("<br />");
  echo("<br />");
  $dev='false';
  $maint='false';
  $dark='false';
  $param=wswdteam_get_option();
  if (isset($param['wswdteam_developer_mode'])){
    if ($param['wswdteam_developer_mode']==='true'){
      $dev='true';
    }
  }
  echo(wswdteam_lang("wswdteam_developer_mode")." - ".wswdteam_lang($dev));
  echo("<br />");
  if (isset($param['wswdteam_maintenance_mode'])){
    if ($param['wswdteam_maintenance_mode']==='true'){
      $maint='true';
    }
  }
  echo(wswdteam_lang("wswdteam_maintenance_mode")." - ".wswdteam_lang($maint));
  echo("<br />");
  if (isset($param['wswdteam_dark_mode'])){
    if ($param['wswdteam_dark_mode']==='true'){
      $dark='true';
    }
  }
  echo(wswdteam_lang("wswdteam_dark_mode")." - ".wswdteam_lang($dark));
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
  echo('<b>'.wswdteam_lang('Beállítások').'</b>');
  echo("<span class=wswdteamspaceholder></span>");
  echo('<form action="'.menu_page_url(__FILE__).'" method="post">');
  if ($dev==='true'){
    $checked='checked';
  } else {
    $checked='';
  }
  echo('<input type="checkbox" id="developer" name="developer" value="1" '.$checked.">");
  echo('<span>'.wswdteam_lang('Developer üzemmód bekapcsolása').'</span>');
  echo(' </label>');
  echo("<span class=wswdteamspaceholder></span>");
  echo('<label class="switch">');
  if ($maint==='true'){
    $checked='checked';
  } else {
    $checked='';
  }
  echo('<input type="checkbox" id="maintenance" name="maintenance" value="1" '.$checked.">");
  echo('<span>'.wswdteam_lang('Karbantartási üzemmód bekapcsolása').'</span>');
  echo(' </label>');
  echo("<span class=wswdteamspaceholder></span>");
  if ($dark==='true'){
    $checked='checked';
  } else {
    $checked='';
  }
  echo('<input type="checkbox" id="darkmode" name="darkmode" value="1" '.$checked.">");
  echo('<span>'.wswdteam_lang('Sötét mód kérése a téma sablontól').'</span>');
  echo(' </label>');
  submit_button(wswdteam_lang('Beállítások mentése'));
  echo('</form>');
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
}




//fejléc
function wswdteam_upagehead(){
  echo("<br />");
  echo("<h1>".wswdteam_lang('WSWDTeam app keretrendszer')."</h1>");
  echo("<br />");
  echo(wswdteam_lang('Beállítások'));
  echo("<span class=wswdteamspaceholder></span>");
  echo("<span class=wswdteamspaceholder></span>");
}


// új nyelvi elemek kiírása
echo(wswdteam_lang_newlines());

?>
