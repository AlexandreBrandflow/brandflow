<?php
function bfw_echo_svg($url, $size = array('48', '48'), $class = '', $style = '') {
    $ext = pathinfo($url, PATHINFO_EXTENSION);
    if ($ext == 'svg') {
        echo '<div class="svg ' . esc_attr($class) . ' --svg-style-' . esc_attr($style) . '">'
        . file_get_contents($url)
        . '</div>';
    } else {
        ?>
        <div class="svg">
            <img src="<?= esc_url($url) ?>" width="<?= esc_attr($size[0]); ?>" height="<?= esc_attr($size[1]); ?>">
        </div>
        <?php
    }
}


function bfw_echo_button($args)
{
  $size = array('24', '24');
  $lien = $args['lien'];
  $icone = $args['icone'];
  $size = ($args['size']) ? $args['size'] : 'S';
  $title = $lien['title'];
  $target = $lien['target'] ? $lien['target'] : '_self';
  $data = $args['data-attribute'];
  $classe = ($args['classe']) ? $args['classe'] : '';
  $contenu = ($args['contenu']) ? $args['contenu'] : '';
  if ($icone['image']) {
    $type = ($icone['type']) ? $icone['type'] : 'fill';
    // Vérifier si $icone['image'] commence par "http://" ou "https://"
    if (strpos($icone['image'], 'http://') === 0 || strpos($icone['image'], 'https://') === 0) {
      $image_src = $icone['image'];
    } else {
      $image_src = get_template_directory_uri() . '/assets/icons/' . $icone['image'] . '.svg';
    }

    $position = ($icone['position']) ? $icone['position'] : 'left';
    $classe .= ' has-icon ';
  }
  
  ?>
    <a href="<?= $lien['url'];?>" class="btn --style-<?= $args['style'];?> <?= $classe ?> size--<?= $size;?> <?= ($title) ? '' : 'badge';?>" <?= ($data) ? $data : '';?> target="<?php echo esc_attr( $target ); ?>">
      <div class="fx">
        <?php if(!$contenu):?>
        <?= ($title) ? '<span>' . $title . '</span>' : '';?>
        <?php else:?>
          <div class="fx-col btn__col">
            <span class="btn__col__title"><?= ($title) ? $title : '';?></span>
            <span class="btn__col__contenu"><?= $contenu?></span>
          </div>
        <?php endif;?>
        <?php if($icone['image']):
        $classe = $icone['classe'];
        $classe = 'type--'.$type;
        if(!$title)
        {
          $position = '';
        }
        ?>
        
          <div class="icon pos-<?= $position;?>">
            <?php bfw_echo_svg($image_src, $size, $classe);?>
          </div>
        
        <?php endif;?>
      </div>
    </a>
  <?php
}

function bfw_echo_lien($args)
{
  $size = array('24', '24');
  $lien = $args['lien'];
  $target = $lien['target'] ? $lien['target'] : '_self';
  $icone = $args['icone'];
  $size = ($args['size']) ? $args['size'] : 'S';
  $title = $lien['title'];
  if($icone['image'])
  {
    $image_src = array(get_template_directory_uri() . '/assets/icons/'.$icone['image'].'.svg');
    $position = ($icone['position']) ? $icone['position'] : 'left';
  }
  
  ?>
    <a href="<?= $lien['url'];?>" class="style--<?= $args['style'];?> <?= $args['classe'];?> lien" target="<?php echo esc_attr( $target ); ?>">
      <div class="fx al-center">
        <?= ($title) ? $title : '';?>
        <?php if($icone['image']):
          $class = $icone['classe'];
          $class .= 'type--'.$icone['type'];?>
          
          <div class="icon pos-<?= $position;?>">
            <?php bfw_echo_svg($image_src[0], $size, $class);?>
          </div>
        
        <?php endif;?>
      </div>
    </a>
  <?php
}



function bfw_generate_image_size($width, $height) {
  $size_name = 'custom-size-' . $width . 'x' . $height;
  
  if (!bfw_has_image_size($size_name)) {
      add_image_size($size_name, $width, $height, false);
  }
  return $size_name;
}

function bfw_has_image_size($size_name) {
  global $_wp_additional_image_sizes;

  if (in_array($size_name, get_intermediate_image_sizes())) {
      return true;
  }

  if (isset($_wp_additional_image_sizes[$size_name])) {
      return true;
  }

  return false;
}

function bfw_echo_image($img, $size, $class = '') {
    // Check if the image is valid
    if (!isset($img['ID'])) {
      echo '<!-- Invalid image ID -->';
      return;
    }

    $img_id = $img['ID'];
    $size_name = 'full';
  
   // Ensure $size is defined and not null
   if (is_array($size) && isset($size[0]) && isset($size[1])) {
    $size_name = bfw_generate_image_size($size[0], $size[1]);
  } elseif (!is_array($size) && !empty($size)) {
    $size_name = $size;
  }
  $image_srcset = wp_get_attachment_image_srcset($img_id, $size_name);
  $image_sizes = wp_get_attachment_image_sizes($img_id, $size_name);
  $image_attributes = wp_get_attachment_image_src($img_id, $size_name);

  // Check if image attributes are retrieved correctly
  if (!$image_attributes) {
    echo '<!-- Unable to retrieve image attributes for size: ' . esc_attr($size_name) . ' -->';
    return;
  }

  // Output the image tag
  echo '<img
    srcset="' . esc_attr($image_srcset) . '"
    sizes="' . esc_attr($image_sizes) . '"
    src="' . esc_url($image_attributes[0]) . '"
    alt="' . esc_attr($img['alt']) . '"
    width="' . esc_attr($image_attributes[1]) . '"
    height="' . esc_attr($image_attributes[2]) . '"
    loading="lazy"
    class="' . esc_attr($class) . '"
  />';
}
