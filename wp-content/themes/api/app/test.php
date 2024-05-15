<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/language/service.php';
use language\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(2153);
$response['body'] = $post->show();
echo json_encode($response);