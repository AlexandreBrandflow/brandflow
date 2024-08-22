<?php

//TODO: AJouter des tailles de médias à Wordpress

/* Ajout des supports du thème */
function bfw_after_setup_theme() {

    add_theme_support( 'custom-logo' );
    add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'bfw_after_setup_theme' );