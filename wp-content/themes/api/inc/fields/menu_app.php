<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_menu' );
function crb_attach_theme_menu():void {
    Container::make( 'theme_options', __( 'Menus' ) )
        ->add_fields(array(
            Field::make( 'complex', SETTINGS_KEYS['HEADER_MENU'], 'Header menu')
            ->add_fields( array(
                    Field::make('image', 'src', 'Icon')->set_value_type( 'url' )->set_width( 33 ),
                    Field::make('text', 'value_1', 'Link')->set_width( 33 ),
                    Field::make('text', 'value_2', 'Text')->set_width( 33 ),
                    Field::make( 'complex', 'child', 'Drop menu')->add_fields( array(
                        Field::make('text', 'value_1', 'Link')->set_width( 33 ),
                        Field::make('text', 'value_2', 'Text')->set_width( 33 ),
                    ))
                )
                    ),
            Field::make( 'complex', SETTINGS_KEYS['FOOTER_MENU'], 'Footer menu')
                    ->add_fields( array(
                            Field::make('text', 'value_1', 'Link')->set_width( 50 ),
                            Field::make('text', 'value_2', 'Text')->set_width( 50 ),
                        )
                    ),
            Field::make( 'complex', SETTINGS_KEYS['PARTNERS_MENU'], 'Partners menu')
                    ->add_fields( array(
                            Field::make('image', 'src', 'Icon')->set_value_type( 'url' )->set_width( 33 ),
                            Field::make('text', 'value_1', 'Link')->set_width( 33 ),
                            Field::make('text', 'value_2', 'Text')->set_width( 33 ),
                        )
                    ),
        ));
}