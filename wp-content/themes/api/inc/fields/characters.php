<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'characters' );
function characters() {
    Container::make( 'post_meta', 'Characters' ) 
    ->show_on_post_type(['slot']) 
    ->add_fields( array(
        Field::make( 'complex', FIELDS_KEY['CHARACTERS'] ) 
            ->add_fields( array( 
                Field::make('image', 'src', 'Icon')->set_value_type( 'url' )->set_width( 25 ),
                Field::make( 'text', 'value_1', 'Характеристика')->set_width( 25 ), 
                Field::make( 'text', 'value_2', 'Характеристика')->set_width( 25 ), 
                Field::make( 'text', 'value_3', 'Характеристика')->set_width( 25 ), 
            )), 
    ));
}