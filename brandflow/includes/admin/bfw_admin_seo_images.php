<?php

function bfw_admin_page_seo_images_display() {


    if (isset($_POST['submit'])) {

        // Dans le cas d'un POST sur cette page
        if (isset($_POST) && isset($_POST['seo'])) {
            foreach ($_POST['seo'] as $seo) {
                // Si la ligne courante a été modifiée, alors on modifie les valeurs de l'attachment
                if (isset($seo['isupdated'])) {

                    // Récupération des valeurs dans la ligne courante
                    $attachment_id = stripslashes($seo['attachmentid']) ;
                    $attachment_title = stripslashes($seo['title']);
                    $attachment_content = stripslashes($seo['content']);
                    $attachment_excerpt = stripslashes($seo['excerpt']);
                    $attachment_alt = stripslashes($seo['alt']);

                    /// Récupération en base de données du post à modifier
                    $attachment = get_post($attachment_id);

                    // Modification du post et de ses metas
                    $attachment->post_title = apply_filters('the_title', $attachment_title);
                    $attachment->post_content = apply_filters('the_title', $attachment_content);;
                    $attachment->post_excerpt = apply_filters('the_title', $attachment_excerpt);
                    update_post_meta($attachment_id, '_wp_attachment_image_alt', $attachment_alt);

                    // Sauvegarde en base de données
                    wp_update_post($attachment);
                }
            }
        }
    }

    $images = get_posts(array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'post_status'    => 'inherit',
        'posts_per_page' => - 1,
    ));

    ?>

    <div class="bfw_admin_page bfw_admin_page_detail">
        <div class="bfw_admin_page_header">
            <h2>bfw - SEO Images</h2>
        </div>
        <div class="bfw_admin_page_content">
            <div class="bfw_admin_page_content_wrapper">

                <div class="dashboard_indicator">
                    <div class="dashboard_indicator_wrapper" style="height: auto; padding: 20px 20px 60px 20px;">

                        <form method="post">

                            <table class="bfw_admin_table">
                                <tr>
                                    <th>Image</th>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Excerpt</th>
                                    <th>Texte Alternatif</th>
                                </tr>

                                <?php

                                    foreach ($images as $attachment_id => $attachment) {

                                        $title = apply_filters('the_title', $attachment->post_title);
                                        $content = str_replace(array('<p>', '</p>'), "", apply_filters('the_content', $attachment->post_content));

                                        $id = apply_filters('the_id', $attachment->ID);
                                        $excerpt = str_replace(array('<p>', '</p>'), "", apply_filters('the_excerpt', $attachment->post_excerpt));
                                        $alt = str_replace(array('<p>', '</p>'), "", get_post_meta($id, '_wp_attachment_image_alt', true));

                                ?>

                                    <tr>

                                        <td>
                                            <img src="<?= wp_get_attachment_url($attachment->ID);  ?>" style="width: 100px; height: auto;">
                                            <input type="hidden"  name="seo[<?= $attachment_id ?>][attachmentid]" value="<?php echo $id; ?>">
                                            <input type="checkbox" name="seo[<?= $attachment_id ?>][isupdated]" id="cb_is_changed_<?php echo $attachment_id; ?>" style="display: none;">
                                        </td>

                                        <td>
                                            <input type="text" name="seo[<?= $attachment_id ?>][title]" value="<?php echo str_replace(array('<p>', '</p>'), "", $title); ?>" data-trigger="textbox-change" data-target="#cb_is_changed_<?php echo $attachment_id; ?>" style="width: 100%;">
                                        </td>

                                        <td>
                                            <input type="text" name="seo[<?= $attachment_id ?>][content]" value="<?= $content; ?>" data-trigger="textbox-change" data-target="#cb_is_changed_<?php echo $attachment_id; ?>"  style="width: 100%;">
                                        </td>

                                        <td>
                                            <input type="text" name="seo[<?= $attachment_id ?>][excerpt]" value="<?= $excerpt ?>" data-trigger="textbox-change" data-target="#cb_is_changed_<?php echo $attachment_id; ?>"  style="width: 100%;">
                                        </td>

                                        <td>
                                            <input type="text" name="seo[<?= $attachment_id ?>][alt]" value="<?= $alt ?>" data-trigger="textbox-change" data-target="#cb5_is_changed_<?php echo $attachment_id; ?>"  style="width: 100%;">
                                        </td>

                                    </tr>

                                    <?php } ?>

                            </table>

                            <div class="dashboard_indicator_actions">

                                <button type="submit" name="submit" class="dashboard_indicator_action">
                                    Enregistrer les modifications
                                </button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        (function($) {

            /**
             * Permet de mettre dans la BDD uniquement les images modifiés
             */
            jQuery(document).ready(function() {
                jQuery('[data-trigger="textbox-change"]').change(function() {
                    var target = jQuery(this).data('target');
                    jQuery(target).prop('checked', 'checked');
                });
            });

        })(jQuery);

    </script>

    <?php

}