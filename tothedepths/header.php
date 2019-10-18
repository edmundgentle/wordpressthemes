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
	<div class="container">
		<div class="header">
			<h1><a href="<?php echo home_url();?>"><?php echo get_bloginfo('name');?> <img src="<?php echo get_template_directory_uri(); ?>/images/logo_big.png" /></a></h1>
		</div>
		<div class="mob_menu">
			<a href="javascript:;" id="mob_cat_link">Categories</a>
		</div>
		<?php wp_nav_menu(array('theme_location'=>'main-menu','menu_id'=>false,'container'=>false,'menu_class'=>'main_menu'));?>
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