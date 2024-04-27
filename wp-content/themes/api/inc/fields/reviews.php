<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'reviews' );
function reviews() {
    Container::make('post_meta', 'Reviews') 
        ->show_on_post_type(['casino', 'poker']) 
        ->add_fields(array( 
            Field::make( 'complex', 'reviews' ) 
            ->add_fields( array( 
                Field::make('text', 'review_name', 'Имя')->set_width( 33 ), 
                Field::make( 'text', 'review_rating', 'Рейтинг, мак 100')->set_width( 33 ), 
                Field::make( 'text', 'date', 'Дата')->set_width( 33 ), 
                Field::make( 'textarea', 'review_text', 'Текст')->set_width( 100 ) 
                ) 
            ) 
        ));
}