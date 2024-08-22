<?php
/**
 * bfw-actualites Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-actualites block-bfw container-large';
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
    <div class="container-inner pt-sm-8 pb-sm-11 pt-4 pb-5 fx-col gap-6 gap-sm-8">
        <div class="fx-col gap-4 gap-sm-5">
            <div class="al-sm-center fx-col gap-25">
                <?php if ($acf['sur_titre']): ?>
                    <div class="sur_titre"><?= $acf['sur_titre']; ?></div>
                <?php endif; ?>
                <?php if ($acf['titre']): ?>
                    <h2 class="font-large text-center text-sm-left"><?= $acf['titre']; ?></h2>
                <?php endif; ?>
            </div>

            <?php
            $exclude_category_id = get_cat_ID('non-indexe-cache');

            $query = new WP_Query(
                array(
                    'post_type' => 'post',
                    'posts_per_page' => 10,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'category__not_in' => array('13'),

                )
            );

            // Vérifier si des articles ont été trouvés
            if ($query->have_posts()): ?>

                <div class="actualites-slider">
                    <div class="swiper actualites-swiper bfw-swiper bfw-swiper--grab" data-gap="36">
                        <div class="swiper-wrapper">
                            <?php
                            while ($query->have_posts()):
                                $query->the_post();
                                $args = array('id' => $post->ID, 'classe' => 'swiper-slide actualites-slider__item');
                                ?>
                                <?php get_template_part('templates/post', null, $args); ?>
                                <?php

                            endwhile;

                            // Réinitialiser la requête principale
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php get_template_part('templates/lore/newsletter-lore', null, $args); ?>



    </div>
</div>