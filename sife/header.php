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
		<link href="http://fonts.googleapis.com/css?family=Coda:800" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
		<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/jquery.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/basic-jquery-slider.js"></script>
	    <script>
	      $(document).ready(function() {$('#banner').bjqs({'animation' : 'fade','width' : 701,'height' : 350,'showMarkers' : false,'showControls' : false});});
	    </script>
		<?php
			wp_head();
		?>
	</head>
	<body <?php body_class();?>>
		<div id="container">
			<a href="<?php echo home_url();?>"><div id="logo"><h1><?php bloginfo('name');?></h1></div></a>
			<div class="extra-wide">
				<div class="header">
					<?php wp_nav_menu(array('theme_location'=>'main-menu','menu_id'=>false,'container'=>false,'menu_class'=>'main-menu')); ?>
				</div>
			</div>
			<div class="wide-left-wedge wedge-blue"></div>
			<div class="wide-right-wedge wedge-blue"></div>
			<ul class="social-links">
				<?php if(get_option('sife_fb_link')!='') {?><li class="fb"><a href="<?php echo get_option('sife_fb_link');?>" target="_blank">Facebook</a></li><?php }?>
				<?php if(get_option('sife_tw_link')!='') {?><li class="tw"><a href="<?php echo get_option('sife_tw_link');?>" target="_blank">Twitter</a></li><?php }?>
				<?php if(get_option('sife_yt_link')!='') {?><li class="yt"><a href="<?php echo get_option('sife_yt_link');?>" target="_blank">YouTube</a></li><?php }?>
			</ul>