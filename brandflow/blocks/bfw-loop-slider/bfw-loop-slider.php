<?php
/**
 * bfw-loop-slider Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-loop-slider';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values

$args = array();

$acf = bfw_get_fields($args); ?>


<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr($class_name); ?> --style-blue-light">

    <div class="container-large ">
        <div class=" pt-4 pb-5 py-sm-6 py-lg-8">
            <div class="fx-col gap-4 gap-sm-6">

                <div class="al-sm-center fx-col gap-25 container-inner">
                    <?php if ($acf['sur_titre']): ?>
                        <div class="sur_titre"><?= $acf['sur_titre']; ?></div>
                    <?php endif; ?>
                    <?php if ($acf['titre']): ?>
                        <h2><?= $acf['titre']; ?></h2>
                    <?php endif; ?>
                </div>

                <div class="text-center container-inner bfw-grid">
                    <div class="texte-large__container"><?= $acf['contenu']; ?></div>
                </div>

                <div class="bfw-loop-slider">
                    <div class="bfw-loop-slider__grid">
                        <div class="bfw-loop-slider__grid__wrapper fx gap-4 al-center">
                            <?php
                            $elements = get_field('clients', 'option');
                            $total = count($elements);
                            $minElements = 12;
                                if (count($elements) < $minElements) {
                                    // Duplique le contenu de $lignes0 autant de fois que nécessaire pour atteindre $minElements éléments
                                    while (count($elements) < $minElements) {
                                        $elements = array_merge($elements, $elements);
                                    }
                                }
                            foreach ($elements as $args): ?>
                                <div class="bfw-loop-slider__item">
                                    <?php get_template_part('templates/lore/client', null, $args); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>