<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'relative_license' );
function relative_license():void {
    $arrPostTypes = ['casino', 'poker'];
    $posts = get_posts( array(
        'numberposts' => -1,
        'orderby'     => 'date',
        'order'       => 'DESC',
        'include'     => array(),
        'exclude'     => array(),
        'meta_key'    => '',
        'meta_value'  => '',
        'post_type'   => 'license',
        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        ) );

        $data = [];
        foreach ($posts as $item) $data[$item->ID] = $item->post_title;

        Container::make( 'post_meta', __( 'Relative License' ) )
            ->show_on_post_type($arrPostTypes)
            ->add_fields(array(
                Field::make('multiselect', FIELDS_KEY['RELATIVE_LICENSE'], 'Список лицензий')
                    ->add_options($data)
        ));
}
