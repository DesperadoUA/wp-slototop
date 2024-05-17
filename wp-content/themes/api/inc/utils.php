<?php
function url_to_post_id($url, $post_type) {
    $query = new WP_Query( array(
        'post_type'         => $post_type,
        'name'              => $url,
        'post_status'       => 'publish'
    ));
    if(!isset($query->post)) return 0;
    else return $query->post->ID;
}
function get_public_post_id_by_rating($post_type, $limit = -1, $executeIds = []) {
    $arr_id = [];
    $query = new WP_Query( array(
        'posts_per_page' => $limit,
        'post_type'      => $post_type,
        'post_status'    => 'publish',
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC',
        'post__not_in'    => $executeIds,
        'meta_query' => array(
            array(
                'key' => '_rating',
            )
        ),
    ));
    if(empty($query->posts)) return $arr_id;
    foreach ($query->posts as $item ) $arr_id[] = $item->ID;
    return $arr_id;
}
function get_public_post_id($post_type, $limit = -1, $executeIds = []) {
    $arr_id = [];
    $query = new WP_Query( array(
        'posts_per_page' => $limit,
        'post_type'      => $post_type,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post__not_in'   => $executeIds,
    ));
    if(empty($query->posts)) return $arr_id;
    foreach ($query->posts as $item ) $arr_id[] = $item->ID;
    return $arr_id;
}