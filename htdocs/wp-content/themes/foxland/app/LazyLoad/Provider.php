<?php
/**
 * LazyLoad service provider.
 *
 * Bootstraps the Lazy loading images component.
 *
 * @package   Foxland
 */

namespace Foxland\LazyLoad;

use Hybrid\Tools\ServiceProvider;

/**
 * LazyLoad service provider class.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {
	/**
	 * Binds query component to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {
		$this->app->singleton( Component::class );
	}

	/**
	 * Bootstrap the query component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->app->resolve( Component::class )->boot();
	}
}
