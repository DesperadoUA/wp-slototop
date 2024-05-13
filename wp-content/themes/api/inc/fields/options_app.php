<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options():void {
    Container::make( 'theme_options', __( 'Options' ) )
        ->add_fields(array(
            Field::make('image', OPTIONS_KEYS['LOGO'], 'Logo')->set_value_type( 'url' ),
            Field::make( 'complex', OPTIONS_KEYS['GLOBAL_REF'], 'Global Ref')
                ->add_fields( array(
                        Field::make('text', 'link', 'Реферальная ссылка'),
                    )
                )
        ));
}