<?php
/**
 * Minimalio Child – functions.
 *
 * Add your own PHP at the bottom of this file, below "Custom code".
 *
 * @package minimalio-child
 */

defined( 'ABSPATH' ) || exit;

/**
 * Version string for a file in this theme: its last-modified time.
 * When the file changes, the URL changes, so browsers and caches
 * (including WordPress.com's) load the new version straight away.
 *
 * @param string $file Path relative to the child theme folder.
 * @return string
 */
function minimalio_child_asset_version( $file ) {
	$path = get_stylesheet_directory() . '/' . $file;
	return file_exists( $path ) ? (string) filemtime( $path ) : wp_get_theme()->get( 'Version' );
}

/**
 * Does a CSS file contain anything besides comments?
 * style.css usually holds only the theme header, so it isn't loaded then.
 *
 * @param string $file Path relative to the child theme folder.
 * @return bool
 */
function minimalio_child_has_css( $file ) {
	$path = get_stylesheet_directory() . '/' . $file;
	if ( ! is_readable( $path ) ) {
		return false;
	}
	$css = preg_replace( '#/\*.*?\*/#s', '', (string) file_get_contents( $path ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	return '' !== trim( $css );
}

/**
 * Child styles and scripts. Minimalio loads its own CSS and JavaScript itself;
 * these load after it, so custom CSS here wins.
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		// Minimalio loads this theme's style.css itself (handle "minimalio-child-style"),
		// with WordPress's version number. Replace it with a cache-safe version,
		// and skip it entirely when it holds only the theme header.
		wp_dequeue_style( 'minimalio-child-style' );
		wp_deregister_style( 'minimalio-child-style' );
		if ( minimalio_child_has_css( 'style.css' ) ) {
			wp_enqueue_style( 'minimalio-child-style', get_stylesheet_uri(), [], minimalio_child_asset_version( 'style.css' ) );
		}

		if ( minimalio_child_has_css( 'assets/child-styles.css' ) ) {
			wp_enqueue_style( 'minimalio-child-custom', get_stylesheet_directory_uri() . '/assets/child-styles.css', [], minimalio_child_asset_version( 'assets/child-styles.css' ) );
		}

		wp_enqueue_script(
			'minimalio-child-script',
			get_stylesheet_directory_uri() . '/assets/child-script.js',
			[],
			minimalio_child_asset_version( 'assets/child-script.js' ),
			[ 'in_footer' => true, 'strategy' => 'defer' ]
		);
	},
	99
);

/*
 * ---------------------------------------------------------------------------
 * Custom code
 * ---------------------------------------------------------------------------
 * Add your own PHP below. Give functions a unique prefix (for example
 * "minimalio_child_") so they don't clash with plugins.
 */
