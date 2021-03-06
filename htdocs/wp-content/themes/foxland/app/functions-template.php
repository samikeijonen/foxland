<?php
/**
 * Template functions.
 *
 * This file holds functions related to templates.
 *
 * @package   Foxland
 */

namespace Foxland;

/**
 * Returns the metadata separator.
 *
 * @since  1.0.0
 * @access public
 * @param  string $sep Separator for metadata.
 * @return string
 */
function sep( $sep = '' ) {

	return apply_filters(
		'foxland/sep',
		sprintf(
			' <span class="sep">%s</span> ',
			$sep ?: esc_html_x( '&#x2015;', 'meta separator', 'foxland' )
		)
	);
}

/**
 * The site title markup.
 *
 * @since  1.0.0
 * @access public
 */
function site_title() {
	if ( is_front_page() && is_home() ) :
		?>
		<h1 class="app-header__title mb-0 h3 font-serif fw-700"><a class="decoration-none has-dark-color" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php else : ?>
		<p class="app-header__title mb-0 h3 font-serif fw-700"><a class="decoration-none has-dark-color" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php
	endif;
}

/**
 * The site description markup.
 *
 * @since  1.0.0
 * @access public
 */
function site_description() {
	$description = get_bloginfo( 'description', 'display' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound

	if ( $description || is_customize_preview() ) :
		?>
			<p class="app-header__description has-grey-colorfont-size-1 mb-0"><?php echo $description; // phpcs:ignore WordPress.XSS.EscapeOutput ?></p>
		<?php
	endif;
}
