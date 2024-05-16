<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
include APP_DIR.'/game/service.php';
use game\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service(55644);
$response['body'] = $post->show();
echo json_encode($response);