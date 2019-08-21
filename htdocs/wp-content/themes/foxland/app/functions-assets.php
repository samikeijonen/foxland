<?php
/**
 * Styles and scripts related functions, hooks, and filters.
 *
 * @package   Foxland
 */

namespace Foxland;

use Hybrid\App;

/**
 * Add critical styles to the header.
 *
 * @since 1.0.0
 */
add_action(
	'wp_head',
	function() {
		$critical_styles = file_get_contents( get_parent_theme_file_path( 'dist/css/critical.css' ) );

		echo '<style>' . $critical_styles . '</style>';
	},
	0
);

/**
 * Enqueue scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		// Main scripts.
		wp_enqueue_script( 'foxland-app', asset( 'js/app.js' ), null, null, true );

		// Main styles.
		wp_enqueue_style( 'foxland-style', asset( 'css/style.css' ), null, null );

		// Comment script.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Dequeue Core block styles.
		wp_dequeue_style( 'wp-block-library' );
	},
	10
);

/**
 * Set the media property for the default theme styles to all.
 *
 * By default loading the styles blocks rendering. By setting the media type to
 * print, and then changing the media type when loading completes, we ensure the
 * main stylesheet loads asynchronously.
 *
 * @see https://www.filamentgroup.com/lab/load-css-simpler/
 */
function async_style_loading( $html, $handle ) {
	if ( 'foxland-style' === $handle ) {
		// Replace the media all with media print, and add an onload handler to switch it back.
		$print_html = str_replace( "media='all'", "media='print' onload='this.media=\"all\"'", $html );

		// Wrap the original link in a noscript tag for users who don't have js enabled.
		$html = $print_html . '<noscript>' . $html . '</noscript>';
	}

	return $html;
}
add_filter( 'style_loader_tag', __NAMESPACE__ . '\async_style_loading', 10, 2 );

/**
 * Enqueue editor scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action(
	'enqueue_block_editor_assets',
	function() {
		// Editor styles.
		wp_enqueue_style( 'foxland-editor', asset( 'css/editor.css' ), null, null );

		// Editor scripts.
		wp_enqueue_script(
			'foxland-editor-scripts',
			asset( 'js/editorScripts.js' ),
			[
				'wp-i18n',
				'wp-blocks',
				'wp-dom-ready',
				'wp-edit-post',
				'wp-editor',
				'wp-element',
				'wp-components',
			],
			null,
			true
		);
	},
	10
);

/**
 * Enqueue editor and front-end scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action(
	'enqueue_block_assets',
	function() {
		// Overwrite Core block styles with empty styles.
		wp_deregister_style( 'wp-block-library' );
		wp_register_style( 'wp-block-library', '' );

		// Overwrite Core theme styles with empty styles.
		wp_deregister_style( 'wp-block-library-theme' );
		wp_register_style( 'wp-block-library-theme', '' );
	},
	10
);

/**
 * Helper function for outputting an asset URL in the theme. This integrates
 * with Laravel Mix for handling cache busting. If used when you enqueue a script
 * or style, it'll append an ID to the file name.
 *
 * @link   https://laravel.com/docs/5.6/mix#versioning-and-cache-busting
 * @since  1.0.0
 * @access public
 * @param  string $path Path to asset.
 * @return string
 */
function asset( $path ) {
	// Get the manifest.
	$manifest = App::resolve( 'foxland/manifest' );

	if ( $manifest && isset( $manifest[ $path ] ) ) {
		$path = $manifest[ $path ];
	}

	return get_theme_file_uri( 'dist/' . $path );
}

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since 1.0.0
 */
add_action(
	'wp_head',
	function() {
		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
	},
	0
);
