<?php
add_action( 'init', 'register_post_types_type_bonus' );
function register_post_types_type_bonus(){
    register_post_type( 'type_bonus', [
        'label'  => null,
        'labels' => [
            'name'               => 'type_bonus', // основное название для типа записи
            'singular_name'      => 'type_bonus', // название для одной записи этого типа
            'add_new'            => 'Добавить type bonus', // для добавления новой записи
            'add_new_item'       => 'Добавление type bonus', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование type bonus', // для редактирования типа записи
            'new_item'           => 'Новый type bonus', // текст новой записи
            'view_item'          => 'Смотреть страницу', // для просмотра записи этого типа.
            'search_items'       => 'Искать запись', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Type bonuses', // название меню
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
function type_bonus_custom_fields() {
    add_post_type_support( 'type_bonus', 'custom-fields'); // в качестве первого параметра укажите название типа поста
}
add_action('init', 'type_bonus_custom_fields');