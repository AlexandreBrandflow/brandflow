<?php

/**
 * bfw-texte-image-multi Block Template.
 */
// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';
// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw block-bfw-texte-image-multi container-large ';
if (!empty($block['className'])) {
   $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
   $class_name .= ' align' . $block['align'];
}
$args = array(
);
$acf = bfw_get_fields($args); ?>

<?php $liens = $acf['liens'];
$lien_items = $liens[0]; ?>

<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr($class_name); ?> --style-<?= $acf['style']; ?>">

   <div class="container-large ">
      <div class="container-inner pt-4 pb-5 py-sm-8 py-lg-11 fx-col gap-5 gap-sm-8">
         <div class="al-sm-center fx-col gap-25">
            <?php if ($acf['sur_titre']): ?>
               <div class="sur_titre"><?= $acf['sur_titre']; ?></div>
            <?php endif; ?>
            <?php if ($acf['titre']): ?>
               <h2><?= $acf['titre']; ?></h2>
            <?php endif; ?>
         </div>

         <?php
         $elements = $acf['elements'];
         if (!empty($elements)): ?>
            <div class="texte-image-multi gap-6 gap-sm-11 fx-col">
               <?php
               $c = 0;
               foreach ($elements as $el):
                  $liens = $el['liens'];
                  ?>
                  <div class="bfw-grid gap-sm-4 gap-md-6 gap-lg-8 texte-image-multi__item  al-center" id="<?= $el['ancre']; ?>">
                     <div class=" texte-image-multi__item__img bfw-grid__item">
                        <?php if ($el['image']): ?>
                           <div class="img img--cover img--shadow-large">
                              <?php bfw_echo_image($el['image'], array('600', '800'), ''); ?>
                           </div>
                           <?php if ($el['vecteurs']):
                              $c = 0;
                              $url = $el['vecteurs'][0]['image'];
                              ?>
                              <div class="vecteurs">
                                 <?php foreach ($el['vecteurs'] as $image):
                                    $url = $image['image'];
                                    $class = 'vecteurs__item vecteurs__item__' . $c;
                                    ?>
                                    <?php bfw_echo_svg($url, $size, $class); ?>
                                    <?php
                                    $c++;
                                 endforeach; ?>
                              </div>
                           <?php endif; ?>
                        <?php endif; ?>
                     </div>
                     <div class="content py-25 py-sm-0 texte-image-multi__item__content bfw-grid__item">
                        <div class="fx fx-col gap-3">
                           <div class="gap-2 fx fx-col">
                              <h3 class="font-large"><?= $el['titre']; ?></h3>

                           </div>
                           <div class="fw-500">
                              <?php if ($el['contenu']): ?>
                                 <?= $el['contenu']; ?>
                              <?php endif; ?>
                           </div>

                           <div class="">
                              <?php if ($el['contenu_secondaire']): ?>
                                 <?= $el['contenu_secondaire']; ?>
                              <?php endif; ?>
                           </div>
                           
                           <?php if (!empty($liens)): ?>
                              <div class="fx gap-2">
                                 <?php foreach ($liens as $lien): ?>
                                    <?php
                                    ?>
                                    <?php bfw_echo_button($lien); ?>
                                 <?php endforeach; ?>
                              </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php
                  $c++;
               endforeach; ?>
               <div class="fx-col gap-35 gap-sm-5">
                  <h3 class="text-sm-center font-large"><?= wp_strip_all_tags($acf['contenu_secondaire']); ?></h3>
                  <?php 
                  $args = $lien_items;
                  get_template_part('templates/lore/solutions-complementaires', null, $args); ?>
               </div>
            </div>
         <?php endif; ?>






         <div>
            <?php $liens = $acf['liens']; ?>
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