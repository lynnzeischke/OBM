<?php
/**
 * Abschnitt: Über mich mit Zählern.
 *
 * @package lynnzeischke
 */

$s = $args['section'];
?>
<section class="section section-dark" id="<?php echo esc_attr( $s['id'] ); ?>">
	<div class="container about">
		<div class="about-photo" data-reveal="left">
			<?php
			if ( lz_opt( 'about_image' ) ) {
				echo wp_get_attachment_image( lz_opt( 'about_image' ), 'large', false, array( 'alt' => 'Lynn Zeischke', 'loading' => 'lazy' ) );
			} else {
				echo '<span class="lz-mark" aria-hidden="true">LZ</span>';
			}
			?>
		</div>
		<div>
			<span class="eyebrow" data-reveal><?php echo esc_html( $s['eyebrow'] ); ?></span>
			<h2 data-reveal style="--d:1"><?php echo esc_html( $s['title'] ); ?></h2>
			<p class="lead" data-reveal style="--d:2"><?php echo esc_html( $s['lead'] ); ?></p>
			<?php foreach ( $s['paras'] as $p ) : ?>
				<p data-reveal style="--d:3"><?php echo esc_html( $p ); ?></p>
			<?php endforeach; ?>
			<div class="facts">
				<?php foreach ( $s['facts'] as $i => $f ) : ?>
					<?php
					$decimals = floor( $f[0] ) != $f[0] ? 1 : 0; // phpcs:ignore Universal.Operators.StrictComparisons.LooseNotEqual
					$display  = number_format( $f[0], $decimals, ',', '.' ) . $f[1];
					?>
					<div class="fact" data-reveal style="--d:<?php echo (int) $i; ?>">
						<strong data-count="<?php echo esc_attr( $f[0] ); ?>" data-decimals="<?php echo (int) $decimals; ?>" data-suffix="<?php echo esc_attr( $f[1] ); ?>"><?php echo esc_html( $display ); ?></strong>
						<span><?php echo esc_html( $f[2] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
			<a class="btn btn-primary magnetic" href="<?php echo esc_url( lz_booking_url() ); ?>"><?php esc_html_e( 'Lernen wir uns kennen', 'lynnzeischke' ); ?> <span class="arrow" aria-hidden="true">→</span></a>
		</div>
	</div>
</section>
