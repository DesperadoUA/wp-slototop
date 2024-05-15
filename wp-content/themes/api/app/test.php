<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/poker/service.php';
use poker\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(2419);
$response['body'] = $post->show();
echo json_encode($response);