<?php
/**
 * bfw-features Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-features block-bfw style-beige container-large';
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


<div id="<?= sanitize_title($ancre); ?>" class=" <?php echo esc_attr($class_name); ?> container-large">
    <div class="pt-4 pb-0 py-sm-8 py-lg-11">
        <div class="fx-col gap-4 gap-sm-8">

            <div class="al-sm-center fx-col gap-25 container-inner">
                <?php if ($acf['sur_titre']): ?>
                    <div class="sur_titre"><?= $acf['sur_titre']; ?></div>
                <?php endif; ?>
                <?php if ($acf['titre']): ?>
                    <h2><?= $acf['titre']; ?></h2>
                <?php endif; ?>
            </div>

            <?php if (!empty($acf['elements'])): ?>
                <div class="features container-inner bfw-grid gap-sm-4 ">
                    <?php $elements = $acf['elements']; ?>
                    <?php foreach ($elements as $el): ?>
                        <div class="features__item br-sm-24 br-12 bfw-grid__item fx-col col-md-4 --style-blue-light pt-25 pb-3 px-25 py-sm-3 px-sm-35">
                            <div class="fx-col gap-35 al-start mb-3 mb-sm-9">

                                <?php $icone = $el['icone'];
                                $size = array('24', '24');
                                bfw_echo_svg($icone['image'], $size, $icone['classe'], $icone['style']); ?>
                                <div>
                                    <h3 class="fw-500 font-md mb-2"><?= $el['titre']; ?></h3>
                                    <div class=""><?= $el['contenu']; ?></div>
                                </div>
                            </div>

                            <?php $liens = $el['liens']; ?>
                            <?php if (!empty($liens)): ?>
                                <div class="fx gap-2 mt-auto">
                                    <?php foreach ($liens as $lien): ?>
                                        <?php
                                        ?>
                                        <?php bfw_echo_lien($lien); ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>



                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="container-inner fullwidth-xs">
                <?php if (get_field('variante') == 'cta'): ?>
                    <?php get_template_part('templates/lore/solutions-cta', null, $args); ?>
                </div>

            <?php endif; ?>
        </div>

    </div>
</div>