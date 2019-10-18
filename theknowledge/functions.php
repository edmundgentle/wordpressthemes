<?php
if (!isset($content_width)) {
	$content_width = 505;
}
$hidden_cats=split("(\n|\r)",trim(get_option('knowledge_hidden_cats')));
if(is_null($hidden_cats)) {
	$hidden_cats=array();
}
if(function_exists('register_nav_menu')) {
	register_nav_menu('main-menu','Main navigation menu across the top of the page.');
	register_nav_menu('footer-menu','Footer links at bottom of the page.');
}
if ( function_exists('register_sidebar') ) {
	register_sidebar();
}
add_theme_support('post-thumbnails');
function custom_excerpt_length($length) {
	return 30;
}
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_length','custom_excerpt_length',999);
add_filter('excerpt_more', 'new_excerpt_more');
add_action('admin_menu','theknowledge_admin_menu');
function theknowledge_admin_menu() {
	add_theme_page(__('Theme Options','theknowledge'), __('Theme Options','theknowledge'), 8, 'knowledge-settings', 'knowledge_show_settings');
}
function knowledge_show_settings() {?>
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
		<h2><?php _e('Theme Options','theknowledge');?></h2>
		<?php
		if(isset($_POST['colorscheme'])) {
			update_option('knowledge_cat_colors', stripslashes($_POST['colorscheme']));
		}
		if(isset($_POST['hpcats'])) {
			update_option('knowledge_hp_cats', stripslashes($_POST['hpcats']));
		}
		if(isset($_POST['hiddencats'])) {
			update_option('knowledge_hidden_cats', stripslashes($_POST['hiddencats']));
		}
		if(isset($_POST) and count($_POST)) {
			echo'<div class="nh_success"><div class="nh_inner">'.__('Theme settings have been saved!','theknowledge').'</div></div>';
		}?>
		<form method="post">
			<table class="form-table">
				<tbody>
				<tr valign="top">
					<th scope="row"><label><?php _e('Colours of categories','theknowledge');?>:</label></th>
					<td>
						<textarea rows="10" cols="50" name="colorscheme" class="large-text code"><?php echo get_option('knowledge_cat_colors');?></textarea>
						<em>The above is a map of category slugs to hexadecimal colours. For example, if a slug is "news" and the colour is "FF0000" then you would enter "news::FF0000". Each category must be on a new line.</em>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Homepage categories','theknowledge');?>:</label></th>
					<td>
						<textarea rows="10" cols="50" name="hpcats" class="large-text code"><?php echo get_option('knowledge_hp_cats');?></textarea>
						<em>A list of category slugs, each on a new line.</em>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Hidden categories','theknowledge');?>:</label></th>
					<td>
						<textarea rows="10" cols="50" name="hiddencats" class="large-text code"><?php echo get_option('knowledge_hidden_cats');?></textarea>
						<em>A list of category slugs, each on a new line.</em>
					</td>
				</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes','theknowledge');?>" />
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
add_action('widgets_init', create_function('', 'return register_widget("widget_knowledge_latest");'));
add_theme_support('automatic-feed-links');
add_theme_support('custom-fields');
set_post_thumbnail_size(200,140,true);
add_image_size('hpslider', 690, 285,true);
add_image_size('hpblox', 335, 120,true);
update_option('thumbnail_size_w', 200);
update_option('thumbnail_size_h', 400);
update_option('thumbnail_crop', 0);
update_option('medium_size_w', 230);
update_option('medium_size_h', 400);
update_option('medium_crop', 0);
update_option('large_size_w', 505);
update_option('large_size_h', 505);
update_option('medium_crop', 0);
function knowledge_add_editor_styles() {
    add_editor_style('editor-style.css');
}
add_action( 'init', 'knowledge_add_editor_styles' );
?>