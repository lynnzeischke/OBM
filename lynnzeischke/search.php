<?php
/**
 * Suchergebnisse.
 *
 * @package lynnzeischke
 */

get_header();
?>
<section class="page-hero">
	<div class="hero-grid" aria-hidden="true"></div>
	<div class="container">
		<?php lz_breadcrumbs(); ?>
		<span class="eyebrow"><?php esc_html_e( 'Suche', 'lynnzeischke' ); ?></span>
		<h1>
			<?php
			/* translators: %s: Suchbegriff */
			printf( esc_html__( 'Ergebnisse für „%s“', 'lynnzeischke' ), esc_html( get_search_query() ) );
			?>
		</h1>
		<?php get_search_form(); ?>
	</div>
</section>
<?php get_template_part( 'template-parts/blog', 'list' ); ?>
<?php
get_footer();
