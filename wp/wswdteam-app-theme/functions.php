<?php
/**
 * Minimal Theme funkciók és beállítások
 */


// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}



global $wswdteam_status_line;
if (!isset($w_status_line)) {
  $w_status_line=date('Y.m.d.');
}
if ($w_status_line==""){
  $w_status_line=date('Y.m.d.');
}

global $w_header_title;
if (!isset($w_header_title)){
  $w_header_title=date('Y.m.d.');
}
if ($w_header_title==""){
  $w_header_title=date('Y.m.d.');
}

global $w_credit;
if (!isset($w_credit)){
  $w_credit=date('Y.m.d.');
}
if ($w_credit==""){
  $w_credit=date('Y.m.d.');
}



// beállítások
function minimal_theme_setup(){
    // Támogatás a fejlécben megjelenő automatikus title tag-hez
    add_theme_support('title-tag');
    // Blokk stílusok alapértelmezett betöltése
    add_theme_support('wp-block-styles');
    // Széles és teljes szélességű képek engedélyezése
    add_theme_support('align-wide');
    // Saját CSS fájl betöltése a frontend oldalon
    add_action('wp_enqueue_scripts','minimal_theme_enqueue_styles');
    add_action('wp_enqueue_scripts','minimal_theme_color_styles');
}
add_action('after_setup_theme','minimal_theme_setup');



// saját css szín alapján
function minimal_theme_color_styles(){
  global $w_darkmode;

  // A CSS fájl regisztrálása és betöltése
  if ($w_darkmode){
    $f='/inc/style-dark.css';
  }else{
    $f='/inc/style-white.css';
  }
  wp_enqueue_style(
    'color-style',
    get_template_directory_uri() . $f,
    array(),
    '1.0',
  'all'
  );
}



// css betöltése
function minimal_theme_enqueue_styles(){
    wp_enqueue_style( 
        'minimal-theme-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );
}



// fej cím
function header_shortcode_title(){
    global $w_header_title;

    $kimenet='';
    if (isset($w_header_title)){
      $kimenet='<h2 style=text-align:right;>
        <a href="'.home_url().'" style="
          text-decoration:none;
          color:inherit;
          outline:none;
          background-color:transparent;
          cursor:pointer;
        ">'.$w_header_title.'</a></h2>';
    }
    return $kimenet;
}
add_shortcode('wswdteam_header_title','header_shortcode_title');



// láb státusz sor
function footer_shortcode_statusline(){
    global $w_status_line;

    $kimenet='';
    if (isset($w_status_line)) {
      $kimenet=$w_status_line;
    }
    return $kimenet;
}
add_shortcode('wswdteam_footer_statusline','footer_shortcode_statusline');



// verzió
function footer_shortcode_credit(){
    global $w_credit;

    $kimenet='';
    if (isset($w_credit)) {
      $kimenet='<a href="'.home_url().'" style="
          text-decoration:none;
          color:inherit;
          outline:none;
          background-color:transparent;
          cursor:pointer;
        ">'.$w_credit.'</a>';
    }
    return $kimenet;
}
add_shortcode('wswdteam_footer_credit','footer_shortcode_credit');



// saját logo a login oldalra
function ws_login_logo(){
    global $w_applogo;
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo($w_applogo) ?>);
            height: 200px;
            width: 200px;
            border-radius: 20px 20px 20px 20px;
            background-size: contain;
            background-repeat: no-repeat;
            bpadding-bottom: 20px;
        }
    </style>
    <?php
}
add_action( 'login_enqueue_scripts', 'ws_login_logo' );



// A logó linkjének módosítása a saját oldaladra
function ws_login_logo_url(){
    return home_url();
}
add_filter( 'login_headerurl', 'ws_login_logo_url' );



// favicon csere
add_filter('get_site_icon_url','wswd_custom_favicon',10,1);
function wswd_custom_favicon( $url ) {
    global $w_applogo;
    // A logó elérési útja a témád mappáján belül
    //return get_stylesheet_directory_uri().'/assets/images/wswd-favicon.png';
    return $w_applogo;
}



// menü cseréje
add_filter('render_block_data','custom_change_navigation_menu_id',10,2);
function custom_change_navigation_menu_id($parsed_block,$source_block){
  // Csak a navigációs blokkot keressük
  if ('core/navigation'===$parsed_block['blockName']){
    // Ellenőrizzük, hogy van-e 'ref' (ez a menü ID-ja)
    if (isset($parsed_block['attrs']['ref'])){
      // Itt add meg az új ID-t (pl. $uj_menu_id)
      $nav_menus=get_posts(array(
                        'post_type'=>'wp_navigation',
                        'post_status'=>'publish',
                        'numberposts'=>1
      ));
      $menu_slug='header-navigacio';
      $nav_menu=get_page_by_path($menu_slug,OBJECT,'wp_navigation');
      $uj_menu_id=$nav_menu->ID;
      $parsed_block['attrs']['ref']=$uj_menu_id;
    }
  }
  return $parsed_block;
}



// blokkok hozzáadása
//require get_template_directory() . '/inc/block-patterns.php';


?>
