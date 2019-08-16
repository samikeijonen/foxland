<?php
/**
 * Template without header.
 *
 * @package   Foxland
 */

?>
<article <?php Hybrid\Attr\display( 'entry' ); ?>>
	<div class="entry__content">
		<?php
		the_content();
		Hybrid\View\display( 'nav/pagination', 'post' );
		?>
	</div>
</article>
