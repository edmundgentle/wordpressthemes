<?php
if (!isset($content_width)) {
	$content_width = 630;
}
if(function_exists('register_nav_menu')) {
	register_nav_menu('main-menu','Main navigation menu across the top of the page.');
}
add_action('admin_menu','sife_admin_menu');
function sife_admin_menu() {
	add_theme_page(__('Theme Options','sife'), __('Theme Options','sife'), 8, 'sife-settings', 'sife_show_settings');
	add_theme_page(__('Slider Settings','sife'), __('Slider Settings','sife'), 8, 'sife-slider', 'sife_slider_settings');
}
function sife_show_settings() {?>
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
		<h2><?php _e('Theme Options','sife');?></h2>
		<?php
		if(isset($_POST['fb_link'])) {
			update_option('sife_fb_link', $_POST['fb_link']);
		}
		if(isset($_POST['tw_link'])) {
			update_option('sife_tw_link', $_POST['tw_link']);
		}
		if(isset($_POST['yt_link'])) {
			update_option('sife_yt_link', $_POST['yt_link']);
		}
		if(isset($_POST) and count($_POST)) {
			echo'<div class="nh_success"><div class="nh_inner">'.__('Theme settings have been saved!','sife').'</div></div>';
		}?>
		<form method="post" name="editsettings" enctype="multipart/form-data">
			<input type="hidden" name="feedaction" value="save" />
			<table class="form-table">
				<tbody>
				<tr valign="top">
					<th scope="row"><label><?php _e('Facebook Link','sife');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="fb_link" value="<?php echo get_option('sife_fb_link');?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Twitter Username','sife');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="tw_link" value="<?php echo get_option('sife_tw_link');?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('YouTube Link','sife');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="yt_link" value="<?php echo get_option('sife_yt_link');?>" />
					</td>
				</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes','sife');?>" />
			</p>
		</form>
	</div>
<?php
}
function sife_slider_settings() {?>
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
		<h2><?php _e('Slider Settings','sife');?></h2>
		<?php
		if(isset($_POST['slimgs']) and is_array($_POST['slimgs'])) {
			$images=implode(',',$_POST['slimgs']);
			update_option('sife_slideshow_arr',$images);
		}
		if(isset($_FILES['new_img']['tmp_name']) and $_FILES['new_img']['tmp_name']) {
			$random=sha1(strtotime('now'));
			$result=wp_upload_bits("sife_".$random.".png", null, sife_make_thumbnail($_FILES['new_img']['tmp_name'],701,350));
			if(isset($result['url'])) {
				$images=get_option('sife_slideshow_arr');
				$images=explode(',',$images);
				$images[]=$result['url'];
				$images=implode(',',$images);
				update_option('sife_slideshow_arr',$images);
			}
		}
		if(isset($_POST) and count($_POST)) {
			echo'<div class="nh_success"><div class="nh_inner">'.__('Theme settings have been saved!','sife').'</div></div>';
		}?>
		<form method="post" name="editsettings" enctype="multipart/form-data">
			<table class="form-table">
				<tbody>
				<tr valign="top">
					<th scope="row"><label><?php _e('Current Images','sife');?></label></th>
					<td>
						<?php
						$images=get_option('sife_slideshow_arr');
						$images=explode(',',$images);
						foreach($images as $img) {
							if(strlen($img)) {
								echo'<div><input type="checkbox" checked="checked" name="slimgs[]" value="'.$img.'" /> <img src="'.$img.'" /></div>';
							}
						}
						?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Add a new image','sife');?></label></th>
					<td>
						<input type="file" id="new_img" name="new_img" />
					</td>
				</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes','sife');?>" />
			</p>
		</form>
	</div>
<?php
}
function sife_make_thumbnail($img_src,$target_width,$target_height) {
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
add_theme_support('automatic-feed-links');
?>