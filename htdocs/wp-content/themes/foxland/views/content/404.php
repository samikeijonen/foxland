<?php
/**
 * 404 template.
 *
 * @package   Foxland
 */

?>
<main id="main" class="app-main py-4">
	<section class="entry entry--error mx-auto max-width-md">
		<header class="entry__header">
			<h1 class="entry__title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'foxland' ); ?></h1>
		</header>

		<div class="entry__content mt-md">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try search?', 'foxland' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</section>
</main>
