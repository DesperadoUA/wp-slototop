<?php
include APP_DIR . '/slot_tax/service.php';
use slot_tax\service\Service;
$tax_id = get_term_by( 'slug', $_POST['url'], 'slot-tax' );
if (!$tax_id) $response['confirm'] = ERROR_STATUS;
else {
    $post = new Service($_POST['url'], 'slot-tax');
    $response['confirm'] = SUCCESS_STATUS;
    $response['body'] = $post->show();
}
echo json_encode($response);