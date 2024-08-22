<?php
/**
 * bfw-evenements Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-evenements evenements block-bfw container-large bfw-posts';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}


// Load values

$args = array();

$acf = bfw_get_fields($args);

?>


<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr($class_name); ?> --style-<?= $acf['style']; ?>">
    <div class="container-inner pt-sm-8 pb-sm-11 pt-4 pb-5 fx-col gap-4 gap-sm-5">
        <div class="evenements__title just-sm-between gap-35 fx-col fx-sm-row">
            <h2 class="fx gap-25 font-xl">
                <?= $acf['titre']; ?>
            </h2>
            <?php $liens = $acf['liens']; ?>
            <?php if (!empty($liens)): ?>
                <div class="fx gap-25 fx-wrap">
                    <?php foreach ($liens as $lien): ?>
                        <?php bfw_echo_button($lien); ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php

        // Créer une nouvelle requête pour les articles de blog les plus récents en état publié
        $query = new WP_Query(
            array(
                'post_type' => 'lore_evenements', // Type de post 'post' pour les articles de blog natifs
                'posts_per_page' => 3, // Limite de résultats à 6 articles
                'post_status' => 'publish', // Seulement les posts publiés
                'orderby' => 'date', // Trier par date de publication
                'order' => 'DESC', // Ordre de tri descendant (du plus récent au plus ancien)
            )
        );

        // Vérifier si des articles ont été trouvés
        if ($query->have_posts()): ?>

            <div class="evenements__row bfw-posts__grid bfw-grid gap-35-0 gap-sm-5-35">
                <?php
                // Inclure le template pour afficher les résultats
                while ($query->have_posts()):
                    $query->the_post();
                    $args = array('id' => $post->ID, 'classe' => 'evenements__item bfw-posts__item col-md-4 bfw-grid__item', 'variante' => 'evenements');
                    get_template_part('templates/post', null, $args);
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>


    </div>
</div>