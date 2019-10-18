<?php
if (!isset($content_width)) {
	$content_width = 470;
}
if(function_exists('register_nav_menu')) {
	register_nav_menu('main-menu','Main navigation menu across the top of the page.');
}
if (function_exists('register_sidebar')) {
	register_sidebar();
}
add_theme_support('post-thumbnails');
function custom_excerpt_length($length) {
	return 100;
}
add_filter('excerpt_length','custom_excerpt_length',999);
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
?>