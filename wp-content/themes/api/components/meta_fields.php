<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'headers_meta_lang');
function headers_meta_lang()
{
    $arrPostTypes = ['posts', 'page', 'casino', 'slot'];
    /*--------------------------Add fields on posts----------------------------------------*/
    Container::make('post_meta', 'Headers Meta Lang')
        ->show_on_post_type($arrPostTypes)
        ->add_fields(array(
            Field::make( 'complex', 'headers_meta_lang' )
                ->add_fields( array(
                        Field::make( 'select', 'headers_lang', 'Headers lang' )
                            ->add_options( array('ru-UA' => 'ru-UA', 'uk-UA' => 'uk-UA') ),
                        Field::make('text', 'headers_link', 'Ссылка на страницу'),
                    )
                )
        ));
}