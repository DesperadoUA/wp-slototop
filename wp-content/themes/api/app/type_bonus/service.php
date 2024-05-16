<?php
namespace type_bonus\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'type_bonus';
    function meta() {
        return [
            'slug'      => $this->postType,
            'post_type' => $this->postType,
            'sub_title' => carbon_get_post_meta($this->currentPost->ID, 'sub_title'),
        ];
    }
    function relative() {
        return [
            'posts' => get_bonus_card_data(Relative::getRelative($this->currentPost->ID, 'bonus', 'relative_type_bonus')),
        ];
    }
}
