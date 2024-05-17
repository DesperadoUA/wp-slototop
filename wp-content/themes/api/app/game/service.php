<?php
namespace game\service;
use BaseService;

class Service extends BaseService {
    public $postType = 'game';
    function meta() {
        return [
            'slug'       => $this->postType,
            'post_type'  => $this->postType,
            'banner'     => (string)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['BANNER']),
            'jackpot'    => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['JACKPOT']),
            'risk_game'  => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RISK_GAME']),
            'max_gain'   => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['MAX_GAIN']),
            'max_bet'    => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['MAX_BET']),
            'min_bet'    => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['MIN_BET']),
            'iframe'     => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['IFRAME']),
            'rating'     => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RATING']),
            'gallery'    => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['GALLERY']),
            'characters' => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['CHARACTERS']),
            'details'    => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['DETAILS']),
        ];
    }
    function relative() {
        $casinoIds = get_public_post_id_by_rating('casino', 5);
        $gameIds = get_public_post_id_by_rating('slot', 5, [$this->currentPost->ID]);
        return [
            'vendor' => get_vendor_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_VENDOR'])),
            'casino' => get_casino_card_data($casinoIds),
            'games'  => get_slot_card_data($gameIds),
        ];
    }
}
