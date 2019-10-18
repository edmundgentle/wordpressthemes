<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
		<title><?php
			global $page, $paged;
			wp_title('&laquo;',true,'right');
			bloginfo('name');
			$site_description = get_bloginfo( 'description', 'display' );
			if($site_description && (is_home() || is_front_page()))
				echo " &raquo; $site_description";
			if($paged >= 2 || $page >= 2)
				echo ' &laquo; ' . sprintf(__('Page %s','surfer'),max($paged,$page));
			?></title>
		<link href="http://fonts.googleapis.com/css?family=Signika:600,300" rel="stylesheet" type="text/css" />
		<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" media="all" />
		<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/jquery.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/basic-jquery-slider.js"></script>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class();?>>
		<div class="header">
			<a href=""><h1><?php bloginfo('name'); ?></h1>
			<h3><?php bloginfo('description'); ?></h3></a>
			<?php wp_nav_menu(array('theme_location'=>'main-menu','menu_id'=>false,'container'=>false,'menu_class'=>'main_menu','depth'=>2)); ?>
		</div>
		<div class="main">
			<div class="content">