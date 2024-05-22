<?php
include APP_DIR.'/type_payment/service.php';
use type_payment\service\Service;
$post_id = url_to_post_id($_POST['url'], 'type_payment');
if($post_id === 0) $response['confirm'] = ERROR_STATUS;
else{
    $post = new Service($post_id);
    $response['confirm'] = SUCCESS_STATUS;
    $response['body'] = $post->show();
}
echo json_encode($response);