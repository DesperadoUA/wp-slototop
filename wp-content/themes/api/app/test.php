<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
$response['confirm'] = SUCCESS_STATUS;
$response['body'] = getOptions();
echo json_encode($response);