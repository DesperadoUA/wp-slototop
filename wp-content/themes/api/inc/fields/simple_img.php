<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;
add_action('carbon_fields_register_fields', 'img_fields');
function img_fields() {
    $data = [
        [
            'container_label' => 'Banner',
            'label' => 'Banner',
            'post_types' => ['slot'],
            'key' => 'banner',
            'editor' => 'image'
        ]
    ];
    foreach ($data as $item) {
        Container::make('post_meta', $item['container_label'])
        ->show_on_post_type($item['post_types'])
        ->add_fields(array(
            Field::make($item['editor'], $item['key'], $item['label'])->set_value_type( 'url' )
        ));
    }
}