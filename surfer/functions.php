<?php
if (!isset($content_width)) {
	$content_width = 610;
}
if(function_exists('register_nav_menu')) {
	register_nav_menu('main-menu','Main navigation menu across the top of the page.');
	register_nav_menu('footer-menu','Footer links at bottom of the page.');
	register_nav_menu('home-cats','Homepage Categories');
}
if ( function_exists('register_sidebar') ) {
	register_sidebar(array('name'=>'mainsidebar'));
	register_sidebar(array('name'=>'videosidebar'));
	register_sidebar(array('name'=>'homesidebar'));
}
add_theme_support('post-thumbnails');
function custom_excerpt_length($length) {
	return 18;
}
add_filter('excerpt_length','custom_excerpt_length',999);
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
add_action('admin_menu','surfer_admin_menu');
function surfer_admin_menu() {
	add_theme_page(__('Theme Options','surfer'), __('Theme Options','surfer'), 8, 'surfer-settings', 'surfer_show_settings');
	add_theme_page(__('Slider Settings','surfer'), __('Slider Settings','surfer'), 8, 'surfer-slider', 'surfer_slider_settings');
}
function surfer_show_settings() {?>
	<style type="text/css">
	.nh_success {
		border: 1px solid #FCCD69;
		border-radius: 5px;
		margin-bottom:20px;
	}
	.nh_success .nh_inner {
		border-top: 1px solid #FFF9EE;
		border-radius:4px;
		padding: 5px 10px;
		background-color: #FEEECD;
		text-align: center;
	}
	</style>
	<div class="wrap">
		<div id="icon-themes" class="icon32"><br></div>
		<h2><?php _e('Theme Options','surfer');?></h2>
		<?php
		if(isset($_POST['bg_type'])) {
			if($_POST['bg_type']=='color') {
				update_option('surfer_bg', $_POST['theme_bg_color']);
			}
			if($_POST['bg_type']=='default') {
				update_option('surfer_bg', '#EEEEEE');
			}
			if($_POST['bg_type']=='image' and isset($_FILES['theme_bg_image']['tmp_name']) and $_FILES['theme_bg_image']['tmp_name']) {
				$random=sha1(strtotime('now'));
				$result=wp_upload_bits("surf_".$random.".png", null, file_get_contents($_FILES['theme_bg_image']['tmp_name']));
				if(isset($result['url'])) {
					update_option('surfer_bg', $result['url']);
				}
			}
		}
		if(isset($_FILES['new_img']['tmp_name']) and $_FILES['new_img']['tmp_name']) {
			$random=sha1(strtotime('now'));
			$result=wp_upload_bits("surf_".$random.".png", null, surfer_make_thumbnail($_FILES['new_img']['tmp_name'],430,70));
			if(isset($result['url'])) {
				update_option('surfer_hl_img', $result['url']);
			}
		}
		if(isset($_POST['hl_link'])) {
			update_option('surfer_hl_link', $_POST['hl_link']);
		}
		if(isset($_POST['cbg_type'])) {
			if($_POST['cbg_type']=='color') {
				update_option('surfer_cbg', $_POST['theme_cbg_color']);
			}
			if($_POST['cbg_type']=='default') {
				update_option('surfer_cbg', '#EEEEEE');
			}
		}
		if(isset($_POST['logo_type'])) {
			if($_POST['logo_type']=='default') {
				update_option('surfer_logo', '');
			}
			if($_POST['logo_type']=='image' and isset($_FILES['theme_logo_image']['tmp_name']) and $_FILES['theme_logo_image']['tmp_name']) {
				$random=sha1(strtotime('now'));
				$result=wp_upload_bits("surf_".$random.".png", null, file_get_contents($_FILES['theme_logo_image']['tmp_name']));
				if(isset($result['url'])) {
					update_option('surfer_logo', $result['url']);
				}
			}
		}
		if(isset($_POST['logo2_type'])) {
			if($_POST['logo2_type']=='default') {
				update_option('surfer_logo2', '');
			}
			if($_POST['logo2_type']=='image' and isset($_FILES['theme_logo2_image']['tmp_name']) and $_FILES['theme_logo2_image']['tmp_name']) {
				$random=sha1(strtotime('now'));
				$result=wp_upload_bits("surf_".$random.".png", null, file_get_contents($_FILES['theme_logo2_image']['tmp_name']));
				if(isset($result['url'])) {
					update_option('surfer_logo2', $result['url']);
				}
			}
		}
		if(isset($_POST['bg_link'])) {
			update_option('surfer_bg_link', $_POST['bg_link']);
		}
		if(isset($_POST['fb_link'])) {
			update_option('surfer_fb_link', $_POST['fb_link']);
		}
		if(isset($_POST['tw_link'])) {
			update_option('surfer_tw_link', $_POST['tw_link']);
		}
		if(isset($_POST['cn_link'])) {
			update_option('surfer_cn_link', $_POST['cn_link']);
		}
		if(isset($_POST['ga_code'])) {
			update_option('surfer_ga_code', stripslashes($_POST['ga_code']));
		}
		if(isset($_POST) and count($_POST)) {
			echo'<div class="nh_success"><div class="nh_inner">'.__('Theme settings have been saved!','surfer').'</div></div>';
		}?>
		<form method="post" name="editsettings" enctype="multipart/form-data">
			<input type="hidden" name="feedaction" value="save" />
			<table class="form-table">
				<tbody>
				<tr valign="top">
					<th scope="row" rowspan="3"><label><?php _e('Background','surfer');?></label></th>
					<td>
						<label><input type="radio" name="bg_type" value="color"<?php if(substr(get_option('surfer_bg'),0,1)=='#' and get_option('surfer_bg')!='#EEEEEE') {echo' checked="checked"';}?> /> Colour: </label>
						<input type="text" class="regular-text" id="bg_color" name="theme_bg_color" value="<?php if(substr(get_option('surfer_bg'),0,1)=='#' and get_option('surfer_bg')!='#EEEEEE') {echo get_option('surfer_bg');}?>" />
						<span class="description"><?php _e('The background color (hex value)','surfer');?></span>
					</td>
				</tr>
				<tr>
					<td>
						<label><input type="radio" name="bg_type" value="image"<?php if(substr(get_option('surfer_bg'),0,1)!='#') {echo' checked="checked"';}?> /> Image: </label>
						<input type="file" id="bg_img" name="theme_bg_image" />
						<span class="description"><?php _e('The background image','surfer');?></span>
						<?php if(substr(get_option('surfer_bg'),0,1)!='#') {echo'<div><img src="'.get_option('surfer_bg').'" /></div>';}?>
					</td>
				</tr>
				<tr>
					<td>
						<label><input type="radio" name="bg_type" value="default"<?php if(get_option('surfer_bg')=='#EEEEEE') {echo' checked="checked"';}?> /> Default</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" rowspan="2"><label><?php _e('Content Background','surfer');?></label></th>
					<td>
						<label><input type="radio" name="cbg_type" value="color"<?php if(substr(get_option('surfer_cbg'),0,1)=='#' and get_option('surfer_cbg')!='#EEEEEE') {echo' checked="checked"';}?> /> Colour: </label>
						<input type="text" class="regular-text" name="theme_cbg_color" value="<?php if(substr(get_option('surfer_cbg'),0,1)=='#' and get_option('surfer_cbg')!='#EEEEEE') {echo get_option('surfer_cbg');}?>" />
						<span class="description"><?php _e('The background color of content (hex value)','surfer');?></span>
					</td>
				</tr>
				<tr>
					<td>
						<label><input type="radio" name="cbg_type" value="default"<?php if(get_option('surfer_cbg')=='#EEEEEE') {echo' checked="checked"';}?> /> Default</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>Headline image:</label></th>
					<td><input type="file" id="new_img" name="new_img" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>Headline link:</label></th>
					<td><input type="text" name="hl_link" value="<?php echo get_option('surfer_hl_link');?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row" rowspan="2"><label><?php _e('Logo 1: Homepage','surfer');?></label></th>
					<td>
						<label><input type="radio" name="logo_type" value="image"<?php if(substr(get_option('surfer_logo'),0,1)!='') {echo' checked="checked"';}?> /> Image: </label>
						<input type="file" id="logo_img" name="theme_logo_image" />
						<span class="description"><?php _e('The logo image','surfer');?></span>
						<?php if(substr(get_option('surfer_logo'),0,1)!='') {echo'<div><img src="'.get_option('surfer_logo').'" /></div>';}?>
					</td>
				</tr>
				<tr>
					<td>
						<label><input type="radio" name="logo_type" value="default"<?php if(get_option('surfer_logo')=='') {echo' checked="checked"';}?> /> Default</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" rowspan="2"><label><?php _e('Logo 2: Other pages','surfer');?></label></th>
					<td>
						<label><input type="radio" name="logo2_type" value="image"<?php if(substr(get_option('surfer_logo2'),0,1)!='') {echo' checked="checked"';}?> /> Image: </label>
						<input type="file" id="logo_img" name="theme_logo2_image" />
						<span class="description"><?php _e('The logo image','surfer');?></span>
						<?php if(substr(get_option('surfer_logo2'),0,1)!='') {echo'<div><img src="'.get_option('surfer_logo2').'" /></div>';}?>
					</td>
				</tr>
				<tr>
					<td>
						<label><input type="radio" name="logo2_type" value="default"<?php if(get_option('surfer_logo2')=='') {echo' checked="checked"';}?> /> Default</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Page Background Link','surfer');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="bg_link" value="<?php echo get_option('surfer_bg_link');?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Facebook Link','surfer');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="fb_link" value="<?php echo get_option('surfer_fb_link');?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Twitter Username','surfer');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="tw_link" value="<?php echo get_option('surfer_tw_link');?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Contact Link','surfer');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="cn_link" value="<?php echo get_option('surfer_cn_link');?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Google Analytics Code','surfer');?>:</label></th>
					<td>
						<textarea rows="10" cols="50" name="ga_code" class="large-text code"><?php echo get_option('surfer_ga_code');?></textarea>
					</td>
				</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes','surfer');?>" />
			</p>
		</form>
	</div>
