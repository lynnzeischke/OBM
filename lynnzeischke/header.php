<?php
/**
 * Kopfbereich.
 *
 * @package lynnzeischke
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#inhalt"><?php esc_html_e( 'Zum Inhalt springen', 'lynnzeischke' ); ?></a>

<header class="site-header">
	<div class="container">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
					<span><?php bloginfo( 'description' ); ?></span>
				</a>
			<?php endif; ?>
		</div>

		<button class="nav-toggle" aria-controls="hauptmenue" aria-expanded="false">
			<span></span><b class="screen-reader-text"><?php esc_html_e( 'Menü', 'lynnzeischke' ); ?></b>
		</button>

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
	</div>
</header>

<main id="inhalt">
