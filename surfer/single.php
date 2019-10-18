<?php get_header();?>
<?php
query_posts('category_name=Videos&orderby=rand&showposts=3');
$mystr='';
if ( have_posts() ) { while ( have_posts() ) { the_post();
	$mystr.='<li><a href="'.get_permalink().'">';
	$mystr.=get_the_post_thumbnail(get_the_ID(),array(166,110));
	$mystr.='</a><a href="'.get_permalink().'">'.get_the_title().'</a>'.get_the_excerpt().'</li>';
}}
wp_reset_query();?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
	$format = get_post_format();
	if($format!='video') {
	?>
		<?php get_sidebar();?>
		<div class="main-ws">
	<?php }?>
				<ul class="home-cats">
					<li><?php the_category(' / '); ?></li>
				</ul>
				<div class="article">
					<h2><?php the_title();?></h2>
					<p class="subtitle"><strong>Published: </strong><?php the_date();?></p>
					<div style="position:absolute;width:610px;">
						<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
						<a class="addthis_button_tweet"></a>
						<a class="addthis_button_google_plusone" g:plusone:annotation="bubble"></a> 
						<a class="addthis_button_pinterest_pinit"></a>
						<a class="addthis_counter addthis_pill_style"></a>
						</div>
						<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5062067476e624bd"></script>
						<!-- AddThis Button END -->
					</div>
					<div style="margin-top:40px"> </div>
					<?php if($format=='video') {
						$content=get_the_content();
						$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
						if(preg_match($reg_exUrl, $content, $url)) {
							$url=$url[0];
							$parsedUrl  = parse_url($url);
							if(strpos($parsedUrl['host'],'youtube.com')>-1) {
								$embed      = $parsedUrl['query'];
								parse_str($embed, $out);  
								$embedUrl   = 'http://www.youtube.com/embed/'.$out['v'].'?rel=0';
							}
							if(strpos($parsedUrl['host'],'vimeo.com')>-1) {
								$embed      = $parsedUrl['query'];
								$embedUrl   = 'http://player.vimeo.com/video'.$parsedUrl['path'].'?portrait=0&amp;badge=0&amp;outro=0';
							}
							$content=str_replace($url,'',$content);
						}
						if(isset($embedUrl)) {
						?>  
						<div class="video"><iframe width="930" height="523" src="<?php echo $embedUrl; ?>" frameborder="0" allowfullscreen></iframe></div>
						<?php }?>
						</div>
						<div class="widgetsidebar">
	<form action="<?php echo home_url('/');?>" method="get" class="search">
		<input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="SEARCH <?php echo strtoupper(get_bloginfo('name'));?>" /><input type="submit" value="Search" />
	</form>
	<ul>
		<?php dynamic_sidebar('videosidebar');?>
	</ul>
</div>
						<div class="main-ws">
							<div class="article">
					<?php 
						echo apply_filters('the_content',$content);?>
						<h3>More Videos</h3>
						<ul class="article-thumb-medium">
							<?php echo $mystr;?>
						</ul><?php
					}else{
						if(has_post_thumbnail()) {?>
							<div class="image">
							<?php the_post_thumbnail(array(610,800));?>
							<div class="caption"><?php the_title_attribute();?></div>
							</div>
						<?php }
function lp_multipages($content) {
	$content .= wp_link_pages(array('echo'=>0,'before'=>'<div align="center"><strong>' . __('Pages:'),'after'=>'</strong></div>'));
	return $content;
}
add_filter('the_content', 'lp_multipages');
						the_content();?>
						<?php  ?>
					<?php }?>
				</div>
			 <?php endwhile; else: ?>
		     	<div class="nocontent">This post could be found.</div>
			 <?php endif; ?>
		</div>
<?php get_footer();?>