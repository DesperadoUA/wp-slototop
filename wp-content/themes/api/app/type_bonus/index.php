<?php
$post_id = url_to_post_id($_POST['url'], $_POST['type']);
if($post_id === 0) $response['status'] = ERROR_STATUS;
else{
    $response['status'] = SUCCESS_STATUS;
    $response['body'] = [];
}
echo json_encode($response);