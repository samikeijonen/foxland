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

namespace Foxland\Providers;

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
		$this->app->singleton( Customize::class );
		$this->app->singleton( LazyLoad::class );

		// Bind the manifest for cache-busting.
		$this->app->singleton(
			'foxland/manifest',
			function() {

				$file = get_theme_file_path( 'dist/manifest.json' );

				return file_exists( $file ) ? json_decode( file_get_contents( $file ), true ) : null;
			}
		);
	}

	/**
	 * Callback executed after all the service providers have been registered.
	 * This is particularly useful for single-instance container objects that
	 * only need to be loaded once per page and need to be resolved early.
	 *
	 * @since  5.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		// Boot the customizer class instance.
		$this->app->resolve( Customize::class )->boot();
		$this->app->resolve( LazyLoad::class )->boot();
	}
}
