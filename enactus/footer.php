<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div id="footer">
<div class="left">&copy; Enactus Plymouth <?php echo date("Y");?> - <a href="/contact-us/">Contact Us</a> - Website by <a href="http://www.edmundgentle.com" target="_blank">Edmund Gentle</a></div>
<ul class="social">
<?php if(get_option('enactus_fb_link')!='') {?><li class="fb"><a href="<?php echo get_option('enactus_fb_link');?>" target="_blank">Enactus Plymouth on Facebook</a></li><?php }?>
<?php if(get_option('enactus_tw_link')!='') {?><li class="tw"><a href="<?php echo get_option('enactus_tw_link');?>" target="_blank">Enactus Plymouth on Twitter</a></li><?php }?>
<?php if(get_option('enactus_li_link')!='') {?><li class="li"><a href="<?php echo get_option('enactus_li_link');?>" target="_blank">Enactus Plymouth on LinkedIn</a></li><?php }?>
</ul>
<div class="clear"></div>
</div>
</div>
<?php wp_footer();?>
</body>
</html>