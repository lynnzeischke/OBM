<?php
/**
 * Archive: Kategorie, Schlagwort, Datum, Autor.
 *
 * @package lynnzeischke
 */

get_header();
?>
<section class="page-hero">
	<div class="hero-grid" aria-hidden="true"></div>
	<div class="container">
		<?php lz_breadcrumbs(); ?>
		<span class="eyebrow" data-reveal><?php esc_html_e( 'Blog', 'lynnzeischke' ); ?></span>
		<h1 data-reveal style="--d:1"><?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?></h1>
		<?php if ( get_the_archive_description() ) : ?>
			<div class="lead" data-reveal style="--d:2"><?php the_archive_description(); ?></div>
		<?php endif; ?>
		<?php get_template_part( 'template-parts/blog', 'filter' ); ?>
	</div>
</section>
<?php get_template_part( 'template-parts/blog', 'list' ); ?>
<?php
get_footer();
