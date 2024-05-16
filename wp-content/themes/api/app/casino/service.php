<?php
namespace casino\service;
use BaseService;

class Service extends BaseService {
    public $postType = 'casino';
    function meta() {
        return [
            'slug'                 => $this->postType,
            'post_type'            => $this->postType,
            'close'                => (int)carbon_get_post_meta($this->currentPost->ID, 'close'),
            'rating'               => (int)carbon_get_post_meta($this->currentPost->ID, 'rating'),
            'phone'                => (string)carbon_get_post_meta($this->currentPost->ID, 'phone'),
            'min_deposit'          => (string)carbon_get_post_meta($this->currentPost->ID, 'min_deposit'),
            'min_payments'         => (string)carbon_get_post_meta($this->currentPost->ID, 'min_payments'),
            'email'                => (string)carbon_get_post_meta($this->currentPost->ID, 'email'),
            'chat'                 => (string)carbon_get_post_meta($this->currentPost->ID, 'chat'),
            'year'                 => (string)carbon_get_post_meta($this->currentPost->ID, 'year'),
            'site'                 => (string)carbon_get_post_meta($this->currentPost->ID, 'site'),
            'withdrawal'           => (string)carbon_get_post_meta($this->currentPost->ID, 'withdrawal'),
            'number_games'         => (string)carbon_get_post_meta($this->currentPost->ID, 'number_games'),
            'reliability'          => (int)carbon_get_post_meta($this->currentPost->ID, 'reliability'),
            'convenience_payments' => (int)carbon_get_post_meta($this->currentPost->ID, 'convenience_payments'),
            'interface'            => (int)carbon_get_post_meta($this->currentPost->ID, 'interface'),
            'support'              => (int)carbon_get_post_meta($this->currentPost->ID, 'support'),
            'popularity'           => (int)carbon_get_post_meta($this->currentPost->ID, 'popularity'),
            'shares'               => (int)carbon_get_post_meta($this->currentPost->ID, 'shares'),
            'promocod'             => (string)carbon_get_post_meta($this->currentPost->ID, 'promocod'),
            'faq'                  => carbon_get_post_meta($this->currentPost->ID, 'faq'),
            'ref'                  => postRefAdapter(carbon_get_post_meta($this->currentPost->ID, 'ref')),
            'reviews'              => carbon_get_post_meta($this->currentPost->ID, 'reviews')
        ];
    }
    function relative() {
        $casinoIds = get_public_post_id_by_rating('casino', 5);
        $sidebarCasinoIds = get_public_post_id_by_rating('casino', 10);
        $sidebarBonusIds = get_public_post_id('bonus', 5);
        $sidebarSlotIds = get_public_post_id_by_rating('slot', 5);
        return [
            'vendors'      => get_vendor_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_vendor')),
            'type_payment' => get_type_payment_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_type_payment')),
            'technology'   => get_technology_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_technology')),
            'payments'     => get_payment_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_payment')),
            'licenses'     => get_license_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_license')),
            'language'     => get_language_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_language')),
            'currency'     => get_currency_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_currency')),
            'country'      => get_country_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_country')),
            'bonuses'      => get_bonus_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_bonus')),
            'casino'       => get_casino_card_data($casinoIds),
            'sidebar'      => [
                'casino'  => get_casino_sidebar_card_data($sidebarCasinoIds),
                'bonuses' => get_bonus_card_data($sidebarBonusIds),
                'games'   => get_slot_card_data($sidebarSlotIds)
            ]
        ];
    }
}
