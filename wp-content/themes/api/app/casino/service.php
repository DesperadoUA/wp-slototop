<?php
namespace casino\service;
use BaseService;

class Service extends BaseService {
    public $postType = 'casino';
    function meta() {
        return [
            'slug'                 => $this->postType,
            'post_type'            => $this->postType,
            'close'                => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['CLOSE']),
            'rating'               => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RATING']),
            'phone'                => (string)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['PHONE']),
            'min_deposit'          => (string)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['MIN_DEPOSIT']),
            'min_payments'         => (string)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['MIN_PAYMENTS']),
            'email'                => (string)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['EMAIL']),
            'chat'                 => (string)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['CHAT']),
            'year'                 => (string)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['YEAR']),
            'site'                 => (string)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['SITE']),
            'withdrawal'           => (string)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['WITHDRAWAL']),
            'number_games'         => (string)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['NUMBER_GAMES']),
            'reliability'          => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELIABILITY']),
            'convenience_payments' => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['CONVENIENCE_PAYMENTS']),
            'interface'            => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['INTERFACE']),
            'support'              => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['SUPPORT']),
            'popularity'           => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['POPULARITY']),
            'shares'               => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['SHARES']),
            'promocod'             => (string)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['PROMOCOD']),
            'faq'                  => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['FAQ']),
            'ref'                  => postRefAdapter(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['REF'])),
            'reviews'              => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['REVIEWS'])
        ];
    }
    function relative() {
        $casinoIds = get_public_post_id_by_rating('casino', 5);
        $sidebarCasinoIds = get_public_post_id_by_rating('casino', 10);
        $sidebarBonusIds = get_public_post_id('bonus', 5);
        $sidebarSlotIds = get_public_post_id_by_rating('slot', 5);
        return [
            'vendors'      => get_vendor_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_VENDOR'])),
            'type_payment' => get_type_payment_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_TYPE_PAYMENT'])),
            'technology'   => get_technology_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_TECHNOLOGY'])),
            'payments'     => get_payment_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_PAYMENT'])),
            'licenses'     => get_license_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_LICENSE'])),
            'language'     => get_language_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_LANGUAGE'])),
            'currency'     => get_currency_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_CURRENCY'])),
            'country'      => get_country_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_COUNTRY'])),
            'bonuses'      => get_bonus_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_BONUS'])),
            'casino'       => get_casino_card_data($casinoIds),
            'sidebar'      => [
                'casino'  => get_casino_sidebar_card_data($sidebarCasinoIds),
                'bonuses' => get_bonus_card_data($sidebarBonusIds),
                'games'   => get_slot_card_data($sidebarSlotIds)
            ]
        ];
    }
}
