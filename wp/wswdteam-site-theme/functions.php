<?php
/**
 * Minimal Theme funkciók és beállítások
 */


global $w_status_line;
if (!isset($w_status_line)) {
  $w_status_line=date('Y.')." "."Minden jog fenntartva";
}
if ($w_status_line=="") {
  $w_status_line=date('Y.')." "."Minden jog fenntartva";
}

function minimal_theme_setup() {
    // Támogatás a fejlécben megjelenő automatikus title tag-hez
    add_theme_support('title-tag');
    // Blokk stílusok alapértelmezett betöltése
    add_theme_support('wp-block-styles');
    // Széles és teljes szélességű képek engedélyezése
    add_theme_support('align-wide');
    // Saját CSS fájl betöltése a frontend oldalon
    add_action('wp_enqueue_scripts','minimal_theme_enqueue_styles');
}

add_action('after_setup_theme','minimal_theme_setup');

function minimal_theme_enqueue_styles() {
    wp_enqueue_style( 
        'minimal-theme-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );
}

function footer_shortcode() {
    global $w_status_line;

    $kimenet="";
    if (isset($w_status_line)) {
      $kimenet=$w_status_line;
    }
    return $kimenet;
}
add_shortcode('wswdteam_footer','footer_shortcode');

function header_shortcode_title() {
    global $w_header_title;

    $kimenet='';
    if (isset($w_header_title)) {
      $kimenet='<h2 style=text-align:right;>'.$w_header_title.'</h2>';
    }
    return $kimenet;
}
add_shortcode('wswdteam_title','header_shortcode_title');


// saját logo a login oldalra
function ws_login_logo() {
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
add_action('login_enqueue_scripts','ws_login_logo');

// A logó linkjének módosítása a saját oldaladra
function ws_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl','ws_login_logo_url');


// fejléc logo kicserélése
add_filter('render_block',function($block_content,$block){
    global $w_applogo;
    // Csak kép blokkoknál futtatjuk a keresést
    if (isset($block['blockName']) && $block['blockName'] === 'core/image'){
        // Megnézzük, hogy a legenerált HTML-ben benne van-e az alt="ws-logo"
        if (strpos($block_content,'alt="ws-logo"') !== false){
            $new_image_url=$w_applogo;
            // Kicseréljük az src-t
            $block_content=preg_replace('/src="([^"]*)"/','src="'.$new_image_url.'"',$block_content);
            // Töröljük a srcset-et és a sizes-t, hogy ne zavarja be a régi kép
            $block_content=preg_replace('/srcset="([^"]*)"/','',$block_content);
            $block_content=preg_replace('/sizes="([^"]*)"/','',$block_content);
            // Opcionális: lekerekítés hozzáadása közvetlenül a stílushoz
            $block_content=str_replace('<img ','<img style="height:150px;border-radius:15px;" ',$block_content);
        }
    }
    return $block_content;
}, 10, 2);


// favicon csere
add_filter('get_site_icon_url','wswd_custom_favicon',10,1);
function wswd_custom_favicon( $url ) {
    global $w_applogo;
    // A logó elérési útja a témád mappáján belül
    //return get_stylesheet_directory_uri().'/assets/images/wswd-favicon.png';
    return $w_applogo;
}


?>
