<?php
$categories = ($args['variante'] == 'evenements') ? array((object) ['name' => 'Évènements']) : get_the_category($id);
$lien = ($args['variante'] == 'evenements') ? "En savoir plus" : "Lire l'article";
?>

<div class="bfw-post <?= esc_attr($args['classe']); ?>">
   <a class="hoverlink" href="<?= esc_url(get_permalink($id)); ?>"></a>
   
   <?php
   if (has_post_thumbnail($id)) {
      $image = get_post_thumbnail_id($id);  
   } else
   {
      $photos_images = get_field('photos_images', $id);
      if(!empty($photos_images))
      {
         $image = $photos_images['photo_carre'] ?? null;
      }
      else
      {
         $image = get_field('images_par_defaut', 'option');
      }
      
   }
   if ($image): ?>
      <div class="img img--cover bfw-post__img">
         <?php bfw_echo_image($image, array('520', '320'), ''); ?>
      </div>
   <?php endif; ?>

   <div class="content fx fx-col gap-25 bfw-post__content">
      <?php if ($args['variante'] == 'evenements'): ?>
         <div class="sur_titre">Évènements</div>
      <?php else: ?>
         <?php if (!empty($categories)): ?>
            <div class="fx gap-2">
               <?php if ($category = $categories[0] ?? null): ?>
                  <div class="sur_titre"><?= esc_html($category->name); ?></div>
               <?php endif; ?>
            </div>
         <?php endif; ?>
      <?php endif; ?>
      
      <h3 class="font-alt fw-400"><?= wp_strip_all_tags(get_the_title($id)); ?></h3>

      <?php if ($args['variante'] == 'evenements'): ?>
         <?php
         $lecture = get_field('temps_de_lecture', $id);
         $date = get_field('date_de_levenement', $id);
         ?>
         <div class="fx-col bfw-post__attributs fx-col">
            <?php if ($lecture): ?>
               <div class="bfw-post__attributs__item">
                  <div class="icon type--fill">
                     <?php
                     $url = get_template_directory_uri() . '/assets/icons/date.svg';
                     $size = array('24', '24');
                     bfw_echo_svg($url, $size, ''); ?>
                  </div>
                  <?= esc_html($lecture); ?>
               </div>
            <?php endif; ?>

            <?php if ($date): ?>
               <div class="bfw-post__attributs__item">
                  <div class="icon type--fill">
                     <?php
                     $url = get_template_directory_uri() . '/assets/icons/time.svg';
                     $size = array('24', '24');
                     bfw_echo_svg($url, $size, ''); ?>
                  </div>
                  <?= esc_html($date); ?>
               </div>
            <?php endif; ?>
         </div>
      <?php endif; ?>
      
      <a href="<?= esc_url(get_permalink($id)); ?>" class="lien mt-auto pt-2"><?= esc_html($lien); ?></a>
   </div>
</div>
