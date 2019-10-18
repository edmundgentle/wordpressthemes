<?php
if (!isset($content_width)) {
	$content_width = 550;
}
if(function_exists('register_nav_menu')) {
	register_nav_menu('main-menu','Main navigation menu across the top of the page.');
}
if (function_exists('register_sidebar')) {
	register_sidebar();
}
add_theme_support('post-thumbnails');
function custom_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length','custom_excerpt_length',999);
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
add_action('admin_menu','enactus_admin_menu');
function enactus_admin_menu() {
	add_theme_page(__('Theme Options','enactus'), __('Theme Options','enactus'), 8, 'enactus-settings', 'enactus_show_settings');
}
function enactus_show_settings() {?>
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
		<h2><?php _e('Theme Options','enactus');?></h2>
		<?php
		if(isset($_FILES['hp_image']['tmp_name']) and $_FILES['hp_image']['tmp_name']) {
			$random=sha1(strtotime('now'));
			$result=wp_upload_bits("hpimg_".$random.".png", null, enactus_make_thumbnail($_FILES['hp_image']['tmp_name'],1400,600));
			if(isset($result['url'])) {
				update_option('enactus_hp_img', $result['url']);
			}
		}
		if(isset($_POST['fb_link'])) {
			update_option('enactus_fb_link', $_POST['fb_link']);
		}
		if(isset($_POST['tw_link'])) {
			update_option('enactus_tw_link', $_POST['tw_link']);
		}
		if(isset($_POST['li_link'])) {
			update_option('enactus_li_link', $_POST['li_link']);
		}
		if(isset($_POST['stats'])) {
			update_option('enactus_stats', stripslashes($_POST['stats']));
		}
		if(isset($_POST) and count($_POST)) {
			echo'<div class="nh_success"><div class="nh_inner">'.__('Theme settings have been saved!','enactus').'</div></div>';
		}?>
		<form method="post" name="editsettings" enctype="multipart/form-data">
			<input type="hidden" name="feedaction" value="save" />
			<table class="form-table">
				<tbody>
				<tr valign="top">
					<th scope="row"><label><?php _e('Homepage Image: 1400x600 pixels','enactus');?></label></th>
					<td>
						<input type="file" name="hp_image" />
						<?php if(get_option('enactus_hp_img')) {echo'<div><img src="'.get_option('enactus_hp_img').'" /></div>';}?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Facebook Link','enactus');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="fb_link" value="<?php echo get_option('enactus_fb_link');?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Twitter Link','enactus');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="tw_link" value="<?php echo get_option('enactus_tw_link');?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('LinkedIn Link','enactus');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="li_link" value="<?php echo get_option('enactus_li_link');?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Stats','enactus');?>:</label></th>
					<td>
						<textarea name="stats"><?php echo get_option('enactus_stats');?></textarea>
					</td>
				</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes','enactus');?>" />
			</p>
		</form>
	</div>
<?php
}
function enactus_make_thumbnail($img_src,$target_width,$target_height) {
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
add_theme_support('automatic-feed-links');
?>