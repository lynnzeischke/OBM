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
		'email'            => 'hallo@lynnzeischke.de',
		'phone'            => '+49 172 58 611 60',
		'whatsapp'         => true,
		'brand_sub'        => 'Beratung für KMU, Handwerk & Gastro',
		'hero_badge'       => 'Steuerfachangestellte · M.Sc. Digital Commerce, Marketing & Psychologie · Co-Founderin mit eigener Praxiserfahrung',
		'region'           => 'Remote · deutschlandweit',
		'calendly_url'     => '',
		'call_times'       => 'Erstgespräch kostenfrei & unverbindlich – per Telefon oder Video.',
		'hero_image'       => 0,
		'about_image'      => 0,
		'meta_description' => 'Weniger Büro, mehr Zeit fürs Kerngeschäft: Kaufmännische Beratung & operative Umsetzung für KMU, Handwerk und Gastronomie – von Website & Marketing über digitale Büroabläufe bis zur vorbereitenden Buchhaltung. Remote, deutschlandweit.',
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
		'phone'            => array( __( 'Telefon (auch für WhatsApp)', 'lynnzeischke' ), 'sanitize_text_field', 'text' ),
		'brand_sub'        => array( __( 'Unterzeile neben dem Logo', 'lynnzeischke' ), 'sanitize_text_field', 'text' ),
		'hero_badge'       => array( __( 'Dunkler Kasten auf dem Foto (Qualifikationen)', 'lynnzeischke' ), 'sanitize_textarea_field', 'textarea' ),
		'region'           => array( __( 'Region / Einzugsgebiet', 'lynnzeischke' ), 'sanitize_text_field', 'text' ),
		'calendly_url'     => array( __( 'Link zur Online-Terminbuchung (z. B. Calendly) – optional', 'lynnzeischke' ), 'esc_url_raw', 'url' ),
		'call_times'       => array( __( 'Hinweis Erreichbarkeit', 'lynnzeischke' ), 'sanitize_text_field', 'text' ),
		'meta_description' => array( __( 'Allgemeine Google-Beschreibung (Fallback & Unternehmensdaten)', 'lynnzeischke' ), 'sanitize_textarea_field', 'textarea' ),
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

	$wp_customize->add_setting(
		'lz_whatsapp',
		array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		'lz_whatsapp',
		array(
			'label'   => __( 'WhatsApp-Button unten rechts anzeigen', 'lynnzeischke' ),
			'section' => 'lz_settings',
			'type'    => 'checkbox',
		)
	);

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
	if ( $url ) {
		return $url;
	}
	if ( function_exists( 'lz_current_landing_key' ) && lz_current_landing_key() ) {
		return '#kontakt';
	}
	if ( is_singular( 'post' ) || is_category() ) {
		$cat = is_category() ? get_queried_object() : ( function_exists( 'lz_primary_category' ) ? lz_primary_category() : null );
		if ( $cat && in_array( $cat->slug, array( 'handwerk', 'gastro' ), true ) ) {
			return home_url( '/' . $cat->slug . '/#kontakt' );
		}
	}
	return home_url( '/#kontakt' );
}

/**
 * Telefonnummer für tel:/wa.me-Links (nur Ziffern und +).
 *
 * @param string $phone Telefonnummer.
 */
function lz_phone_link( $phone ) {
	return preg_replace( '/[^0-9+]/', '', $phone );
}

/**
 * Telefonnummer in nationaler Schreibweise, z. B. „(0172) 58 611 60“.
 *
 * @param string $phone Telefonnummer.
 */
function lz_phone_display( $phone ) {
	if ( preg_match( '/^\+?\s*49\s*(\d+)\s+(.*)$/', trim( $phone ), $m ) ) {
		return '(0' . $m[1] . ') ' . $m[2];
	}
	return $phone;
}
