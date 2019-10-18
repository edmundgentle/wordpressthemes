<? if(is_home() || is_front_page()) {
	get_template_part( 'index' );
}else{?>
<?php get_header();?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
<h1><?php the_title();?></h1>
<?php the_content();?>
<?php endwhile; else: ?>
	<div class="nocontent">This page could be found.</div>
<?php endif; ?>
<?php get_footer();?>
<? }?>