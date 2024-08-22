<?php

/**
 * bfw-cta-carrieres Block Template.
 */
// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';
// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw block-bfw-cta-carrieres';
if (!empty($block['className'])) {
   $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
   $class_name .= ' align' . $block['align'];
}

$acf = get_field('carrieres_cta', 'option'); ?>


<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr($class_name); ?>">
   <div class="container-large">
      <div class=" pt-4 pb-0 py-sm-8 py-lg-11 fx-col gap-4 gap-sm-8">

         <div class="al-sm-center fx-col gap-25 container-inner">
            <?php if ($acf['sur_titre']): ?>
               <div class="sur_titre"><?= $acf['sur_titre']; ?></div>
            <?php endif; ?>
            <?php if ($acf['titre']): ?>
               <h2><?= $acf['titre']; ?></h2>
            <?php endif; ?>
         </div>

         <div class="container-inner fullwidth-xs">
            <div class="bfw-cta-carrieres px-25 pt-35 pb-45 px-sm-5 py-sm-5 ">
               <div class="bfw-cta-carrieres__content py-25 px-25 px-sm-4 py-sm-4">

                  <div class="fx-col gap-25">
                     <h3 class="font-medium">
                        <?= wp_strip_all_tags($acf['contenu']); ?>
                     </h3>
                     <?= $acf['contenu_secondaire']; ?>
                     <?php $liens = $acf['liens']; ?>
                     <?php if (!empty($liens)): ?>
                        <div class="fx gap-2">
                           <?php foreach ($liens as $lien): ?>
                              <?php bfw_echo_button($lien); ?>
                           <?php endforeach; ?>
                        </div>
                     <?php endif; ?>
                  </div>
               </div>
               <div class="img img--cover img--absolute h-100 w-100 bfw-cta-carrieres__background">
                  <?php bfw_echo_image($acf['background'], array('2000', '2000')); ?>
               </div>
            </div>
         </div>

      </div>

   </div>
</div>