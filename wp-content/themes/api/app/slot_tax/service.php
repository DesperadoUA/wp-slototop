<?php
namespace slot_tax\service;
use BaseServiceTaxonomy;
use Relative;
class Service extends BaseServiceTaxonomy
{
    public string $postType = 'game/category';
    function meta(): array {
        return [
            'slug'         => $this->postType,
            'post_type'    => $this->postType,
        ];
    }
    function relative(): array
    {
        $settings = [
            'slug' => $this->currentTax->slug,
            'post_type' => 'slot',
            'taxonomy' => $this->taxonomy
        ];
        return [
            'posts' => get_slot_card_data(Relative::getPostsFromTaxByRating($settings))
        ];
    }
}
