<?php
/**
 * Displays navigation.
 *
 * @package   Foxland
 */

if ( ! has_nav_menu( $data->name ) ) :
	return;
endif
?>

<nav class="menu menu--<?= esc_attr( $data->name ) ?>" id="js-menu--<?= esc_attr( $data->name ) ?>" aria-label="<?php esc_attr_e( 'Top', 'foxland' ); ?>">
	<button id="menu-toggle" class="menu-toggle" aria-expanded="false">
		<?php
			esc_html_e( 'Menu', 'foxland' );
			echo Foxland\get_svg( [ 'icon' => 'angle-down' ] ); // phpcs:ignore
		?>
	</button>

	<?php
	wp_nav_menu(
		[
			'theme_location' => $data->name,
			'container'      => '',
			'menu_id'        => '',
			'menu_class'     => 'menu__items menu__items--' . esc_attr( $data->name ),
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'item_spacing'   => 'discard',
		]
	);
	?>

</nav>
