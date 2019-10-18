<?php
if (!isset($content_width)) {
	$content_width = 750;
}
if(function_exists('register_nav_menu')) {
	register_nav_menu('main-menu','Main navigation menu across the top of the page.');
}
add_theme_support('post-thumbnails');
function custom_excerpt_length($length) {
	return 35;
}
add_filter('excerpt_length','custom_excerpt_length',999);
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
add_theme_support('automatic-feed-links');


update_option( 'medium_size_w', 230 );
update_option( 'medium_size_h', 200 );
update_option( 'medium_crop', 1 );

update_option( 'thumbnail_size_w', 160 );
update_option( 'thumbnail_size_h', 160 );
update_option( 'thumbnail_crop', 1 );

update_option( 'large_size_w', 730 );
update_option( 'large_size_h', 600 );
update_option( 'large_crop', 0 );

add_image_size( 'header', 750, 400, 1 );

add_image_size( 'blogthumb', 360,175, true );
?>