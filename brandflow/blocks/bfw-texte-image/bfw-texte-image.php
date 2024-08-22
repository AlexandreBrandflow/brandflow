<?php
/**
 * bfw-texte-image Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw block-bfw-texte-image style-beige container-large';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$bloc_size = 'full';

$args = array(
    'bloc_size' => $bloc_size
    );
    
$acf = bfw_get_fields($args);
    
?>


<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr( $class_name ); ?> style--<?= $acf['style'];?>">

    <div class="container-large py-3 py-lg-11">

        <div class="container-inner">
            <div class="bfw-grid gap-md-4">
                <div class="col-md-4">
                    <?php if($acf['image']):?>

                        <div class="img img--cover">
                            <?php bfw_echo_image($acf['image'], array('640', '640   '), '');?>
                        </div>
                    <?php endif;?>
                </div>

                <div class="col-md-4 pt-md-35">
                    <div class="fx fx-col gap-md-5">
                        <div class="fx fx-col gap-md-3">
                            <div class="gap-2 fx fx-col">
                                <h2 class="font-fonseca">
                                    
                                        <span class="font-xl"><?= $acf['sur_titre'];?></span>
                                        <span class="font-script font-xxl"><?= $acf['titre'];?></span>
                                </h2>

                            </div>

                        <div class="text-left">

                            <?php if($acf['contenu']):?>

                                <?= $acf['contenu'];?>
                                <?php endif;?>
                        </div>
                    </div>
                    

                    <?php $liens = $acf['liens'];?>
                    <?php if(!empty($liens)):?>
                        <div class="fx gap-2">
                            <?php foreach($liens as $lien):?>
                            

                                <?php 
                                ?>
                                <?php bfw_echo_button($lien);?>


                            <?php endforeach;?>
                        </div>
                    <?php endif;?>
                </div>
                </div>
                

            </div>

        </div>

    </div>

</div>