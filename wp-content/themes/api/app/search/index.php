<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
$response['confirm'] = SUCCESS_STATUS;
$search_word = $_POST['search_word'];
$response['body']['posts'] = search($search_word);
echo json_encode($response);