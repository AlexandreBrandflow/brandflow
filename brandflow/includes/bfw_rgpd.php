<?php

//TIPS : la documentation de tarteaucitron.js est disponible ici : https://tarteaucitron.io/fr/install/

/**
 * Initialise tarteaucitron dans le header
 */
function tarteaucitron_init() {

    //TIPS: tu peux configurer la page de politique de confidentialité dans le back office Wordpress => Réglages -> Confidentialité

    ?>

    <script src="<?= get_template_directory_uri() ?>/assets/libs/tarteaucitron.js/tarteaucitron.js"></script>

    <script type="text/javascript">

        tarteaucitron.init({
            "privacyUrl": "<?= get_privacy_policy_url() ?>",  /* Privacy policy url */
            "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
            "cookieName": "tartaucitron", /* Cookie name */
            "orientation": "bottom", /* Banner position (top - bottom) */
            "showAlertSmall": false, /* Show the small banner on bottom right */
            "cookieslist": false, /* Show the cookie list */
            "adblocker": false, /* Show a Warning if an adblocker is detected */
            "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
            "highPrivacy": true, /* Disable auto consent */
            "handleBrowserDNTRequest": false, /* If Do Not Track == 1, accept all */
            "removeCredit": true, /* Remove credit link */
            "moreInfoLink": false, /* Show more info link */
        });

    </script>

    <?php
}
//add_action('wp_head', 'tarteaucitron_init');


/**
 * Ajout des différents services tiers avec tarteaucitron.js
 */
function add_tarteaucitron_services()
{
    $bfwSiteSettings = new bfwSiteSettings();

    if ($bfwSiteSettings->isGoogleServicesTagManagerOk()) {
        ?>
            <script type="text/javascript">
                tarteaucitron.user.googletagmanagerId = '<?= $bfwSiteSettings->getGoogleServicesTagManager() ?>';
                (tarteaucitron.job = tarteaucitron.job || []).push('googletagmanager');
            </script>
        <?php
    }

    if ($bfwSiteSettings->isGoogleServicesMapsApiTokenOk()) {
        ?>
            <script type="text/javascript">
                (function($) {
                    tarteaucitron.user.googlemapsKey = '<?= $bfwSiteSettings->getGoogleServicesMapsApiToken() ?>';
                    tarteaucitron.user.mapscallback = 'init_maps';
                    (tarteaucitron.job = tarteaucitron.job || []).push('googlemaps');
                })($);
            </script>
        <?php
    }
}
add_action('wp_footer', 'add_tarteaucitron_services');