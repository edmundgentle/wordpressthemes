<?php get_header(); ?>
<div id="col-left">
	<?php
	$categories=get_categories();
	foreach($categories as $cat) {
		echo'<div class="content-box"><h2><a href="'.get_category_link($cat->term_id).'">'.$cat->cat_name.'</a></h2><ul class="games">';
		$games=get_posts(array('orderby'=>'rand','category'=>$cat->term_id,'numberposts'=>6));
		foreach($games as $game) {
			echo'<li><a href="'.get_permalink($game->ID).'"><img src="'.get_post_meta($game->ID, 'thumbnail_url',true).'" /></a><a href="'.get_permalink($game->ID).'"><strong>'.$game->post_title.'</strong></a><br />'.nhSubstr(get_post_meta($game->ID, 'description',true),100).'</li>';
		}
		echo'</p><div class="content-end"></div></div>';
	}
	?>
</div><div id="col-right">
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>