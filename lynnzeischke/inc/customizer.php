<?php
/**
 * Einstellungen unter Design → Customizer → „Lynn Zeischke – Kontakt & Texte“.
 *
 * @package lynnzeischke
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Standardwerte. Alles hier kann im Customizer überschrieben werden.
 */
function lz_defaults() {
	return array(
		'email'            => get_option( 'admin_email' ),
		'phone'            => '',
		'region'           => 'Künzelsau, Hohenlohe & Umgebung',
		'calendly_url'     => '',
		'call_times'       => 'Gut erreichbar vormittags und am frühen Nachmittag – gern auch an Ihrem Ruhetag.',
		'hero_image'       => 0,
		'about_image'      => 0,
		'meta_description' => 'Buchhaltung, Google-Profil, Homepage und Personal für Handwerksbetriebe und Gastronomie – aus einer Hand, zum Festpreis. Kostenloses Erstgespräch mit Lynn Zeischke.',
	);
}

/**
 * Einstellung auslesen (mit Standardwert).
 *
 * @param string $key Schlüssel.
 * @return mixed
 */
function lz_opt( $key ) {
	$defaults = lz_defaults();
	return get_theme_mod( 'lz_' . $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

/**
 * Customizer-Felder registrieren.
 *
 * @param WP_Customize_Manager $wp_customize Customizer.
 */
function lz_customize_register( $wp_customize ) {
	$defaults = lz_defaults();

	$wp_customize->add_section(
		'lz_settings',
		array(
			'title'    => __( 'Lynn Zeischke – Kontakt & Texte', 'lynnzeischke' ),
			'priority' => 30,
		)
	);

	$text_fields = array(
		'email'            => array( __( 'E-Mail (Empfänger Kontaktformular)', 'lynnzeischke' ), 'sanitize_email', 'email' ),
		'phone'            => array( __( 'Telefon', 'lynnzeischke' ), 'sanitize_text_field', 'text' ),
		'region'           => array( __( 'Region / Einzugsgebiet', 'lynnzeischke' ), 'sanitize_text_field', 'text' ),
		'calendly_url'     => array( __( 'Link zur Online-Terminbuchung (z. B. Calendly) – optional', 'lynnzeischke' ), 'esc_url_raw', 'url' ),
		'call_times'       => array( __( 'Hinweis Erreichbarkeit', 'lynnzeischke' ), 'sanitize_text_field', 'text' ),
		'meta_description' => array( __( 'Google-Beschreibung der Startseite', 'lynnzeischke' ), 'sanitize_textarea_field', 'textarea' ),
	);

	foreach ( $text_fields as $key => $field ) {
		$wp_customize->add_setting(
			'lz_' . $key,
			array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => $field[1],
			)
		);
		$wp_customize->add_control(
			'lz_' . $key,
			array(
				'label'   => $field[0],
				'section' => 'lz_settings',
				'type'    => $field[2],
			)
		);
	}

	$images = array(
		'hero_image'  => __( 'Foto oben auf der Startseite (Hochformat)', 'lynnzeischke' ),
		'about_image' => __( 'Foto „Über mich“ (quadratisch)', 'lynnzeischke' ),
	);
	foreach ( $images as $key => $label ) {
		$wp_customize->add_setting(
			'lz_' . $key,
			array(
				'default'           => 0,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'lz_' . $key,
				array(
					'label'     => $label,
					'section'   => 'lz_settings',
					'mime_type' => 'image',
				)
			)
		);
	}
}
add_action( 'customize_register', 'lz_customize_register' );

/**
 * Link für Terminbuchung: Calendly, falls hinterlegt – sonst Kontaktformular.
 */
function lz_booking_url() {
	$url = lz_opt( 'calendly_url' );
	return $url ? $url : '#kontakt';
}
