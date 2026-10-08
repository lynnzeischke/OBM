<?php
/**
 * Seite nicht gefunden.
 *
 * @package lynnzeischke
 */

get_header();
?>
<section class="page-content">
	<div class="container">
		<h1><?php esc_html_e( 'Diese Seite gibt es leider nicht.', 'lynnzeischke' ); ?></h1>
		<p><?php esc_html_e( 'Vielleicht hat sich die Adresse geändert. Auf der Startseite finden Sie alles Wichtige.', 'lynnzeischke' ); ?></p>
		<p><a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Zur Startseite', 'lynnzeischke' ); ?></a></p>
	</div>
</section>
<?php
get_footer();
