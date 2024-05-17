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
add_theme_support( 'post-thumbnails' );
add_theme_support('menus');
add_filter('wp_insert_post_data', function ($data, $postarr) { $data['post_content'] = wpautop($data['post_content']); return $data; }, 10, 2);
define('APP_DIR', __DIR__.'/app/');
define('DEFAULT_META_SETTINGS', [
    'classification' => 'онлайн казино',
    'distribution'   => 'Ukraine',
    'author'         => 'onlinecasino.in.ua',
    'creator'        => 'onlinecasino.in.ua',
    'copyright'      => 'onlinecasino.in.ua',
    'publisher'      => 'onlinecasino.in.ua',
    'placename'      => 'вулиця Жилянська, 30-32, Київ, Украина, 02000',
    'position'       => '30.5108240;50.4345170',
    'region'         => 'UA-город Киев',
    'ICBM'           => '30.5108240, 50.4345170',
    'robots'         => 'index, follow'
]);