<?php get_header();?>
	<div class="main_content">
		<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
			<h2><?php the_title();?></h2>
			<?php the_content();?>
		<?php }
		}else{ ?>
			<div class="nocontent">This page could be found.</div>
		<?php } ?>
	</div>
<?php get_footer();?>