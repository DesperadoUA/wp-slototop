<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
/* test */
$controllers = [
    'page' => 'pages/index.php',
    'settings' => 'settings/index.php',
    'options' => 'options/index.php',
    'casino' => 'casino/index.php',
    'game' => 'game/index.php',
    'vendor' => 'vendor/index.php',
    'payment' => 'payment/index.php',
    'bonus' => 'bonus/index.php',
    'poker' => 'poker/index.php',
    'country' => 'country/index.php',
    'currency' => 'currency/index.php',
    'language' => 'language/index.php',
    'license' => 'license/index.php',
    'technology' => 'technology/index.php',
    'type_payment' => 'type_payment/index.php',
    'type_bonus' => 'type_bonus/index.php'
];
if(key_exists($_POST['type'], $controllers)) {
    include $controllers[$_POST['type']];
} else {
    $response['status'] = ERROR_STATUS;
    echo json_encode($response);
}