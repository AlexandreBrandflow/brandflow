<?php

require_once dirname( __FILE__ ) . '/libs/TGM-Plugin-Activation-develop/class-tgm-plugin-activation.php';

function register_required_plugins() {

	$plugins = array(

		array(
			'name' => 'WP-SCSS',
			'slug' => 'wp-scss',
			'source' => get_template_directory() . '/includes/plugins/zip/wp-scss-2.3.0.zip',
			'required' => false,
			'version' => '2.3.0',
			'force_activation' => true,
			'force_deactivation' => false,
			'external_url' => '',
			'is_callable' => '',
		),

        array(
            'name' => 'WooCommerce',
            'slug' => 'woocommerce',
            'source' => get_template_directory() . '/includes/plugins/zip/woocommerce.5.5.2.zip',
            'required' => false,
            'version' => '5.5.2',
            'force_activation' => true,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),

        array(
            'name' => 'WooCommerce Clic And Pay by Groupe Crédit du Nord',
            'slug' => 'woocommerce-clicandpay-by-groupe-credit-du-nord',
            'source' => get_template_directory() . '/includes/plugins/zip/woocommerce-clicandpay-by-groupe-credit-du-nord.1.9.3.zip',
            'required' => false,
            'version' => '1.9.3',
            'force_activation' => true,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),

        array(
            'name' => 'WooCommerce Gateway Stripe',
            'slug' => 'woocommerce-gateway-stripe',
            'source' => get_template_directory() . '/includes/plugins/zip/woocommerce-gateway-stripe.5.3.0.zip',
            'required' => false,
            'version' => '5.3.0',
            'force_activation' => true,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),

        array(
            'name' => 'WooCommerce Paypal Payments',
            'slug' => 'woocommerce-paypal-payments',
            'source' => get_template_directory() . '/includes/plugins/zip/woocommerce-paypal-payments.1.4.0.zip',
            'required' => false,
            'version' => '1.4.0',
            'force_activation' => true,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),

        array(
            'name' => 'Polylang',
            'slug' => 'polylang',
            'source' => get_template_directory() . '/includes/plugins/zip/polylang.3.1.zip',
            'required' => false,
            'version' => '3.1',
            'force_activation' => true,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),

        array(
            'name' => 'Yoast SEO',
            'slug' => 'wordpress-seo',
            'source' => get_template_directory() . '/includes/plugins/zip/wordpress-seo.16.8.zip',
            'required' => false,
            'version' => '16.8',
            'force_activation' => true,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),

        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form',
            'source' => get_template_directory() . '/includes/plugins/zip/contact-form-7.5.4.2.zip',
            'required' => false,
            'version' => '7.5.4.2',
            'force_activation' => true,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),

        array(
            'name' => 'Contact Form CFDB7',
            'slug' => 'contact-form-cfdb7',
            'source' => get_template_directory() . '/includes/plugins/zip/contact-form-cfdb7-1.2.5.9.zip',
            'required' => false,
            'version' => '1.2.5.9',
            'force_activation' => true,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),

        array(
            'name' => 'Duplicate Page and Post',
            'slug' => 'duplicate-wp-page-post',
            'source' => get_template_directory() . '/includes/plugins/zip/duplicate-wp-page-post.2.6.5.zip',
            'required' => false,
            'version' => '2.6.5',
            'force_activation' => true,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),

        array(
            'name' => 'Autoptimize',
            'slug' => 'autoptimize',
            'source' => get_template_directory() . '/includes/plugins/zip/autoptimize.2.9.2.zip',
            'required' => false,
            'version' => '2.9.2',
            'force_activation' => true,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),

        array(
            'name' => 'WP Fastest Cache',
            'slug' => 'wp-fastest-cache',
            'source' => get_template_directory() . '/includes/plugins/zip/wp-fastest-cache.0.9.4.zip',
            'required' => false,
            'version' => '0.9.4',
            'force_activation' => true,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),

	);

	$config = array(
		'id' => 'tgmpa',
		'default_path' => '',
		'menu' => 'tgmpa-install-plugins',
		'parent_slug' => 'themes.php',
		'capability' => 'edit_theme_options',
		'has_notices' => true,
		'dismissable' => true,
		'dismiss_msg' => '',
		'is_automatic' => false,
		'message' => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'register_required_plugins' );
