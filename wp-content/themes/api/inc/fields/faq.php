<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'faq' );
function faq() {
    Container::make( 'post_meta', 'FAQ' ) 
    ->show_on_post_type(['casino','poker']) 
    ->add_fields( array(
        Field::make( 'complex', FIELDS_KEY['FAQ'] ) 
            ->add_fields( array( 
                Field::make( 'text', 'value_1', 'Вопрос'), 
                Field::make( 'textarea', 'value_2', 'Ответ'), 
            )), 
    ));
}