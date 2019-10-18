<?php get_header(); ?>
	<div class="main_content">
		<h2><?php wp_title('',true);?></h2>
		<?php $count=0;if ( have_posts() ) {?>
			<ul class="just_articles">
			<?php while ( have_posts() ) { the_post();?>
				<li>
					<a href="<?php the_permalink();?>">
						<div class="image"><?php if(has_post_thumbnail()) { the_post_thumbnail(array(200,140)); }?></div>
						<div class="title"><?php the_title();?></div>
						<div class="summary"><?php the_excerpt();?></div>
					</a>
				</li>
		<?php }
		?>
			</ul>
		<?php
		}else{ ?>
	    	<div class="nocontent">No articles could be found.</div>
		<?php } ?>
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
		</ul>
	</div>
<?php get_footer(); ?>