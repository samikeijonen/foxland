<?php
/**
 * Theme setup functions.
 *
 * This file holds basic theme setup functions executed on appropriate hooks with
 * some opinionated priorities based on theme dev, particularly working with child
 * theme devs/users, over the years. I've also decided to use anonymous functions
 * to keep these from being easily unhooked. WordPress has an appropriate API for
 * unregistering, removing, or modifying all of the things in this file.  Those APIs
 * should be used instead of attempting to use `remove_action()`.
 *
 * @package   Foxland
 */

namespace Foxland;

/**
 * Set up theme support. This is where calls to `add_theme_support()` happen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action(
	'after_setup_theme',
	function() {
		// Load theme translations.
		// @link https://developer.wordpress.org/reference/functions/load_theme_textdomain/.
		load_theme_textdomain( 'foxland', get_parent_theme_file_path( 'assets/lang' ) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Switch default core markup for search form, comment form, and comments
		// to output valid HTML5.
		add_theme_support(
			'html5',
			[
				'caption',
				'comment-form',
				'comment-list',
				'gallery',
				'search-form',
			]
		);

		// Add title tag support.
		add_theme_support( 'title-tag' );

		// Add selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Post thumbnails support.
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add support for editor color palette.
		 *
		 * Outputted class name are .has-{slug}-background-color and .has-{slug}-color.
		 *
		 * For example .has-main-background-color and .has-main-color.
		 */
		add_theme_support(
			'editor-color-palette',
			[
				[
					'name'  => esc_html__( 'Main', 'foxland' ),
					'slug'  => 'main',
					'color' => 'hsl(182, 40%, 45%)',
				],
				[
					'name'  => esc_html__( 'Dark', 'foxland' ),
					'slug'  => 'dark',
					'color' => 'hsl(182, 82%, 7%)',
				],
				[
					'name'  => esc_html__( 'White', 'foxland' ),
					'slug'  => 'white',
					'color' => 'hsl(0, 0%, 100%)',
				],
				[
					'name'  => esc_html__( 'Light', 'foxland' ),
					'slug'  => 'light',
					'color' => 'hsl(0, 0%, 93%)',
				],
				[
					'name'  => esc_html__( 'Grey', 'foxland' ),
					'slug'  => 'grey',
					'color' => 'hsla(0, 0%, 0%, 0.6)',
				],
			]
		);

		/**
		 * Add support for editor font sizes.
		 *
		 * Outputted class name is .has-{slug}-font-size.
		 *
		 * For example .has-small-font-size.
		 */
		add_theme_support(
			'editor-font-sizes',
			[
				[
					'name' => esc_html__( 'Small', 'foxland' ),
					'size' => 14,
					'slug' => 'small',
				],
				[
					'name' => esc_html__( 'Medium', 'foxland' ),
					'size' => 20,
					'slug' => 'medium',
				],
				[
					'name' => esc_html__( 'Large', 'foxland' ),
					'size' => 24,
					'slug' => 'large',
				],
				[
					'name' => esc_html__( 'Larger', 'foxland' ),
					'size' => 40,
					'slug' => 'larger',
				],
			]
		);

		// Add support for align wide blocks.
		add_theme_support( 'align-wide' );
	},
	5
);

/**
 * Adds support for the custom background feature. This is in its own function
 * hooked to `after_setup_theme` so that we can give it a later priority. This
 * is so that child themes can more easily overwrite this feature. Note that
 * overwriting the background should be done *before* rather than after.
 *
 * @link   https://developer.wordpress.org/reference/functions/add_theme_support/#custom-background
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'custom-background' );
	},
	15
);

/**
 * Register image sizes.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action(
	'init',
	function() {
		// Set the `post-thumbnail` size.
		set_post_thumbnail_size( 960, 540, true );
	},
	5
);

/**
 * Register menus.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_nav_menus/
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action(
	'init',
	function() {

		register_nav_menus(
			[
				'primary' => esc_html_x( 'Primary', 'nav menu location', 'foxland' ),
				'social'  => esc_html_x( 'Social Links', 'nav menu location', 'foxland' ),
			]
		);

	},
	5
);

/**
 * Register image sizes.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action(
	'init',
	function() {
		// Set the `post-thumbnail` size.
		set_post_thumbnail_size( 972, 600, true );
	},
	5
);

/**
 * Register sidebars.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_sidebar/
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action(
	'widgets_init',
	function() {
		$args = [
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title h3 has-white-color">',
			'after_title'   => '</h2>',
		];

		register_sidebar(
			[
				'id'   => 'primary',
				'name' => esc_html_x( 'Primary', 'sidebar', 'foxland' ),
			] + $args
		);
	},
	5
);

/**
 * Registers custom templates with WordPress.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $templates
 * @return void
 */
add_action(
	'hybrid/templates/register',
	function( $templates ) {
		$templates->add(
			'template-entry-no-header.php',
			[
				'label'      => esc_html__( 'No Post Header', 'foxland' ),
				'post_types' => [
					'page',
					'post',
				],
			]
		);
	}
);
