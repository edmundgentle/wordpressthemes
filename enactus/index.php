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
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
	wp_head();
?>
<style>
<?php if(get_option('enactus_hp_img')) {
	echo '#homemain {background-image:url('.get_option('enactus_hp_img').');}';
}?>
</style>
</head>
<body <?php body_class();?>>
	<div id="container">
		<?php wp_nav_menu(array('theme_location'=>'main-menu','menu_id'=>'mainmenu','container'=>false,'menu_class'=>false)); ?>
		<div id="homemain">
			<div class="logo">Enactus: Plymouth University</div>
			<ul class="stats">
				<?
				$stats=get_option('enactus_stats');
				$s=explode("\n",$stats);
				foreach($s as $stat) {
					$e=explode('|',$stat);
					echo'<li><span class="num">'.$e[0].'</span> '.$e[1].'</li>';
				}
				?>
			</ul>
		</div>
		<div id="footer">
			<div class="left">&copy; Enactus Plymouth <?php echo date("Y");?> - <a href="/contact-us/">Contact Us</a> - Website by <a href="http://www.edmundgentle.com" target="_blank">Edmund Gentle</a></div>
			<ul class="social">
				<?php if(get_option('enactus_fb_link')!='') {?><li class="fb"><a href="<?php echo get_option('enactus_fb_link');?>" target="_blank">Enactus Plymouth on Facebook</a></li><?php }?>
				<?php if(get_option('enactus_tw_link')!='') {?><li class="tw"><a href="<?php echo get_option('enactus_tw_link');?>" target="_blank">Enactus Plymouth on Twitter</a></li><?php }?>
				<?php if(get_option('enactus_li_link')!='') {?><li class="li"><a href="<?php echo get_option('enactus_li_link');?>" target="_blank">Enactus Plymouth on LinkedIn</a></li><?php }?>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<?php wp_footer();?>
</body>
</html>