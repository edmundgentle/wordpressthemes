<?php get_header(); ?>
<h1><?php wp_title('',true);?></h1>
<ul class="blogposts">
<?php if ( have_posts() ) { while ( have_posts() ) { the_post();?>
	<li>
		<a href="<?php the_permalink();?>"><?php if(has_post_thumbnail()) { the_post_thumbnail(array(260,173)); }?></a>
		<a href="<?php the_permalink();?>" class="title"><?php the_title();?></a>
		<div class="description"><?php the_excerpt();?></div>
		<div class="date"><?php the_date();?></div>
	</li>
	<?php 
	}
	}else{ ?>
		<div class="nocontent">No posts could be found.</div>
<?php } ?>
</ul>
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
<?php get_footer(); ?>