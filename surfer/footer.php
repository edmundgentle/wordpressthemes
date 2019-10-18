</div>
<div id="footer">
	<?php wp_nav_menu(array('theme_location'=>'footer-menu','menu_id'=>'footer-menu')); ?>
	<div id="copyright">&copy; <?php bloginfo('name');?> <?php echo date("Y");?>. All Rights Reserved. </div>
</div>
</div>
<?php echo get_option('surfer_ga_code');?>
<?php wp_footer();?>
</body>
</html>