<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'gallery' );
function gallery() {
    Container::make( 'post_meta', 'Gallery' ) 
    ->show_on_post_type(['slot']) 
    ->add_fields( array(
        Field::make( 'complex', 'gallery' ) 
            ->add_fields( array( 
                Field::make('image', 'src', 'Icon')->set_value_type( 'url' )->set_width( 33 ),
                Field::make( 'text', 'value_1', 'Alt')->set_width( 33 ), 
                Field::make( 'text', 'value_2', 'Title')->set_width( 33 ),  
            )), 
    ));
}