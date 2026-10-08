<?php
/**
 * Abschnitt: Ablauf in drei Schritten.
 *
 * @package lynnzeischke
 */

$s = $args['section'];
?>
<section class="section section-alt" id="<?php echo esc_attr( $s['id'] ); ?>">
	<div class="container">
		<?php get_template_part( 'template-parts/section', 'head', array( 'section' => $s, 'center' => true ) ); ?>
		<ol class="grid grid-3 steps">
			<?php foreach ( $s['steps'] as $i => $step ) : ?>
				<li class="card step" data-reveal style="--d:<?php echo (int) $i; ?>">
					<h3><?php echo esc_html( $step[0] ); ?></h3>
					<p><?php echo esc_html( $step[1] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
