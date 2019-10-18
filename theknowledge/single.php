<?php get_header();?>
	<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();?>
			<div class="main_content article">
				<h2><?php the_title();?></h2>
				<div class="article_meta">
					<?
					$line='';
					$authorfb=@get_post_meta($post->ID, 'authorfb', true);
					$authortitle=@get_post_meta($post->ID, 'authortagline', true);
					if($authorfb and strlen($authorfb)) {
						$uname=current(explode('/',trim(parse_url($authorfb,PHP_URL_PATH),'/')));
						if($uname and strlen($uname)) {
							$info = json_decode(file_get_contents('https://graph.facebook.com/'.$uname),true);
							if(isset($info['id']) and isset($info['name'])) {?>
								<div class="author_image"><img src="https://graph.facebook.com/<? echo $info['id'];?>/picture?type=normal" /></div>
								<div class="author_name"><? echo $info['name'];?></div>
								<? if($authortitle and strlen($authortitle)) {?>
									<div class="author_tagline"><? echo trim($authortitle);?></div>
								<? }
								$line=' lined';
							}
						}
					}
					?>
					<div class="pub_date<? echo $line;?>"><?php the_date();?></div>
					<ul class="categories">
						<?
						$categories = get_the_category();
						foreach($categories as $cat) {
							if(!in_array($cat->slug,$hidden_cats)) {?>
							<li class="category_<?php echo $cat->slug;?>"><a href="<?php echo get_category_link($cat->term_id);?>"><? echo $cat->cat_name;?></a></li>
						<? }}?>
					</ul>
				</div>
				<div class="article_body">
					<?php the_content();?>
				</div>
				<div class="fb_comments">
					<div class="fb-comments" data-href="<?php the_permalink();?>" data-width="690"></div>
				</div>
			</div>
	<?php }
	}else{?>
		<div class="main_content">
			<div class="nocontent">This article could be found.</div>
		</div>
	<?php } ?>
<?php get_footer();?>