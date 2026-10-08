<?php
/**
 * Blog-Übersicht (/blog).
 *
 * @package lynnzeischke
 */

get_header();
$blog_page = get_option( 'page_for_posts' );
?>
<section class="page-hero">
	<div class="hero-grid" aria-hidden="true"></div>
	<div class="container">
		<?php lz_breadcrumbs(); ?>
		<span class="eyebrow" data-reveal><?php esc_html_e( 'Blog', 'lynnzeischke' ); ?></span>
		<h1 data-reveal style="--d:1"><?php esc_html_e( 'Wissen für Ihren Betrieb.', 'lynnzeischke' ); ?> <span class="gold"><?php esc_html_e( 'Ohne Berater-Sprech.', 'lynnzeischke' ); ?></span></h1>
		<p class="lead" data-reveal style="--d:2"><?php esc_html_e( 'Praktische Tipps zu Buchhaltung, E-Rechnung, Google, Homepage und Personal – für Handwerk, Gastronomie und kleine Unternehmen.', 'lynnzeischke' ); ?></p>
		<?php get_template_part( 'template-parts/blog', 'filter' ); ?>
	</div>
</section>
<?php get_template_part( 'template-parts/blog', 'list' ); ?>
<?php
get_footer();
