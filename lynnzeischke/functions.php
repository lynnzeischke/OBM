<?php
/**
 * Lynn Zeischke – Theme-Funktionen
 *
 * @package lynnzeischke
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LZ_VERSION', '1.2.0' );

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/contact-form.php';

/**
 * Theme-Grundfunktionen.
 */
function lz_setup() {
	load_theme_textdomain( 'lynnzeischke', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 96,
			'width'       => 320,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Hauptmenü', 'lynnzeischke' ),
			'footer'  => __( 'Footer-Menü (Impressum, Datenschutz)', 'lynnzeischke' ),
		)
	);
}
add_action( 'after_setup_theme', 'lz_setup' );

/**
 * CSS und JS einbinden – keine externen Quellen (keine Google Fonts, kein CDN).
 */
function lz_assets() {
	wp_enqueue_style( 'lz-style', get_stylesheet_uri(), array(), LZ_VERSION );
	wp_enqueue_script( 'lz-main', get_template_directory_uri() . '/assets/js/main.js', array(), LZ_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'lz_assets' );

/**
 * Unnötiges aus dem <head> entfernen (Emojis laden sonst Dateien von s.w.org).
 */
function lz_cleanup() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_generator' );
	add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'lz_cleanup' );

/**
 * Meta-Beschreibung für die Startseite (falls kein SEO-Plugin aktiv ist).
 */
function lz_meta_description() {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) {
		return;
	}
	if ( is_front_page() ) {
		$desc = lz_opt( 'meta_description' );
		if ( $desc ) {
			printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
		}
	}
}
add_action( 'wp_head', 'lz_meta_description', 1 );

/**
 * Strukturierte Daten (schema.org) für Google – lokales Unternehmen.
 */
function lz_schema() {
	if ( ! is_front_page() ) {
		return;
	}
	$data = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'ProfessionalService',
		'name'        => 'Lynn Zeischke',
		'url'         => home_url( '/' ),
		'description' => lz_opt( 'meta_description' ),
		'areaServed'  => lz_opt( 'region' ),
	);
	if ( lz_opt( 'email' ) ) {
		$data['email'] = lz_opt( 'email' );
	}
	if ( lz_opt( 'phone' ) ) {
		$data['telephone'] = lz_opt( 'phone' );
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'lz_schema' );

/**
 * Abschnitte der Startseite (für die Punkte in der Seitenleiste).
 */
function lz_sections() {
	return array(
		'start'      => __( 'Start', 'lynnzeischke' ),
		'probleme'   => __( 'Kennen Sie das?', 'lynnzeischke' ),
		'leistungen' => __( 'Leistungen', 'lynnzeischke' ),
		'fuer-wen'   => __( 'Für wen', 'lynnzeischke' ),
		'pakete'     => __( 'Pakete', 'lynnzeischke' ),
		'ablauf'     => __( 'Ablauf', 'lynnzeischke' ),
		'ueber-mich' => __( 'Über mich', 'lynnzeischke' ),
		'faq'        => __( 'FAQ', 'lynnzeischke' ),
		'kontakt'    => __( 'Kontakt', 'lynnzeischke' ),
	);
}

/**
 * Fallback-Menü, solange unter Design → Menüs noch nichts angelegt ist.
 * Verlinkt die Abschnitte der Startseite.
 */
function lz_fallback_menu() {
	$home  = is_front_page() ? '' : home_url( '/' );
	$items = array(
		'#leistungen' => __( 'Leistungen', 'lynnzeischke' ),
		'#pakete'     => __( 'Pakete', 'lynnzeischke' ),
		'#ablauf'     => __( 'Ablauf', 'lynnzeischke' ),
		'#ueber-mich' => __( 'Über mich', 'lynnzeischke' ),
		'#faq'        => __( 'FAQ', 'lynnzeischke' ),
		'#kontakt'    => __( 'Kontakt', 'lynnzeischke' ),
	);
	echo '<ul>';
	foreach ( $items as $anchor => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $home . $anchor ), esc_html( $label ) );
	}
	printf( '<li class="nav-cta"><a href="%s">%s</a></li>', esc_url( $home . '#kontakt' ), esc_html__( 'Kostenloses Erstgespräch', 'lynnzeischke' ) );
	echo '</ul>';
}

/**
 * Kleines Inline-SVG-Icon-Set (keine Icon-Fonts nötig).
 *
 * @param string $name Icon-Name.
 */
function lz_icon( $name ) {
	$icons = array(
		'beleg'   => '<path d="M6 2h12v20l-3-2-3 2-3-2-3 2V2z"/><path d="M9 7h6M9 11h6M9 15h4"/>',
		'google'  => '<circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>',
		'web'     => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M7 6.5h.01M10 6.5h.01"/>',
		'team'    => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5"/><circle cx="17" cy="9" r="2.5"/><path d="M17 14.5c2.2 0 4 1.5 4.5 4"/>',
		'chart'   => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
		'phone'   => '<path d="M5 3h4l2 5-2.5 1.5a11 11 0 0 0 6 6L16 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 5a2 2 0 0 1 2-2"/>',
		'mail'    => '<rect x="3" y="5" width="18" height="14" rx="1"/><path d="M3 7l9 6 9-6"/>',
		'globe'   => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>',
		'handout' => '<path d="M4 4h16v12H8l-4 4z"/>',
	);
	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $icons[ $name ] . '</svg>';
}
