<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_faq_static_pages' );
function crb_attach_theme_faq_static_pages():void {
    Container::make( 'theme_options', __( 'Faq static pages' ) )
        ->add_fields(array(
            Field::make( 'complex', SETTINGS_KEYS['BONUS_PAGE_FAQ'], 'Bonus page Faq')
                    ->add_fields( array(
                            Field::make('text', 'value_1', 'Вопрос')->set_width( 50 ),
                            Field::make('textarea', 'value_2', 'Ответ')->set_width( 50 ),
                        )
                    ),
            Field::make( 'complex', SETTINGS_KEYS['MAIN_PAGE_FAQ'], 'Main page faq')
                    ->add_fields( array(
                            Field::make('text', 'value_1', 'Вопрос')->set_width( 50 ),
                            Field::make('textarea', 'value_2', 'Ответ')->set_width( 50 ),
                        )
                    ),
            Field::make( 'complex', SETTINGS_KEYS['CASINO_PAGE_FAQ'], 'Casino page faq')
                    ->add_fields( array(
                            Field::make('text', 'value_1', 'Вопрос')->set_width( 50 ),
                            Field::make('textarea', 'value_2', 'Ответ')->set_width( 50 ),
                        )
                    ),
            Field::make( 'complex', SETTINGS_KEYS['POKER_PAGE_FAQ'], 'Poker page faq')
                    ->add_fields( array(
                            Field::make('text', 'value_1', 'Вопрос')->set_width( 50 ),
                            Field::make('textarea', 'value_2', 'Ответ')->set_width( 50 ),
                        )
                    ),
            Field::make( 'complex', SETTINGS_KEYS['GAME_PAGE_FAQ'], 'Game page faq')
                    ->add_fields( array(
                            Field::make('text', 'value_1', 'Вопрос')->set_width( 50 ),
                            Field::make('textarea', 'value_2', 'Ответ')->set_width( 50 ),
                        )
                    ),
        ));
}