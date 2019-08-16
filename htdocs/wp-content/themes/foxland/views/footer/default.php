<?php
/**
 * The footer for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package   Foxland
 */

?>
	<footer class="app-footer px-2 py-8">
		<div class="mx-auto max-width-xl">
			<?php Hybrid\View\display( 'nav/menu', 'social', [ 'name' => 'social' ] ); ?>

			<p class="app-footer__credit text-center has-grey-500-color mb-0">
				<?php esc_html_e( 'Power of the Foxland.', 'foxland' ); ?>
			</p>
		</div>
	</footer>

</div><!-- .app -->

<?php wp_footer(); ?>
</body>
</html>
