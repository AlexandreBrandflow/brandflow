<?php
/**
 * bfw-header-classique Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

$bloc_size = array('1800', '');

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-header-classique block-bfw-header';
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


<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr($class_name); ?>">
    <div class="container-large h-100 pt-9 pb-9 pt-sm-12 pb-sm-12">

        <div class="container-inner fx-col h-100 text-center al-center">
            <div class="fx-col gap-4 content w-sm-70 h-100 ">
                <div class="fx-col gap-35">
                    <?php
                    $sur_titre = $acf['sur_titre'];
                    if ($sur_titre):
                        $args = array('contenu' => $sur_titre);
                        get_template_part('templates/lore/tip', null, $args);
                    endif; ?>

                    <h1 class="">
                        <?= $acf['titre']; ?>
                    </h1>

                    <?php if ($acf['contenu']): ?>
                        <div class="fw-500 font-md">
                            <?= $acf['contenu']; ?>
                        </div>

                    <?php endif; ?>
                </div>
                <?php $liens = $acf['liens']; ?>
                <?php if (!empty($liens)): ?>
                    <div class="fx gap-35 fx-wrap">
                        <?php foreach ($liens as $lien): ?>
                            <?php
                            ?>
                            <?php bfw_echo_button($lien); ?>


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