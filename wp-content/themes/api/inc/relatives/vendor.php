<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'relative_vendor' );
function relative_vendor():void {
    $arrPostTypes = ['casino', 'slot'];
    $posts = get_posts( array(
        'numberposts' => -1,
        'orderby'     => 'date',
        'order'       => 'DESC',
        'include'     => array(),
        'exclude'     => array(),
        'meta_key'    => '',
        'meta_value'  => '',
        'post_type'   => 'vendor',
        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        ) );

        $data = [];
        foreach ($posts as $item) $data[$item->ID] = $item->post_title;

        Container::make( 'post_meta', __( 'Relative Vendor' ) )
            ->show_on_post_type($arrPostTypes)
            ->add_fields(array(
                Field::make('multiselect', FIELDS_KEY['RELATIVE_VENDOR'], 'Список производителей')
                    ->add_options($data)
        ));
}
