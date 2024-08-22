<?php
/**
 * bfw-solution-complementaires Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw block-bfw-solution-complementaires ';
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
$elements = $acf['elements'];
?>

<?php $liens = $acf['liens']; 
$lien = $liens[0]; ?>

<div id="<?= sanitize_title($ancre); ?>"
    class="container-large <?php echo esc_attr($class_name); ?> --style-<?= $acf['style']; ?>">
    <div class="container-inner pt-4 pb-5 py-sm-6 py-lg-8">
        <div class="fx-col gap-35 gap-sm-5">
            <h3 class="text-sm-center font-large"><?= wp_strip_all_tags($acf['titre']); ?></h3>
            <?php $args = $lien;?>
            <?php get_template_part('templates/lore/solutions-complementaires', null, $args); ?>
            <div>
                
                <?php if (!empty($liens)): ?>
                    <div class="fx gap-2 just-center">
                        <?php foreach ($liens as $lien): ?>
                            <?php bfw_echo_button($lien); ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>