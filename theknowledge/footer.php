</div>
<div class="footer">
	<p>&copy; <strong><?php bloginfo('name');?></strong> <?php echo date("Y");?></p>
	<?php wp_nav_menu(array('theme_location'=>'footer-menu','menu_id'=>false, 'menu_class'=>'menu','container'=>false)); ?>
</div>
</div>
<?php wp_footer();?>
</body>
</html>