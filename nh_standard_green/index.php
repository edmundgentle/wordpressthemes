<?php get_header(); ?>
<div id="col-left">
	<div class="content-box"><h2><?php wp_title('',true); ?></h2><ul class="games">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
	echo'<li><a href="'.get_permalink(get_the_ID()).'"><img src="'.get_post_meta(get_the_ID(), 'thumbnail_url',true).'" /></a><a href="'.get_permalink(get_the_ID()).'"><strong>'.get_the_title().'</strong></a><br />'.nhSubstr(get_post_meta(get_the_ID(), 'description',true),100).'</li>';
	endwhile; else: ?>
		<p>Sorry, no posts matched your criteria.</p>
	 <?php endif; ?>
	</ul><div class="content-end"></div></div>
</div><div id="col-right">
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>