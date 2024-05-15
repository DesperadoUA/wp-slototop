<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/type_payment/service.php';
use type_payment\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(2481);
$response['body'] = $post->show();
echo json_encode($response);