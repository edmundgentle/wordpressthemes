<?php get_header();?>
<?php
if(is_front_page()) {
?>
<div class="extra-wide">
	<div id="banner">
		<ul class="bjqs">
			<?php
			$images=get_option('sife_slideshow_arr');
			$images=explode(',',$images);
			$images=array_reverse($images);
			foreach($images as $img) {
				if(strlen($img)) {
					echo'<li><img src="'.$img.'" /></li>';
				}
			}
			?>
		</ul>
	</div>
</div>
<div class="wide-left-wedge"></div>
<div class="wide-right-wedge"></div>
<?php }?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<h1><?php the_title();?></h1>
	<?php the_content();?>
 <?php endwhile; else: ?>
	<h1>Page not found</h1>
 <?php endif; ?>
<?php get_footer();?>