<?php
/**
 * Minimal Theme funkciók és beállítások
 */

global $wswdteam_status_line;
if (!isset($w_status_line)) {
  $w_status_line=date('Y.m.d.');
}
if ($w_status_line=="") {
  $w_status_line=date('Y.m.d.');
}

global $w_header_title;
if (!isset($w_header_title)) {
  $w_header_title=date('Y.m.d.');
}
if ($w_header_title=="") {
  $w_header_title=date('Y.m.d.');
}

global $w_credit;
if (!isset($w_credit)) {
  $w_credit=date('Y.m.d.');
}
if ($w_credit=="") {
  $w_credit=date('Y.m.d.');
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

function header_shortcode_title() {
    global $w_header_title;

    $kimenet='';
    if (isset($w_header_title)) {
      $kimenet='<h2>'.$w_header_title.'</h2>';
    }
    return $kimenet;
}
add_shortcode('wswdteam_header_title','header_shortcode_title');

function footer_shortcode_statusline() {
    global $w_status_line;

    $kimenet='';
    if (isset($w_status_line)) {
      $kimenet=$w_status_line;
    }
    return $kimenet;
}
add_shortcode('wswdteam_footer_statusline','footer_shortcode_statusline');

function footer_shortcode_credit() {
    global $w_credit;

    $kimenet='';
    if (isset($w_credit)) {
      $kimenet=$w_credit;
    }
    return $kimenet;
}
add_shortcode('wswdteam_footer_credit','footer_shortcode_credit');


// blokkok hozzáadása
require get_template_directory() . '/inc/block-patterns.php';


?>
