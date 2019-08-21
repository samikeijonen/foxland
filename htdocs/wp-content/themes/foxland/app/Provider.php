<?php
/**
 * App service provider.
 *
 * Service providers are essentially the bootstrapping code for your theme.
 * They allow you to add bindings to the container on registration and boot them
 * once everything has been registered.
 *
 * @package   Foxland
 */

namespace Foxland;

use Hybrid\Tools\ServiceProvider;
use Foxland\Customize\Customize;

/**
 * App service provider.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Callback executed when the `\Hybrid\Core\Application` class registers
	 * providers. Use this method to bind items to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {
		// Bind the manifest for cache-busting.
		$this->app->singleton(
			'foxland/manifest',
			function() {

				$file = get_theme_file_path( 'dist/manifest.json' );

				return file_exists( $file ) ? json_decode( file_get_contents( $file ), true ) : null;
			}
		);
	}
}
