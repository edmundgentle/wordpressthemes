<?php get_header(); ?>
<div id="col-left">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="content-box"><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2><p><?php the_content(); ?></p><div class="content-end"></div></div>
	 <?php endwhile; else: ?>
		<div class="content-box"><p>Sorry, no posts matched your criteria.</p><div class="content-end"></div></div>
	 <?php endif; ?>
</div><div id="col-right">
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>