<?php

/**
 * Déclaration du CPT bfw_map_marker
 */
function bfw_declare_cpt_bfw_map_marker() {
    $labels = [
        'name' => __('Markers'),
        'singular_name' => __('Marker'),
        'add_new' => __('Nouveau Marker'),
        'add_new_item' => __('Ajouter un nouveau marker'),
        'edit_item' => __('Modifier le marker'),
        'new_item' => __('Nouveau marker'),
        'view_item' => __('Voir le marker'),
        'search_items' => __('Rechercher un marker'),
        'not_found' =>  __('Aucun marker trouvé'),
        'not_found_in_trash' => __('Aucun marker trouvé dans la corbeille'),
    ];
    $args = [
        'labels' => $labels,
        'has_archive' => false,
        'public' => true,
        'hierarchical' => false,
        'supports' => [ 'title', ],
        'taxonomies' => [],
    ];
    register_post_type('bfw_map_marker', $args);
}
add_action('init', 'bfw_declare_cpt_bfw_map_marker');

/**
 * Déclaration de la métabox dans la page d'édition d'un marker
 */
function bfw_marker_meta_box() {
    add_meta_box(
        'bfw_marker_meta_box',
        'Adresse Marqueur',
        'bfw_marker_meta_box_content',
        'bfw_map_marker',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bfw_marker_meta_box');

/**
 * Affichage des champs contenus dans la metabox pour le CPT bfw_map_marker
 * @param $post
 */
function bfw_marker_meta_box_content($post) {

    // Récupération des informations du marker
    $adresse = get_post_meta($post->ID, 'bfw_map_marker_adresse', true);
    $telephone = get_post_meta($post->ID, 'bfw_map_marker_telephone', true);
    $email = get_post_meta($post->ID, 'bfw_map_marker_email', true);

    // Récupération de toutes les cartes publiées
    $args = array( 'post_type' => 'bfw_map',  'numberposts' => '-1', );
    $maps = get_posts($args) ? get_posts($args) : '';

    // Récupération de l'ID de post de la carte configurée sur le marker
    $bfw_map_id = get_post_meta($post->ID, 'bfw_map_id', true);

    ?>

    <div class="bfw_admin_form_group">
        <label style="width: 100%;">Adresse</label>
        <input name="bfw_map_marker_adresse" style="width: 100%;"  value="<?= $adresse ?>"/>
    </div>

    <div class="bfw_admin_form_group">
        <label style="width: 100%;">Téléphone</label>
        <input name="bfw_map_marker_telephone" style="width: 100%;"  value="<?= $telephone ?>"/>
    </div>

    <div class="bfw_admin_form_group">
        <label style="width: 100%;">Email</label>
        <input name="bfw_map_marker_email" style="width: 100%;"  value="<?= $email ?>"/>
    </div>

    <div class="bfw_admin_form_group">
        <label style="width: 100%;">Carte</label>
        <select name="bfw_map_id">
            <?php foreach ($maps as $map) {  ?>
                <option value="<?php echo $map->ID ?>" <?php if ($bfw_map_id == $map->ID) echo 'selected'; ?> >
                    <?php echo $map->post_title ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <?php

    echo '<input type="hidden" name="bfw_marker_meta_box_content_nonce" value="' . wp_create_nonce() . '">';
}

/**
 * Sauvegarde des informations du marker courant
 * @param $post_id
 * @return mixed
 */
function bfw_marker_meta_box_save($post_id) {

    $isNotSetNonce = !isset($_POST['bfw_marker_meta_box_content_nonce']) && !wp_verify_nonce($_REQUEST['bfw_marker_meta_box_content_nonce']);
    $isDoingAutoSave = defined('DOING_AUTOSAVE') && DOING_AUTOSAVE;
    $isNotMarkerCpt = 'bfw_map_marker' != $_POST['post_type'];

    // Vérifications de sécurité
    if ($isNotSetNonce || $isDoingAutoSave || $isNotMarkerCpt) {
        return $post_id;
    }

    // Récupération de l'ancienne et de la nouvelle valeur de l'adresse
    $adresse_old = get_post_meta($post_id, 'bfw_map_marker_adresse', true);
    $adresse_new = $_POST['bfw_map_marker_adresse'];

    // Si les valeurs d'adresses sont différentes, alors on la met à jour et on met à jour les coordonnées GPS avec l'API Geocoding de Google
    if ($adresse_new !== $adresse_old) {

        $bfwSiteSettings = new bfwSiteSettings();
        $googleMapsUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($adresse_new) . "&key=" . $bfwSiteSettings->getGoogleServicesMapsApiToken();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $googleMapsUrl);
        curl_setopt($ch, CURLOPT_REFERER, $googleMapsUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3000);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10000);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);

        update_post_meta($post_id, 'bfw_map_marker_adresse', $adresse_new);
        update_post_meta($post_id, 'bfw_map_marker_latitude', $result->results[0]->geometry->location->lat);
        update_post_meta($post_id, 'bfw_map_marker_longitude', $result->results[0]->geometry->location->lng);
    }

    // On met aussi à jour quoi qu'il arrive les autres informations du bfw_map_marker
    update_post_meta($post_id, 'bfw_map_marker_telephone', $_POST['bfw_map_marker_telephone']);
    update_post_meta($post_id, 'bfw_map_marker_email', $_POST['bfw_map_marker_email']);
    update_post_meta($post_id, 'bfw_map_id', $_POST['bfw_map_id']);

    // 5a68b8f0-1207-11ec-82a8-0242ac130003 - 1 - Ajouter ici la sauvegarde des champs à ajouter
    //update_post_meta($post_id, '{meta_key_to_update}', $_POST['{form_control_name}']);
}
add_action('save_post', 'bfw_marker_meta_box_save');

/**
 * Supprime l'item de menu dans l'administration correspondant au CPT bfw_map_marker
 */
function bfw_map_marker_remove_menu_item() {
    remove_menu_page( 'edit.php?post_type=bfw_map_marker' );
}
add_action( 'admin_menu', 'bfw_map_marker_remove_menu_item' );