<?php
/**
 * Einzelne Seite (z. B. Impressum, Datenschutz).
 *
 * @package lynnzeischke
 */

get_header();
while ( have_posts() ) :
	the_post();
	?>
	<header class="page-hero">
		<div class="hero-grid" aria-hidden="true"></div>
		<div class="container narrow">
			<?php lz_breadcrumbs(); ?>
			<h1 data-reveal><?php the_title(); ?></h1>
		</div>
	</header>
	<section class="section page-body">
		<div class="container narrow">
			<div class="entry-content prose"><?php the_content(); ?></div>
		</div>
	</section>
	<?php
endwhile;
get_footer();
