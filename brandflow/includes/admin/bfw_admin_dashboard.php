<?php

/* Méthode de display du dashboard des bfw theme settings */
function bfw_admin_page_display() {

	?>

	<div class="bfw_admin_page">
		<div class="bfw_admin_page_header">
			<h2>bfw - Dashboard</h2>
		</div>
		<div class="bfw_admin_page_content">

            <div class="bfw_admin_page_content_title">
                <h3>Configuration</h3>
            </div>

			<div class="bfw_admin_page_content_wrapper">

				<?php require "partials/bfw_admin_dashboard_mode.php"; ?>

                <?php require "partials/bfw_admin_dashboard_plugins.php"; ?>

			</div>

            <div class="bfw_admin_page_content_title">
                <h3>Services tiers</h3>
            </div>

            <div class="bfw_admin_page_content_wrapper">

                <?php require "partials/bfw_admin_dashboard_google_services.php"; ?>

            </div>

            <div class="bfw_admin_page_content_title">
                <h3>Fonctionnalités embarquées</h3>
            </div>

            <div class="bfw_admin_page_content_wrapper">

                <?php require "partials/bfw_admin_dashboard_maps.php"; ?>

                <?php require "partials/bfw_admin_dashboard_seo_meta.php"; ?>

                <?php require "partials/bfw_admin_dashboard_seo_image.php"; ?>

            </div>
		</div>
	</div>

	<?php

}