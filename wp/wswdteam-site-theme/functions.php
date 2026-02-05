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



?>
