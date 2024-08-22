<?php
/**
 * bfw-timeline Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-timeline block-bfw has-animation';
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
    
    
    <div id="<?= sanitize_title($ancre); ?>" class="container-large <?php echo esc_attr( $class_name ); ?>"  data-animate="timeline">
        <div class="container-inner vpd">
            <div class="content">
               
                <div class="fx fx-col bfw-timeline-elements">
                    <div class="bfw-timeline-progress"><div class="bfw-timeline-progress-bar"></div></div>
                    <?php if(!empty($acf['elements'])):?>
                    <?php
                        $c = 0;
                        foreach ($acf['elements'] as $el):
                            $size = array('24', '24');
                            $icone_src = wp_get_attachment_image_src($el['icone']['image'], $size);
                            $classe = '';
                            ?>
                            <?php if($el['contenu']):?>
                                <div class="bfw-timeline-element fx pb-4 pl-5">
                                <div class="bfw-timeline-element-progress"><div class="bfw-timeline-element-progress-bar"></div></div>
                                    <div class="icon icon-large bfw-timeline-element-icon <?= $el['icone']['classe'];?>"><?php bfw_echo_svg($icone_src[0], $size, $class);?></div>
                                        <div class="fx just-between mt-2">
                                        <div class="w-40">
                                            <?php if($el['sous_titre']):?>
                                                <div class="sous_titre"><?= $el['sous_titre'];?></div>
                                            <?php endif;?>
                                            <?php if($el['titre']):?>
                                            <h2><?= $el['titre'];?></h2>
                                            <?php endif;?>
                                            <?php if($el['contenu']):?><div class="medium"><?= $el['contenu'];?></div><?php endif;?>
                                        </div>
                                        <div class="img br-8 w-100 w-md-40">
                                            <?php 
                                                $size = $bloc_size;
                                                $image = $el['image'];
                                                $image_src = wp_get_attachment_image_src($image, $size);
                                            ?>
                                            <img src="<?= $image_src[0];?>" loading="lazy" width="<?= $size[0];?>" height="<?= $size[1];?>">
                                        </div>
                                    </div>
                                </div>  
                            <?php endif;?>
                            <?php
                            $elements_sub = $el['elements'];
                            if(!empty($elements_sub)):
                            ?>
                            <div class="bfw-timeline-element fx fx-col pt-6">
                            <div class="icon icon-large bfw-timeline-element-icon <?= $el['icone']['classe'];?>"><?php bfw_echo_svg($icone_src[0], $size, $class);?></div>
                                <div>
                                    <?php if($el['sous_titre']):?>
                                        <div class="sous_titre"><?= $el['sous_titre'];?></div>
                                    <?php endif;?>
                                    <?php if($el['titre']):?>
                                    <h2><?= $el['titre'];?></h2>
                                    <?php endif;?>
                                    <?php if($el['contenu']):?><div class="medium"><?= $el['contenu'];?></div><?php endif;?>
                                </div>
                                <div class="bfw-timeline-element-grid mt-3">
                                    <?php
                                    foreach($elements_sub as $el_sub):
                                        $icone = $el_sub['icone']['image'];
                                        if($icone):
                                            $size = array('46', '46');
                                            $icone_src = wp_get_attachment_image_src($el_sub['icone']['image'], $size);
                                            $classe = '';
                                        endif;?>
                                        <?php $image = $el_sub['image'];
                                        $size = array('600', '');
                                        if($image)
                                        {
                                            $image_src = wp_get_attachment_image_src($image, $size);
                                        }?>
                                        <div class="card card-large card-argument fx fx-col <?= $el_sub['classe'];?> <?= ($image) ? 'has-img' : '';?>  ">
                                            <?php if($image): ?>
                                                <div class="img br-8">
                                                    <img src="<?= $image_src[0];?>" loading="lazy" width="<?= $size[0];?>" height="<?= $size[1];?>">
                                                </div>
                                            <?php else:?>
                                                <?php if($icone):?>
                                                    <div class="icon icon-large mb-2 mb-md-4 <?= $el_sub['icone']['classe'];?>">
                                                    <?php bfw_echo_svg($icone_src[0], $size, $class);?>
                                                    </div>
                                                <?php elseif($el_sub['sous_titre']):?>
                                                    <div class=""><?= $el_sub['sous_titre'];?></div>
                                                    
                                                <?php endif;?>
                                            <?php if($el_sub['titre']):?><h3 class="mt-auto h2"><?= $el_sub['titre'];?></h3><?php endif;?>
                                            <div class="larger bold"><?= $el_sub['contenu'];?></div>
                                            <?php endif;?>
                                                
                                            
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <?php endif;?>
                                   
                        <?php endforeach;?>

                    <?php endif;?>
                </div>
            </div>
    
        <div class="vectors">
            <?php 
            if(!empty($acf['images'])):
                $size = array('1000', '');
                $c = 1;
                foreach($acf['images'] as $image):
                    $image_src = wp_get_attachment_image_src($image, $size);
                    ?>
                    <div class="vector vector-<?= $c;?>" data-depth="5">
                        <img src="<?= $image_src[0];?>" loading="lazy" width="<?= $size[0];?>" height="<?= $size[1];?>">
                    </div>
                <?php 
            $c++;
            endforeach;?>
            <?php endif;?>
        </div>
        
    </div>