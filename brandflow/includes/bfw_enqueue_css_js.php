<?php

/* Ajout des fichiers js et css au thème */
function bfw_enqueue_scripts()
{

    wp_enqueue_script('gsap', get_template_directory_uri() . '/assets/libs/gsap/gsap.min.js', array(), '1.0', true);
    wp_enqueue_script('scrollTrigger', get_template_directory_uri() . '/assets/libs/gsap/ScrollTrigger.min.js', array(), '1.0', true);

    wp_enqueue_script('lenis', get_template_directory_uri() . '/assets/libs/lenis/lenis.min.js', array(), '1.0', true);


    // wp_enqueue_script('popper', get_template_directory_uri() . '/assets/libs/tippy/popper.min.js', array('jquery'), '1.0', true);
    // wp_enqueue_script('tippy', get_template_directory_uri() . '/assets/libs/tippy/tippy.min.js', array('jquery'), '1.0', true);


    // wp_enqueue_script('select2', get_template_directory_uri() . '/assets/libs/select2/select2.min.js', array('jquery'), '1.0', true);

    wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/libs/swiper/swiper-bundle.min.js', array('jquery'), '1.0', true);
    wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/libs/swiper/swiper-bundle.min.css');

    wp_enqueue_script('mixitup', get_template_directory_uri() . '/assets/libs/mixitup/mixitup.min.js', array(), '1.0', true);

}
add_action('wp_enqueue_scripts', 'bfw_enqueue_scripts');


function bfw_enqueue_universe_styles_scripts()
{

    wp_enqueue_script('app');
    wp_enqueue_style('app', get_stylesheet_directory_uri() . '/assets/css/app.css'); // LORE

}
add_action('wp_enqueue_scripts', 'bfw_enqueue_universe_styles_scripts');