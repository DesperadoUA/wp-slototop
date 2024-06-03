<?php
add_action( 'init', 'game_taxonomy_register' );
function game_taxonomy_register(){
    $labels = array(
        'name'                       => 'Game_tax',
        'singular_name'              => 'Game tax',
        'menu_name'                  => 'Виды игор' ,
        'all_items'                  => 'Все категории игор',
        'edit_item'                  => 'Редактировать категорию игор',
        'view_item'                  => 'Посмотреть категорию игор',
        'update_item'                => 'Сохранить категорию игор',
        'add_new_item'               => 'Добавить новую категорию игор',
        'new_item_name'              => 'Новая категория игор',
        'parent_item'                => 'Родительская категория игор',
        'parent_item_colon'          => 'Родительская категория игор:',
        'search_items'               => 'Поиск по категориям игор',
        'popular_items'              => 'Популярные Метки игор',
        'separate_items_with_commas' => 'Список Меток (разделяются запятыми)',
        'add_or_remove_items'        => 'Добавить или удалить Метку',
        'choose_from_most_used'      => 'Выбрать Метку',
        'add_or_remove_items'        => 'Добавить или удалить Метку',
        'not_found'                  => 'Меток не найдено',
        'back_to_items'              => 'Назад на страницу рубрик',
    );
    $args = array(
        'labels'                => $labels,
        'label'                 => 'Game tax',
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => false,
        'rest_base'             => 'url_rest',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_tagcloud'         => true,
        'show_in_quick_edit'    => true,
        'meta_box_cb'           => null,
        'show_admin_column'     => true,
        'description'           => '',
        'hierarchical'          => true,
        'update_count_callback' => '',
        'query_var'             => false,
        'rewrite'               => true,
        'sort'                  => true,
        '_builtin'              => false,
    );
    register_taxonomy('slot-tax', array('slot'), $args);
}

/*
 * Replace Taxonomy slug with Post Type slug in url
 */

function rewrite_game_category()
{
    $game_category_args = get_taxonomy('slot-tax');
    $game_category_args->show_admin_column = true;
    $game_category_args->rewrite = [];
    $game_category_args->rewrite['slug'] = 'slot-tax';
    $game_category_args->rewrite['with_front'] = false;
    register_taxonomy('slot-tax', array('slot'), (array)$game_category_args);
}
add_action('init', 'rewrite_game_category', 11);