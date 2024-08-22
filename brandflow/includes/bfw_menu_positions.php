<?php

/* Ajout des emplacements de menu du thème */
function add_nav_menus() {
    register_nav_menus( array(
        'bfw header'=>'bfw header',
        'bfw footer'=> 'bfw footer',
    ));
}
add_action('init', 'add_nav_menus');