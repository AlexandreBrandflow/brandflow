<?php
/**
 * bfw-intro-section Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-intro-section style-green-dark container-large';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values



$args = array(
'bloc_size' => $bloc_size
);
    
$acf = bfw_get_fields($args);
    
?>

<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr( $class_name ); ?>">
    <div class="container-inner pt-5 pt-md-7 pb-5 pb-md-7">
            <div class="content">
            <h2 class="text-center font-fonseca mb-3 mb-md-5">
                <?= $acf['titre'];?>
                <span class="font-script color-green-light"><?= $acf['sous_titre'];?></span>
            </h2>
                <div class="text-left">
                    <?php if($acf['contenu']):?>
                        <div class="font-h h3 font-h-01">
                            <?= $acf['contenu'];?>
                        </div>
                        <?php endif;?>
                </div>
                <div class="mx-auto mt-5 text-center">
                    <div class="circle">
                        <svg width="25" height="32" viewBox="0 0 14 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.05127 0.578125L7.05127 18.5268" stroke="#FFFDF0" stroke-width="1.5" stroke-miterlimit="10"/>
                            <path d="M7.07308 18.1095C7.07308 14.3364 10.1292 11.2803 13.9023 11.2803" stroke="#FFFDF0" stroke-width="1.5" stroke-miterlimit="10"/>
                            <path d="M0.222001 11.3477C3.99517 11.3477 7.05127 14.4038 7.05127 18.1769" stroke="#FFFDF0" stroke-width="1.5" stroke-miterlimit="10"/>
                        </svg>
                    </div>
                </div>
            </div>
    </div>
</div>