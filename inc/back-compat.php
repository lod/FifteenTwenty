<?php
/**
 * Fifteen Twenty back compat functionality
 *
 * Prevents Fifteen Twenty from running on WordPress versions prior to 4.1,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.1.
 */

/**
 * Prevent switching to Fifteen Twenty on old versions of WordPress.
 *
 * Switches to the default theme.
 */
function fifteentwenty_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'fifteentwenty_upgrade_notice' );
}
add_action( 'after_switch_theme', 'fifteentwenty_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Fifteen Twenty on WordPress versions prior to 4.1.
 */
function fifteentwenty_upgrade_notice() {
	$message = sprintf( __( 'Fifteen Twenty requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'fifteentwenty' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.1.
 */
function fifteentwenty_customize() {
	wp_die( sprintf( __( 'Fifteen Twenty requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'fifteentwenty' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'fifteentwenty_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.1.
 */
function fifteentwenty_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Fifteen Twenty requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'fifteentwenty' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'fifteentwenty_preview' );
