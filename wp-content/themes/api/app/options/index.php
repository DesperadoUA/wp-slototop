<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include  APP_DIR.'functions.php';
$response['main_page_text'] = carbon_get_theme_option('main_page_text');
$response['footer_text'] = carbon_get_theme_option( 'footer_text' );
$response['footer_desc'] = carbon_get_theme_option( 'footer_desc' );
$response['logo'] = carbon_get_theme_option( 'logo' );
$response['partners'] = carbon_get_theme_option( 'partners' );
$response['footer_menu'] = get_menu('footer_menu');
$response['header_menu'] = carbon_get_theme_option('header_menu');
$response['filters']['currency_filters']  = array_values(include(ROOT_DIR.'/configs/currency.php'));
$response['filters']['vendors_filters']   = array_values(include(ROOT_DIR.'/configs/vendors.php'));
$response['filters']['languages_filters'] = array_values(include(ROOT_DIR.'/configs/languages.php'));
$response['filters']['payments_filters']  = array_values(include(ROOT_DIR.'/configs/payment.php'));
echo json_encode($response);