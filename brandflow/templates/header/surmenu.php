<div class="global-navigation">


<div class="bfw-surmenu">
   <div class="container-large">
      <nav class="fx just-between">
         <div class="bfw-surmenu__01" data-mytoggle="menu">
            <?php
            $logos = get_field('logos', 'option');
            $logo = $logos['logo_base'];
            ?>
            <a class="bfw-surmenu__01__logo font-xs" href="<?= get_site_url(); ?>">
               <?php bfw_echo_svg($logo, array('148', '48'), '', ''); ?>
               <span> / </span>
               <div class="bfw-surmenu__01__logo__current"><?= $args['current']; ?>
                  <div class="icon type--outline">
                     <?php
                     $url = get_template_directory_uri() . '/assets/icons/chevron-down.svg';
                     $size = array('24', '24');
                     bfw_echo_svg($url, $size, ''); ?>
                  </div>
               </div>

            </a>
         </div>
         <div class="bfw-surmenu__menu">
            <div class="header-menu-toggle" data-mytoggle="menu">
               <span class="header-menu-toggle__label bfw-surmenu__menu__label font-xs fw-500 text-primary">Menu</span>
               <button class="hamburger hamburger--spring bfw-hamburger" type="button">
                  <span class="hamburger-box">
                     <span class="hamburger-inner"></span>
                  </span>
               </button>
            </div>
         </div>
      </nav>
   </div>
  
</div>

<?php
   $logos = get_field('logos', 'option');
   $logo = $logos['logo_base']; // dependance menu-mobile
   $args = get_field('mega_menu', 'option');
   $args = array('elements' => $args, 'logo' => $logo, 'menu_mobile' => get_field('menu_mobile', 'option'));
   get_template_part('templates/header/menu-mobile', null, $args);
   ?>
</div>