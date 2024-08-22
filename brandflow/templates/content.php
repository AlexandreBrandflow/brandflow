<?php 
$count = $args['count'];
if(in_array($count, array(0,2,3))):
	$image = get_post_thumbnail_id();
	$size = array('1400', '');
	$image_src = wp_get_attachment_image_src($image, $size);
	$style = 'background-image:url('. $image_src[0] .')';
	$class="actualites-item-even image text-white img-filter-black img-filter-green";
	$color = 'text-white';
else:
	$style = '';
	$color = 'text-black';
	$class="actualites-item-odd bg-white";
endif;
?>
<article>
	<div class="transition actualites-item fx fx-col py-sm-3 px-sm-3 py-2 px-2 <?= $class;?>"  style="<?= $style;?>">
	<a href="<?php the_permalink(); ?>">
		<div class="categories fx gap-10 mb-2">
		<?php
		foreach(get_the_category() as $category)
		{
			echo '<div class="category">'.$category->cat_name.'</div>';
		}
		?>
		</div>
		<h3 class="no-after <?= $color;?>">
			<?php the_title(); ?>
		</h3>
		<div class="<?= $color;?>"><?php the_excerpt(); ?></div>
			<a class="<?= ($count == 0) ? 'btn-primary' : 'underline';?> mt-auto <?php if(in_array($count, array(2,3))) echo 'text-white white';?>" href="<?= the_permalink();?>">Lire l'article <?php if($count == 0): bfw_echo_btn_svg(); endif;?></a>
	</a>
	</div>
</article>