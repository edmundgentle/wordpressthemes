<?php get_header(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
	echo'<div class="content-box"><h2>Play '.get_the_title().'</h2>
	<div align="center"><embed type="application/x-shockwave-flash" src="'.get_post_meta(get_the_ID(), 'swf_url',true).'" width="'.get_post_meta(get_the_ID(), 'width',true).'" height="'.get_post_meta(get_the_ID(), 'height',true).'"></embed></div></div>
	<div class="content-box"><h2>How to play</h2>
	<table width="100%"><tr valign="top"><td><p>'.get_post_meta(get_the_ID(), 'description',true).'</p></td><td width="50">'.nh_favorite('square-rounded',false).'</td></tr></table></div>
	<div class="content-box"><h2>Comments</h2>
	'.nh_comments(860,5,0).'</div>';
	endwhile; else: ?>
		<p>Sorry, this game wasn't found.</p>
	 <?php endif; ?>
<?php get_footer(); ?>