<?php
}
function surfer_slider_settings() {?>
	<style type="text/css">
	.nh_success {
		border: 1px solid #FCCD69;
		border-radius: 5px;
		margin-bottom:20px;
	}
	.nh_success .nh_inner {
		border-top: 1px solid #FFF9EE;
		border-radius:4px;
		padding: 5px 10px;
		background-color: #FEEECD;
		text-align: center;
	}
	</style>
	<div class="wrap">
		<div id="icon-themes" class="icon32"><br></div>
		<h2><?php _e('Slider Settings','surfer');?></h2>
		<?php
		if(isset($_POST['slimgs']) and is_array($_POST['slimgs'])) {
			$images=implode(',',$_POST['slimgs']);
			update_option('surfer_slideshow_arr',$images);
		}
		$links=array();
		$bol=false;
		foreach($_POST as $p=>$v) {
			if(substr($p,0,5)=='link_') {
				$bol=true;
				$links[substr($p,5)]=$v;
			}
		}
		if($bol) {
			update_option('surfer_slideshow_links',json_encode($links));
		}
		if(isset($_FILES['new_img']['tmp_name']) and $_FILES['new_img']['tmp_name']) {
			$random=sha1(strtotime('now'));
			$result=wp_upload_bits("surf_".$random.".png", null, surfer_make_thumbnail($_FILES['new_img']['tmp_name'],450,299));
			if(isset($result['url'])) {
				$images=get_option('surfer_slideshow_arr');
				$images=explode(',',$images);
				$images[]=$result['url'];
				$images=implode(',',$images);
				update_option('surfer_slideshow_arr',$images);
				$links=json_decode(get_option('surfer_slideshow_links'),true);
				$links[sha1($result['url'])]='';
				update_option('surfer_slideshow_links',json_encode($links));
			}
		}
		if(isset($_POST) and count($_POST)) {
			echo'<div class="nh_success"><div class="nh_inner">'.__('Theme settings have been saved!','surfer').'</div></div>';
		}?>
		<form method="post" name="editsettings" enctype="multipart/form-data">
			<table class="form-table">
				<tbody>
				<tr valign="top">
					<th scope="row"><label><?php _e('Current Images','surfer');?></label></th>
					<td>
						<?php
						$images=get_option('surfer_slideshow_arr');
						$images=explode(',',$images);
						$links=json_decode(get_option('surfer_slideshow_links'),true);
						foreach($images as $img) {
							if(strlen($img)) {
								if(!isset($links[sha1($img)])) {
									$links[sha1($img)]='';
								}
								echo'<div><input type="checkbox" checked="checked" name="slimgs[]" value="'.$img.'" /> <img src="'.$img.'" /><br />Link: <input type="text" value="'.$links[sha1($img)].'" name="link_'.sha1($img).'" /></div>';
							}
						}
						?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Add a new image','surfer');?></label></th>
					<td>
						<input type="file" id="new_img" name="new_img" />
					</td>
				</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes','surfer');?>" />
			</p>
		</form>
	</div>
<?php
}
function surfer_make_thumbnail($img_src,$target_width,$target_height) {
	$info = getimagesize($img_src);
	$factor = $target_width / $info[0];
	if($target_height<($factor * $info[1])) {
		$targetheight=$factor*$info[1];
		$targetwidth=$target_width;
		$yoff=($targetheight-$target_height)/2;
		$xoff=0;
	}else{
		$factor = $target_height / $info[1];
		$targetheight=$target_height;
		$targetwidth=$factor*$info[0];
		$xoff=($targetwidth-$target_width)/2;
		$yoff=0;
	}
	$mime = $info['mime'];
	$type = substr(strrchr($mime, '/'), 1);
	$typemaps=array(
		'jpeg'=>'ImageCreateFromJPEG',
		'pjpeg'=>'ImageCreateFromJPEG',
		'png'=>'ImageCreateFromPNG',
		'bmp'=>'ImageCreateFromBMP',
		'x-windows-bmp'=>'ImageCreateFromBMP',
		'vnd.wap.wbmp'=>'ImageCreateFromWBMP',
		'gif'=>'ImageCreateFromGIF',
		'x-xbitmap'=>'ImageCreateFromXBM',
		'x-xbm'=>'ImageCreateFromXBM',
		'xbm'=>'ImageCreateFromXBM',
	);
	$func=$typemaps['jpeg'];
	if(isset($typemaps[$type])) $func=$typemaps[$type];
	$thumb=imagecreatetruecolor($targetwidth,$targetheight);
	$white = imagecolorallocate($thumb, 255, 255, 255);
	imagefill($thumb, 0, 0, $white);
	$source = $func($img_src);
    imagecopyresampled($thumb,$source,0,0,0,0,$targetwidth,$targetheight,$info[0],$info[1]);
    $dest = imagecreatetruecolor($target_width,$target_height);
	imagecopy($dest,$thumb, 0, 0, $xoff,$yoff, $target_width, $target_height);
	ob_start();
	imagepng($dest);
	$stringdata = ob_get_contents();
	ob_end_clean();
	return $stringdata;
}
//widgets
add_action('widgets_init', create_function('', 'return register_widget("widget_surfer_advert");'));
class widget_surfer_advert extends WP_Widget {
	function widget_surfer_advert() {
		parent::WP_Widget(false, $name = 'Surfer Advert');
    }
    function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title='';
		echo"<a href=\"".$instance['link']."\" target=\"_blank\"><img src=\"".$instance['image']."\" border=\"0\" /></a>";
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['link'] = strip_tags($new_instance['link']);
		$instance['image'] = strip_tags($new_instance['image']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'link' => '', 'image' => '') );
		$link = strip_tags($instance['link']);
		$image = strip_tags($instance['image']);?><p><label for="<?php echo $this->get_field_id('link'); ?>">Link: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('image'); ?>">Image URL: <input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_attr($image); ?>" /></label></p>
