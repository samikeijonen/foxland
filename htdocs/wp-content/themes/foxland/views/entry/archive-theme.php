<?php
/**
 * Archive template.
 *
 * @package   Foxland
 */

?>
<article <?php Hybrid\Attr\display( 'entry', 'archive' ); ?>>
	<header class="entry__header">
		<h2 class="entry__title"><a class="decoration-none h-decoration-underline color-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>

	<div class="entry__summary mt-sm">
		<?php the_excerpt(); ?>
	</div>
</article>
