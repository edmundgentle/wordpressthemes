<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf(__('Page %s','surfer'), max( $paged, $page ) );
	?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>">
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/jquery.js"></script>
<script>
</script>
<?php
	wp_head();
?>
</head>
<body <?php body_class();?>>
	<div class="container">
		<div class="header">
			<h1><?php bloginfo( 'name' );?></h1>
			<ul class="mainmenu">
			<?php 
			$pages=array();
			$items = wp_get_nav_menu_items('main-menu');
			foreach($items as $i) {
				$pages[]=$i->object_id;
				$url=end((explode('/', trim($i->url,'/'))));
				if(strpos($url,'.')!==false) {
					$url='home';
				}
				?>
				<li><a href="/#<? echo $url;?>"><? echo $i->title;?></a></li>
			<? } ?>
			</ul>
		</div>
		<div class="content">
			<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				$url=end((explode('/', trim(get_permalink(),'/'))));
				if(strpos($url,'.')!==false) {
					$url='home';
				}?>
				<div id="<? echo $url;?>" class="pagebox">
					<h2><?php the_title();?></h2>
					<div class="pagebox_inner">
						<?php
						if(has_post_thumbnail()) {
						?>
						<div class="header_image"><?php the_post_thumbnail(array(750,400)); ?></div>
						<? }?>
					<?php the_content();?>
					</div>
				</div>
			<?php endwhile; else: ?>
				<div class="nocontent">This page could be found.</div>
			<?php endif; ?>
		</div>
	</div>
	<?php wp_footer();?>
</body>
</html>