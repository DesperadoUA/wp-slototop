<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/vendor/service.php';
use vendor\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(2993);
$response['body'] = $post->show();
echo json_encode($response);