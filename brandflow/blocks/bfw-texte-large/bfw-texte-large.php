<?php
/**
 * bfw-texte-large Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-texte-large texte-large container-large';
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
    <div class="img img--cover texte-large__image --shadow-large">
        <?php bfw_echo_image($acf['image'], array('1200', '800'), ''); ?>
    </div>
    <div class="container-inner pt-4 pb-5 py-sm-8 py-lg-11 fx-col">
        <div class="bfw-grid texte-large__grid">
            <div class="texte-large__container ">


                <div class="fx-col gap-4 gap-sm-6">


                    <div class="al-sm-center fx-col gap-25">
                        <?php if ($acf['sur_titre']): ?>
                            <div class="sur_titre"><?= $acf['sur_titre']; ?></div>
                        <?php endif; ?>
                        <?php if ($acf['titre']): ?>
                            <h2><?= $acf['titre']; ?></h2>
                        <?php endif; ?>
                    </div>

                    <div class="texte-large__content">
                        <?= $acf['contenu']; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>