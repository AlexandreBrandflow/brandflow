<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

   <link href="" rel="icon" type="image/x-icon" />
   <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
   <meta charset="<?php bloginfo('charset'); ?>">

   <?php wp_head(); ?>	

   <?php // ne pas charger de scripts ici sauf si nécessaire;?>
</head>


<body <?php body_class(); ?>>

<?php 
$queryVar = get_query_var('header_variante'); // dépendance functions.php
?>

   <header class="header <?= $queryVar;?>" <?php // dynamiquement ajouter une classe ;?>>
      <div class="container-large">
         <div class="container-inner">
            <nav class="navbar fx">
               <div class="navbar__01">
                  <?php
                  $logos = get_field('logos', 'option');
                  $logo = $logos['logo_base']; // dependance menu-mobile
                  ?>
                  <a class="header__logo" href="<?= get_site_url(); ?>">
                     <?php bfw_echo_svg($logo, array('148', '48'), '', ''); ?>
                  </a>

                  <?php
                  $args = get_field('mega_menu', 'option'); // dep ACF mega menu option page
                  get_template_part('templates/header/mega-menu', null, $args); ?>
               </div>

               <div class="header-menu-toggle" data-mytoggle="menu"> <?php // affichage géré par scss / app / header.scss;?>
                  <span class="header-menu-toggle__label">Menu </span>
                  <button class="hamburger hamburger--spring bfw-hamburger" type="button">
                     <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                     </span>
                  </button>
               </div>
               <?php
               $header = get_field('header', 'option');
               $liens = $header['liens_principaux']['cta_liens']; ?>
               <ul class="bfw_navigation">
                  <?php foreach ($liens as $lien): ?>
                     <li>
                        <?php bfw_echo_button($lien); ?>
                     </li>
                  <?php endforeach; ?>
               </ul>
            </nav>
         </div>
      </div>
      <?php
      $args = array('elements' => $args, 'logo' => $logo, 'menu_mobile' => get_field('menu_mobile', 'option')); // dep ACF mega menu option page
      get_template_part('templates/header/menu-mobile', null, $args);
      ?>
   </header>