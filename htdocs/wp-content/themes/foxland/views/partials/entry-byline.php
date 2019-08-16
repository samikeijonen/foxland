<?php
/**
 * Entry byline.
 *
 * @package   Foxland
 */

if ( 'post' !== get_post_type() ) :
	return;
endif;
?>

<div class="entry__byline fw-500">
	<?php Hybrid\Post\display_author(); ?>
	<?php Hybrid\Post\display_date( [ 'before' => Foxland\sep() ] ); ?>
	<?php Hybrid\Post\display_comments_link( [ 'before' => Foxland\sep() ] ); ?>
</div>
