<?php
/**
 * Post content template.
 *
 * @package   Foxland
 */

?>
<article <?php Hybrid\Attr\display( 'entry' ); ?>>
	<header class="entry__header">
		<h1 class="entry__title"><?php single_post_title(); ?></h1>
	</header>

	<div class="entry__content mt-md">
		<?php
		the_content();
		?>
	</div>
</article>
