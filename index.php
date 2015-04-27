<?php
/**
 * The only template for displaying the website
 *
 * The traditional WordPress template structure has been inverted.
 * Rather than WordPress choosing a template based on the content type we
 * have a single template which dictates the style and structure of the site.
 * We use partials to keep everything neat and structured but the partials
 * supply content to the this template rather than the standard WordPress
 * method of multiple templates pulling in common elements such as get_header()
 *
 * The advantage of this revised layout is that changes to the site structure
 * are much easier. The initial motivation was a desire to reorder the sidebar
 * and content divs in a theme, this change required modifying every php file.
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'fifteentwenty' ); ?></a>

	<div id="sidebar" class="sidebar">
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				<?php
					$title_text = '<a href="'.esc_url(home_url('/')).'" rel="home">'.get_bloginfo('name', 'display').'</a>';
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><?php echo $title_text ?></h1>
					<?php else : ?>
						<p class="site-title"><?php echo $title_text ?></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description ?></p>
					<?php endif; ?>
				<button class="secondary-toggle"><?php _e( 'Menu and widgets', 'fifteentwenty' ); ?></button>
			</div><!-- .site-branding -->
		</header><!-- .site-header -->

		<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) || is_active_sidebar( 'sidebar-1' )  ) : ?>
		<div id="secondary" class="secondary">

			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php
						// Primary navigation menu.
						wp_nav_menu( array(
							'menu_class'     => 'nav-menu',
							'theme_location' => 'primary',
						) );
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav id="social-navigation" class="social-navigation" role="navigation">
					<?php
						// Social links navigation menu.
						wp_nav_menu( array(
							'theme_location' => 'social',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
						) );
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
				<div id="widget-area" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div><!-- .widget-area -->
			<?php endif; ?>

		</div><!-- .secondary -->
		<?php endif; ?>

	</div><!-- .sidebar -->

	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
				// Default index portion
				if ( have_posts() ) {
					if ( is_home() && ! is_front_page() )
						get_template_part( 'heading', 'static_homepage' );
					elseif ( is_search() )
						get_template_part( 'heading', 'search' );
					elseif ( is_archive() )
						get_template_part( 'heading', 'archive' );

					// Start the loop.
					while ( have_posts() ) {
						the_post();

						/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						$format = get_post_format();
						if(is_page())   $format = 'page';
						if(is_search()) $format = 'search';

						if(is_single() && is_attachment()) {
							// Template based on the first portion of mime, image/jpeg -> content-image.php
							// Tack on tail to avoid overlap with get_post_format() formats
							$format = explode("/", get_post_mime_type(), 2)[0]."_attachment";
							// Don't want prepend_attachment on single pages, this mimics template-loader.php
							remove_filter('the_content', 'prepend_attachment');
						}

						get_template_part( 'content', $format );

						// Display comments partial if appropriate
						if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) ) :
							comments_template();
						endif;

					} // have_posts()

					// Previous/next page navigation.
					get_template_part( 'navigation', $format );
			} else {
				// If no content, include the "No posts found" or 404 partial.
				get_template_part( 'content', is_404() ? '404' : 'none' );
			} // have_posts()
			?>

			</main><!-- .site-main -->
		</div><!-- .content-area -->
	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php
				// Fires before the footer text for footer customization.
				do_action( 'fifteentwenty_credits' );
			?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'fifteentwenty' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'fifteentwenty' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
