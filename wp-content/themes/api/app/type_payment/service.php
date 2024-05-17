<?php
namespace type_payment\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'type_payment';
    function meta() {
        return [
            'slug'      => $this->postType,
            'post_type' => $this->postType,
            'sub_title' => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['SUB_TITLE']),
        ];
    }
    function relative() {
        return [
            'posts' => get_payment_card_data(Relative::getRelative($this->currentPost->ID, 'payment', FIELDS_KEY['RELATIVE_TYPE_PAYMENT'])),
        ];
    }
}
