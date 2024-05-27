<?php
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
include 'functions.php';
/*
include APP_DIR.'/slot_tax/service.php';
use slot_tax\service\Service;
$response['confirm'] = SUCCESS_STATUS;
$post = new Service('ruletki', 'slot-tax');
$response['body'] = $post->show();
echo json_encode($response);
*/
// Cash::store('pages', 'payments', "test page casino");
// Cash::get('slots-city');

echo "<pre>";
var_dump(Cash::get('slots-city'));
echo "</pre>";
