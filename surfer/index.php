<?php get_header();
$quote=array();
query_posts('category_name=Quote&posts_per_page=1');
while (have_posts()) {the_post();
	if(preg_match('/<blockquote>(.*)<\/blockquote>/',get_the_content(),$m)) {
		$quote=array(get_permalink(),$m[1]);
	}
} wp_reset_query();?>
		<div class="widgetsidebar">
	<form action="<?php echo home_url('/');?>" method="get" class="search">
		<input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="SEARCH <?php echo strtoupper(get_bloginfo('name'));?>" /><input type="submit" value="Search" />
	</form>
	<ul>
		<?php dynamic_sidebar('homesidebar');?>
	</ul>
</div>
		<div class="main-ws">
			<ul class="home-cats actual_home_cats">
				<li class="selected"><a id="q_1" href="<?php home_url();?>">All</a></li>
				<?php
				$c=1;
				if(($locations=get_nav_menu_locations()) && isset($locations['home-cats'])) {
					$menu = wp_get_nav_menu_object($locations['home-cats']);
					$menu_items = wp_get_nav_menu_items($menu->term_id);
					foreach((array)$menu_items as $key=>$menu_item ) {
						$c++;
						if($menu_item->object=='category') {
							echo'<li><a id="q_'.$c.'" href="'.get_category_link($menu_item->object_id).'">'.$menu_item->title.'</a></li>';
						}
					}
				}
				?>
				<li class="right"><a href="/category/all/">More</a></li>
			</ul>
			<div id="rq_1" class="hp_panel selected">
				<ul class="article-thumb-large">
					<?php $count=0;query_posts('posts_per_page=8');if ( have_posts() ) { while ( have_posts() ) { the_post();
					$count++;
					if($count==5) {?>
						</ul>
						<?php if(count($quote)==2) {?>
						<a href="<?php echo $quote[0];?>" class="quote">
							<span class="explain">STORY</span>
							<?php echo strip_tags($quote[1]);?>
						</a>
						<?php }?>
						<div class="ad3"><?php echo adrotate_group(3); ?></div>
						<ul class="article-thumb-large">
					<?php }?>
						<li><a href="<?php the_permalink();?>"><?php if(has_post_thumbnail()) { the_post_thumbnail(array(260,173)); }?><div class="caption"><div><span class="category"><?php
						$categories = get_the_category();
						if($categories) {
							echo $categories[0]->cat_name;
						}?></span> <?php the_title();?></div></div></a><div class="description"><?php the_excerpt();?></div></li>
					<?php }
					}else{ ?>
				           No posts
					<?php } ?>
				</ul>
				<div class="morelink"><a href="/category/all/">More</a></div>
			</div>
			<?php
			$c=1;
			if(($locations=get_nav_menu_locations()) && isset($locations['home-cats'])) {
				$menu = wp_get_nav_menu_object($locations['home-cats']);
				$menu_items = wp_get_nav_menu_items($menu->term_id);
				foreach((array)$menu_items as $key=>$menu_item ) {
					$c++;
					if($menu_item->object=='category') {?>
						<div id="rq_<?php echo $c;?>" class="hp_panel">
							<ul class="article-thumb-large">
								<?php query_posts('cat='.$menu_item->object_id.'&posts_per_page=10');if ( have_posts() ) { while ( have_posts() ) { the_post();?>
									<li><a href="<?php the_permalink();?>"><?php if(has_post_thumbnail()) { the_post_thumbnail(array(260,173)); }?><div class="caption"><div><span class="category"><?php
									$categories = get_the_category();
									if($categories) {
										echo $categories[0]->cat_name;
									}?></span> <?php the_title();?></div></div></a><div class="description"><?php the_excerpt();?></div></li>
								<?php }
								}else{ ?>
							           No posts
								<?php } ?>
							</ul>
							<div class="morelink"><a href="<?php echo get_category_link($menu_item->object_id);?>">More</a></div>
						</div>
					<?php }
				}
			}
			?>
		</div>
<?php get_footer();?>