<?php
namespace payment\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'payment';
    function show() {
        return array_merge($this->commonData(), $this->meta(), $this->relative());
    }
    function meta() {
        return [
            'slug'              => $this->postType,
            'post_type'         => $this->postType,
            'site'              => carbon_get_post_meta($this->currentPost->ID, 'site'),
            'commission'        => carbon_get_post_meta($this->currentPost->ID, 'commission'),
            'withdrawal'        => carbon_get_post_meta($this->currentPost->ID, 'withdrawal'),
            'withdrawal_period' => carbon_get_post_meta($this->currentPost->ID, 'withdrawal_period'),
        ];
    }
    function relative() {
        return [
            'casino'       => get_casino_card_data(Relative::getRelativeOrderByRating($this->currentPost->ID, 'casino', 'relative_payment')),
            'currency'     => get_currency_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_currency')),
            'type_payment' => get_type_payment_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_type_payment')),
        ];
    }
}
