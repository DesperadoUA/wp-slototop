<?php
include APP_DIR.'/game/service.php';
use game\service\Service;
$post_id = url_to_post_id($_POST['url'], 'slot');
if($post_id === 0) $response['confirm'] = ERROR_STATUS;
else{
    $post = new Service($post_id);
    $response['confirm'] = SUCCESS_STATUS;
    $response['body'] = $post->show();
}
echo json_encode($response);