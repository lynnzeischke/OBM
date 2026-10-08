<?php
/**
 * Fußbereich.
 *
 * @package lynnzeischke
 */

?>
</main>

<footer class="site-footer">
	<div class="container">
		<div>
			<strong style="color:#fff">Lynn Zeischke</strong><br>
			<?php esc_html_e( 'Buchhaltung · Marketing · Webdesign für Handwerk & Gastro', 'lynnzeischke' ); ?><br>
			<?php echo esc_html( lz_opt( 'region' ) ); ?>
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
				$impressum = get_page_by_path( 'impressum' );
				echo '<ul>';
				if ( $impressum ) {
					printf( '<li><a href="%s">%s</a></li>', esc_url( get_permalink( $impressum ) ), esc_html__( 'Impressum', 'lynnzeischke' ) );
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

<?php wp_footer(); ?>
</body>
</html>
