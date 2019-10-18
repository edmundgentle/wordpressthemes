<?php get_header(); ?>
<h2><?php wp_title("",true); ?></h2>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="blog_preview">
		<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<p class="bloginfo"><strong>Date posted:</strong> <?php the_date('l jS F Y'); ?></p>
		<?php the_content();?>
	</div>
	<?php endwhile; else: ?>
		<h2>Page Not Found</h2>
		<p>We're sorry, the page you were looking for could not be found.</p>
		<p><a href="/">Go to the homepage</a></p>
	<?php endif; ?>
	<div class="pagenums">
	<?php
	global $wp_query;
	$total_pages=$wp_query->max_num_pages;
	$current_page=max(1,get_query_var('paged'));
	if($total_pages>1) {
	  echo paginate_links(array(
	      'base' => get_pagenum_link(1) . '%_%',
	      'format' => '/page/%#%',
	      'current' => $current_page,
	      'total' => $total_pages,
			'before'=>'<p>'
		));
	}
	?>
	</div>
<?php get_footer(); ?>