<?php
/**
 * Kategorie-Filter und Suche über der Blog-Liste.
 *
 * @package lynnzeischke
 */

$cats     = get_categories( array( 'hide_empty' => true ) );
$current  = is_category() ? get_queried_object_id() : 0;
$blog_url = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' );
?>
<div class="blog-tools" data-reveal style="--d:3">
	<nav class="chips" aria-label="<?php esc_attr_e( 'Kategorien', 'lynnzeischke' ); ?>">
		<a class="chip<?php echo is_home() ? ' is-active' : ''; ?>" href="<?php echo esc_url( $blog_url ); ?>"><?php esc_html_e( 'Alle', 'lynnzeischke' ); ?></a>
		<?php foreach ( $cats as $cat ) : ?>
			<?php
			if ( 'uncategorized' === $cat->slug || 'allgemein' === $cat->slug ) {
				continue;
			}
			?>
			<a class="chip<?php echo $current === $cat->term_id ? ' is-active' : ''; ?>" href="<?php echo esc_url( get_category_link( $cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
		<?php endforeach; ?>
	</nav>
	<?php get_search_form(); ?>
</div>
