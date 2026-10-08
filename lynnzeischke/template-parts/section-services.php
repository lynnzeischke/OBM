<?php
/**
 * Abschnitt: Leistungen.
 *
 * @package lynnzeischke
 */

$s    = $args['section'];
$cols = isset( $s['cols'] ) ? (int) $s['cols'] : 3;
?>
<section class="section" id="<?php echo esc_attr( $s['id'] ); ?>">
	<div class="container">
		<?php get_template_part( 'template-parts/section', 'head', array( 'section' => $s ) ); ?>
		<div class="grid grid-<?php echo esc_attr( $cols ); ?>">
			<?php foreach ( $s['items'] as $i => $item ) : ?>
				<div class="card spotlight service" data-reveal style="--d:<?php echo (int) ( $i % $cols ); ?>">
					<span class="service-num">0<?php echo (int) $i + 1; ?></span>
					<div class="icon"><?php echo lz_icon( $item[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
					<h3><?php echo esc_html( $item[1] ); ?></h3>
					<p><?php echo esc_html( $item[2] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
