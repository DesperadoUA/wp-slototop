<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_settings' );
function crb_attach_theme_settings():void {
    Container::make( 'theme_options', __( 'Settings' ) )
        ->add_fields(array(
            Field::make('text', SETTINGS_KEYS['FOOTER_TEXT'], 'Footer text'),
            Field::make( 'complex', SETTINGS_KEYS['BANNER'], 'Banner')
            ->add_fields( array(
                Field::make('image', 'src', 'Image')->set_value_type( 'url' )->set_width( 33 ),
                Field::make('text', 'value_1', 'Link')->set_width( 33 ),
                Field::make('text', 'value_2', 'Text')->set_width( 33 ),
                )
            ),
            Field::make( 'complex', SETTINGS_KEYS['SOCIAL_LINKS_AUTHOR'], 'Social links author')
            ->add_fields( array(
                Field::make('image', 'src', 'Image')->set_value_type( 'url' )->set_width( 33 ),
                Field::make('text', 'value_1', 'Link')->set_width( 33 ),
                )
            ),
        ));
}