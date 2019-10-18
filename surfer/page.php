<?php get_header();?>
		<?php get_sidebar();?>
		<div class="main-ws">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="article">
					<h2><?php the_title();?></h2>
					<?php the_content();?>
				</div>
			 <?php endwhile; else: ?>
		           <div class="nocontent">This page could be found.</div>
			 <?php endif; ?>
		</div>
<?php get_footer();?>