<?php
/**
 * bfw-texte-loop-slider Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-texte-loop-slider';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values

$args = array();
$autoplay = 1000; // necessaire pour les sliders
$acf = bfw_get_fields($args); ?>


<?php
$elements = $acf['galerie'];

if (!empty($elements)) {
    // Total number of elements
    $total = count($elements);

    // Determine the size of each part ensuring a minimum of 8 elements each
    $min_part_size = 8;
    $required_size = 3 * $min_part_size; // Total minimum elements needed

    // Duplicate the elements globally to ensure there are enough elements if needed
    $original_elements = $elements; // Store the original elements
    while (count($elements) < $required_size) {
        $elements = array_merge($elements, $original_elements);
    }

    // Calculate the final size for each part to ensure the parts are equal
    $part_size = ceil(count($elements) / 3);

    // Slice the array into three parts
    $elements1 = array_slice($elements, 0, $part_size);
    $elements2 = array_slice($elements, $part_size, $part_size);
    $elements3 = array_slice($elements, 2 * $part_size);

    // Ensure each part has at least $min_part_size elements
    if (count($elements3) < $min_part_size) {
        $shortfall = $min_part_size - count($elements3);
        $elements3 = array_merge($elements3, array_slice($elements, 0, $shortfall));
    }

    if (count($elements2) < $min_part_size) {
        $shortfall = $min_part_size - count($elements2);
        $elements2 = array_merge($elements2, array_slice($elements, 0, $shortfall));
    }

    if (count($elements1) < $min_part_size) {
        $shortfall = $min_part_size - count($elements1);
        $elements1 = array_merge($elements1, array_slice($elements, 0, $shortfall));
    }
}

?>


<div id="<?= sanitize_title($ancre); ?>" class="container-large <?php echo esc_attr($class_name); ?> --style-<?= $acf['style']; ?>">

    <div class="container-inner">
        <div class=" pt-4 pb-5 py-sm-6 fx-col gap-4 gap-sm-8">
            <div class="bfw-grid al-md-center">


                <div class="fx-col gap-4 gap-sm-8 col-md-7 bfw-grid__item px-md-35">


                    <div class=" fx-col gap-25">
                        <?php if ($acf['sur_titre']): ?>
                            <div class="sur_titre"><?= $acf['sur_titre']; ?></div>
                        <?php endif; ?>
                        <?php if ($acf['titre']): ?>
                            <h2><?= $acf['titre']; ?></h2>
                        <?php endif; ?>
                    </div>

                    <div class="">
                        <?= $acf['contenu']; ?>
                    </div>
                </div>
                <div class="col-md-5 bfw-grid__item mt-4 mt-sm-0" >
                    <div class="texte-loop-slider ">
                        <div class="texte-loop-slider__container">
                            <div class="texte-loop-slider__swiper --vertical bfw-swiper swiper"
                                data-reversedirection="0" data-loop="true" data-gap="20"
                                data-speedindex="<?= $autoplay; ?>">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach ($elements1 as $args):
                                        get_template_part('templates/lore/card-client-logo', null, $args);
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                            <div class="texte-loop-slider__swiper --vertical bfw-swiper swiper"
                                data-reversedirection="1" data-loop="true" data-gap="20"
                                data-speedindex="<?= $autoplay; ?>">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach ($elements2 as $args):
                                        get_template_part('templates/lore/card-client-logo', null, $args);
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                            <div class="texte-loop-slider__swiper --vertical bfw-swiper swiper"
                                data-reversedirection="0" data-loop="true" data-gap="20"
                                data-speedindex="<?= $autoplay; ?>">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach ($elements3 as $args):
                                        get_template_part('templates/lore/card-client-logo', null, $args);
                                    endforeach;
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>