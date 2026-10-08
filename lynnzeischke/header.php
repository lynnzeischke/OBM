<?php
/**
 * Kopfbereich: Fortschrittsleiste, Seitenleiste links, dunkle Kopfzeile mit Logo,
 * Menü, Bürolicht-Schalter und Erstgespräch-Button.
 *
 * @package lynnzeischke
 */

$lz_phone    = lz_opt( 'phone' );
$lz_sections = lz_sections();
$lz_key      = lz_current_landing_key();
$lz_subs     = array(
	'handwerk' => 'Beratung für Handwerksbetriebe',
	'gastro'   => 'Beratung für die Gastronomie',
);
$lz_sub      = isset( $lz_subs[ $lz_key ] ) ? $lz_subs[ $lz_key ] : lz_opt( 'brand_sub' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#1f1d22">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#inhalt"><?php esc_html_e( 'Zum Inhalt springen', 'lynnzeischke' ); ?></a>
<div class="scroll-progress" aria-hidden="true"></div>

<aside class="side-rail" aria-label="<?php esc_attr_e( 'Abschnitte', 'lynnzeischke' ); ?>">
	<a class="rail-text" href="<?php echo esc_url( home_url( '/' ) ); ?>">Lynn Zeischke</a>
	<?php if ( $lz_sections ) : ?>
		<ul class="rail-dots">
			<?php foreach ( $lz_sections as $lz_id => $lz_label ) : ?>
				<li><a href="#<?php echo esc_attr( $lz_id ); ?>" data-section="<?php echo esc_attr( $lz_id ); ?>"><span class="rail-label"><?php echo esc_html( $lz_label ); ?></span></a></li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<span class="rail-line" aria-hidden="true"></span>
	<?php endif; ?>
	<?php if ( $lz_phone ) : ?>
		<a class="rail-text" href="tel:<?php echo esc_attr( lz_phone_link( $lz_phone ) ); ?>"><?php echo esc_html( lz_phone_display( $lz_phone ) ); ?></a>
	<?php else : ?>
		<span></span>
	<?php endif; ?>
</aside>

<header class="site-header">
	<div class="container">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="lz-mark" aria-hidden="true">LZ</span>
					<span>
						<span class="brand-name"><?php bloginfo( 'name' ); ?></span>
						<span class="brand-sub"><?php echo esc_html( $lz_sub ); ?></span>
					</span>
				</a>
			<?php endif; ?>
		</div>

		<div class="header-right">
			<nav id="hauptmenue" class="main-nav" aria-label="<?php esc_attr_e( 'Hauptmenü', 'lynnzeischke' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'fallback_cb'    => 'lz_fallback_menu',
						'depth'          => 1,
					)
				);
				?>
			</nav>

			<button class="theme-toggle" type="button" aria-pressed="false" data-label-on="<?php esc_attr_e( 'Bürolicht an', 'lynnzeischke' ); ?>" data-label-off="<?php esc_attr_e( 'Bürolicht aus', 'lynnzeischke' ); ?>">
				<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/><path d="M12 2a10 10 0 0 1 0 20z" fill="currentColor"/></svg>
				<span class="label"><?php esc_html_e( 'Bürolicht an', 'lynnzeischke' ); ?></span>
			</button>

			<a class="btn btn-primary header-cta" href="<?php echo esc_url( lz_booking_url() ); ?>"><?php esc_html_e( 'Kostenloses Erstgespräch', 'lynnzeischke' ); ?></a>

			<button class="nav-toggle" aria-controls="hauptmenue" aria-expanded="false">
				<span></span><b class="screen-reader-text"><?php esc_html_e( 'Menü', 'lynnzeischke' ); ?></b>
			</button>
		</div>
	</div>
</header>

<main id="inhalt">
