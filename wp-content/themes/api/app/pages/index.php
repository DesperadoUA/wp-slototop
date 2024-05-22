<?php
include APP_DIR.'/pages/service.php';
use pages\service\Service;
$post_id = $_POST['url'] === 'main' 
    ? MAIN_PAGE_ID 
    : url_to_post_id($_POST['url'], 'page'); 
if($post_id === 0) $response['confirm'] = ERROR_STATUS;
else{
    $page = new Service($post_id);
    $response['confirm'] = SUCCESS_STATUS;
    switch ($post_id) {
        case AUTHOR_PAGE_ID: {
            $response['body'] = $page->author();
            break;
        }
        case CASINO_PAGE_ID: {
            $response['body'] = $page->casino();
            break;
        }
        case BONUSES_PAGE_ID: {
            $response['body'] = $page->bonuses();
            break;
        }
        case VENDORS_PAGE_ID: {
            $response['body'] = $page->vendors();
            break;
        }
        case PAYMENTS_PAGE_ID: {
            $response['body'] = $page->payments();
            break;
        }
        case MAIN_PAGE_ID: {
            $response['body'] = $page->main();
            break;
        }
        case GAMES_PAGE_ID: {
            $response['body'] = $page->games();
            break;
        }
        case POKER_PAGE_ID: {
            $response['body'] = $page->poker();
            break;
        }
        default: {
            $response['body'] = $page->show();
        }
    }
}
echo json_encode($response);