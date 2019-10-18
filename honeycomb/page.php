<?php get_header(); ?>
<div class="padding">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<h2><?php the_title();?></h2>
		<div class="lcontent">
			<?php the_content();?>
		</div>
	 <?php endwhile; else: ?>
	       <div class="nocontent">This page could be found.</div>
	 <?php endif; ?>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>

