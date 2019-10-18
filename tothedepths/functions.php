<?php
if (!isset($content_width)) {
	$content_width = 880;
}
if(function_exists('register_nav_menu')) {
	register_nav_menu('main-menu','Main navigation menu.');
}
function custom_excerpt_length($length) {
	return 100;
}
add_filter('excerpt_length','custom_excerpt_length',999);
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
add_action('admin_menu','ttd_admin_menu');
function ttd_admin_menu() {
	add_theme_page(__('Theme Options','ttd'), __('Theme Options','ttd'), 8, 'ttd-settings', 'ttd_show_settings');
}
function ttd_show_settings() {?>
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
		<h2><?php _e('Theme Options','ttd');?></h2>
		<?php
		if(isset($_FILES['mimg']['tmp_name']) and $_FILES['mimg']['tmp_name']) {
			$random=sha1(strtotime('now'));
			$result=wp_upload_bits("ttd_".$random.".png", null, file_get_contents($_FILES['mimg']['tmp_name']));
			if(isset($result['url'])) {
				update_option('ttd_mimg', $result['url']);
			}
		}
		if(isset($_POST['fb_link'])) {
			update_option('ttd_fb_link', $_POST['fb_link']);
		}
		if(isset($_POST['tw_link'])) {
			update_option('ttd_tw_link', $_POST['tw_link']);
		}
		if(isset($_POST['yt_link'])) {
			update_option('ttd_yt_link', $_POST['yt_link']);
		}
		if(isset($_POST['rv_link'])) {
			update_option('ttd_rv_link', $_POST['rv_link']);
		}
		if(isset($_POST) and count($_POST)) {
			echo'<div class="nh_success"><div class="nh_inner">'.__('Theme settings have been saved!','ttd').'</div></div>';
		}?>
		<form method="post" name="editsettings" enctype="multipart/form-data">
			<input type="hidden" name="feedaction" value="save" />
			<table class="form-table">
				<tbody>
				<tr valign="top">
					<th scope="row"><label><?php _e('Main Image','ttd');?></label></th>
					<td>
						<input type="file" id="mimg" name="mimg" />
						<span class="description"><?php _e('The background image','ttd');?></span>
						<div><img src="<? echo get_option('ttd_mimg');?>" /></div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Facebook Link','ttd');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="fb_link" value="<?php echo get_option('ttd_fb_link');?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Twitter Link','ttd');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="tw_link" value="<?php echo get_option('ttd_tw_link');?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('YouTube Link','ttd');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="yt_link" value="<?php echo get_option('ttd_yt_link');?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('ReverbNation Link','ttd');?>:</label></th>
					<td>
						<input type="text" class="regular-text" name="rv_link" value="<?php echo get_option('ttd_rv_link');?>" />
					</td>
				</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes','ttd');?>" />
			</p>
		</form>
	</div>
<?php
}
?>