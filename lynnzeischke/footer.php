<?php
/**
 * Fußbereich mit WhatsApp-Button.
 *
 * @package lynnzeischke
 */

?>
</main>

<footer class="site-footer">
	<div class="container">
		<div class="footer-brand">
			<span class="lz-mark" aria-hidden="true">LZ</span>
			<div>
				<strong>Lynn Zeischke</strong><br>
				<?php echo esc_html( lz_opt( 'brand_sub' ) ); ?><br>
				<?php echo esc_html( lz_opt( 'region' ) ); ?>
			</div>
		</div>
		<nav aria-label="<?php esc_attr_e( 'Rechtliches', 'lynnzeischke' ); ?>">
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'depth'          => 1,
					)
				);
			} else {
				$lz_impressum = get_page_by_path( 'impressum' );
				echo '<ul>';
				if ( $lz_impressum ) {
					printf( '<li><a href="%s">%s</a></li>', esc_url( get_permalink( $lz_impressum ) ), esc_html__( 'Impressum', 'lynnzeischke' ) );
				}
				if ( get_privacy_policy_url() ) {
					printf( '<li><a href="%s">%s</a></li>', esc_url( get_privacy_policy_url() ), esc_html__( 'Datenschutz', 'lynnzeischke' ) );
				}
				echo '</ul>';
			}
			?>
		</nav>
		<div>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> Lynn Zeischke</div>
	</div>
</footer>

<?php if ( lz_opt( 'whatsapp' ) && lz_opt( 'phone' ) ) : ?>
	<a class="whatsapp-btn" href="<?php echo esc_url( 'https://wa.me/' . ltrim( lz_phone_link( lz_opt( 'phone' ) ), '+' ) ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Per WhatsApp schreiben', 'lynnzeischke' ); ?>">
		<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.47 14.38c-.3-.15-1.75-.86-2.02-.96-.27-.1-.47-.15-.67.15-.2.3-.77.96-.94 1.16-.17.2-.35.22-.64.07-.3-.15-1.25-.46-2.38-1.47-.88-.79-1.47-1.76-1.65-2.06-.17-.3-.02-.46.13-.6.13-.14.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.6-.92-2.2-.24-.58-.49-.5-.67-.5h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.21 3.08c.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.75-.72 2-1.41.25-.7.25-1.29.17-1.41-.07-.13-.27-.2-.57-.35zM12.05 21.5h-.01a9.4 9.4 0 0 1-4.79-1.31l-.34-.2-3.56.93.95-3.47-.22-.36a9.43 9.43 0 1 1 7.97 4.41zm8.02-17.45A11.27 11.27 0 0 0 12.04.75C5.8.75.72 5.83.72 12.08c0 2 .52 3.94 1.52 5.66L.62 23.6l6-1.57a11.3 11.3 0 0 0 5.42 1.38h.01c6.24 0 11.32-5.08 11.33-11.33 0-3.03-1.18-5.87-3.31-8.01z"/></svg>
	</a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
