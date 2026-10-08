<?php
/**
 * Einzelne Seite (z. B. Impressum, Datenschutz).
 *
 * @package lynnzeischke
 */

get_header();
?>
<section class="page-content">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<div class="entry-content"><?php the_content(); ?></div>
			</article>
		<?php endwhile; ?>
	</div>
</section>
<?php
get_footer();
