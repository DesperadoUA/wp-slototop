<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/currency/service.php';
use currency\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(2120);
$response['body'] = $post->show();
echo json_encode($response);