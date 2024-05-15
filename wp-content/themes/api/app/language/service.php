<?php
namespace language\service;
use BaseService;
use Relative;

class Service extends BaseService {
    public $postType = 'lang';
    function show() {
        return array_merge($this->commonData(), $this->meta(), $this->relative());
    }
    function meta() {
        return [
            'slug'      => $this->postType,
            'post_type' => $this->postType,
            'sub_title' => carbon_get_post_meta($this->currentPost->ID, 'sub_title'),
        ];
    }
    function relative() {
        return [
            'casino'  => get_casino_card_data(Relative::getRelativeOrderByRating($this->currentPost->ID, 'casino', 'relative_language')),
        ];
    }
}
