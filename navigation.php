<?php
/**
 * Partial for showing the default navigation elements
 */

if (is_single()) {
	the_post_navigation( array(
		'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'fifteentwenty' ) . '</span> ' .
			'<span class="screen-reader-text">' . __( 'Next post:', 'fifteentwenty' ) . '</span> ' .
			'<span class="post-title">%title</span>',
		'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'fifteentwenty' ) . '</span> ' .
			'<span class="screen-reader-text">' . __( 'Previous post:', 'fifteentwenty' ) . '</span> ' .
			'<span class="post-title">%title</span>',
	) );
} else {
	the_posts_pagination( array(
		'prev_text'          => __( 'Previous page', 'fifteentwenty' ),
		'next_text'          => __( 'Next page', 'fifteentwenty' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'fifteentwenty' ) . ' </span>',
	) );
}
?>
