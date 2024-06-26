<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'headers_meta_lang');
function headers_meta_lang() {
    /*--------------------------Add fields on posts----------------------------------------*/
    Container::make('post_meta', 'Headers Meta Lang')
        ->show_on_post_type(ALL_POST_TYPES)
        ->add_fields(array(
            Field::make( 'complex', FIELDS_KEY['HEADER_META_LANG'] )
                ->add_fields( array(
                        Field::make( 'select', 'lang', 'Headers lang' )
                            ->add_options( array('ru-UA' => 'ru-UA', 'uk-UA' => 'uk-UA') ),
                        Field::make('text', 'link', 'Ссылка на страницу'),
                    )
                )
    ));

    Container::make('term_meta', 'Category Properties')
        ->show_on_taxonomy(ALL_TAXONOMIES)
        ->add_fields(array(
            Field::make( 'complex', FIELDS_KEY['HEADER_META_LANG'] )
                ->add_fields( array(
                        Field::make( 'select', 'lang', 'Headers lang' )
                            ->add_options( array('ru-UA' => 'ru-UA', 'uk-UA' => 'uk-UA') ),
                        Field::make('text', 'link', 'Ссылка на страницу'),
                    )
            )
    ));
}
