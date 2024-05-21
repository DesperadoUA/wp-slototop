<?php
namespace language\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'lang';
    function meta(): array {
        return [
            'slug'      => $this->postType,
            'post_type' => $this->postType,
            'sub_title' => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['SUB_TITLE']),
        ];
    }
    function relative(): array {
        return [
            'casino' => get_casino_card_data(Relative::getRelativeOrderByRating($this->currentPost->ID, 'casino', FIELDS_KEY['RELATIVE_LANGUAGE'])),
        ];
    }
}
