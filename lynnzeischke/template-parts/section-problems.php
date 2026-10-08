<?php
/**
 * Abschnitt: „Kennen Sie das?“ – O-Töne.
 *
 * @package lynnzeischke
 */

$s = $args['section'];
?>
<section class="section section-alt" id="<?php echo esc_attr( $s['id'] ); ?>">
	<div class="container">
		<?php get_template_part( 'template-parts/section', 'head', array( 'section' => $s, 'center' => true ) ); ?>
		<div class="grid grid-3">
			<?php foreach ( $s['quotes'] as $i => $quote ) : ?>
				<blockquote class="card quote-card" data-reveal style="--d:<?php echo (int) ( $i % 3 ); ?>"><?php echo esc_html( $quote ); ?></blockquote>
			<?php endforeach; ?>
		</div>
	</div>
</section>
