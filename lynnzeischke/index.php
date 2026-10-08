<?php
/**
 * Fallback-Template.
 *
 * @package lynnzeischke
 */

get_header();
?>
<section class="page-hero">
	<div class="container">
		<h1><?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?></h1>
	</div>
</section>
<?php get_template_part( 'template-parts/blog', 'list' ); ?>
<?php
get_footer();
