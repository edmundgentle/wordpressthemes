</div>
</div>
<div class="footer">
<div class="footer_1">
	<p><?php echo nl2br(htmlspecialchars(get_option('rw_address')));?></p>
	<div class="mobile">
		<div class="btn_iTzCzcyfkwpC"><a href="http://maps.apple.com/maps?q=<? echo urlencode(str_replace("\n"," ",get_option('rw_address')));?>">Get Directions</a></div>
	</div>
</div>
<div class="footer_2 nomobile">
	<p><?php echo nl2br(htmlspecialchars(get_option('rw_contact')));?></p>
</div>
<div class="footer_2 mobile">
	<div class="btn_iTzCzcyfkwpC"><a href="tel:<?php echo get_option('rw_phone');?>">Call Us Now</a></div>
</div>
<div class="footer_3">
	<p>&copy; <strong><?php echo get_bloginfo('name');?></strong> <?php echo date("Y");?></p>
</div>
</div>
<?php wp_footer();?>
</body>
</html>