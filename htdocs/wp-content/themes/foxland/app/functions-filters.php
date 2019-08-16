<?php
/**
 * Filter functions.
 *
 * This file holds functions that are used for filtering.
 *
 * @package   Foxland
 */

namespace Foxland;

use function Foxland\get_svg;

/**
 * Filters the WP nav menu link attributes.
 *
 * @param array    $atts {
 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
 *
 *     @type string $title  Title attribute.
 *     @type string $target Target attribute.
 *     @type string $rel    The rel attribute.
 *     @type string $href   The href attribute.
 * }
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return string  $attr
 */
add_filter(
	'nav_menu_link_attributes',
	function( $atts, $item, $args, $depth ) {
		$atts['class'] = 'menu__anchor menu__anchor--' . $args->theme_location;

		if ( in_array( 'current-menu-item', $item->classes, true ) ) {
			$atts['class'] .= ' is-active';
		}

		if ( in_array( 'button', $item->classes, true ) ) {
			$atts['class'] .= ' menu__anchor--button';
		}

		return $atts;
	},
	10,
	4
);

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="continue-reading"><a href="%1$s" class="continue-reading__link underline-link" aria-hidden="true" tabindex="-1">%2$s %3$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'foxland' ), get_the_title( get_the_ID() ) ),
		get_svg( [ 'icon' => 'arrow-next' ] )
	);

	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', __NAMESPACE__ . '\excerpt_more' );

/**
 * Changes the theme template path to the `public/views` folder.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
add_filter(
	'hybrid/template/path',
	function() {
		return 'views';
	}
);

/**
 * Add quote icon to blockquote.
 *
 * @param  string $block_content The block content about to be appended.
 * @param  array  $block         The full block, including name and attributes.
 * @return string $block_content Modified block content.
 */
function render_block( $block_content, $block ) {
	if ( 'core/quote' === $block['blockName'] ) {
		$block_content = str_replace( '</blockquote>', get_svg( [ 'icon' => 'quotes-left' ] ) . '</blockquote>', $block_content );
	}

	return $block_content;
}
add_filter( 'render_block', __NAMESPACE__ . '\render_block', 10, 2 );
