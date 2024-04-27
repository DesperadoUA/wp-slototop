<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'details' );
function details() {
    Container::make( 'post_meta', 'Details' ) 
    ->show_on_post_type(['slot']) 
    ->add_fields( array(
        Field::make( 'complex', 'details' ) 
            ->add_fields( array( 
                Field::make( 'text', 'value_1', 'Характеристика'), 
                Field::make( 'text', 'value_2', 'Описание'), 
            )), 
    ));
}