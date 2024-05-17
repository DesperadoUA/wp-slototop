<?php
namespace bonus\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'bonus';
    function meta() {
        $casinoIds = carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_CASINO']);
        $thumbnail = !empty($casinoIds) ? get_the_post_thumbnail_url($casinoIds[0], 'full') : '';
        return [
            'slug'        => $this->postType,
            'post_type'   => $this->postType,
            'ref'         => postRefAdapter(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['REF'])),
            'close'       => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['CLOSE']),
            'wager'       => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['WAGER']),
            'number_use'  => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['NUMBER_USE']),
            'value_bonus' => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['VALUE_BONUS']),
            'thumbnail'   => $thumbnail,
        ];
    }
    function relative() {
        $casinoIds = carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_CASINO']);
        $bonusesIds = !empty($casinoIds) ? Relative::getAllBonusesCasino($casinoIds[0]) : [];
        $currentBonusesIds = [];
        foreach($bonusesIds as $item) {
            if($item !== $this->currentPost->ID) {
                $currentBonusesIds[] = $item;
            }
        }
        return [
            'casino'     => get_casino_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_CASINO'])),
            'type_bonus' => get_type_bonus_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_TYPE_BONUS'])),
            'country'    => get_country_card_data(carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['RELATIVE_COUNTRY'])),
            'bonuses'    => get_bonus_card_data($currentBonusesIds)
        ];
    }
}
