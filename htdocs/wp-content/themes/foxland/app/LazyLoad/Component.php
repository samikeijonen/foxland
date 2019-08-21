<?php
/**
 * LazyLoad class.
 *
 * Lazy load images in native way.
 *
 * @package   Foxland
 */

namespace Foxland\LazyLoad;

use WP_Customize_Manager;
use Hybrid\Contracts\Bootable;

/**
 * Handles setting up everything we need for the lazy load.
 *
 * @link   https://web.dev/native-lazy-loading
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Adds actions on the appropriate action hooks.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		// Add new attribute.
		add_filter( 'the_content', [ $this, 'media_lazyload_attributes' ], PHP_INT_MAX );
		add_filter( 'wp_get_attachment_image_attributes', [ $this, 'attachment_lazyload_attributes' ], PHP_INT_MAX );
	}

	/**
	 * Add loading="lazy" attribute to content with "src", images and iframes.
	 *
	 * @param string $content Content of the current post.
	 * @return string The updated content with lazy load attributes.
	 */
	public function media_lazyload_attributes( $content ) {
		$content = preg_replace(
			'/src="/',
			'loading="lazy" src="',
			$content
		);

		return $content;
	}

	/**
	 * Add loading="lazy" attribute to attachments.
	 *
	 * @param array $attributes Attributes of the current <img> element.
	 * @return array The updated image attributes array with lazy load attributes.
	 */
	public function attachment_lazyload_attributes( array $attributes ) {
		if ( empty( $attributes['src'] ) ) {
			return $attributes;
		}

		if ( ! array_key_exists( 'loading', $attributes ) ) {
			$attributes['loading'] = 'lazy';
		}

		return $attributes;
	}
}
