<?php
/**
 * Archive header.
 *
 * @package   Foxland
 */

if ( ! is_front_page() ) : ?>

	<div class="archive-header mx-auto max-width-md pb-8 text-center">
		<?php
			the_archive_title( '<h1 class="archive-header__title">', '</h1>' );
			the_archive_description( '<div class="archive-header__description">', '</div>' );
		?>
	</div>

	<?php
endif;
