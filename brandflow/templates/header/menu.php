
<div class="modal modal--menu menu fx just-between" id="menu">
 
    <div class="menu__left w-100 w-md-60 h-100 pt-md-2 pl-md-35 pr-md-7 pb-md-6 fx fx-col ">
      <!-- <div class="close mb-md-5" data-mytoggle="menu">
      <?php 
      // $class = '';
      // $url = get_template_directory_uri() . '/assets/icons/close.svg';
      // $size = array('24', '24');
      //bfw_echo_svg($url, $size, $class);?>
    </div> -->
      <nav class="menu__liens_principaux px-sm-1 px-25 pt-5 pt-sm-7">
        <?php 
        $liens = $args['liens_principaux'];
        ?>
          <?php if(!empty($liens)):?>

            <ul class="gap-sm-35 gap-3 fx fx-col">

              <?php foreach($liens as $lien):?>
              
                <li class="font-h font-large">

                  <?php 
                  ?>
                  <?php bfw_echo_lien($lien);?>

                </li>

              <?php endforeach;?>

            </ul>

          <?php endif;?>

          <?php $liens = $args['liens_principaux_cta'];?>
          <?php if(!empty($liens)):?>

            <ul class="mt-sm-5 mt-35">

              <?php foreach($liens as $lien):?>
              
                <li class="">

                  <?php 
                  ?>
                  <?php bfw_echo_button($lien);?>

                </li>

              <?php endforeach;?>

            </ul>

            <?php endif;?>
      </nav>
      <div class="fx just-md-between menu__left__bottom mt-auto al-md-center pt-2 gap-25">

          <ul class="menu__liens_secondaires fx gap-25 gap-sm-3">
            <?php 
            $liens = $args['liens_secondaires'];
            ?>
            <?php if(!empty($liens)):?>
              <?php foreach($liens as $lien):?>
              
                <li class="font-md">

                  <?php 
                  ?>
                  <?php bfw_echo_lien($lien);?>

                </li>

              <?php endforeach;?>
            <?php endif;?>
          </ul>


          <?php
          
          $liens_rs = get_field('liens_rs', 'option');
          $liens = $liens_rs['liens'];?>
          <?php if(!empty($liens)):?>
            <ul class="menu__reseaux_sociaux fx gap-25 gap-sm-2">
              <?php foreach($liens as $lien):?>
              
                <li>

                  <?php 
                  ?>
                  <?php bfw_echo_button($lien);?>

                </li>

              <?php endforeach;?>
            </ul>
            <?php endif;?>
      </div>
  </div>
  
  <div class="menu__right display-none display-block-md w-40 h-100">

    <?php
    ?>
    <div class="menu__img img img--cover h-100">
        <?php bfw_echo_image($args['image'], 'large', '');?>
    </div>
        
  </div>
</div>