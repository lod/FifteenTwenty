<?php
/**
 * The partial for displaying image post formats
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<nav id="image-navigation" class="navigation image-navigation">
		<div class="nav-links">
			<div class="nav-previous"><?php previous_image_link( false, __( 'Previous Image', 'fifteentwenty' ) ); ?></div><div class="nav-next"><?php next_image_link( false, __( 'Next Image', 'fifteentwenty' ) ); ?></div>
		</div><!-- .nav-links -->
	</nav><!-- .image-navigation -->

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="entry-attachment">
		<?php
			$image_size = apply_filters( 'fifteentwenty_attachment_size', 'large' );
			echo wp_get_attachment_image( get_the_ID(), $image_size );

			if ( has_excerpt() ) {
				echo '<div class="entry-caption">';
				the_excerpt();
				echo '</div><!-- .entry-caption -->';
			}
		?>
		</div><!-- .entry-attachment -->

		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'fifteentwenty' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'fifteentwenty' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php fifteentwenty_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'fifteentwenty' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
