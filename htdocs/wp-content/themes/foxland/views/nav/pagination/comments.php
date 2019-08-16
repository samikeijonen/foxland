<?php
/**
 * Comments pagination.
 *
 * @package   Foxland
 */

Hybrid\Pagination\display(
	'comments',
	[
		'prev_text'          => Foxland\get_svg( [ 'icon' => 'arrow-left' ] ) . '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'foxland' ) . '</span>',
		'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'foxland' ) . '</span>' . Foxland\get_svg( [ 'icon' => 'arrow-right' ] ),
		'before_page_number' => '<span class="screen-reader-text">' . esc_html__( 'Page', 'foxland' ) . ' </span>',
	]
);
