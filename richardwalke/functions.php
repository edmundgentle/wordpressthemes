<?php
if (!isset($content_width)) {
	$content_width = 700;
}
if(function_exists('register_nav_menu')) {
	register_nav_menu('main-menu','Main navigation menu across the top of the page.');
}
function custom_excerpt_length($length) {
	return 500;
}
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_length','custom_excerpt_length',999);
add_filter('excerpt_more', 'new_excerpt_more');
add_action('admin_menu','richardwalke_admin_menu');
function richardwalke_admin_menu() {
	add_theme_page(__('Theme Options','richardwalke'), __('Theme Options','richardwalke'), 8, 'rw-settings', 'rw_show_settings');
}
function rw_show_settings() {?>
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
		<h2><?php _e('Theme Options','richardwalke');?></h2>
		<?php
		if(isset($_POST['slimgs']) and is_array($_POST['slimgs'])) {
			$images=implode(',',$_POST['slimgs']);
			update_option('rw_slideshow_arr',$images);
		}
		if(isset($_FILES['new_img']['tmp_name']) and $_FILES['new_img']['tmp_name']) {
			$random=sha1(strtotime('now'));
			$result=wp_upload_bits("rw_".$random.".png", null, rw_make_thumbnail($_FILES['new_img']['tmp_name'],1280,450));
			if(isset($result['url'])) {
				$images=get_option('rw_slideshow_arr');
				$images=explode(',',$images);
				$images[]=$result['url'];
				$images=implode(',',$images);
				update_option('rw_slideshow_arr',$images);
			}
		}
		if(isset($_POST['address'])) {
			update_option('rw_address', stripslashes($_POST['address']));
		}
		if(isset($_POST['contact'])) {
			update_option('rw_contact', stripslashes($_POST['contact']));
		}
		if(isset($_POST['phone'])) {
			update_option('rw_phone', stripslashes($_POST['phone']));
		}
		if(isset($_POST) and count($_POST)) {
			echo'<div class="nh_success"><div class="nh_inner">'.__('Theme settings have been saved!','richardwalke').'</div></div>';
		}?>
		<form method="post" enctype="multipart/form-data">
			<table class="form-table">
				<tbody>
				<tr valign="top">
					<th scope="row"><label><?php _e('Address to display','richardwalke');?>:</label></th>
					<td>
						<textarea rows="5" cols="50" name="address" class="large-text code"><?php echo get_option('rw_address');?></textarea>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Contact information','richardwalke');?>:</label></th>
					<td>
						<textarea rows="5" cols="50" name="contact" class="large-text code"><?php echo get_option('rw_contact');?></textarea>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Default phone number','richardwalke');?>:</label></th>
					<td>
						<input type="text" name="phone" value="<?php echo get_option('rw_phone');?>">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Current Images','richardwalke');?></label></th>
					<td>
						<?php
						$images=get_option('rw_slideshow_arr');
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
					<th scope="row"><label><?php _e('Add a new image','richardwalke');?></label></th>
					<td>
						<input type="file" id="new_img" name="new_img" />
					</td>
				</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes','richardwalke');?>" />
			</p>
		</form>
	</div>
<?php
}
//widgets
class widget_knowledge_latest extends WP_Widget {
	function widget_knowledge_latest() {
		parent::WP_Widget(false, $name = 'The Knowledge Latest Articles');
    }
    function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title='';
		echo'<h2>Latest Articles</h2>
			<ul class="article_list">';
			query_posts('posts_per_page=5');
			while (have_posts()) {
				the_post();
				$cat=array('','');
				$categories = get_the_category();
				if(isset($categories[0])) {
					$cat=array($categories[0]->cat_name, 'category_'.$categories[0]->slug);
				}
				echo"<li class=\"".$cat[1]."\">
					<a href=\"".get_permalink()."\">
						<span class=\"title\">".get_the_title()."</span>
						<span class=\"info\"><span class=\"category\">".$cat[0]."</span> ".get_the_time('jS F')."</span>
					</a>
				</li>";
			}
			wp_reset_query();
			echo'
		</ul>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		return $instance;
	}
}
function rw_make_thumbnail($img_src,$target_width,$target_height) {
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
add_theme_support('custom-fields');
update_option('thumbnail_size_w', 200);
update_option('thumbnail_size_h', 300);
update_option('thumbnail_crop', 0);
update_option('medium_size_w', 450);
update_option('medium_size_h', 400);
update_option('medium_crop', 0);
update_option('large_size_w', 700);
update_option('large_size_h', 500);
update_option('medium_crop', 0);
?>