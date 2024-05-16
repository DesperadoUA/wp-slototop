<?php
namespace game\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'game';
    function show() {
        return array_merge($this->commonData(), $this->meta(), $this->relative());
    }
    function meta() {
        return [
            'slug'       => $this->postType,
            'post_type'  => $this->postType,
            'banner'     => (string)carbon_get_post_meta($this->currentPost->ID, 'banner'),
            'jackpot'    => carbon_get_post_meta($this->currentPost->ID, 'jackpot'),
            'risk_game'  => carbon_get_post_meta($this->currentPost->ID, 'risk_game'),
            'max_gain'   => carbon_get_post_meta($this->currentPost->ID, 'max_gain'),
            'max_bet'    => carbon_get_post_meta($this->currentPost->ID, 'max_bet'),
            'min_bet'    => carbon_get_post_meta($this->currentPost->ID, 'min_bet'),
            'iframe'     => carbon_get_post_meta($this->currentPost->ID, 'iframe'),
            'rating'     => (int)carbon_get_post_meta($this->currentPost->ID, 'rating'),
            'gallery'    => carbon_get_post_meta($this->currentPost->ID, 'gallery'),
            'characters' => carbon_get_post_meta($this->currentPost->ID, 'characters'),
            'details'    => carbon_get_post_meta($this->currentPost->ID, 'details'),
        ];
    }
    function relative() {
        $casinoIds = get_public_post_id('casino', 5);
        $gameIds = get_public_post_id('slot', 5, [$this->currentPost->ID]);
        return [
            'vendor' => get_vendor_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_vendor')),
            'casino' => get_casino_card_data($casinoIds),
            'games'  => get_slot_card_data($gameIds),
        ];
    }
}
