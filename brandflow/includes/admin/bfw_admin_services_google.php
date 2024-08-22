<?php

/* Méthode de display du dashboard des bfw theme settings */
function bfw_admin_page_google_services_display() {

	?>

	<div class="bfw_admin_page bfw_admin_page_detail">

        <?php  dbi_render_plugin_settings_page(); ?>

	</div>

	<?php

}

function dbi_add_settings_page() {
    add_options_page( 'Example plugin page', 'Example Plugin Menu', 'manage_options', 'dbi-example-plugin', 'dbi_render_plugin_settings_page' );
}
add_action( 'admin_menu', 'dbi_add_settings_page' );

function dbi_render_plugin_settings_page() {
    ?>

    <div class="bfw_admin_page_header">
        <h2>bfw - Services Google</h2>
    </div>
    <div class="bfw_admin_page_content">
        <div class="bfw_admin_page_content_wrapper">

            <form action="options.php" method="post">

                <div class="dashboard_indicator">
                    <div class="dashboard_indicator_wrapper">
                        <?php
                            settings_fields( 'bfw_options_google_services' );
                            do_settings_sections( 'bfw_admin_page_google_services' );
                        ?>
                        <div class="dashboard_indicator_actions">
                            <button class="dashboard_indicator_action" type="submit">
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
    <?php
}

/**
 * Déclaration des options de la page
 */
function bfw_register_options_google_services() {
    register_setting( 'bfw_options_google_services', 'bfw_options_google_services', 'bfw_options_google_services_validate' );
    add_settings_section( 'bfw_options_google_services', '', 'bfw_options_google_services_text', 'bfw_admin_page_google_services' );

    add_settings_field( 'bfw_options_google_services_tag_manager', 'Google Tag Manager', 'bfw_options_google_services_tag_manager', 'bfw_admin_page_google_services', 'bfw_options_google_services' );
    add_settings_field( 'bfw_options_google_services_maps', 'Google Maps API Token', 'bfw_options_google_services_maps_api_token', 'bfw_admin_page_google_services', 'bfw_options_google_services' );
}
add_action( 'admin_init', 'bfw_register_options_google_services' );

/**
 * Validation des options de la page
 *
 * @param $input
 * @return array
 */
function bfw_options_google_services_validate( $input ) {
    $newinput['tag_manager'] = trim( $input['tag_manager'] );
    $newinput['maps_api_token'] = trim( $input['maps_api_token'] );

    return $newinput;
}

function bfw_options_google_services_text() { echo ''; }

function bfw_options_google_services_tag_manager() {

    $options = get_option( 'bfw_options_google_services' );
    $googleTagManagerOption = isset($options['tag_manager']) ? esc_attr( $options['tag_manager'] ) : '';
    echo "<input id='bfw_options_google_services_tag_manager' name='bfw_options_google_services[tag_manager]' type='text' value='"  .  $googleTagManagerOption  .  "' placeholder='GTM-XXXXXX' />";
}

function bfw_options_google_services_maps_api_token() {

    $options = get_option( 'bfw_options_google_services' );
    $googleMapsApiToken = isset($options['maps_api_token']) ? esc_attr( $options['maps_api_token'] ) : '';
    echo "<input id='bfw_options_google_services_maps_api_token' name='bfw_options_google_services[maps_api_token]' type='text' value='"  .  $googleMapsApiToken  .  "' placeholder='XXXXXXXXXX' />";
}