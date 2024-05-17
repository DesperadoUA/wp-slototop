<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/bonus/service.php';
use bonus\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(1814);
$response['body'] = $post->show();
echo json_encode($response);