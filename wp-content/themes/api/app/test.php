<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/pages/service.php';
use pages\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(PAYMENTS_PAGE_ID);
$response['body'] = $post->payments();
echo json_encode($response);