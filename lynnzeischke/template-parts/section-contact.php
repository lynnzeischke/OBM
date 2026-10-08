<?php
/**
 * Abschnitt: Kontakt mit Formular.
 *
 * @package lynnzeischke
 */

$s       = $args['section'];
$branche = isset( $args['page']['branche'] ) ? $args['page']['branche'] : '';
$booking = lz_booking_url();
?>
<section class="section section-gold" id="<?php echo esc_attr( $s['id'] ); ?>">
	<div class="container contact">
		<div class="contact-info">
			<span class="eyebrow" data-reveal><?php esc_html_e( 'Kontakt', 'lynnzeischke' ); ?></span>
			<h2 data-reveal style="--d:1"><?php echo esc_html( $s['title'] ); ?></h2>
			<p class="lead" data-reveal style="--d:2"><?php echo esc_html( $s['lead'] ); ?></p>
			<ul class="contact-lines" data-reveal style="--d:3">
				<?php if ( lz_opt( 'phone' ) ) : ?>
					<li><?php echo lz_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><a href="tel:<?php echo esc_attr( lz_phone_link( lz_opt( 'phone' ) ) ); ?>"><?php echo esc_html( lz_opt( 'phone' ) ); ?></a></li>
				<?php endif; ?>
				<?php if ( lz_opt( 'email' ) ) : ?>
					<li><?php echo lz_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><a href="mailto:<?php echo esc_attr( antispambot( lz_opt( 'email' ) ) ); ?>"><?php echo esc_html( antispambot( lz_opt( 'email' ) ) ); ?></a></li>
				<?php endif; ?>
				<li><?php echo lz_icon( 'globe' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( lz_opt( 'region' ) ); ?></li>
			</ul>
			<p class="contact-note"><?php echo esc_html( lz_opt( 'call_times' ) ); ?></p>
			<?php if ( 0 === strpos( $booking, 'http' ) ) : ?>
				<p><a class="btn btn-dark" href="<?php echo esc_url( $booking ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Termin direkt online buchen', 'lynnzeischke' ); ?></a></p>
			<?php endif; ?>
		</div>

		<form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" data-reveal="right">
			<?php lz_contact_notice(); ?>
			<input type="hidden" name="action" value="lz_contact">
			<input type="hidden" name="lz_ts" value="<?php echo esc_attr( time() ); ?>">
			<input type="hidden" name="lz_source" value="<?php echo esc_attr( wp_parse_url( get_permalink( get_queried_object_id() ) ?: home_url( '/' ), PHP_URL_PATH ) ); ?>">
			<?php wp_nonce_field( 'lz_contact', 'lz_nonce' ); ?>
			<div class="hp" aria-hidden="true">
				<label for="lz-website">Website</label>
				<input type="text" id="lz-website" name="website" tabindex="-1" autocomplete="off">
			</div>

			<div class="row">
				<div>
					<label for="lz-name"><?php esc_html_e( 'Name *', 'lynnzeischke' ); ?></label>
					<input type="text" id="lz-name" name="lz_name" required autocomplete="name">
				</div>
				<div>
					<label for="lz-company"><?php esc_html_e( 'Betrieb', 'lynnzeischke' ); ?></label>
					<input type="text" id="lz-company" name="lz_company" autocomplete="organization">
				</div>
			</div>
			<div class="row">
				<div>
					<label for="lz-email"><?php esc_html_e( 'E-Mail *', 'lynnzeischke' ); ?></label>
					<input type="email" id="lz-email" name="lz_email" required autocomplete="email">
				</div>
				<div>
					<label for="lz-phone"><?php esc_html_e( 'Telefon', 'lynnzeischke' ); ?></label>
					<input type="tel" id="lz-phone" name="lz_phone" autocomplete="tel">
				</div>
			</div>
			<label for="lz-branche"><?php esc_html_e( 'Branche', 'lynnzeischke' ); ?></label>
			<select id="lz-branche" name="lz_branche">
				<?php foreach ( array( 'Handwerk', 'Gastronomie', 'Etwas anderes' ) as $opt ) : ?>
					<option<?php selected( $branche, $opt ); ?>><?php echo esc_html( $opt ); ?></option>
				<?php endforeach; ?>
			</select>
			<label for="lz-message"><?php esc_html_e( 'Wobei kann ich helfen? *', 'lynnzeischke' ); ?></label>
			<textarea id="lz-message" name="lz_message" required placeholder="<?php echo esc_attr( $s['placeholder'] ); ?>"></textarea>
			<label class="consent">
				<input type="checkbox" name="lz_consent" value="1" required>
				<span>
					<?php
					$privacy = get_privacy_policy_url();
					if ( $privacy ) {
						printf(
							/* translators: %s: Link zur Datenschutzerklärung */
							esc_html__( 'Ich bin einverstanden, dass meine Angaben zur Bearbeitung meiner Anfrage verwendet werden. Mehr dazu in der %s.', 'lynnzeischke' ),
							'<a href="' . esc_url( $privacy ) . '" target="_blank">' . esc_html__( 'Datenschutzerklärung', 'lynnzeischke' ) . '</a>'
						);
					} else {
						esc_html_e( 'Ich bin einverstanden, dass meine Angaben zur Bearbeitung meiner Anfrage verwendet werden.', 'lynnzeischke' );
					}
					?>
				</span>
			</label>
			<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Anfrage senden', 'lynnzeischke' ); ?> <span class="arrow" aria-hidden="true">→</span></button>
		</form>
	</div>
</section>
