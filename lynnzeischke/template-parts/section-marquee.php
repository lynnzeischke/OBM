<?php
/**
 * Abschnitt: Laufband mit Stichworten.
 *
 * @package lynnzeischke
 */

$items = $args['section']['items'];
?>
<div class="marquee" aria-label="<?php esc_attr_e( 'Themen', 'lynnzeischke' ); ?>">
	<div class="marquee-track">
		<?php for ( $i = 0; $i < 2; $i++ ) : ?>
			<ul<?php echo $i ? ' aria-hidden="true"' : ''; ?>>
				<?php foreach ( $items as $item ) : ?>
					<li><?php echo esc_html( $item ); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endfor; ?>
	</div>
</div>
