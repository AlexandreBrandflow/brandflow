<?php

/**
 * Déclaration du CPT bfw_map
 */
function bfw_declare_cpt_bfw_map() {
    $labels = array(
        'name' => __('Cartes'),
        'singular_name' => __('carte'),
        'add_new' => __('Nouvelle carte'),
        'add_new_item' => __('Ajouter une nouvelle carte'),
        'edit_item' => __('Modifier la carte'),
        'new_item' => __('Nouvelle carte'),
        'view_item' => __('Voir la carte'),
        'search_items' => __('Rechercher une carte'),
        'not_found' => __('Aucune carte trouvée'),
        'not_found_in_trash' => __('Aucune carte trouvée dans la corbeille'),
    );
    $args = array(
        'labels' => $labels,
        'has_archive' => false,
        'public' => true,
        'hierarchical' => false,
        'supports' => [ 'title', ],
        'taxonomies' => [],
    );
    register_post_type('bfw_map', $args);
}
add_action('init', 'bfw_declare_cpt_bfw_map');

/**
 * Déclaration de la metabox dans la page d'édition d'une carte
 */
function bfw_map_meta_box() {

    global $post;

    if ($post->post_status != 'auto-draft') {

        add_meta_box(
            'data_carte_box_content',
            'Markers de la cartes',
            'bfw_map_markers_box_content',
            'bfw_map',
            'normal',
            'high'
        );

    }
}
add_action('add_meta_boxes', 'bfw_map_meta_box');

/**
 *  Fait l'affichage des données de markers attachés à la map courante
 * @param $post
 */
function bfw_map_markers_box_content($post) {

    $markers = get_posts([
        'post_type' => 'bfw_map_marker',
        'numberposts' => '-1',
        'meta_query' => array(
            array(
                'key' => 'bfw_map_id',
                'value' => $post->ID,
                'compare' => '=',
            ),
        )
    ]);

    if (count($markers) > 0) {

    ?>

        <table class="bfw_admin_table">
            <tr>
                <th>Adresse</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>&nbsp;</th>
            </tr>

            <?php
            foreach ($markers as $marker) {

                $marker_adresse = get_post_meta($marker->ID, 'bfw_map_marker_adresse', true);
                $marker_latitude = get_post_meta($marker->ID, '_latitude', true);
                $marker_longitude = get_post_meta($marker->ID, '_longitude', true);
                $marker_telephone = get_post_meta($marker->ID, 'telephone_marqueur', true);
                $marker_email = get_post_meta($marker->ID, 'mail_marqueur', true);

                ?>

                <tr>
                    <td><?= $marker_adresse ?></td>
                    <td><?= $marker_latitude?></td>
                    <td><?= $marker_longitude ?></td>
                    <td><?= $marker_telephone ?></td>
                    <td><?= $marker_email ?></td>
                    <td>
                        <a href="<?= admin_url('post.php?post=' . $marker->ID . '&action=edit') ?>">Modifier</a>
                    </td>
                </tr>

                <?php
            }

            ?>

        </table>

    <?php

    }

    if ($post->post_status != 'auto-draft') {
        echo '<a href="' . admin_url('post-new.php?post_type=bfw_map_marker') . '" class="button" target="_blank">Ajouter un marker</a>';
    }

}

/**
 * Déclaration du shortcode d'affichage du CPT bfw_map
 * @param $atts
 */
function bfw_map_shortcode($atts) {
    if (!is_admin()) {
        $atts = shortcode_atts([ 'id' => '', ], $atts);
        bfw_map_shortcode_display($atts['id']);
    }}
add_shortcode('bfw_map', 'bfw_map_shortcode');

/**
 * Déclare la colonne de shortcode dans la liste des bfw_map
 * @param $columns
 * @return mixed
 */
function bfw_map_add_columns($columns) {
    $columns['shortcode'] = 'Shortcode';
    return $columns;
}
add_filter('manage_bfw_map_posts_columns', 'bfw_map_add_columns');

/**
 * Écrit la valeur  d'exemple du short code pour le CPT bfw_map
 * @param $column_name
 * @param $post_id
 */
function bfw_map_add_columns_content( $column_name, $post_id ) {
    if ( $column_name == 'shortcode' ) {
        echo '[bfw_map id="'.$post_id.'"]';
    }
}
add_action( 'manage_bfw_map_posts_custom_column', 'bfw_map_add_columns_content', 10, 2 );

/**
 * Affichage de la carte sur le front
 * @param $post_id
 */
function bfw_map_shortcode_display($post_id) {

    $markers = get_posts([
        'post_type' => 'bfw_map_marker',
        'numberposts' => '-1',
        'meta_query' => array(
            array(
                'key' => 'bfw_map_id',
                'value' => $post_id,
                'compare' => '=',
            ),
        )
    ]);

    $markers_arr = [];
    foreach ($markers as $marker) {
        $markers_arr[] = [
            'adresse' => get_post_meta($marker->ID, 'bfw_map_marker_adresse', true),
            'latitude' => get_post_meta($marker->ID, 'bfw_map_marker_latitude', true),
            'longitude' => get_post_meta($marker->ID, 'bfw_map_marker_longitude', true),
            'telephone' => get_post_meta($marker->ID, 'bfw_map_marker_telephone', true),
            'email' => get_post_meta($marker->ID, 'bfw_map_marker_email', true),
        ];
    }

    $markers_json = json_encode($markers_arr);

    ?>

    <div id="bfw_map" class="bfw_map_<?= $post_id ?>"></div>
    <div id="bfw_map_data" class="bfw_map_data_<?= $post_id ?>"><?= $markers_json ?></div>

    <?php
}

/**
 * Supprime l'item de menu dans l'administration correspondant au CPT bfw_map_marker
 */
function bfw_map_remove_menu_item() {
    remove_menu_page( 'edit.php?post_type=bfw_map' );
}
add_action( 'admin_menu', 'bfw_map_remove_menu_item' );