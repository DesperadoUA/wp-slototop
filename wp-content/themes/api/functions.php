<?php
include 'inc/utils.php';
define('ROOT_DIR', __DIR__);
define('ALL_POST_TYPES', ['posts', 'page', 'casino', 'slot', 'bonus', 'country', 'currency', 'language', 'license', 'payment', 'poker', 'technology', 'type_bonus', 'type_payment', 'vendor']);
define('SUCCESS_STATUS', 'ok');
define('ERROR_STATUS', 'error');
define('HOST_URL', get_site_url( null, '', 'https' ));
include 'inc/headers.php';
include 'inc/post_types/index.php';
include 'inc/fields/index.php';
include 'inc/relatives/index.php';
define('AUTHOR_PAGE_ID', url_to_post_id('author', 'page'));
define('CASINO_PAGE_ID', url_to_post_id('casino', 'page'));
define('BONUSES_PAGE_ID', url_to_post_id('bonuses', 'page'));
define('GAMES_PAGE_ID', url_to_post_id('games', 'page'));
define('VENDORS_PAGE_ID', url_to_post_id('vendors', 'page'));
define('PAYMENTS_PAGE_ID', url_to_post_id('payments', 'page'));
define('MAIN_PAGE_ID', get_option('page_on_front'));
add_theme_support( 'post-thumbnails' );
add_theme_support('menus');
add_filter('wp_insert_post_data', function ($data, $postarr) { 
    $data['post_content'] = wpautop($data['post_content']); 
    return $data; }, 
    10, 2);
define('APP_DIR', __DIR__.'/app/');