<p></p><?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("widget_surfer_tabs");'));
class widget_surfer_tabs extends WP_Widget {
	function widget_surfer_tabs() {
		parent::WP_Widget(false, $name = 'Surfer Tabbed Widget');
    }
    function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title='';
		echo"<div class=\"tabbed-widget\">
			<ul class=\"tabs\">
				<li class=\"selected\"><a id=\"s_1\" href=\"".get_home_url()."\" class=\"sl\">Latest</a></li><li><a id=\"s_2\" href=\"".get_category_link(get_cat_ID('Competition'))."\" class=\"sl\">Competition</a></li><li><a id=\"s_3\" href=\"".get_category_link(get_cat_ID('Industry News'))."\">Industry News</a></li><li><a id=\"s_4\" href=\"https://www.twitter.com/".get_option('surfer_tw_link')."\" class=\"sl\">Twitter</a></li>
			</ul>
			<ul class=\"tab-content\">
				<li id=\"ps_1\" class=\"selected\">
					<ul class=\"postlist\">";
					query_posts('posts_per_page=5');
					while (have_posts()) {
						the_post();
						echo"<li><a href=\"".get_permalink()."\"><strong>".get_the_title()."</strong>".get_the_excerpt()."</a></li>";
					}
					wp_reset_query();
					echo"
					</ul>
					<div class=\"morelink\"><a href=\"".get_home_url()."\">More</a></div>
				</li>
				<li id=\"ps_2\">
					<ul class=\"postlist\">";
					query_posts('category_name=Competition News&posts_per_page=5');
					while (have_posts()) {
						the_post();
						echo"<li><a href=\"".get_permalink()."\"><strong>".get_the_title()."</strong>".get_the_excerpt()."</a></li>";
					}
					wp_reset_query();
					echo"
					</ul>
					<div class=\"morelink\"><a href=\"".get_category_link(get_cat_ID('Competition'))."\">More</a></div>
				</li>
				<li id=\"ps_3\">
					<ul class=\"postlist\">";
					query_posts('category_name=Industry News&posts_per_page=5');
					while (have_posts()) {
						the_post();
						echo"<li><a href=\"".get_permalink()."\"><strong>".get_the_title()."</strong>".get_the_excerpt()."</a></li>";
					}
					wp_reset_query();
					echo"
					</ul>
					<div class=\"morelink\"><a href=\"".get_category_link(get_cat_ID('Industry News'))."\">More</a></div>
				</li>
				<li id=\"ps_4\">
					<script charset=\"utf-8\" src=\"http://widgets.twimg.com/j/2/widget.js\"></script>
					<script>
					new TWTR.Widget({
					  version: 2,
					  type: 'profile',
					  rpp: 5,
					  interval: 30000,
					  width: 'auto',
					  height: 300,
					  theme: {
					    shell: {
					      background: '#eeeeee',
					      color: '#333333'
					    },
					    tweets: {
					      background: '#eeeeee',
					      color: '#333333',
					      links: '#006699'
					    }
					  },
					  features: {
					    scrollbar: false,
					    loop: false,
					    live: false,
					    behavior: 'all'
					  }
					}).render().setUser('".get_option('surfer_tw_link')."').start();
					</script>
				</li>
			</ul>
		</div>";
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		return $instance;
	}
}
add_theme_support('post-formats',array('video'));
function surfer_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);?>
	<div id="comment-<?php comment_ID(); ?>" class="comment">
		<strong><?php echo get_comment_author_link();?></strong>
		<?php comment_text(); ?>
		<div class="date"><?php echo get_comment_date();?> at <?php echo get_comment_time();?></div>
	</div><?php
}
add_theme_support('automatic-feed-links');
?>