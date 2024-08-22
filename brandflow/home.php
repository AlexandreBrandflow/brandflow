<?php get_header(); ?>
<div id="main" class="site-main">
	<?php
	// Vérifier si aucun filtre ou pagination n'est activé
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	$is_filtered = isset($_GET['filter']) && !empty($_GET['filter']); // Remplacez 'filter' par le nom réel du paramètre de filtre utilisé
	
	if (!$is_filtered && $paged == 1):

		$classeActualites = '';
		

		$page_for_posts = get_option('page_for_posts');
		if ($page_for_posts) {
			// Récupérer le post de la page de blog
			$blog_page = get_post($page_for_posts);

			// Afficher le contenu de la page de blog
			echo apply_filters('the_content', $blog_page->post_content);
		};

	else:

		$classeActualites=' pt-4 pt-sm-11';

	endif;
	?>
	<div class="container-large bfw-posts pb-sm-11 pb-5 <?= $classeActualites;?>">
		<div class="container-inner gap-4 gap-sm-5 fx-col">
			<?php get_template_part('templates/lore/posts-header', null, $args); ?>
			<div class="bfw-grid bfw-posts__grid gap-35-0 gap-sm-5-35">
				<?php
				if (have_posts()):
					$count = 0;
					while (have_posts()):
						the_post();
						$args = array('id' => $post->ID, 'classe' => 'actualites__item bfw-posts__item col-md-4 col-xl-3 bfw-grid__item');
						get_template_part('templates/post', null, $args);
						$count++;
					endwhile;
				else:
					get_template_part('content', 'none');
				endif;
				?>
			</div>
			<?php
			if (function_exists('bfw_display_custom_pagination'))
			{
				bfw_display_custom_pagination(); // fonction custom
			}
			?>
		</div>

	</div>
</div>

<?php get_footer(); ?>