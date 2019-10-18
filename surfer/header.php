<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php wp_title('|'); ?></title>

<meta name="keywords" content="supboardermag.com, supboarder, supboarding, sup, magazine, supboardermagazine, supboardermag, sup board, supboard, sup boarding, stand up board, paddle boarding, paddleboarding, paddle board, paddleboard, stand up paddleboarding, standup, surfing, water, sea, watersports, paddle, surf, competitions" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/jquery.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/basic-jquery-slider.js"></script>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
	wp_head();
?>
<style>
<?php if(get_option('surfer_bg')) {
	if(substr(get_option('surfer_bg'),0,1)=='#') {
		echo 'body {background-color:'.get_option('surfer_bg').';}';
	}else{
		echo 'body {background-image:url('.get_option('surfer_bg').');}';
	}
}?>
<?php if(get_option('surfer_cbg')) {
	if(substr(get_option('surfer_cbg'),0,1)=='#') {
		echo '#container {background-color:'.get_option('surfer_cbg').';}';
	}
}?>
.ai1ec-container, #ai1ec-calendar-view-container, table.ai1ec-month-view, .ai1ec-week-view table, .ai1ec-oneday-view table, .ai1ec-posterboard-view {
	clear:none !important;
}
.clearfix::after {
	clear: left !important;
}
.fixfloat {
	clear: left !important;
}
</style>
</head>
<body <?php body_class();?>>
<?php
if(get_option('surfer_bg_link')) {
	echo "<a id=\"bglink\" href=\"".get_option('surfer_bg_link')."\" target=\"_blank\"></a>";
}?>
<script>
$(function() {
	$('.tabbed-widget .tabs a').bind('click',function(e) {
		e.preventDefault();
		var id=$(this).attr('id');
		$('.tabbed-widget .selected').removeClass('selected');
		$('#'+id).parent().addClass('selected');
		$('#p'+id).addClass('selected');
	});
	$('.actual_home_cats a').bind('click',function(e) {
		var id=$(this).attr('id');
		if(id) {
			e.preventDefault();
			$('.main-ws .selected').removeClass('selected');
			$('#'+id).parent().addClass('selected');
			$('#r'+id).addClass('selected');
			$('.actual_home_cats .right').html($('#r'+id+' .morelink').html());
		}
	});
	$('#banner').bjqs({
		'animation' : 'slide',
	    'width' : 450,
	    'height' : 299,
		'showMarkers' : false,
		'showControls' : true,
		'centerControls': false
	});
});
</script>
<div id="container">
	<div id="header" class="<?php if(is_home()) {echo'hbig';}else{echo'hsmall';}?>">
		<?php if(is_home()) {?>
			<div class="slideshow"><div id="banner">
			        <ul class="bjqs">
						<?php
						$images=get_option('surfer_slideshow_arr');
						$images=explode(',',$images);
						$images=array_reverse($images);
						$links=json_decode(get_option('surfer_slideshow_links'),true);
						foreach($images as $img) {
							if(strlen($img)) {
								echo'<li>';
								if(isset($links[sha1($img)]) and strlen($links[sha1($img)])) {
									echo'<a href="'.$links[sha1($img)].'">';
								}
								echo'<img src="'.$img.'" />';
								if(isset($links[sha1($img)]) and strlen($links[sha1($img)])) {
									echo'</a>';
								}
								echo'</li>';
							}
						}
						?>
			        </ul>
			      </div></div>
		<?php }else{?>
			<div class="ad4"><?php echo adrotate_group(4); ?></div>
		<?php }?>
		<a href="<?php echo home_url();?>"><h1><?php
		if(get_option('surfer_logo')=='') {
			echo strtolower(get_bloginfo('name'));
		}else{
			if(is_home()) {
				echo '<img src="'.get_option('surfer_logo').'" />';
			}else{
				if(get_option('surfer_logo2')!='') {
					echo '<img src="'.get_option('surfer_logo2').'" />';
				}else{
					echo'<img src="'.get_option('surfer_logo').'" />';
				}
			}
		}?></h1><?php if(is_home() and get_option('surfer_logo')=='') {echo'<h3>'.get_bloginfo('description').'</h3>';}?></a>
		<?php if(is_home() and get_option('surfer_hl_link')) {?>
			<div class="feature" align="center"><a href="<?php echo get_option('surfer_hl_link');?>"><img src="<?php echo get_option('surfer_hl_img');?>" /></a></div>
		<?php }?>
	</div>
	<div id="main-menu">
		<ul id="menu2">
			<?php if(get_option('surfer_fb_link')!='') {?><li><a href="<?php echo get_option('surfer_fb_link');?>" target="_blank" class="fb">Facebook</a></li><?php }?>
			<?php if(get_option('surfer_tw_link')!='') {?><li><a href="https://www.twitter.com/<?php echo get_option('surfer_tw_link');?>" target="_blank" class="tw">Twitter</a></li><?php }?>
			<?php if(get_option('surfer_cn_link')!='') {?><li><a href="<?php echo get_option('surfer_cn_link');?>" class="em">Email</a></li><?php }?>
			<li><a href="<?php bloginfo('rss2_url');?>" target="_blank" class="bl">Blog</a></li>
		</ul>
		<?php wp_nav_menu(array('theme_location'=>'main-menu','menu_id'=>'menu1','container'=>false,'menu_class'=>false)); ?>
	</div>
	<?php if(is_home()) {echo adrotate_group(2);} ?>
	<div class="main">