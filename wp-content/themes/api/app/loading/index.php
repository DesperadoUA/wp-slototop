<?php
$response['confirm'] = SUCCESS_STATUS;
$postType = $_POST['postType'];
$url = $_POST['url'];
if($postType === 'page') {
    if($url === 'casino') {
        $casinoIds = get_public_post_id_by_rating('casino', 150);
        $response['body']['posts'] = get_casino_card_data($casinoIds);
    }
    else if ($url === 'bonuses') {
        $bonusIds = get_public_post_id('bonus', 150);
        $response['body']['posts'] = get_bonus_card_data($bonusIds);
    }
    else if ($url === 'games') {
        $slotIds = get_public_post_id_by_rating('slot', 150);
        $response['body']['posts'] = get_slot_card_data($slotIds);
    }
    else if ($url === 'vendors') {
        $vendorsIds = get_public_post_id('vendor', 150);
        $response['body']['posts'] = get_vendor_card_data($vendorsIds);
    }
    else if ($url === 'payments') {
        $paymentsIds = get_public_post_id('payment', 150);
        $response['body']['posts'] = get_payment_card_data($paymentsIds);
    }
    else if ($url === 'poker') {
        $pokerIds = get_public_post_id_by_rating('poker', 150);
        $response['body']['posts'] = get_poker_card_data($pokerIds);
    }
}
else if ($postType === 'license') {
    $post_id = url_to_post_id($url, $postType);
    $response['body']['posts'] = get_casino_card_data(Relative::getRelativeOrderByRating($post_id, 'casino', FIELDS_KEY['RELATIVE_LICENSE']));
}
else if ($postType === 'country') {
    $post_id = url_to_post_id($url, $postType);
    $response['body']['posts'] = get_casino_card_data(Relative::getRelativeOrderByRating($post_id, 'casino', FIELDS_KEY['RELATIVE_COUNTRY']));
}
else if ($postType === 'lang') {
    $post_id = url_to_post_id($url, 'language');
    $response['body']['posts'] = get_casino_card_data(Relative::getRelativeOrderByRating($post_id, 'casino', FIELDS_KEY['RELATIVE_LANGUAGE']));
}
else if ($postType === 'payment') {
    $post_id = url_to_post_id($url, $postType);
    $response['body']['posts'] = get_casino_card_data(Relative::getRelativeOrderByRating($post_id, 'casino', FIELDS_KEY['RELATIVE_PAYMENT']));
}
else if ($postType === 'technology') {
    $post_id = url_to_post_id($url, $postType);
    $response['body']['posts'] = get_casino_card_data(Relative::getRelativeOrderByRating($post_id, 'casino', FIELDS_KEY['RELATIVE_TECHNOLOGY']));
}
else if ($postType === 'vendor') {
    $card = $_POST['card'];
    $post_id = url_to_post_id($url, $postType);
    if($card === 'slot') {
        $response['body']['posts'] = get_slot_card_data(Relative::getRelativeOrderByRating($post_id, 'slot', FIELDS_KEY['RELATIVE_VENDOR']));
    } elseif ($card === 'casino') {
        $response['body']['posts'] = get_casino_card_data(Relative::getRelativeOrderByRating($post_id, 'casino', FIELDS_KEY['RELATIVE_VENDOR']));
    }
}
else if ($postType === 'type-bonus') {
    $post_id = url_to_post_id($url, 'type_bonus');
    $response['body']['posts'] = get_bonus_card_data(Relative::getRelative($post_id, 'bonus', FIELDS_KEY['RELATIVE_TYPE_BONUS']));
}
else if ($postType === 'casino') {
    $post_id = url_to_post_id($url, 'casino');
    $response['body']['posts'] = carbon_get_post_meta($post_id, FIELDS_KEY['REVIEWS']);
}
else if ($postType === 'games') {
    $tax = get_term_by( 'slug', $url, 'slot-tax' );
    $settings = [
        'slug' => $tax->slug,
        'post_type' => 'slot',
        'taxonomy' => 'slot-tax'
    ];
    $response['body']['posts'] = get_slot_card_data(Relative::getPostsFromTaxByRating($settings));
}
else if ($postType === 'currency') {
    $post_id = url_to_post_id($url, $postType);
    $response['body']['posts'] = get_payment_card_data(Relative::getRelative($post_id, 'payment', FIELDS_KEY['RELATIVE_CURRENCY']));
}
else if ($postType === 'type-payment') {
    $post_id = url_to_post_id($url, 'type_payment');
    $response['body']['posts'] = get_payment_card_data(Relative::getRelative($post_id, 'payment', FIELDS_KEY['RELATIVE_TYPE_PAYMENT']));
}
echo json_encode($response);