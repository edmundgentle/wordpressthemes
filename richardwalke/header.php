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
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri();?>/images/logo@2x.png">
		<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.slides.min.js"></script>
		<script>
			$(function() {
				$('#imgslider').slidesjs({
					width:$( window ).width(),
					height:($( window ).width()/1280)*450,
					play: {active:false,auto:true,effect:'slide',interval:5000},
					pagination: {active:false},
					navigation:{active:false}
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
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=338312122922775&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<div id="header">
		<h1><a href="<?php echo home_url();?>"><?php echo get_bloginfo('name');?></a></h1>
		<?php wp_nav_menu(array('theme_location'=>'main-menu','menu_class'=>'menu','container'=>false));?>
	</div>
	<?php if(is_front_page()) {?>
	<div class="content_slider">
		<div id="imgslider">
			<?php
			$images=get_option('rw_slideshow_arr');
			$images=explode(',',$images);
			$images=array_reverse($images);
			foreach($images as $img) {
				if(strlen($img)) {
					echo'<img src="'.$img.'" />';
				}
			}
			?>
		</div>
	</div>
	<? }?>
	<div class="main">
		<div class="inner">