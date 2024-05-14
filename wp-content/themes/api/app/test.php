<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/payment/service.php';
use payment\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(2215);
$response['body'] = $post->show();
echo json_encode($response);