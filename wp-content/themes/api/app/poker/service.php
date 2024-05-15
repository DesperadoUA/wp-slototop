<?php
namespace poker\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'poker';
    function show() {
        return array_merge($this->commonData(), $this->meta(), $this->relative());
    }
    function meta() {
        return [
            'slug'         => $this->postType,
            'post_type'    => $this->postType,
            'ref'          => postRefAdapter(carbon_get_post_meta($this->currentPost->ID, 'ref')),
            'phone'        => carbon_get_post_meta($this->currentPost->ID, 'phone'),
            'faq'          => carbon_get_post_meta($this->currentPost->ID, 'faq'),
            'rating'       => (int)carbon_get_post_meta($this->currentPost->ID, 'rating'),
            'min_deposit'  => carbon_get_post_meta($this->currentPost->ID, 'min_deposit'),
            'min_payments' => carbon_get_post_meta($this->currentPost->ID, 'min_payments'),
            'email'        => carbon_get_post_meta($this->currentPost->ID, 'email'),
            'year'         => carbon_get_post_meta($this->currentPost->ID, 'year'),
            'site'         => carbon_get_post_meta($this->currentPost->ID, 'site'),
            'withdrawal'   => carbon_get_post_meta($this->currentPost->ID, 'withdrawal'),
            'rakeback'     => carbon_get_post_meta($this->currentPost->ID, 'rakeback'),
            'reviews'      => carbon_get_post_meta($this->currentPost->ID, 'reviews'),
        ];
    }
    function relative() {
        return [
            'type_payment' => get_type_payment_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_type_payment')),
            'technology'   => get_technology_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_technology')),
            'payments'     => get_payment_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_payment')),
            'licenses'     => get_license_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_license')),
            'language'     => get_language_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_language')),
            'currency'     => get_currency_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_currency')),
            'country'      => get_country_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_country')),
            'pokers'       => get_poker_card_data(get_public_post_id('poker', 5, [$this->currentPost->ID]))
        ];
    }
}
