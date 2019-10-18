<?php get_header();?>
<div class="m2col">
	<div class="col1">
		<div class="textblock">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
			<h2><?php the_title();?></h2>
			<?php the_content();?>
			<?php endwhile; else: ?>
				<h2>Page not found</h2>
				<p>This page could be found.</p>
			<?php endif; ?>
		</div>
	</div>
	<div class="col2">
		<? echo get_sidebar();?>
	</div>
</div>
<?php get_footer();?>