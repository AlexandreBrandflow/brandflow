<?php

$bfwSiteSettings = new bfwSiteSettings();

?>

<div class="dashboard_indicator <?php echo $bfwSiteSettings->isGoogleServicesTagManagerOk() ? 'dashboard_indicator_positive' : 'dashboard_indicator_negative'; ?>">
    <div class="dashboard_indicator_wrapper">
        <h3>SEO Metas - Editeur de masse</h3>
        <p>
            Éditez en masse les métas de l'ensemble des pages du site.
        </p>
        <div class="dashboard_indicator_actions">
            <a href="<?= admin_url('admin.php?page=wpseo_tools&tool=bulk-editor')  ?>" class="dashboard_indicator_action">
                Éditer les métas
            </a>
        </div>
    </div>
</div>