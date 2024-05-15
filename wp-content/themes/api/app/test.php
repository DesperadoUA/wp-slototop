<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/license/service.php';
use license\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(2180);
$response['body'] = $post->show();
echo json_encode($response);