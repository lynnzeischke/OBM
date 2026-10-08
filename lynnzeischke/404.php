<?php
/**
 * Seite nicht gefunden.
 *
 * @package lynnzeischke
 */

get_header();
?>
<section class="page-hero error-404">
	<div class="hero-grid" aria-hidden="true"></div>
	<div class="container narrow">
		<span class="eyebrow">Fehler 404</span>
		<h1><?php esc_html_e( 'Diese Seite gibt es nicht.', 'lynnzeischke' ); ?> <span class="gold"><?php esc_html_e( 'Der Rest schon.', 'lynnzeischke' ); ?></span></h1>
		<p class="lead"><?php esc_html_e( 'Vielleicht hat sich die Adresse geändert. Hier geht es weiter:', 'lynnzeischke' ); ?></p>
		<div class="hero-actions">
			<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Zur Startseite', 'lynnzeischke' ); ?></a>
			<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/handwerk/' ) ); ?>"><?php esc_html_e( 'Handwerk', 'lynnzeischke' ); ?></a>
			<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/gastro/' ) ); ?>"><?php esc_html_e( 'Gastro', 'lynnzeischke' ); ?></a>
		</div>
		<?php get_search_form(); ?>
	</div>
</section>
<?php
get_footer();
