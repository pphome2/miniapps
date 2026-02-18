<?php

// paraméterek beállítása


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




echo("<div class=wdhdspaceholder></div>");

// adatfeldolgozás
if (function_exists('wswdteam_param_formdata_app')){
    wswdteam_param_formdata_app($wdhd_table);
}
if (isset($_POST['new'])){
  // új adat gomb a táblából
  wdhd_pform();
}else{
  wdhd_ptable();
  wdhd_pload();
  wdhd_pageload();
}


// adat form
function wdhd_pform($w_id="",$w_name="",$w_text=""){
  if (function_exists('wswdteam_pform_app')){
    wswdteam_pform_app($w_id="",$w_name="",$w_text="");
  }
}


// adat tábla
function wdhd_ptable(){
  global $wdhd_table;

  if (function_exists('wswdteam_ptable_app')){
    wswdteam_ptable_app($wdhd_table);
  }
}





//fejléc
function wdhd_ppagehead(){
  if (function_exists('wswdteam_ppagehead_app')){
    wswdteam_ppagehead_app();
  }
}





// bejegyzések betöltése könyvtárból
function wdhd_pload(){
  global $wdhd_dir_post,$wdhd_locale;  

  if (function_exists('wswdteam_pload_app')){
    wswdteam_pload_app(dirname(dirname(__FILE__)).$wdhd_dir_post,$wdhd_locale);
  }

}



// lapok betöltése könyvtárból
function wdhd_pageload(){
  global $wdhd_dir_page,$wdhd_locale;
  
  if (function_exists('wswdteam_pageload_app')){
    wswdteam_pageload_app(dirname(dirname(__FILE__)).$wdhd_dir_page,$wdhd_locale);
  }

}


// új nyelvi elemek kiírása
echo(wdhd_lang_newlines());


?>