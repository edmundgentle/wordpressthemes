<?php get_header(); ?>
		<?php get_sidebar();
$cv=get_category( get_query_var( 'cat' )); ?>
		<div class="main-ws">
			<ul class="home-cats">
				<li class="selected"><a href=""><?php echo $cv->name;?></a></li>
			</ul>
			<?php if($cv->name=='All'){
query_posts( array('post_status' => 'publish' ) );
}
$count=0;if ( have_posts() ) { while ( have_posts() ) { the_post();
			$count++;
			if($count==1) {?>
				<ul class="article-thumb-large">
			<?php }
			if($count==3) {?>
				<ul class="article-thumb-medium">
			<?php }
			if($count==12) {?>
				<ul class="article-thumb-small">
			<?php }
			if($count<=2) {?>
				<li><a href="<?php the_permalink();?>"><?php if(has_post_thumbnail()) { the_post_thumbnail(array(260,173)); }?><div class="caption"><div><span class="category"><?php
				$categories = get_the_category();
				if($categories) {
					echo $categories[0]->cat_name;
				}?></span> <?php the_title();?></div></div></a><div class="description"><?php the_excerpt();?></div></li>
			<?php }elseif($count<=11) {?>
				<li><a href="<?php the_permalink();?>"><?php if(has_post_thumbnail()) { the_post_thumbnail(array(166,110)); }?></a><a href="<?php the_permalink();?>"><?php the_title();?></a><?php the_excerpt();?></li>
			<?php }else{?>
				<li><a href="<?php the_permalink();?>"><?php the_title();?></a><?php the_excerpt();?></li>
			<?php }
			if($count==2 || $count==11) {?>
				</ul>
			<?php }
			}
			if($count!=2 and $count!=11) {
				echo'</ul>';
			}
			}else{ ?>
		    	<div class="nocontent">No posts could be found.</div>
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
			<li class="info">Page <?php echo $current_page;?> of <?php echo $total_pages;?></li>
		</ul>	
		</div>
<?php get_footer(); ?>