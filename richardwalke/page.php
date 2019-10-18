<?php get_header();?>
	<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
		<? if(!is_front_page()) {?><h2><?php the_title();?></h2><? }?>
		<?php the_content();?>
	<?php }
	}else{ ?>
		<div class="nocontent">This page could not be found.</div>
	<?php } ?>
<?php get_footer();?>