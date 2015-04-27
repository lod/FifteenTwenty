<?php
/**
 * Partial for showing the navigation elements for image attachments
 */

the_post_navigation( array(
	'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'fifteentwenty' ),
) );
?>
