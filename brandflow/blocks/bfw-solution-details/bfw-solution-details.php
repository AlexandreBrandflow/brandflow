<?php
/**
 * bfw-solution-details Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw block-bfw-solution-details';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values

$args = array();

$acf = bfw_get_fields($args);
$elements = $acf['elements'];

$variante = $acf['variante'];
?>

<div id="<?= sanitize_title($acf['titre']); ?>" data-parent
    class="container-large <?php echo esc_attr($class_name); ?> --style-<?= $acf['style']; ?> <?= $variante ? '--variante-' . $variante : ''; ?>">
    <div class="container-inner">
        <div class="solution-details fx-col gap-35 gap-sm-5 ">

            <div class="solution-details__header bfw-grid">
                <div class="fx just-between al-center solution-details__header__inner fx-wrap gap-35">

                    <div class="solution-details__logo">
                        <h2 class="fx gap-2 gap-sm-25 font-xl al-center">
                            <?= $acf['titre']; ?>
                            <?php if ($acf['icone']['image']):
                                $icone = $acf['icone'];
                                $size = array('24', '24');
                                bfw_echo_svg($icone['image'], $size, $icone['classe'], $icone['style']); ?>
                            <?php endif; ?>
                        </h2>
                    </div>

                    <div class="solution-details__liens">
                        <?php $liens = $acf['liens']; ?>
                        <?php if (!empty($liens)): ?>
                            <div class="fx gap-2 gap-sm-25 fx-wrap">
                                <?php foreach ($liens as $lien): ?>
                                    <?php bfw_echo_button($lien); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
            <?php
            if (!empty($elements)): ?>
                <div class="bfw-grid solution-details__grid gap-lg-6 gap-md-4">

                    <div class="solution-details__content">

                        <div class="solution-details__nav">
                            <?php
                            $c = 0;
                            foreach ($elements as $el):
                                $slug = sanitize_title($el['sur_titre']);
                                ?>


                                <a href="#<?= $slug; ?>" data-mytoggle="onglet"
                                    class="<?= ($c == 0) ? 'active' : ''; ?> solution-details__nav__item btn --style-secondary  size--S">
                                    <?= $el['sur_titre']; ?>
                                </a>


                                <?php
                                $c++;
                            endforeach; ?>
                        </div>

                        <div class="solution-details__tabs content">
                            <?php
                            $c = 0;
                            foreach ($elements as $el):
                                $slug = sanitize_title($el['sur_titre']);
                                ?>


                                <div id="<?= $slug; ?>" data-item
                                    class="pt-4 pb-3 solution-details__tabs__item --<?= $slug; ?> fx-col gap-4 <?= ($c == 0) ? 'active' : ''; ?> ">
                                    <?php if ($el['titre']): ?>
                                        <h3 class="font-large"><?= $el['titre']; ?></h3>
                                    <?php endif; ?>
                                    <?php if ($el['contenu']): ?>
                                        <?= $el['contenu']; ?>
                                    <?php endif; ?>
                                    <?php
                                    if (($el['arguments'])):
                                        $elements = explode("\n", $el['arguments']);
                                        ?>
                                        <!-- <?php //if ($slug !== 'fonctionnalites'): ?>
                                            <div class="stickers fx fx-wrap gap-1">
                                                <?php

                                                // foreach ($elements as $args):
                                                //     get_template_part('templates/lore/sticker', null, $args);
                                                // endforeach; ?>
                                            </div>
                                        <?php //elseif ($slug == 'fonctionnalites'): ?> -->
                                            <div class="fonctionnalites__row">
                                                <?php
                                                foreach ($elements as $el): ?>
                                                    <div class="fonctionnalites__item font-s"><?= $el; ?></div>
                                                <?php endforeach; ?>
                                            </div>

                                        <?php //endif; ?>
                                        <?php
                                    endif;
                                    ?>
                                </div>


                                <?php
                                $c++;
                            endforeach; ?>
                        </div>

                    </div>

                    <div class="solution-details__image">
                        <?php if ($acf['image']): ?>

                            <div class="img img--cover">
                                <?php bfw_echo_image($acf['image'], array('640', '640   '), ''); ?>
                            </div>
                        <?php endif; ?>
                    </div>



                </div>

            </div>
        <?php endif; ?>
        <div class="solution-details__footer__liens mt-25">
            <?php $liens = $acf['liens']; ?>
            <?php if (!empty($liens)): ?>
                <div class="fx gap-2 gap-sm-25 fx-wrap just-center">
                    <?php foreach ($liens as $lien): ?>
                        <?php bfw_echo_button($lien); ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>