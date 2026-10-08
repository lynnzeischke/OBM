<?php
/**
 * Abschnitt: Ergebnis / Erfahrung – Text + Checkliste.
 *
 * @package lynnzeischke
 */

$s = $args['section'];
?>
<section class="section section-alt" id="<?php echo esc_attr( $s['id'] ); ?>">
	<div class="container benefits">
		<div>
			<span class="eyebrow" data-reveal><?php echo esc_html( $s['eyebrow'] ); ?></span>
			<h2 data-reveal style="--d:1"><?php echo esc_html( $s['title'] ); ?></h2>
			<p class="lead" data-reveal style="--d:2"><?php echo esc_html( $s['text'] ); ?></p>
		</div>
		<ul class="check-list big">
			<?php foreach ( $s['items'] as $i => $item ) : ?>
				<li data-reveal style="--d:<?php echo (int) $i; ?>"><?php echo esc_html( $item ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
