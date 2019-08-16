<?php
/**
 * Layout template.
 *
 * @package Foxland
 */

?>
<article <?php Hybrid\Attr\display( 'entry', 'layout' ); ?>>
	<?php
	if ( 0 === $iterator && has_post_thumbnail() ) :
		?>
		<figure class="entry__thumbnail">
			<a class="entry__thumbnail-link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php echo wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'post-thumbnail' ); ?>
			</a>
		</figure>
	<?php endif; ?>

	<header class="entry__header">
		<h2 class="entry__title<?php echo 0 !== $iterator ? ' h3' : ''; ?>"><a class="decoration-none h-decoration-underline color-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<?php Hybrid\View\display( 'partials', 'entry-byline-archive' ); ?>
	</header>

	<?php if ( 0 === $iterator ) : ?>
		<div class="entry__summary mt-sm">
			<?php the_excerpt(); ?>
		</div>
	<?php endif; ?>
</article>
