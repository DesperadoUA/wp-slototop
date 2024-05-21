<?php
namespace payment\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'payment';
    function meta(): array {
        return [
            'slug'              => $this->postType,
            'post_type'         => $this->postType,
            'site'              => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['SITE']),
            'commission'        => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['COMMISSION']),
            'withdrawal'        => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['WITHDRAWAL']),
            'withdrawal_period' => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['WITHDRAWAL_PERIOD']),
        ];
    }
    function relative(): array {
        return [
            'casino'       => get_casino_card_data(Relative::getRelativeOrderByRating($this->currentPost->ID, 'casino', FIELDS_KEY['RELATIVE_PAYMENT'])),
            'currency'     => get_currency_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_CURRENCY'])),
            'type_payment' => get_type_payment_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_TYPE_PAYMENT'])),
        ];
    }
}
