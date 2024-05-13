<?php
if($post_id === 0) $response['confirm'] = 'error';
else{
    $response['confirm'] = 'ok';
    $response['body'] = get_single_game_data($post_id);
}
echo json_encode($response);