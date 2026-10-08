<?php
/**
 * Lynn Zeischke – Theme-Funktionen
 *
 * Aufbau:
 * - inc/customizer.php   Einstellungen (Kontakt, Fotos, Texte)
 * - inc/content.php      Texte der Landingpages (Start, /handwerk, /gastro)
 * - inc/blog.php         Blog-Helfer, Brotkrumen, Links
 * - inc/seo.php          Titel, Meta, Open Graph, schema.org
 * - inc/contact-form.php Kontaktformular
 * - inc/setup.php        Seiten/Kategorien/Startartikel beim Aktivieren
 *
 * @package lynnzeischke
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LZ_VERSION', '2.0.0' );

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/content.php';
require get_template_directory() . '/inc/blog.php';
require get_template_directory() . '/inc/seo.php';
require get_template_directory() . '/inc/contact-form.php';
require get_template_directory() . '/inc/setup.php';

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
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 96,
			'width'       => 320,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_post_type_support( 'page', 'excerpt' );

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
	$ver = LZ_VERSION;
	wp_enqueue_style( 'lz-style', get_stylesheet_uri(), array(), $ver );
	wp_enqueue_script( 'lz-main', get_template_directory_uri() . '/assets/js/main.js', array(), $ver, array( 'strategy' => 'defer', 'in_footer' => true ) );
}
add_action( 'wp_enqueue_scripts', 'lz_assets' );

/**
 * Schriften vorladen – die Überschrift erscheint so ohne Springen.
 */
function lz_preload_fonts() {
	$base = get_template_directory_uri() . '/assets/fonts/';
	foreach ( array( 'ibm-plex-mono-latin-700-normal.woff2', 'inter-latin-400-normal.woff2' ) as $font ) {
		printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( $base . $font ) );
	}
}
add_action( 'wp_head', 'lz_preload_fonts', 2 );

/**
 * Unnötiges aus dem <head> entfernen (Emojis laden sonst Dateien von s.w.org).
 */
function lz_cleanup() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'lz_cleanup' );

/**
 * Klasse „js“ so früh wie möglich setzen – Einblend-Effekte greifen nur mit JavaScript.
 */
function lz_js_class() {
	echo "<script>document.documentElement.classList.add('js');try{if(localStorage.getItem('lz-theme')==='dark'){document.documentElement.setAttribute('data-theme','dark');}}catch(e){}</script>\n";
}
add_action( 'wp_head', 'lz_js_class', 0 );

/**
 * Fallback-Menü, solange unter Design → Menüs noch nichts angelegt ist.
 */
function lz_fallback_menu() {
	$here  = lz_current_landing_key();
	$blog  = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/blog/' );
	$items = array(
		array( __( 'Handwerk', 'lynnzeischke' ), home_url( '/handwerk/' ), 'handwerk' === $here ),
		array( __( 'Gastro', 'lynnzeischke' ), home_url( '/gastro/' ), 'gastro' === $here ),
		array( __( 'Leistungen', 'lynnzeischke' ), ( $here ? '' : home_url( '/' ) ) . '#leistungen', false ),
		array( __( 'Pakete', 'lynnzeischke' ), ( $here ? '' : home_url( '/' ) ) . '#pakete', false ),
		array( __( 'Über mich', 'lynnzeischke' ), ( $here ? '' : home_url( '/' ) ) . '#ueber-mich', false ),
		array( __( 'Blog', 'lynnzeischke' ), $blog, is_home() || is_singular( 'post' ) || is_category() ),
	);
	echo '<ul>';
	foreach ( $items as $item ) {
		printf(
			'<li%s><a href="%s"%s>%s</a></li>',
			$item[2] ? ' class="current-menu-item"' : '',
			esc_url( $item[1] ),
			$item[2] ? ' aria-current="page"' : '',
			esc_html( $item[0] )
		);
	}
	printf( '<li class="nav-cta"><a href="%s">%s</a></li>', esc_url( lz_booking_url() ), esc_html__( 'Kostenloses Erstgespräch', 'lynnzeischke' ) );
	echo '</ul>';
}

/**
 * Kleines Inline-SVG-Icon-Set (keine Icon-Fonts nötig).
 *
 * @param string $name Icon-Name.
 */
function lz_icon( $name ) {
	$icons = array(
		'beleg'     => '<path d="M6 2h12v20l-3-2-3 2-3-2-3 2V2z"/><path d="M9 7h6M9 11h6M9 15h4"/>',
		'google'    => '<circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>',
		'search'    => '<circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>',
		'web'       => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M7 6.5h.01M10 6.5h.01"/>',
		'team'      => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5"/><circle cx="17" cy="9" r="2.5"/><path d="M17 14.5c2.2 0 4 1.5 4.5 4"/>',
		'chart'     => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
		'flow'      => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><path d="M6.5 10v4a3 3 0 0 0 3 3H14"/>',
		'key'       => '<circle cx="8" cy="15" r="4"/><path d="M11 12l9-9M17 6l3 3M15 8l2 2"/>',
		'hammer'    => '<path d="M14 6l4 4-9.5 9.5a2.1 2.1 0 0 1-3-3z"/><path d="M13 3l8 8-2 2-8-8z"/>',
		'cup'       => '<path d="M4 8h13v5a6 6 0 0 1-6 6h-1a6 6 0 0 1-6-6z"/><path d="M17 10h1.5a2.5 2.5 0 0 1 0 5H17M8 2v3M12 2v3"/>',
		'briefcase' => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 13h18"/>',
		'phone'     => '<path d="M5 3h4l2 5-2.5 1.5a11 11 0 0 0 6 6L16 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 5a2 2 0 0 1 2-2"/>',
		'mail'      => '<rect x="3" y="5" width="18" height="14" rx="1"/><path d="M3 7l9 6 9-6"/>',
		'globe'     => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>',
	);
	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $icons[ $name ] . '</svg>';
}
