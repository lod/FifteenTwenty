<?php
/**
 * The partial for displaying 404 pages (not found)
 */
?>
<section class="error-404 not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'fifteentwenty' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'fifteentwenty' ); ?></p>

		<?php get_search_form(); ?>
	</div><!-- .page-content -->
</section><!-- .error-404 -->
