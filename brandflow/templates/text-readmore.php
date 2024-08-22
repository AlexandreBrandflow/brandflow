<div class="text-readmore" data-parent>

  

  <div class="text-readmore__content pt-25">
    <?php
    echo $args['contenu'];?>
  </div>

  <?php 
  $image_src = array(get_template_directory_uri() . '/assets/icons/chevron-down.svg');
  $position = 'right';
  ;?>

  <a class="text-readmore__toggle " href="" data-mytoggle="text-readmore" data-texte-default="Voir plus" data-texte-active="Voir moins">
    <span>Voir plus</span>
    <?php 
     $class .= 'type--outline';?>
          
     <div class="icon pos-<?= $position;?>">
       <?php bfw_echo_svg($image_src[0], $size, $class);?>
     </div>
  </a>

</div>