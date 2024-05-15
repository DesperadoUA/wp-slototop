<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/type_bonus/service.php';
use type_bonus\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(2469);
$response['body'] = $post->show();
echo json_encode($response);