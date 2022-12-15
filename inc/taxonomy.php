<?php

/* ----------------------------------------------------------
  Get posts from another type linked via a same term
---------------------------------------------------------- */

function wputoolbox_get_linked_posts_via_tax($post_id, $target_post_type, $taxonomy, $return = 'object') {

    $terms = wp_get_post_terms($post_id, $taxonomy, array('fields' => 'ids'));

    $posts = get_posts(array(
        'fields' => 'ids',
        'post_type' => $target_post_type,
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'terms' => $terms
            )
        )
    ));

    switch ($return) {
    case 'titles':
        $titles = array();
        foreach ($posts as $p) {
            $titles[] = get_the_title($p);
        }
        return $titles;
        break;
    default:
        return $posts;
    }
}
