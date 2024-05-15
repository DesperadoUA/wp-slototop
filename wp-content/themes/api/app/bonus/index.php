<?php
include APP_DIR.'/bonus/service.php';
use bonus\service\Service;
$post_id = url_to_post_id($_POST['url'], $_POST['type']);
if($post_id === 0) $response['status'] = ERROR_STATUS;
else{
    $post = new Service($post_id);
    $response['status'] = SUCCESS_STATUS;
    $response['body'] = $post->show();
}
echo json_encode($response);