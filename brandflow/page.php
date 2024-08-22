<?php get_header(); ?>
<div id="main" class="site-main">
<?php //include get_template_directory() . '/templates/page-header.php';?>
	<?php 
	  
	  while ( have_posts() ) : the_post();
	                    
	    the_content();
	                        
	  endwhile;

	?>

</div>
                
<?php get_footer(); ?>