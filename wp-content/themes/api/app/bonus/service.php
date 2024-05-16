<?php
namespace bonus\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'bonus';
    function meta() {
        $casinoIds = carbon_get_post_meta($this->currentPost->ID, 'relative_casino');
        $thumbnail = !empty($casinoIds) ? get_the_post_thumbnail_url($casinoIds[0], 'full') : '';
        return [
            'slug'        => $this->postType,
            'post_type'   => $this->postType,
            'ref'         => postRefAdapter(carbon_get_post_meta($this->currentPost->ID, 'ref')),
            'close'       => (int)carbon_get_post_meta($this->currentPost->ID, 'close'),
            'wager'       => carbon_get_post_meta($this->currentPost->ID, 'wager'),
            'number_use'  => carbon_get_post_meta($this->currentPost->ID, 'number_use'),
            'value_bonus' => carbon_get_post_meta($this->currentPost->ID, 'value_bonus'),
            'thumbnail'   => $thumbnail
        ];
    }
    function relative() {
        $casinoIds = carbon_get_post_meta($this->currentPost->ID, 'relative_casino');
        $bonusesIds = !empty($casinoIds) ? Relative::getAllBonusesCasino($casinoIds[0]) : [];
        return [
            'casino'     => get_casino_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_casino')),
            'type_bonus' => get_type_bonus_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_type_bonus')),
            'country'    => get_country_card_data(carbon_get_post_meta($this->currentPost->ID, 'relative_country')),
            'bonuses'    => get_bonus_card_data($bonusesIds)
        ];
    }
}
