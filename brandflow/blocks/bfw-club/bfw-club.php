<?php

/**
 * bfw-club Block Template.
 */
// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';
// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw block-bfw-club bfw-club';
if (!empty($block['className'])) {
   $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
   $class_name .= ' align' . $block['align'];
}

$args = array();
$acf = bfw_get_fields($args); ?>


<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr($class_name); ?> --style-<?= $acf['style']; ?>">

   <div class="container-large ">
      <div class=" pt-4 pb-0 py-sm-8 py-lg-11 fx-col gap-4 gap-sm-6 container-inner fullwidth-xs">
         <div class="al-sm-center fx-col gap-4 px-25 px-sm-0">
            <?php if ($acf['sur_titre']): ?>
               <div class="sur_titre"><?= $acf['sur_titre']; ?></div>
            <?php endif; ?>
            <?php if ($acf['titre']): ?>
               <h2><?= $acf['titre']; ?></h2>
            <?php endif; ?>
            <?php if ($acf['contenu']): ?>
               <?= $acf['contenu']; ?>
            <?php endif; ?>
         </div>

         <div class="fx-col gap-25 gap-sm-5 mx-sm-auto w-xl-80 px-25 px-sm-0">
            <?php $elements = get_field('objectifs'); ?>

            <div class="bfw-club__objectifs gap-25 fx-col fx-sm-row fx-wrap">
               <?php
               $c = 0;
               foreach ($elements as $el):
                  $itemClasse = ($c == 0) ? '--large gap-2' : '--regular gap-25'; ?>
                  <div
                     class="bfw-club__objectifs__item <?= $itemClasse; ?> fx  al-center --style-<?= $el['style']; ?> px-3 py-3 br-16">

                     <?php $icone = $el['icone'];
                     $size = array('24', '24');
                     bfw_echo_svg($icone['image'], $size, $icone['classe'], $icone['style']); ?>
                     <div>
                        <p class="fw-500"><?= $el['titre']; ?></p>
                     </div>
                  </div>

                  <?php $c++; endforeach; ?>
            </div>

            <?php $elements = get_field('bureau'); ?>

            <div class="bfw-club__bureau gap-25-2 py-25 fx-col fx-sm-row fx-wrap br-16 --style-secondary just-center">
               <?php
               $c = 0;
               foreach ($elements as $el): ?>

                  <div class="bfw-club__bureau__item  fx-col al-center text-center --style-<?= $el['style']; ?> px-3 br-8">

                     <?php $icone = $el['icone'];
                     $size = array('24', '24');
                     bfw_echo_svg($icone['image'], $size, $icone['classe'], $icone['style']); ?>
                     <div>
                        <div class="fw-500 my-2"><?= $el['role']; ?></div>
                        <div class=""><?= $el['nom']; ?></div>
                        <div class="bfw-club__bureau__item__societe mt-1"><?= $el['societe']; ?></div>
                     </div>
                  </div>

                  <?php $c++; endforeach; ?>
            </div>

         </div>


         <div class="bfw-club__video" data-parent>
            <?php 
            $idVideo = get_field('video');
            if (!$idVideo == ''): ?>
               <?php
               $type_video = get_field('type_de_video');
               $isDisplayable = true;
               if ($idVideo == '') {
                  $isDisplayable = false;
               } else {
                  switch ($type_video) {
                     case 'youtube':
                        $player = 'youtube_player';
                        $thumbnailUrl = 'https://img.youtube.com/vi/' . $idVideo . '/maxresdefault.jpg';
                        break;
                     case 'vimeo':
                        $player = 'vimeo_player';
                        break;
                     default:
                        _e('Format/Hébergeur de vidéo non reconnu, merci de contacter l\'administrateur du site.', 'etxekoa');
                        $isDisplayable = false;
                        break;
                  }
               }
               if ($isDisplayable):
                  ?>
                  <div class="bfw-club__video__content">
                     <div class="just-between fx py-sm-3 px-sm-35 px-25 py-25 gap-25 al-end">
                        <div class="bfw-club__video__content__title">
                           <h3 class="fw-500 font-md font-alt"><?= get_field('legende_video'); ?></h3>
                        </div>
                        <?php
                        $args = array('classe' => '--style-white');
                        get_template_part('templates/button-play', null, $args); ?>

                     </div>
                  </div>
                  <div class="img img--cover img--absolute bfw-club__video__thumbnail" data-mytoggle="video">
                     <?php if ($type_video == 'youtube') { ?>
                        <img src="<?= $thumbnailUrl ?>" alt="YouTube Thumbnail" class="video-thumbnail">
                     <?php } elseif ($type_video == 'vimeo') { ?>
                        <img src="<?= $thumbnailUrl ?>" alt="Vimeo Thumbnail" class="video-thumbnail"
                           id="vimeo-thumbnail-<?= $idVideo ?>">
                     <?php } ?>
                  </div>
                  <div class="embed-responsive embed-responsive-16by9">

                     <div class="<?= $player ?> embed-responsive-item bfw-club__video__video" videoID="<?= $idVideo ?>"
                        frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" theme="light"
                        rel="1" controls="1" showinfo="1" autoplay="0"></div>
                  </div>
                  <?php
               endif;
               ?>
            <?php endif; ?>
         </div>


      </div>
   </div>
   <?php if ($acf['background']): ?>
      <div class="img img--cover img--absolute h-100 w-100">
         <?php bfw_echo_image($acf['background'], array('2000', '2000')); ?>
      </div>
   <?php endif; ?>
</div>