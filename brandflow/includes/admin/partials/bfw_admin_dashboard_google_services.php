<?php

$bfwSiteSettings = new bfwSiteSettings();

?>

<div class="dashboard_indicator <?php echo $bfwSiteSettings->isGoogleServicesTagManagerOk() ? 'dashboard_indicator_positive' : 'dashboard_indicator_negative'; ?>">
    <div class="dashboard_indicator_wrapper">
        <h3>Services Google</h3>
        <p>
            Configurez les services Google à utiliser sur le site.
        </p>
        <div class="dashboard_indicator_actions">
            <a href="<?php menu_page_url( 'bfw_admin_page_google_services' ) ?>" class="dashboard_indicator_action">
                Configurer les services
            </a>
        </div>
    </div>
</div>