<?php
namespace poker\service;
use BaseService;

class Service extends BaseService {
    public $postType = 'poker';
    function meta() {
        return [
            'slug'         => $this->postType,
            'post_type'    => $this->postType,
            'ref'          => postRefAdapter(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['REF'])),
            'phone'        => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['PHONE']),
            'faq'          => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['FAQ']),
            'rating'       => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RATING']),
            'min_deposit'  => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['MIN_DEPOSIT']),
            'min_payments' => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['MIN_PAYMENTS']),
            'email'        => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['EMAIL']),
            'year'         => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['YEAR']),
            'site'         => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['SITE']),
            'withdrawal'   => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['WITHDRAWAL']),
            'rakeback'     => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RAKEBACK']),
            'reviews'      => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['REVIEWS']),
        ];
    }
    function relative() {
        return [
            'type_payment' => get_type_payment_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_TYPE_PAYMENT'])),
            'technology'   => get_technology_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_TECHNOLOGY'])),
            'payments'     => get_payment_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_PAYMENT'])),
            'licenses'     => get_license_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_LICENSE'])),
            'language'     => get_language_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_LANGUAGE'])),
            'currency'     => get_currency_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_CURRENCY'])),
            'country'      => get_country_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_COUNTRY'])),
            'pokers'       => get_poker_card_data(get_public_post_id_by_rating('poker', 5, [$this->currentPost->ID]))
        ];
    }
}
