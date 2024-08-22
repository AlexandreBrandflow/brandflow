<?php
/**
 * bfw-grid-plus-sticky-slider Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-grid-plus-sticky-slider';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values

$args = array();

$acf = bfw_get_fields($args);

$variante = 'valeurs';

?>


<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr($class_name); ?> --style-<?= $acf['style']; ?>">

    <div class="container-large ">
        <div class=" pt-4 pb-0 pt-sm-8 pt-lg-11 fx-col gap-4 gap-sm-6 ">

            <div class="al-sm-center fx-col gap-25 container-inner">
                <?php if ($acf['sur_titre']): ?>
                    <div class="sur_titre"><?= $acf['sur_titre']; ?></div>
                <?php endif; ?>
                <?php if ($acf['titre']): ?>
                    <h2><?= $acf['titre']; ?></h2>
                <?php endif; ?>
            </div>

            <?php /// première partie : valeurs ; ?>
            <div class="fx-col gap-35 gap-sm-5">
                <div class="container-inner">
                    <div class="swiper bfw-swiper bfw-sticky-slider bfw-sticky-slider--<?= $variante; ?>" data-gap="48">
                        <div class="bfw-sticky-slider__grid__wrapper swiper-wrapper">
                            <?php
                            $elements = $acf['elements'];

                            foreach ($elements as $args): ?>
                                <div class="bfw-sticky-slider__item swiper-slide">
                                    <?php get_template_part('templates/lore/' . $variante . '', null, $args); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>


                <?php // deuxième partie : témoignages ; ?>

                <?php
                // Créer une nouvelle requête pour les custom post types "expert" en état publié et sans limite de résultats
                $query = new WP_Query(
                    array(
                        'post_type' => 'expert',
                        'posts_per_page' => -1, // Aucune limite de résultats
                        'post_status' => 'publish', // Seulement les posts publiés
                        'orderby' => 'menu_order', // Trier par l'ordre du menu de page
                        'order' => 'ASC', // Ordre de tri (ascendant)
                    )
                );

                // Vérifier si des publications ont été trouvées
                if ($query->have_posts()): ?>
                    <div class="swiper bfw-swiper bfw-swiper--grab bfw-sticky-slider bfw-sticky-slider--experts --style-blue-light br-sm-24"
                        data-gap="48">
                        <div class="bfw-sticky-slider__grid__wrapper swiper-wrapper">
                            <?php
                            // Inclure le template pour afficher les résultats
                            while ($query->have_posts()):
                                $query->the_post(); ?>

                                <div class="bfw-sticky-slider__item swiper-slide px-25 pt-25 pb-35 px-sm-0 py-sm-0">

                                    <?php
                                    // Passer l'ID du post actuel au template part
                                    get_template_part('templates/lore/expert', null, array('post_id' => get_the_ID()));
                                    ?>

                                </div>

                                <?php

                            endwhile;

                            // Réinitialiser la requête principale
                            wp_reset_postdata();
                else:
                    // Aucune publication trouvée
                    echo 'Aucun expert trouvé.'; ?>

                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>


        </div>


    </div>

</div>