<?php
namespace type_payment\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'type_payment';
    function show() {
        return array_merge($this->commonData(), $this->meta(), $this->relative());
    }
    function meta() {
        return [
            'slug'      => $this->postType,
            'post_type' => $this->postType,
            'sub_title' => carbon_get_post_meta($this->currentPost->ID, 'sub_title'),
        ];
    }
    function relative() {
        return [
            'posts' => get_payment_card_data(Relative::getRelative($this->currentPost->ID, 'payment', 'relative_type_payment')),
        ];
    }
}
