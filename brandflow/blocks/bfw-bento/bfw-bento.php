<?php

/**
 * bfw-bento Block Template.
 */
// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';
// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw block-bfw-bento  ';
if (!empty($block['className'])) {
   $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
   $class_name .= ' align' . $block['align'];
}

$args = array();
$acf = bfw_get_fields($args); ?>


<div id="<?= sanitize_title($ancre); ?>"
   class="<?php echo esc_attr($class_name); ?>">
   <div class="container-large">
      <div class="container-inner pt-4 pb-5 py-sm-8 py-lg-11 fx-col gap-4 gap-sm-8">

         <div class="al-sm-center fx-col gap-25">
            <?php if ($acf['sur_titre']): ?>
               <div class="sur_titre"><?= $acf['sur_titre']; ?></div>
            <?php endif; ?>
            <?php if ($acf['titre']): ?>
               <h2><?= $acf['titre']; ?></h2>
            <?php endif; ?>
         </div>


         <div class="bfw-bento bfw-grid content">

            <div class="bfw-bento__item bfw-bento__item__01 fx-col gap-3">
               <?php $elements = get_field('bento_1'); ?>
               <?php foreach ($elements as $el): ?>


                  <div class="fx-col gap-2 al-center">

                     <?php $icone = $el['icone'];
                     $size = array('24', '24');
                     bfw_echo_svg($icone['image'], $size, $icone['classe'], $icone['style']); ?>
                     <div>
                        <div class="font-xxl font-title"><?= $el['titre']; ?></div>
                        <div class=""><?= $el['contenu']; ?></div>
                     </div>
                  </div>

               <?php endforeach; ?>
            </div>

            <div class="bfw-bento__item bfw-bento__item__02">
               <?php $bento = get_field('bento_2'); ?>

               <div class="fx-col gap-2 al-center pb-4 pb-sm-0">

                  <?php $icone = $bento['icone'];
                  $size = array('24', '24');
                  bfw_echo_svg($icone['image'], $size, $icone['classe'], $icone['style']); ?>

                  <div>
                     <div class="font-xxl font-title"><?= $bento['titre']; ?></div>
                     <div class=""><?= $bento['contenu']; ?></div>
                  </div>
               </div>
            </div>

            <div class="bfw-bento__item bfw-bento__item__03 bfw-bento__item--img">
               <?php $bento = get_field('bento_3'); ?>
               <div class="img img--cover h-100 w-100">
                  <?php bfw_echo_image($bento['image'], array('640', '640   '), ''); ?>
               </div>
            </div>

            <div class="bfw-bento__item bfw-bento__item__04 bfw-bento__item--paragraphe bfw-bento__item--center">
               <?php $bento = get_field('bento_4'); ?>
               <div class="fx gap-25 al-center fx-wrap">

                  <?php $icone = $bento['icone'];
                  $size = array('24', '24');
                  bfw_echo_svg($icone['image'], $size, $icone['classe'], $icone['style']); ?>

                  <div class="bfw-bento__item__texte">
                     <h3 class="fw-500 font-md mb-2 font-alt"><?= $bento['titre']; ?></h3>
                     <div class=""><?= $bento['contenu']; ?></div>
                  </div>
               </div>
            </div>


            <div class="bfw-bento__item bfw-bento__item__05 bfw-bento__item--img ">
               <?php $bento = get_field('bento_5'); ?>
               <div class="fx-col">
                  <div class="img img--cover">
                     <?php bfw_echo_image($bento['image'], array('640', '640   '), ''); ?>
                  </div>
                  <div class="bfw-bento__item__content">
                  <h3 class="fw-500 font-md mb-2 font-alt"><?= $bento['titre']; ?></h3>
                     <div class=""><?= $bento['contenu']; ?></div>
                  </div>
               </div>

            </div>

            <div class="bfw-bento__item bfw-bento__item__06 bfw-bento__item--center">
               <?php $bento = get_field('bento_6'); ?>

               <div class="fx-col gap-25 al-center">

                  <?php $icone = $bento['icone'];
                  $size = array('24', '24');
                  bfw_echo_svg($icone['image'], $size, $icone['classe'], $icone['style']); ?>

                  <div>
                  <h3 class="fw-500 font-md mb-2 font-alt"><?= $bento['titre']; ?></h3>
                     <div class=""><?= $bento['contenu']; ?></div>
                  </div>
               </div>
            </div>

            <div class="bfw-bento__item bfw-bento__item__07 bfw-bento__item--center">
               <?php $bento = get_field('bento_7'); ?>

               <div class="fx-col gap-2 al-center">

                  <?php $icone = $bento['icone'];
                  $size = array('24', '24');
                  bfw_echo_svg($icone['image'], $size, $icone['classe'], $icone['style']); ?>

                  <div>
                     <div class="font-xxl font-title"><?= $bento['titre']; ?></div>
                     <div class=""><?= $bento['contenu']; ?></div>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>
   <div class="img img--cover img--absolute h-100 w-100">
      <?php bfw_echo_image($acf['background'], array('2000', '2000')); ?>
   </div>
</div>


<div class="fx-col gap-sm-5 gap-25">
   <div class="fx-col gap-35">

   </div>

</div>