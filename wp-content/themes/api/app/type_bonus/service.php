<?php
namespace type_bonus\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'type_bonus';
    function meta(): array {
        return [
            'slug'      => $this->postType,
            'post_type' => $this->postType,
            'sub_title' => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['SUB_TITLE']),
        ];
    }
    function relative(): array {
        $bonusTypeIds = get_public_post_id('type_bonus');
        return [
            'posts' => get_bonus_card_data(Relative::getRelative($this->currentPost->ID, 'bonus', FIELDS_KEY['RELATIVE_TYPE_BONUS'])),
            'bonus_type' => get_type_bonus_card_data($bonusTypeIds),
        ];
    }
}
