<?php
add_action( 'init', 'register_post_types_currency' );
function register_post_types_currency(){
    register_post_type( 'currency', [
        'label'  => null,
        'labels' => [
            'name'               => 'currency', // основное название для типа записи
            'singular_name'      => 'currency', // название для одной записи этого типа
            'add_new'            => 'Добавить Currency', // для добавления новой записи
            'add_new_item'       => 'Добавление Currency', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование Currency', // для редактирования типа записи
            'new_item'           => 'Новый Currency', // текст новой записи
            'view_item'          => 'Смотреть страницу', // для просмотра записи этого типа.
            'search_items'       => 'Искать запись', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Currency', // название меню
        ],
        'description'         => '',
        'public'              => true,
        'show_in_menu'        => null, // показывать ли в меню адмнки
        'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest'        => null, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-welcome-write-blog',
        'hierarchical'        => false,
        'supports'            => ['title','thumbnail','excerpt','comments','revisions','page-attributes','post-formats', 'editor'],
        'taxonomies'          => array( 'category' ),
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ] );
}
function currency_custom_fields() {
    add_post_type_support( 'currency', 'custom-fields'); // в качестве первого параметра укажите название типа поста
}
add_action('init', 'currency_custom_fields');