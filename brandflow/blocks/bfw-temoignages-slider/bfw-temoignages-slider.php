<?php
/**
 * bfw-temoignages-slider Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-temoignages-slider temoignages';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values

$args = array();

$acf = bfw_get_fields($args);

$variante = $acf['variante'];

$timing = 6000;

?>


<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr($class_name); ?> --style-<?= $acf['style']; ?>">

    <div class="container-large">

        <div class="  pt-4 pb-5 py-sm-8 py-lg-11 fx-col gap-4 gap-sm-8 container-inner fullwidth-xs">
            <div class="al-sm-center fx-col gap-25 px-25 px-sm-0">
                <?php if ($acf['sur_titre']): ?>
                    <div class="sur_titre"><?= $acf['sur_titre']; ?></div>
                <?php endif; ?>
                <?php if ($acf['titre']): ?>
                    <h2><?= $acf['titre']; ?></h2>
                <?php endif; ?>
            </div>

            <?php
            $query = new WP_Query(
                array(
                    'post_type' => 'lore_clients',
                    'posts_per_page' => 26,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    // 'meta_query' => array(
                    //     array(
                    //         'key' => 'video',
                    //         'value' => '', 
                    //         'compare' => '!=' 
                    //     ),
                    // ),
                )
            );

            // VIDEOS ONLY
            
            // Vérifier si des articles ont été trouvés
            if ($query->have_posts()):
                $slidesCount = $query->post_count;
                ?>
                <div class="bfw-dynamic-swiper" style="--timing: <?= $timing; ?>ms;" data-parent>
                    <div class="swiper bfw-swiper bfw-swiper--grab temoignages__slider bfw-dynamic-swiper__main --navigation"
                        data-gap="48" data-timing="<?= $timing; ?>">
                        <div class="swiper-wrapper">
                            <?php
                            // Inclure le template pour afficher les résultats
                            while ($query->have_posts()):
                                $query->the_post();
                                $args = array('id' => $post->ID, 'classe' => ' swiper-slide ');
                                get_template_part('templates/lore/temoignages-clients', null, $args);
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <div class="mt-sm-5 mt-3 fx just-center">
                        <div class="bfw-dynamic-component">
                            <div class="bfw-dynamic-swiper__nav__prev bfw-dynamic-swiper__nav__item">
                                <?php
                                $args = array('direction' => 'prev', 'classe' => '', 'variante' => 'large', 'data' => '');
                                get_template_part('templates/bfw-swiper-button', null, $args); ?>
                            </div>
                            <div class="bfw-dynamic-swiper__nav swiper bfw-swiper --navigation ">

                                <div class="swiper-wrapper">
                                    <?php
                                    // Générer les slides pour la pagination
                                    for ($i = 0; $i < $slidesCount; $i++):
                                        ?>
                                        <div class="swiper-slide swiper-thumb">
                                        </div>
                                    <?php endfor; ?>
                                </div>

                            </div>

                            <div class="bfw-dynamic-swiper__nav__prev bfw-dynamic-swiper__nav__item">
                                <?php
                                $args = array('direction' => 'next', 'classe' => '', 'variante' => '', 'data' => '');
                                get_template_part('templates/bfw-swiper-button', null, $args); ?>
                            </div>

                        </div>

                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($acf['background']): ?>
        <div class="img img--cover img--absolute h-100 w-100">
            <?php bfw_echo_image($acf['background'], array('2000', '2000')); ?>
        </div>
    <?php endif; ?>
</div>