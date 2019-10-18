<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
		<title><?php
			global $page, $paged;
			wp_title('|',true,'right');
			bloginfo('name');
			$site_description=get_bloginfo('description','display');
			if($site_description and (is_home() || is_front_page())) {
				echo " $site_description";
			}
			if($paged>=2 or $page>=2) {
				echo ' | '.sprintf(__('Page %s'),max($paged,$page));
			}
			?></title>
		<link href="http://fonts.googleapis.com/css?family=Happy+Monkey" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
		<?php wp_head();?>
	</head>
	<body>
		<div id="header">
			<h1><a href="<?php echo home_url();?>"><?php bloginfo('name');?></a></h1>
			<h3><?php echo bloginfo('description');?></h3>
		</div>
		<div id="main">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="article">
					<?php
					$format = get_post_format();
					if($format=='video') {
						$parsedUrl  = parse_url(get_the_content());  
						$embed      = $parsedUrl['query'];  
						parse_str($embed, $out);  
						$embedUrl   = $out['v'];  
						?>
						<h3><?php the_title();?></h3>
						<div align="center"><iframe width="860" height="483.75" src="https://www.youtube.com/embed/<?php echo $embedUrl;?>?feature=player_embedded&fs=1&modestbranding=1&theme=light" frameborder="0" allowfullscreen></iframe></div>
					<?php }elseif($format=='quote') {?>
						<p class="quote"><?php the_title();?></p>
						<p class="quote_credit"><?php the_content();?></p>
					<?php }else{?>
						<h3><?php the_title();?></h3>
						<?php the_content();?>
					<?php }?>
					<div class="share">
						Spread the love: <div class="facebook"><a href="https://www.facebook.com/dialog/send?name=<?php echo urlencode(get_the_title());?>&link=<?php echo urlencode(get_permalink());?>&redirect_uri=<?php echo urlencode(get_permalink());?>" onclick="fb_share(<? echo json_encode(get_the_title());?>,<? echo json_encode(get_permalink());?>);return false;">Facebook</a></div> <div class="twitter"><a href="https://twitter.com/intent/tweet?text=<?php echo urlencode('Reading the article '.get_the_title());?>&url=<?php echo urlencode(get_permalink());?>">Twitter</a></div> <div class="googleplus"><a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink());?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Google+</a></div>
					</div>
				</div>
			 <?php endwhile; endif; ?>
			<?php
			global $wp_query;
			$total_pages=$wp_query->max_num_pages;
			$current_page=max(1,get_query_var('paged'));
			if($total_pages>1) {
			  echo paginate_links(array(
			      'base' => get_pagenum_link(1) . '%_%',
			      'format' => '/page/%#%',
			      'current' => $current_page,
			      'total' => $total_pages,
					'before'=>'<p>'
				));
			}
			?>
			<div id="footer">
				Made by <a href="http://www.edmundgentle.com" target="_blank">Edmund Gentle</a> · Buttons by <a href="http://www.css3buttonbox.com" target="_blank">CSS3 Button Box</a>
			</div>
		</div>
		<script>
		function fb_share(title,permalink) {
			FB.ui({
				method: 'send',
				name: title,
				link: permalink
			});
		}
		window.fbAsyncInit = function() {
		FB.init({appId: "259118590857695"});
		};
		</script>
	<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
	<script>
		(function(d){
			var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement('script'); js.id = id; js.async = true;
			js.src = "//connect.facebook.net/en_US/all.js";
			ref.parentNode.insertBefore(js, ref);
		}(document));
	</script>
	</body>
</html>