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
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,700,300italic,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/jquery.js"></script>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
	wp_head();
?>
<script>
$(function() {
	$('a[href^="#"]').on('click',function (e) {
		e.preventDefault();
		var target = this.hash,
		$target = $(target);
		$('html, body').stop().animate({'scrollTop': $target.offset().top}, 900, 'swing', function () {window.location.hash = target;});
	});
});
</script>
</head>
<body <?php body_class();?>>
	<div id="container">
		<?php wp_nav_menu(array('theme_location'=>'main-menu','menu_id'=>'mainmenu','container'=>false,'menu_class'=>false)); ?>
		<!--
		<div id="homemain">
			<div class="logo">Enactus: Plymouth University</div>
			<ul class="stats">
				<li><span class="num">39</span> Members</li>
				<li><span class="num">6</span> Projects</li>
				<li><span class="num">8</span> Committee Members</li>
				<li><span class="num">10</span> External Advisors</li>
				<li><span class="num">1,200</span> People Impacted</li>
			</ul>
		</div>
		-->
		<div class="container">
			<div id="sidebar">
				<a href="/"><div class="logo">Enactus: Plymouth University</div></a>
				<? get_sidebar();?>
			</div>
			<div id="main">
				