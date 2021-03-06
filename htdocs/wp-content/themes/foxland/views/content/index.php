<?php
/**
 * Content template.
 *
 * @package   Foxland
 */

?>
<main id="main" class="app-main px-2 py-4 mx-auto max-width-xl">
	<?php
	Hybrid\View\display( 'partials', 'archive-header' );

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			Hybrid\View\display( 'entry', Hybrid\Template\hierarchy() );
		endwhile;

		Hybrid\View\display( 'nav/pagination', 'posts' );
	endif;
	?>
</main>
