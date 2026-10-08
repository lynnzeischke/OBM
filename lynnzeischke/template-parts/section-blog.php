<?php
/**
 * Abschnitt: Neueste Blogartikel (optional nach Kategorie).
 *
 * @package lynnzeischke
 */

$s     = $args['section'];
$query = array(
	'posts_per_page'      => 3,
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
);
if ( ! empty( $s['category'] ) && get_category_by_slug( $s['category'] ) ) {
	$query['category_name'] = $s['category'];
}
$posts = new WP_Query( $query );
if ( ! $posts->have_posts() ) {
	return;
}
$blog_url = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' );
if ( ! empty( $query['category_name'] ) ) {
	$blog_url = get_category_link( get_category_by_slug( $s['category'] ) );
}
?>
<section class="section" id="<?php echo esc_attr( $s['id'] ); ?>">
	<div class="container">
		<div class="section-head-row">
			<?php get_template_part( 'template-parts/section', 'head', array( 'section' => $s ) ); ?>
			<a class="btn btn-ghost" href="<?php echo esc_url( $blog_url ); ?>" data-reveal><?php esc_html_e( 'Alle Artikel', 'lynnzeischke' ); ?> <span class="arrow" aria-hidden="true">→</span></a>
		</div>
		<div class="grid grid-3 post-grid">
			<?php
			$i = 0;
			while ( $posts->have_posts() ) :
				$posts->the_post();
				get_template_part( 'template-parts/post', 'card', array( 'delay' => $i++ ) );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
