<?php
// ##########  Do not delete these lines
if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
	die ('Please do not load this page directly. Thanks!'); }
if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','surfer'); ?></p>
<?php
	return; }
// ##########  End do not delete section

// Display Comments Section
if ( have_comments() ) : ?>
	<?php if (get_option('mytheme_no_post_tags')=="checked") { ?>
		<h3 id="comments"><?php comments_number('No comments', '1 Comment', '% Comments');?></h3>
		<?php wp_list_comments('type=comment&callback=surfer_comment'); ?>
  	<?php } else { ?>
		<h3 id="comments"><?php comments_number('No comments', '1 Comment', '% Comments');?></h3>
		<?php wp_list_comments('type=comment&callback=surfer_comment'); ?>
  	<?php } ?>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<div class="comment-nav-above">
		<div class="fl"><?php previous_comments_link( __( '&larr; Older Comments','surfer' ) ); ?></div>
		<div class="fr"><?php next_comments_link( __( 'Newer Comments &rarr;','surfer' ) ); ?></div>
	</div>
	<?php endif; // check for comment navigation ?>
	<?php else : // this is displayed if there are no comments so far ?>
	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
	<?php endif; ?>
<?php endif; ?>