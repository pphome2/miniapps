<?php
/**
 * Minimal Theme funkciók és beállítások
 */

global $status_line;
if (!isset($status_line)) {
  $status_line=date('Y.m.d.');
}
if ($status_line=="") {
  $status_line=date('Y.m.d.');
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
    global $status_line;

    $kimenet="";
    if (isset($status_line)) {
      $kimenet=$status_line;
    }
    return $kimenet;
}
add_shortcode('wswdteam_footer','footer_shortcode');


?>
