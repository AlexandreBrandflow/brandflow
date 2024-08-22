<?php $data = ($args['data']) ? $args['data'] : 'data-mytoggle="video"'; ?>

<button class="bfw-swiper-nav bfw-swiper-nav--<?= $args['direction']; ?> --style-white btn <?= $args['classe']; ?> --variante-<?= $args['variante']; ?>" <?= $data; ?>>
    
    <?php
    $url = get_template_directory_uri() . '/assets/icons/arrow-swiper.svg';
    $size = array('24', '24');
    bfw_echo_svg($url, $size, 'type--fill'); ?>

</button>