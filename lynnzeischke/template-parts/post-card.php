<?php
/**
 * Karte für einen Blogartikel.
 *
 * @package lynnzeischke
 */

$delay = isset( $args['delay'] ) ? (int) $args['delay'] : 0;
$cat   = lz_primary_category();
?>
<article <?php post_class( 'card post-card spotlight' ); ?> data-reveal style="--d:<?php echo (int) ( $delay % 3 ); ?>">
	<a class="post-card-media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<span class="post-card-fallback"><span><?php echo esc_html( $cat ? $cat->name : 'Blog' ); ?></span></span>
		<?php endif; ?>
	</a>
	<div class="post-card-body">
		<p class="post-meta">
			<?php if ( $cat ) : ?>
				<span class="post-cat"><?php echo esc_html( $cat->name ); ?></span> ·
			<?php endif; ?>
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time> ·
			<?php echo esc_html( lz_reading_time() ); ?>
		</p>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
		<a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Weiterlesen', 'lynnzeischke' ); ?> <span class="arrow" aria-hidden="true">→</span><span class="screen-reader-text">: <?php the_title(); ?></span></a>
	</div>
</article>
