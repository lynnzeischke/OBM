<?php
/**
 * Schlankes Kontaktformular ohne Plugin.
 * Versand per wp_mail() – für zuverlässige Zustellung ein SMTP-Plugin
 * (z. B. „WP Mail SMTP“) mit dem eigenen Postfach verbinden.
 *
 * @package lynnzeischke
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Anfrage verarbeiten.
 */
function lz_handle_contact() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( 'anfrage', $back );
	$fail = function ( $code ) use ( $back ) {
		wp_safe_redirect( add_query_arg( 'anfrage', $code, $back ) . '#kontakt' );
		exit;
	};

	if ( ! isset( $_POST['lz_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['lz_nonce'] ) ), 'lz_contact' ) ) {
		$fail( 'fehler' );
	}

	// Spam-Schutz 1: unsichtbares Feld muss leer bleiben.
	if ( ! empty( $_POST['website'] ) ) {
		$fail( 'ok' );
	}

	// Spam-Schutz 2: Bots schicken das Formular in unter 3 Sekunden ab.
	$started = isset( $_POST['lz_ts'] ) ? absint( $_POST['lz_ts'] ) : 0;
	if ( ! $started || ( time() - $started ) < 3 ) {
		$fail( 'ok' );
	}

	// Spam-Schutz 3: max. 5 Anfragen pro Stunde und IP.
	$ip_key = 'lz_cf_' . md5( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' );
	$count  = (int) get_transient( $ip_key );
	if ( $count >= 5 ) {
		$fail( 'limit' );
	}

	$name    = isset( $_POST['lz_name'] ) ? sanitize_text_field( wp_unslash( $_POST['lz_name'] ) ) : '';
	$email   = isset( $_POST['lz_email'] ) ? sanitize_email( wp_unslash( $_POST['lz_email'] ) ) : '';
	$phone   = isset( $_POST['lz_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['lz_phone'] ) ) : '';
	$company = isset( $_POST['lz_company'] ) ? sanitize_text_field( wp_unslash( $_POST['lz_company'] ) ) : '';
	$branche = isset( $_POST['lz_branche'] ) ? sanitize_text_field( wp_unslash( $_POST['lz_branche'] ) ) : '';
	$message = isset( $_POST['lz_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['lz_message'] ) ) : '';
	$consent = ! empty( $_POST['lz_consent'] );

	if ( '' === $name || ! is_email( $email ) || '' === $message || ! $consent ) {
		$fail( 'pflicht' );
	}

	$to      = lz_opt( 'email' );
	$subject = sprintf( 'Neue Anfrage über lynnzeischke.de: %s', $name . ( $company ? ' (' . $company . ')' : '' ) );
	$body    = "Name: {$name}\nBetrieb: {$company}\nBranche: {$branche}\nE-Mail: {$email}\nTelefon: {$phone}\n\nNachricht:\n{$message}\n\n---\nEinwilligung Datenschutz erteilt am " . wp_date( 'd.m.Y H:i' ) . ' Uhr.';
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $to, $subject, $body, $headers );

	set_transient( $ip_key, $count + 1, HOUR_IN_SECONDS );

	$fail( $sent ? 'ok' : 'fehler' );
}
add_action( 'admin_post_nopriv_lz_contact', 'lz_handle_contact' );
add_action( 'admin_post_lz_contact', 'lz_handle_contact' );

/**
 * Rückmeldung nach dem Absenden.
 */
function lz_contact_notice() {
	if ( ! isset( $_GET['anfrage'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return;
	}
	$code     = sanitize_key( wp_unslash( $_GET['anfrage'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$messages = array(
		'ok'      => array( 'ok', __( 'Danke für Ihre Nachricht! Ich melde mich innerhalb von zwei Werktagen bei Ihnen.', 'lynnzeischke' ) ),
		'pflicht' => array( 'err', __( 'Bitte füllen Sie Name, E-Mail und Nachricht aus und bestätigen Sie den Datenschutzhinweis.', 'lynnzeischke' ) ),
		'limit'   => array( 'err', __( 'Es wurden gerade sehr viele Anfragen gesendet. Bitte versuchen Sie es später noch einmal oder schreiben Sie mir direkt eine E-Mail.', 'lynnzeischke' ) ),
		'fehler'  => array( 'err', __( 'Da ist leider etwas schiefgelaufen. Bitte schreiben Sie mir direkt eine E-Mail.', 'lynnzeischke' ) ),
	);
	if ( isset( $messages[ $code ] ) ) {
		printf( '<div class="form-msg %1$s" role="status">%2$s</div>', esc_attr( $messages[ $code ][0] ), esc_html( $messages[ $code ][1] ) );
	}
}
