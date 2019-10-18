<?php get_header(); ?>
	<div class="main_content home">
		<div id="homepage_slider">
			<ul class="slider bjqs">
				<?
				query_posts('category_name=Slider&posts_per_page=3');
				while (have_posts()) {the_post();
					$cat='';
					$categories = get_the_category();
					if(isset($categories[0])) {
						$cat='category_'.$categories[0]->slug;
					}?>
				<li class="<? echo $cat;?>">
					<a href="<?php the_permalink();?>">
						<div class="image"><?php if(has_post_thumbnail()) { the_post_thumbnail(array(690,285)); }?></div>
						<div class="overlay">
							<div class="title"><?php the_title();?></div>
							<div class="summary"><?php the_excerpt();?></div>
						</div>
					</a>
				</li>
				<? }?>
			</ul>
		</div>
		<?
		$hpcats=array_values(array_filter(split("(\n|\r)",trim(get_option('knowledge_hp_cats')))));
		?>
		<div class="cols">
			<div class="col">
				<div class="col_inner">
					<?
					foreach($hpcats as $i=>$c) {
						if($i % 2 == 0) {
							$cat = get_category_by_slug($c);
							query_posts('cat='.$cat->term_id.'&posts_per_page=5');
							?>
							<div class="section category_<? echo $cat->slug;?>">
								<a href="<?php echo get_category_link($cat->term_id);?>"><h2><? echo $cat->name;?></h2></a>
								<ul class="articles">
									<?php while (have_posts()) {the_post(); ?>
										<li>
											<a href="<?php the_permalink();?>">
												<div class="image"><?php if(has_post_thumbnail()) { the_post_thumbnail(array(335,120)); }?></div>
												<div class="title"><?php the_title();?></div>
												<div class="summary"><?php the_excerpt();?></div>
											</a>
										</li>
									<?php }?>
								</ul>
							</div>
						<? }
					}
					?>
				</div>
			</div>
			<div class="col">
				<div class="col_inner">
					<?
					foreach($hpcats as $i=>$c) {
						if($i % 2 != 0) {
							$cat = get_category_by_slug($c);
							query_posts('cat='.$cat->term_id.'&posts_per_page=5');
							?>
							<div class="section category_<? echo $cat->slug;?>">
								<a href="<?php echo get_category_link($cat->term_id);?>"><h2><? echo $cat->name;?></h2></a>
								<ul class="articles">
									<?php while (have_posts()) {the_post(); ?>
										<li>
											<a href="<?php the_permalink();?>">
												<div class="image"><?php if(has_post_thumbnail()) { the_post_thumbnail(array(335,120)); }?></div>
												<div class="title"><?php the_title();?></div>
												<div class="summary"><?php the_excerpt();?></div>
											</a>
										</li>
									<?php }?>
								</ul>
							</div>
						<? }
					}
					?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>