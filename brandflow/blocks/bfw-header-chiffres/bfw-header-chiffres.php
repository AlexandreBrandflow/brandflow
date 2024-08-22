<?php
/**
 * bfw-header-chiffres Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';


// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw block-bfw-header block-bfw-header-chiffres header-chiffres';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values

$args = array(
);

$acf = bfw_get_fields($args);
?>



<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr($class_name); ?>">
    <div class="container-large h-100 py-35 py-sm-8 py-md-11 py-lg-13">

        <div class="container-inner fx-col h-100 text-center al-sm-center">
            <div class="fx-col gap-4 content w-sm-80 h-100 ">
                <div class="fx-col gap-35">
                    

                    <h1 class="">
                        <?= $acf['titre']; ?>
                    </h1>

                    <?php if ($acf['contenu']): ?>
                        <div class="fw-500 font-md">
                            <?= $acf['contenu']; ?>
                        </div>

                    <?php endif; ?>
                </div>

                <?php

                $elements = $acf['elements'];
                if (!empty($elements)): ?>
                    <div class="header-chiffres__grid fx gap-25 gap-sm-3 fx-wrap just-center mt-3">
                        <?php
                        $c = 0;
                        foreach ($elements as $el): ?>

                            <div class="header-chiffres__item fx-col al-center gap-1">
                                <div class="font-xl header-chiffres__item__title font-title"><?= $el['titre']; ?></div>
                                <div class="font header-chiffres__item__content"><?= $el['contenu']; ?></div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>



        <div class="img img--cover img--absolute h-100 w-100">
            <?php bfw_echo_image($acf['background'], array('2000', '2000')); ?>
        </div>



    </div>




</div>