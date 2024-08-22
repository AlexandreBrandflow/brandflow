<?php
/**
 * bfw-sticky-slider Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-sticky-slider';
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

?>


<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr($class_name); ?> --style-<?= $acf['style']; ?>">

    <div class="container-large ">
        <div class=" pt-4 pb-5 py-sm-8 py-lg-11 fx-col gap-4 gap-sm-8 container-inner">


            <div class="al-sm-center fx-col gap-25 ">
                <?php if ($acf['sur_titre']): ?>
                    <div class="sur_titre"><?= $acf['sur_titre']; ?></div>
                <?php endif; ?>
                <?php if ($acf['titre']): ?>
                    <h2><?= $acf['titre']; ?></h2>
                <?php endif; ?>
            </div>


            <div class="swiper bfw-swiper bfw-sticky-slider bfw-sticky-slider--<?= $variante; ?>" data-gap="48">
                <div class="bfw-sticky-slider__grid__wrapper swiper-wrapper">
                    <?php
                    $elements = $acf['elements'];

                    foreach ($elements as $args): ?>
                        <div class="bfw-sticky-slider__item swiper-slide">
                            <?php get_template_part('templates/' . $variante . '', null, $args); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>


    </div>

</div>