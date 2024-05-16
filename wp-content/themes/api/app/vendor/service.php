<?php
namespace vendor\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'vendor';
    function meta() {
        return [
            'slug'         => $this->postType,
            'post_type'    => $this->postType,
            'year'         => carbon_get_post_meta($this->currentPost->ID, 'year'),
            'rating'       => (int)carbon_get_post_meta($this->currentPost->ID, 'rating'),
            'license'      => carbon_get_post_meta($this->currentPost->ID, 'license'),
            'number_games' => carbon_get_post_meta($this->currentPost->ID, 'number_games'),
        ];
    }
    function relative() {
        return [
            'games'   => get_slot_card_data(Relative::getRelativeOrderByRating($this->currentPost->ID, 'slot', 'relative_vendor')),
            'casino'  => get_casino_card_data(Relative::getRelativeOrderByRating($this->currentPost->ID, 'casino', 'relative_vendor')),
            'country' => get_country_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_country')),
        ];
    }
}
