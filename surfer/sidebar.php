<div class="widgetsidebar">
	<form action="<?php echo home_url('/');?>" method="get" class="search">
		<input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="SEARCH <?php echo strtoupper(get_bloginfo('name'));?>" /><input type="submit" value="Search" />
	</form>
	<ul>
		<?php dynamic_sidebar('mainsidebar');?>
	</ul>
</div>