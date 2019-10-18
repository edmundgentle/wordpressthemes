</div>
<div id="footer">
	<p class="copyright">&copy; <?php bloginfo('name');?>. All Rights Reserved.</p>
	<ul class="social">
		<?php if(get_option('ttd_fb_link')!='') {?><li class="fb"><a href="<?php echo get_option('ttd_fb_link');?>" target="_blank">Facebook</a></li><?php }?>
		<?php if(get_option('ttd_tw_link')!='') {?><li class="tw"><a href="<?php echo get_option('ttd_tw_link');?>" target="_blank">Twitter</a></li><?php }?>
		<?php if(get_option('ttd_yt_link')!='') {?><li class="yt"><a href="<?php echo get_option('ttd_yt_link');?>" target="_blank">YouTube</a></li><?php }?>
		<?php if(get_option('ttd_rv_link')!='') {?><li class="st"><a href="<?php echo get_option('ttd_rv_link');?>" target="_blank">ReverbNation</a></li><?php }?>
	</ul>
</div>
<div class="clear"></div>
</div>
<?php wp_footer();?>
</body>
</html>