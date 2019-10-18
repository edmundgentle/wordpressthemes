<?php get_header();?>
<div class="m2col">
	<div class="col1">
		<div class="textblock">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
			<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			<?php the_excerpt();?>
			<?php endwhile; else: ?>
				<h2>No articles found</h2>
				<p>We couldn't find any articles</p>
			<?php endif; ?>
		</div>
		<ul class="pagination">
			<?php
					global $wp_query;
					$total_pages = $wp_query->max_num_pages;
					$current_page = max(1, get_query_var('paged'));
					if ($total_pages > 1) {
					  echo paginate_links(array(
					      'base' => get_pagenum_link(1) . '%_%',
					      'format' => '/page/%#%',
					      'current' => $current_page,
					      'total' => $total_pages,
					    ));
					}
					?>
					<li class="info">Page <?php echo $current_page;?> of <?php echo $total_pages;?></li>
		</ul>
	</div>
	<div class="col2">
		<? echo get_sidebar();?>
	</div>
</div>
<?php get_footer();?>