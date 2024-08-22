<?php get_header(); ?>

<div id="main" class="site-main">
  <?php

    if ( have_posts() ) :

      while ( have_posts() ) : the_post();

        get_template_part( 'content', get_post_format() );

      endwhile;

    else :

      get_template_part( 'content', 'none' );

    endif;

    the_posts_pagination();

  ?>

</div>

<?php get_footer(); ?>