<?php get_header(); ?>
<div id="main" class="site-main">
	<div class="container vpd hpd pt-10">
	<?php include get_template_directory() . '/templates/blog-header.php';?>
		<div class="grid-actualites">
			<?php 
				if ( have_posts() ) :
					$count = 0;
					while ( have_posts() ) : the_post();
					$args = array(
						'count' => $count,
					);
						get_template_part( 'templates/content', get_post_format(), $args );
					$count++;
					endwhile;
				else :
					get_template_part( 'content', 'none' );
				endif; 
			?>
		</div>
		<div class="navigation-pagination large fx just-between gap-20 mt-2 mt-sm-4 al-center">
			<?php 
				global $wp_query;
				$page = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$ppp = get_query_var('posts_per_page');
				$end = $ppp * $page;
				$start = $end - $ppp + 1;
				$total = $wp_query->found_posts;
				$texte = sprintf("%u - %u sur %u", $start, $end, $total);
				echo $texte;
				the_posts_pagination();
			?>
		</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>