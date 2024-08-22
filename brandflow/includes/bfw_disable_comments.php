<?php

/* Désactivation de tous les commentaires de Wordpress */
add_filter('comments_open', 'bfw_disable_comments', 10, 2);
function bfw_disable_comments( $actif, $post_id ) {
    $post = get_post($post_id);

    //désactive les commentaires sur le custom post type précisé
    //if ('cpt' == $post->post_type) $actif = false;

    //désactive les commentaires sur tous les types de posts
    $actif = false;

    return $actif;
}