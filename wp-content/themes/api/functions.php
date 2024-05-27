<?php
include 'inc/utils.php';
const ROOT_DIR = __DIR__;
const POSTS_SLUG = [
    'casino'       => 'casino', 
    'slot'         => 'game', 
    'bonus'        => 'bonus', 
    'country'      => 'country',
    'currency'     => 'currency',
    'language'     => 'lang', 
    'license'      => 'license', 
    'payment'      => 'payment', 
    'poker'        => 'poker', 
    'technology'   => 'technology',
    'type_bonus'   => 'type-bonus', 
    'type_payment' => 'type-payment', 
    'vendor'       => 'vendor'
];
define('ALL_POST_TYPES', array_merge(['posts', 'page'], array_keys(POSTS_SLUG)));
const ALL_TAXONOMIES = ['slot-tax'];
const SUCCESS_STATUS = 'ok';
const ERROR_STATUS = 'error';
define('HOST_URL', get_site_url( null, '', 'https' ));
define('DEFAULT_IMG', HOST_URL.'/wp-content/themes/api/assets/img/default.jpg');
include 'inc/headers.php';
include 'inc/post_types/index.php';
include 'inc/taxonomy/slot.php';
include 'inc/fields/index.php';
include 'inc/relatives/index.php';
define('AUTHOR_PAGE_ID', url_to_post_id('author', 'page'));
define('CASINO_PAGE_ID', url_to_post_id('casino', 'page'));
define('BONUSES_PAGE_ID', url_to_post_id('bonuses', 'page'));
define('GAMES_PAGE_ID', url_to_post_id('games', 'page'));
define('VENDORS_PAGE_ID', url_to_post_id('vendors', 'page'));
define('PAYMENTS_PAGE_ID', url_to_post_id('payments', 'page'));
define('POKER_PAGE_ID', url_to_post_id('poker', 'page'));
define('SITEMAP_PAGE_ID', url_to_post_id('sitemap', 'page'));
define('MAIN_PAGE_ID', get_option('page_on_front'));
add_theme_support( 'post-thumbnails' );
add_theme_support('menus');
add_filter('wp_insert_post_data', function ($data, $postarr) { 
    $data['post_content'] = wpautop($data['post_content']); 
    return $data; }, 
    10, 2);
const APP_DIR = __DIR__ . '/app/';