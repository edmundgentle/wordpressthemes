<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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
			<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/jquery.js"></script>
			<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
			<?php wp_head();?>
	</head>
	<body <?php body_class();?>>
<div class="header">
				<h1><a href="/"><? bloginfo('name');?></a></h1>
			</div>
		<div class="container">
			<?php wp_nav_menu(array('theme_location'=>'main-menu','menu_id'=>false,'container'=>false,'menu_class'=>'main_menu')); ?>