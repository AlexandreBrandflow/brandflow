<?php get_header();
$categories = get_the_category($id);
?>

<div id="main" class="site-main">

    <div class="bfw-single-post container-large">
        <?php
        // Check for post thumbnail
        if (has_post_thumbnail($id)) {
            $image = get_post_thumbnail($id);

        } else {
            // If no post thumbnail, use ACF field 'photos_images' -> 'photo_carre'
            $imageArray = get_field('photos_images', $id);
            $image = $imageArray['photo_carre'];
        }
        if ($image): ?>
            <div class="img img--cover bfw-single-post__img">
                <?php bfw_echo_image($image, array('2000', '1000'), ''); ?>
            </div>
        <?php endif; ?>
        


        <div class="container-inner bfw-single-post__header --style-blue-light pt-4 pb-5 py-sm-8 <?= (!$image) ? 'pt-sm-11' : '';?> ">
            <div class=" fx-col gap-25">
                <?php
                if (!empty($categories)): ?>
                    <div class="fx gap-2">
                        <?php
                        foreach ($categories as $category):
                            ?>
                            <div class="sur_titre"><?= $category->name; ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <h1><?php the_title(); ?></h1>
            </div>
        </div>

        <div class="container-inner bfw-grid pt-4 pb-5 py-sm-8">
            <div class="texte-large__container ">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

    <?php get_footer(); ?>