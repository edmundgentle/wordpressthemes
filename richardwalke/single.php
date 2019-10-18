<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<h2><?php the_title();?></h2>
	<p class="bloginfo"><strong>Date posted:</strong> <?php the_date('l jS F Y'); ?></p>
	<?php the_content();?>
	<div class="social"><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=edmundgentle" async></script>
<div class="addthis_native_toolbox"></div></div>
	<?php endwhile; else: ?>
		<h2>Page Not Found</h2>
		<p>We're sorry, the page you were looking for could not be found.</p>
		<p><a href="/">Go to the homepage</a></p>
	<?php endif; ?>
<?php get_footer(); ?>