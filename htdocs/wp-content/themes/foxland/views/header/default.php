<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package   Foxland
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<?php wp_head(); ?>
</head>

<body <?php Hybrid\Attr\display( 'body' ); ?>>
<?php wp_body_open() ?>

<div class="app mx-auto max-width-full">
	<header class="app-header px-2 py-4">
		<div class="app-header__wrapper mx-auto max-width-xl">
			<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'foxland' ); ?></a>

			<div class="app-header__branding">
			<?php
				Foxland\site_title();
				Foxland\site_description();
			?>
			</div>

			<?php Hybrid\View\display( 'nav/menu', 'primary', [ 'name' => 'primary' ] ); ?>
		</div>
	</header>
