<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/casino/service.php';
use casino\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(738);
$response['body'] = $post->show();
echo json_encode($response);