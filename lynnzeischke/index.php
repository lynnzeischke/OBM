<?php
/**
 * Fallback-Template: Blog-Übersicht, Archive, Suche.
 *
 * @package lynnzeischke
 */

get_header();
?>
<section class="page-content">
	<div class="container">
		<h1>
			<?php
			if ( is_home() ) {
				single_post_title();
			} elseif ( is_search() ) {
				/* translators: %s: Suchbegriff */
				printf( esc_html__( 'Suche nach „%s“', 'lynnzeischke' ), esc_html( get_search_query() ) );
			} else {
				the_archive_title();
			}
			?>
		</h1>

		<?php if ( have_posts() ) : ?>
			<div class="post-list">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class(); ?>>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="post-meta"><?php echo esc_html( get_the_date() ); ?></p>
						<?php the_excerpt(); ?>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Hier gibt es noch keine Beiträge.', 'lynnzeischke' ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
