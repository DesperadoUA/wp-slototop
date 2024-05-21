<?php
namespace vendor\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'vendor';
    function meta(): array {
        return [
            'slug'         => $this->postType,
            'post_type'    => $this->postType,
            'year'         => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['YEAR']),
            'rating'       => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RATING']),
            'license'      => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['LICENSE']),
            'number_games' => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['NUMBER_GAMES']),
        ];
    }
    function relative(): array {
        return [
            'games'   => get_slot_card_data(Relative::getRelativeOrderByRating($this->currentPost->ID, 'slot', FIELDS_KEY['RELATIVE_VENDOR'])),
            'casino'  => get_casino_card_data(Relative::getRelativeOrderByRating($this->currentPost->ID, 'casino', FIELDS_KEY['RELATIVE_VENDOR'])),
            'country' => get_country_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_COUNTRY'])),
        ];
    }
}
