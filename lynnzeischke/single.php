<?php
/**
 * Einzelner Blogbeitrag.
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
				<p class="post-meta"><?php echo esc_html( get_the_date() ); ?></p>
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large' ); ?>
				<?php endif; ?>
				<div class="entry-content"><?php the_content(); ?></div>
			</article>
			<p><a class="btn btn-primary" href="<?php echo esc_url( home_url( '/#kontakt' ) ); ?>"><?php esc_html_e( 'Kostenloses Erstgespräch', 'lynnzeischke' ); ?></a></p>
		<?php endwhile; ?>
	</div>
</section>
<?php
get_footer();
