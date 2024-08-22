<?php
/**
 * bfw-header-homepage Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';


// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw block-bfw-header block-bfw-header-homepage container-large ';
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

        <div class="container-inner fullwidth-xs fx-col gap-5 gap-sm-8 h-100 pt-0 pt-sm-11 pt-lg-13 gap-lg-13 pb-35">
            <div class="fx-col gap-4 content w-sm-70 w-md-60 h-100">
                <div class="fx-col gap-35">
                    <?php
                    $sur_titre = $acf['sur_titre'];
                    if ($sur_titre):
                        $args = array('contenu' => $sur_titre);
                        get_template_part('templates/lore/tip', null, $args);
                    endif; ?>

                    <h1 class="px-25 px-sm-0">
                        <?= $acf['titre']; ?>
                    </h1>

                    <?php if ($acf['contenu']): ?>
                        <div class="fw-500 font-md px-25 px-sm-0 block-bfw-header-homepage__contenu">
                            <?= $acf['contenu']; ?>
                        </div>

                    <?php endif; ?>
                </div>
                <?php $liens = $acf['liens']; ?>
                <?php if (!empty($liens)): ?>
                    <div class="fx gap-2-3 fx-wrap px-25 px-sm-0 block-bfw-header-homepage__liens">
                        <?php foreach ($liens as $lien): ?>
                            <?php bfw_echo_button($lien); ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mt-auto px-25 px-sm-0">
                <?php
                get_template_part('templates/lore/preuve-sociale', null, $args);
                ?>
            </div>

        </div>



        <div class="img img--cover img--absolute h-100 w-100">
            <?php bfw_echo_image($acf['background'], array('2000', '2000')); ?>
        </div>

        <?php if ($acf['vecteurs']):
            $size = 'full';
            $url = $acf['vecteurs'][0]['image'];
            ?>
            <div class="vecteurs">
                <div class="img h-100">
                    <?php bfw_echo_svg($url, $size, $class); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>



    