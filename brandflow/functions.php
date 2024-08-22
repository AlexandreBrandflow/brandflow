<?php

const bfw_VERSION = '1.0.0'; // test

/* Thème admin */
require "includes/bfw_admin.php";

/* Thème classes */
require "includes/classes/bfwSiteMode.php";
require "includes/classes/bfwSiteModeTask.php";
require "includes/classes/bfwSiteSettings.php";

/* Thème pre-packaged plugins */
require "includes/bfw_plugin_required.php";
require "includes/plugins/bfwPluginWpScss.php";

/* Thème functions */
require "includes/bfw_after_switch_theme.php";
require "includes/bfw_theme_supports.php";
require "includes/bfw_menu_positions.php";
require "includes/bfw_enqueue_css_js.php";
require "includes/bfw_disable_comments.php";
// require "includes/bfw_woocommerce.php";
require "includes/bfw_rgpd.php";

require "includes/bfw_svg_buttons.php";

/* Fonctionnalités du thème */
require "includes/features/bfw_maps.php";

require "includes/bfw_blog_functions.php";

require "includes/bfw_import_export_menus.php";


function bfw_yoast_breadcrumb()
{

	if (function_exists('yoast_breadcrumb') && !is_front_page()) {
		yoast_breadcrumb('<div id="breadcrumbs">', '</div>', true);
	}

}
add_action('bfw_yoast_breadcrumb', 'bfw_yoast_breadcrumb');
add_action('woocommerce_archive_description', 'bfw_yoast_breadcrumb');


function register_questions_frequentes()
{
	$labels = array(
		'name' => _x('Questions fréquentes', 'Post Type General Name', 'bfw'),
		'singular_name' => _x('Question fréquente', 'Post Type Singular Name', 'bfw'),
		'menu_name' => __('Questions fréquentes', 'bfw'),
		'name_admin_bar' => __('Questions fréquentes', 'bfw'),
		'archives' => __('Archives des questions fréquentes', 'bfw'),
		'attributes' => __('Attributs des questions fréquentes', 'bfw'),
		'parent_item_colon' => __('Parent', 'bfw'),
		'all_items' => __('Toutes les questions fréquentes', 'bfw'),
		'add_new_item' => __('Ajouter une question fréquente', 'bfw'),
		'add_new' => __('Ajouter une nouvelle', 'bfw'),
		'new_item' => __('Nouvelle question fréquente', 'bfw'),
		'edit_item' => __('Modifier la question fréquente', 'bfw'),
		'update_item' => __('Mettre à jour la question fréquente', 'bfw'),
		'view_item' => __('Voir la question fréquente', 'bfw'),
		'view_items' => __('Voir les questions fréquentes', 'bfw'),
		'search_items' => __('Rechercher une question fréquente', 'bfw'),
		'not_found' => __('Pas trouvé', 'bfw'),
		'not_found_in_trash' => __('Pas trouvé dans la corbeille', 'bfw'),
		'featured_image' => __('Image principale', 'bfw'),
		'set_featured_image' => __('Définir l\'image principale', 'bfw'),
		'remove_featured_image' => __('Enlever l\'image principale', 'bfw'),
		'use_featured_image' => __('Utiliser comme image principale', 'bfw'),
		'insert_into_item' => __('Insérer dans le post', 'bfw'),
		'uploaded_to_this_item' => __('Uploadé dans le post', 'bfw'),
		'items_list' => __('Liste des questions', 'bfw'),
		'items_list_navigation' => __('Navigation dans la liste des questions', 'bfw'),
		'filter_items_list' => __('Filtrer la liste des questions', 'bfw'),
	);
	$args = array(
		'label' => __('Question fréquente', 'bfw'),
		'description' => __('Questions fréquemment posées', 'bfw'),
		'labels' => $labels,
		'supports' => array('title', 'editor', 'custom-fields', 'page-attributes'),
		'taxonomies' => array('faq_categorie'), // Utilisation de la nouvelle taxonomie "FAQ - Catégories"
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-editor-help',
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => false,
		'has_archive' => false,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'menu_order' => true, // Autoriser le tri personnalisé
	);
	register_post_type('question_frequente', $args);
}
add_action('init', 'register_questions_frequentes', 0);


function register_faq_categories_taxonomy()
{
	$labels = array(
		'name' => _x('FAQ - Catégories', 'taxonomy general name', 'bfw'),
		'singular_name' => _x('FAQ - Catégorie', 'taxonomy singular name', 'bfw'),
		'search_items' => __('Rechercher dans les catégories FAQ', 'bfw'),
		'all_items' => __('Toutes les catégories FAQ', 'bfw'),
		'parent_item' => __('Catégorie parente FAQ', 'bfw'),
		'parent_item_colon' => __('Catégorie parente FAQ :', 'bfw'),
		'edit_item' => __('Modifier la catégorie FAQ', 'bfw'),
		'update_item' => __('Mettre à jour la catégorie FAQ', 'bfw'),
		'add_new_item' => __('Ajouter une nouvelle catégorie FAQ', 'bfw'),
		'new_item_name' => __('Nouveau nom de la catégorie FAQ', 'bfw'),
		'menu_name' => __('FAQ - Catégories', 'bfw'),
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'faq-categorie'),
	);

	register_taxonomy('faq_categorie', array('question_frequente'), $args);
}
add_action('init', 'register_faq_categories_taxonomy', 0);


