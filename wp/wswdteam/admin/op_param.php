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



echo("<div class=wswdspaceholder></div>");

wswdteam_param_formdata();

// főbb funkciók
if (isset($_POST['new'])){
  // új adat gomb a táblából
  wswdteam_pform();
}else{
  wswdteam_ptable();
  wswdteam_pload();
  wswdteam_pageload();
}

echo("<div class=wswdspaceholder></div>");


function wswdteam_param_formdata(){
  global $wswdteam_table;

  wswdteam_param_formdata_app($wswdteam_table);
}





// adat form
function wswdteam_pform($w_id="",$w_name="",$w_text=""){
  wswdteam_pform_app($w_id="",$w_name="",$w_text="");
}


// adat tábla
function wswdteam_ptable(){
  global $wswdteam_table;

  wswdteam_ptable_app($wswdteam_table);
}





//fejléc
function wswdteam_ppagehead(){
  wswdteam_ppagehead_app();
}




// bejegyzése betöltése könyvtárból
function wswdteam_pload(){
  global $wswdteam_dir_post,$wswdteam_locale;
  
  wswdteam_pload_app(dirname(dirname(__FILE__)).$wswdteam_dir_post,$wswdteam_locale);

}



// lapok betöltése könyvtárból
function wswdteam_pageload(){
  global $wswdteam_dir_page,$wswdteam_locale;
  
  wswdteam_pageload_app(dirname(dirname(__FILE__)).$wswdteam_dir_page,$wswdteam_locale);

}


// új nyelvi elemek kiírása
echo(wswdteam_lang_newlines());


?>
