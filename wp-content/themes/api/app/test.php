<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/country/service.php';
use country\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(2032);
$response['body'] = $post->show();
echo json_encode($response);