<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<style type="text/css">
		<?php
		$colors=split("(\n|\r)",trim(get_option('knowledge_cat_colors')));
		foreach($colors as $c) {
			$c=explode("::",$c);?>
			.sidebar_widgets .article_list .category_<?php echo $c[0];?> a:hover, .main_menu .category_<?php echo $c[0];?> a:hover, .slider li.category_<?php echo $c[0];?> .overlay {
				border-color:#<?php echo $c[1];?>;
			}
			.sidebar_widgets .article_list .category_<?php echo $c[0];?> .category, .article_meta .categories li.category_<?php echo $c[0];?> a, .home .col .section.category_<?php echo $c[0];?> h2 {
				background-color:#<?php echo $c[1];?>;
			}
			@media screen and (max-width: 940px) {
				.main_menu .category_<?php echo $c[0];?> a {
					background-color:#<?php echo $c[1];?>;
				}
			}
		<? }?>
		</style>
		<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/jquery.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/basic-jquery-slider.js"></script>
		<script type="text/javascript">
		$(function() {
			$('#mob_cat_link').click(function(e) {
				e.preventDefault();
				$('.main_menu').slideToggle('medium');
			});
			$('#homepage_slider').bjqs({
				'animation' : 'slide',
			    'height' : 285,
				'width' :$('#homepage_slider').width(),
				'showMarkers' : false,
				'showControls' : false,
				'centerControls': false
			});
		});
		</script>
		<?php
			wp_head();
		?>
</head>
<body <?php body_class();?>>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=170983486428741";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="container">
		<div class="header">
			<h1><a href="<?php echo home_url();?>">
			<?php echo get_bloginfo('name');?> 
			<img src="<?php echo get_template_directory_uri(); ?>/images/logo_big.png" /></a></h1>
		</div>
		<div class="mob_menu">
			<a href="javascript:;" id="mob_cat_link">Categories</a>
		</div>
		<?php $items = wp_get_nav_menu_items('main-menu');
		$cats=array();
		foreach($items as $k=>$i) {
			if($i->object=='category') {
				$cats[$i->object_id]=$k;
			}
		}
		$c=array_keys($cats);
		sort($c);
		$categories=get_categories(array('include'=>implode(',',$c),'hide_empty'=>0));
		foreach($categories as $c) {
			if(isset($cats[$c->term_id])) {
				$items[$cats[$c->term_id]]->cat_slug=$c->slug;
			}
		}?>
		<ul class="main_menu">
			<?php
			foreach($items as $i) {?>
				<li class="<?php if(isset($i->cat_slug)) {echo 'category_'.$i->cat_slug;}?>"><a href="<?php echo $i->url;?>" target="<?php echo $i->target;?>"><?php echo $i->title;?></a></li>
			<? }
			?>
		</ul>
		<div class="main_2col">
			<div class="sidebar_right">
				<form class="search_form" action="<?php echo home_url('/');?>" method="get">
					<div class="search_box">
						<input type="submit" value="Search" />
						<input type="text" placeholder="Search..." name="s" value="<?php the_search_query(); ?>" />
					</div>
				</form>
				<ul class="sidebar_widgets">
					<?php dynamic_sidebar();?>
				</ul>
			</div>