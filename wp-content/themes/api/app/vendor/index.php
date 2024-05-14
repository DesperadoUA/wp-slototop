<?php
include APP_DIR.'/vendor/service.php';
use vendor\service\Service;
$post_id = url_to_post_id($_POST['url'], $_POST['type']);
if($post_id === 0) $response['status'] = ERROR_STATUS;
else{
    $response['status'] = SUCCESS_STATUS;
    $post = new Service($post_id);
    $response['body'] = $post->show();
}
echo json_encode($response);