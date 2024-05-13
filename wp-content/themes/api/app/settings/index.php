<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include APP_DIR.'functions.php';
$response['status'] = SUCCESS_STATUS;
$response['body'] = getSettings();
echo json_encode($response);