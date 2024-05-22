<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
$response['status'] = SUCCESS_STATUS;
$response['body'] = getSettings();
echo json_encode($response);