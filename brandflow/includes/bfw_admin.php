<?php

include 'admin/bfw_admin_dashboard.php';
include 'admin/bfw_admin_mode.php';
include 'admin/bfw_admin_services_google.php';
include 'admin/bfw_admin_seo_images.php';

/* Ajout d'une page d'administration du thème */

function bfw_theme_admin_page() {

    add_menu_page(
        'bfw',
        'bfw',
        'manage_options',
        'bfw_admin_page',
        'bfw_admin_page_display',
        '',
        2
    );

    add_submenu_page(
        '',
        'Site Mode',
        'Site Mode',
        'manage_options',
        'bfw_admin_page_mode',
        'bfw_admin_page_mode_display'
    );

    add_submenu_page(
        '',
        'Services Google',
        'Services Google',
        'manage_options',
        'bfw_admin_page_google_services',
        'bfw_admin_page_google_services_display'
    );

    add_submenu_page(
        '',
        'SEO Images',
        'SEO Images',
        'manage_options',
        'bfw_admin_page_seo_images',
        'bfw_admin_page_seo_images_display'
    );
}
add_action('admin_menu', 'bfw_theme_admin_page');

/* Ajout des fichiers css à l'admin Wordpress */
function bfw_enqueue_stylesheets_admin() {
    echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/assets/css/admin.css" type="text/css" media="all" />';
}
add_action('admin_head', 'bfw_enqueue_stylesheets_admin');