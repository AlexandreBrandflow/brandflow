<?php
$footer = get_field('footer', 'option');
$reseaux_sociaux = get_field('reseaux_sociaux', 'option');
?>


<?php // AXEPTIO ; ?>
<script>
  // window.axeptioSettings = {
  //   clientId: "666c43a1ba8d93f715eca3ed",
  //   cookiesVersion: "lore-fr-EU-2",
  //   googleConsentMode: {
  //     default: {
  //       analytics_storage: "denied",
  //       ad_storage: "denied",
  //       ad_user_data: "denied",
  //       ad_personalization: "denied",
  //       wait_for_update: 500
  //     }
  //   }
  // };
  //  
  // (function(d, s) {
  //   var t = d.getElementsByTagName(s)[0], e = d.createElement(s);
  //   e.async = true; e.src = "//static.axept.io/sdk.js";
  //   t.parentNode.insertBefore(e, t);
  // })(document, "script");
</script>
<?php // AXEPTIO ; ?>

<footer class="footer">
  <div class="container-large">
    <div class="container-inner">

      <div class="footer__row pt-sm-5">
        <?php
        $bloc = $footer['footer_1'];
        $logos = get_field('logos', 'option');
        $logo = $logos['logo_base'];
        $liens = $bloc['_liens'];
        ?>
        <div class="fx-col gap-3 footer__logo">
          <a class="footer__logo__img" href="<?= get_site_url(); ?>">
            <?php bfw_echo_svg($logo, array('148', '48'), '', ''); ?>
          </a>
          <p><?= $bloc['contenu']; ?></p>
          <div class="fx gap-25 fx-wrap mt-auto">
            <?php if (!empty($reseaux_sociaux)):
              ?>
              <?php foreach ($reseaux_sociaux as $lien): ?>
                <?php bfw_echo_button($lien); ?>
              <?php endforeach; ?>

            <?php endif; ?>
            <?php if (!empty($liens)): ?>
              <?php foreach ($liens as $lien): ?>
                <?php bfw_echo_button($lien); ?>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <?php
        wp_nav_menu([
          'container' => false,
          'theme_location' => 'bfw footer',
          'menu_class' => 'footer__menu',
        ]);
        ?>


      </div>

      <div class="footer__row al-sm-center pt-5">
        <?php
        $bloc = $footer['footer_2'];
        $liens = $bloc['_liens'];
        ?>
        <div class="footer__row__card">
          <p><?= $bloc['contenu']; ?></p>
          <div class="fx gap-2 fx-wrap">
            <?php if (!empty($liens)): ?>
              <?php foreach ($liens as $lien): ?>
                <?php bfw_echo_button($lien); ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>

        <?php
        $bloc = $footer['footer_3'];
        $liens = $bloc['_liens'];
        ?>
        <div class="footer__row__card">
          <p><?= $bloc['contenu']; ?></p>
          <div class="fx gap-2 fx-wrap">
            <?php if (!empty($liens)): ?>
              <?php foreach ($liens as $lien): ?>
                <?php bfw_echo_button($lien); ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
        <div class="footer__row__card">
          <?php get_template_part('templates/lore/preuve-sociale', null, $args); ?>
        </div>



      </div>

      <div class="footer__row pt-5 just-sm-between mt-sm-10 footer__bottom fx-sm-row fx-col">
        <?php
        $bloc = $footer['footer_4'];
        $liens = $bloc['_liens'];
        ?>
        <div class="fx gap-2 fx gap-2 fx-wrap fx-col fx-sm-row">
          <?php if (!empty($liens)): ?>
            <?php foreach ($liens as $lien): ?>
              <?php bfw_echo_lien($lien); ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <?php
        $bloc = $footer['footer_5'];
        $liens = $bloc['_liens'];
        ?>
        <div class="fx gap-2 fx-wrap fx-col fx-sm-row">
          <?php if (!empty($liens)): ?>
            <?php foreach ($liens as $lien): ?>
              <?php bfw_echo_lien($lien); ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

      </div>


    </div>

  </div>


  <?php if ($footer['background']): ?>
    <div class="img img--cover img--absolute">
      <?php bfw_echo_image($footer['background'], array('2000', '2000')); ?>
    </div>
  <?php endif; ?>
</footer>

<?php // gérer les popups dans un autre fichier ! 
get_template_part('templates/popups/', null, $args); ?>

<div id="overlay"></div> <?php // à garder, overlay pour les popups, menus etc;?>

<?php wp_footer(); ?> <?php // à garder ;?>


</body>

</html>