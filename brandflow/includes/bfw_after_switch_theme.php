<?php

function bfw_after_switch_theme() {

    $bfwSiteMode = new bfwSiteMode();

    $has_already_been_activated = get_site_option('bfw_ACTIVATED');

    /**
     * Première activation du plugin sur le site
     */
    if (!$has_already_been_activated && isset( $_GET['activated'] ))
    {

        $bfwSiteMode->setSiteModeDev();

        /* Réglages généraux */
        update_site_option('WPLANG', 'fr_FR');
        update_site_option('timezone_string', 'Europe/Paris');
        update_site_option('date_format', 'd/m/Y');
        update_site_option('time_format', 'H:i');
        update_site_option('start_of_week', '1');

        /*Réglages d'écriture*/

        /*Réglages de lecture*/
        update_site_option('blog_public', '0');

        /*Réglages des commentaires*/
        update_site_option('default_pingback_flag', '0');
        update_site_option('default_ping_status', '0');
        update_site_option('default_comment_status', '');
        update_site_option('require_name_email', '0');
        update_site_option('comment_registration', '1');
        update_site_option('close_comments_for_old_posts', '1');
        update_site_option('close_comments_days_old', '0');
        update_site_option('show_comments_cookies_opt_in', '0');
        update_site_option('thread_comments', '0');
        update_site_option('thread_comments_depth', '2');
        update_site_option('page_comments', '0');
        update_site_option('comments_notify', '0');
        update_site_option('moderation_notify', '0');
        update_site_option('comment_moderation', '1');
        update_site_option('comment_previously_approved', '1');
        update_site_option('comment_max_links', '0');
        update_site_option('show_avatars', '0');

        /*Réglages des médias*/
        update_site_option('thumbnail_crop', '');
        update_site_option('uploads_use_yearmonth_folders', '');

        /*Réglages des permaliens*/
        update_site_option('permalink_structure', '/%postname%/');
        flush_rewrite_rules();

        /*Réglage du thème bfw*/
        update_site_option('bfw_ACTIVATED', bfw_VERSION);

        /*Redirection vers le dashboard du thème bfw*/
        wp_safe_redirect( admin_url('admin.php?page=bfw_admin_page') );
        exit;
    }
    /**
     * Pas la première activation du site
     */
    else
    {
        if ($has_already_been_activated < '2.0.0') {
            //TODO: Migration de version possible
        }
    }
}
add_action('after_switch_theme', 'bfw_after_switch_theme');