// blocks & ACF

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(
		array(
			'page_title' => 'Options générales',
			'menu_title' => 'Options générales',
			'menu_slug' => 'options-generales',
			'capability' => 'edit_posts',
			'redirect' => false
		)
	);

	acf_add_options_page(
		array(
			'page_title' => 'Blocs génériques',
			'menu_title' => 'Blocs génériques',
			'menu_slug' => 'blocs-generiques',
			'capability' => 'edit_posts',
			'redirect' => false
		)
	);

	acf_add_options_page(
		array(
			'page_title' => 'Menus',
			'menu_title' => 'Menus',
			'menu_slug' => 'menus',
			'capability' => 'edit_posts',
			'redirect' => false
		)
	);
}

add_action('init', 'register_acf_blocks');
function register_acf_blocks()
{

	register_block_type(__DIR__ . '/blocks/bfw-header-homepage');

	register_block_type(__DIR__ . '/blocks/bfw-header-classique');

	register_block_type(__DIR__ . '/blocks/bfw-header-chiffres');

	register_block_type(__DIR__ . '/blocks/bfw-fonctionnalites');

	register_block_type(__DIR__ . '/blocks/bfw-texte-image');

	register_block_type(__DIR__ . '/blocks/bfw-texte-image-multi');

	register_block_type(__DIR__ . '/blocks/bfw-texte-large');

	register_block_type(__DIR__ . '/blocks/bfw-loop-slider');

	register_block_type(__DIR__ . '/blocks/bfw-sticky-slider');

	register_block_type(__DIR__ . '/blocks/bfw-grid-plus-sticky-slider');

	register_block_type(__DIR__ . '/blocks/bfw-services');

	register_block_type(__DIR__ . '/blocks/bfw-features');

	register_block_type(__DIR__ . '/blocks/bfw-bento');

	register_block_type(__DIR__ . '/blocks/bfw-bento-2');

	register_block_type(__DIR__ . '/blocks/bfw-slider-features');

	register_block_type(__DIR__ . '/blocks/bfw-3-colonnes');

	register_block_type(__DIR__ . '/blocks/bfw-temoignages');

	register_block_type(__DIR__ . '/blocks/bfw-solution-details');

	register_block_type(__DIR__ . '/blocks/bfw-solution-complementaires');

	register_block_type(__DIR__ . '/blocks/bfw-arguments-secondaires');

	register_block_type(__DIR__ . '/blocks/bfw-process');

	register_block_type(__DIR__ . '/blocks/bfw-parcours');

	register_block_type(__DIR__ . '/blocks/bfw-bento');

	register_block_type(__DIR__ . '/blocks/bfw-cta-carrieres');

	register_block_type(__DIR__ . '/blocks/bfw-cta-demo');

	register_block_type(__DIR__ . '/blocks/bfw-cta-questions');

	register_block_type(__DIR__ . '/blocks/bfw-cta-telechargement');

	register_block_type(__DIR__ . '/blocks/bfw-footer-lore');

	register_block_type(__DIR__ . '/blocks/bfw-footer-newsletter');

	register_block_type(__DIR__ . '/blocks/bfw-ressources');

	register_block_type(__DIR__ . '/blocks/bfw-webinaires');

	register_block_type(__DIR__ . '/blocks/bfw-faq');

}

// blocks



function bfw_add_slug_body_class($classes)
{
	global $post;
	if (isset($post)) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter('body_class', 'bfw_add_slug_body_class');


function bfw_get_fields($args)
{
	$bloc_id = ($args['bloc_id']) ? $args['bloc_id'] : '';
	$acf = array();

	$acf['sur_titre'] = get_field('sur_titre', $bloc_id);
	$acf['titre'] = get_field('titre', $bloc_id);
	$acf['contenu'] = get_field('contenu', $bloc_id);
	$acf['contenu_secondaire'] = get_field('contenu_secondaire', $bloc_id);

	$acf['image'] = get_field('image', $bloc_id);

	$acf['vecteurs'] = get_field('vecteurs', $bloc_id);
	$acf['style'] = get_field('style', $bloc_id);

	// Repeaters
	$acf['liens'] = get_field('liens', $bloc_id);
	$acf['elements'] = get_field('elements', $bloc_id);
	$acf['arguments'] = get_field('arguments', $bloc_id);

	$acf['images'] = get_field('images', $bloc_id);
	$acf['icone'] = get_field('icone', $bloc_id);
	$acf['galerie'] = get_field('galerie', $bloc_id);

	$acf['background'] = get_field('background', $bloc_id);

	$acf['variante'] = get_field('variante', $bloc_id);


	// Retournez le tableau des valeurs
	return $acf;
}

add_filter('wpcf7_autop_or_not', '__return_false');

function bfw_is_prod()
{
	$is_prod = get_field('is_prod', 'option');
	return $is_prod;
}