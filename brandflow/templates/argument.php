<?php if ( $args ):
    if($args['icone'])
    {
        $image_src = get_template_directory_uri() . '/assets/icons/' . $args['icone'];
    }
    else
    {
        $image_src = get_template_directory_uri() . '/assets/icons/checksquare.svg';
    }
    
    $classe = '';
    ?>
<div class="argument <?= $args['classe'];?>">
    <div class="icon"><?php bfw_echo_svg($image_src, $size, '');?></div>
    <div class="texte"><?= $args ['titre'];?></div>
    
</div>
<?php endif;?>
