<?php

// segéd függvények

// kilépés ha nem wp-ből lett indítva
if (!defined('ABSPATH')){
  exit;
}


// matematikai "nem vagyok robot"

/**
 * 1. TITKOS URL ELLENŐRZÉSE (GET kérés)
 * Ez fut le legelőször, amikor valaki csak beírja a címet.
 */
function sajt_titkos_kapu_ellenorzes() {
    $kulcs='bejarat';
    $ertek='szezamtárulj';

    global $pagenow;

    // Csak a wp-login.php oldalon vizsgálódunk
    if ($pagenow=='wp-login.php') {
        // Ha épp bejelentkezni próbál (POST), azt engedjük tovább a matek ellenőrzőhöz
        if ($_SERVER['REQUEST_METHOD']==='POST') return;
        // Kivételek (kijelentkezés)
        if (isset($_GET['action']) && $_GET['action']=='logout') return;
        if (isset($_GET['loggedout'])) return;

        // Ha nincs ott a titkos kulcs a böngészősávban, irány a főoldal
        if (!isset($_GET[$kulcs]) || $_GET[$kulcs] !== $ertek) {
            wp_redirect(home_url());
            exit;
        }
    }
}
// Az 'init' hook biztosítja, hogy a redirect még azelőtt lefusson, hogy bármi megjelenne
add_action('init','sajt_titkos_kapu_ellenorzes');


/**
 * 2. MATEMATIKAI CAPTCHA ELLENŐRZÉSE (POST kérés)
 */
function sajt_math_verify($user) {
    if ($_SERVER['REQUEST_METHOD']==='POST') {
        $expected=get_transient('login_captcha_res');
        if (!isset($_POST['math_captcha']) || $_POST['math_captcha'] != $expected) {
            $str='<strong>'.wswdteam_lang('HIBA').': '.wswdteam_lang('Helytelen matematikai válasz').'.';
            return new WP_Error('captcha_wrong',$str);
        }
    }
    return $user;
}
add_filter('wp_authenticate_user','sajt_math_verify',10,1);


/**
 * 3. MATEK MEZŐ MEGJELENÍTÉSE
 */
function sajt_math_form_field() {
    $num1=rand(5, 10);
    $num2=rand(1, 5);
    $res=$num1+$num2; // Itt egyszerűség kedvéért +, de mehet bele a korábbi switch is

    set_transient('login_captcha_res',$res,600); 
    ?>
    <p>
        <label> <?php echo wswdteam_lang('Biztonsági kérdés').': '."$num1+$num2"; ?> = ?</label>
        <input type="number" name="math_captcha" class="input" required />
    </p>
    <?php
}
add_action('login_form','sajt_math_form_field');

/**
 * 4. LOGIN URL JAVÍTÁSA
 */
add_filter('login_url',function($url) {
    return add_query_arg(array('bejarat'=>'szezamtárulj'),$url);
},10,1);


/**
 * WORDPRESS VERZIÓSZÁM ELREJTÉSE
 */

// 1. A generátor meta tag eltávolítása a <head>-ből
remove_action('wp_head', 'wp_generator');

// 2. A verziószám eltávolítása az RSS feedekből
add_filter('the_generator', '__return_empty_string');

// 3. A verziószám eltávolítása a betöltött CSS és JS fájlok végéről
function remove_version_from_scripts($src) {
    if (strpos($src, 'ver=' . get_bloginfo('version'))) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'remove_version_from_scripts', 9999);
add_filter('script_loader_src', 'remove_version_from_scripts', 9999);


// REST API felhasználói lista letiltása (hogy ne tudják meg a login nevedet)
add_filter('rest_endpoints', function($endpoints) {
    if (isset($endpoints['/wp/v2/users'])) {
        unset($endpoints['/wp/v2/users']);
    }
    if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
        unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints;
});

?>
