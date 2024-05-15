<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/technology/service.php';
use technology\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(2457);
$response['body'] = $post->show();
echo json_encode($response);