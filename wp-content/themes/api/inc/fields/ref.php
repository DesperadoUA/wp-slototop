<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'ref' );
function ref() {
    $arrPostTypes = ['casino', 'poker', 'bonus'];
    Container::make( 'post_meta', __( 'Ref' ) )
    ->show_on_post_type($arrPostTypes)
    ->add_fields(array(
        Field::make( 'complex', FIELDS_KEY['REF'], 'Ref')
        ->add_fields( array(
                Field::make('text', 'ref_link', 'Реферальные ссылки'),
            )
        )
    ));
}