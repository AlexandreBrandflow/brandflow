<?php

$bfwSiteSettings = new bfwSiteSettings();

?>

<div class="dashboard_indicator <?php echo $bfwSiteSettings->isGoogleServicesTagManagerOk() ? 'dashboard_indicator_positive' : 'dashboard_indicator_negative'; ?>">
    <div class="dashboard_indicator_wrapper">
        <h3>SEO Images - Editeur de masse</h3>
        <p>
            Éditez en masse les textes alternatifs et descriptions de l'ensemble des images du site.
        </p>
        <div class="dashboard_indicator_actions">
            <a href="<?= admin_url('admin.php?page=bfw_admin_page_seo_images')  ?>" class="dashboard_indicator_action">
                Éditer les images
            </a>
        </div>
    </div>
</div>