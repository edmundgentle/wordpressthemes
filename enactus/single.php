<?php get_header();?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
<h1><?php the_title();?></h1>
<p class="subtitle"><strong>Published: </strong><?php the_date();?></p>
<? if(has_post_thumbnail()) {?>
	<div class="image">
	<?php the_post_thumbnail(array(550,800));?>
	<div class="caption"><?php the_title_attribute();?></div>
	</div>
<?php }
the_content();
?>
<?php endwhile; else: ?>
	<div class="nocontent">This post could be found.</div>
<?php endif; ?>
<?php get_footer();?>