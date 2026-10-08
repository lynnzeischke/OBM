<?php
/**
 * Überschriftenblock eines Abschnitts.
 *
 * @package lynnzeischke
 */

$s     = $args['section'];
$class = isset( $args['center'] ) && $args['center'] ? ' center' : '';
?>
<div class="section-head<?php echo esc_attr( $class ); ?>">
	<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
		<span class="eyebrow" data-reveal><?php echo esc_html( $s['eyebrow'] ); ?></span>
	<?php endif; ?>
	<h2 data-reveal style="--d:1"><?php echo esc_html( $s['title'] ); ?></h2>
	<?php if ( ! empty( $s['lead'] ) ) : ?>
		<p class="lead" data-reveal style="--d:2"><?php echo esc_html( $s['lead'] ); ?></p>
	<?php endif; ?>
</div>
