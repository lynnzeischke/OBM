<?php
/**
 * Abschnitt: Hero mit Schreibmaschinen-Effekt.
 *
 * @package lynnzeischke
 */

$s     = $args['section'];
$words = (array) $s['gold'];
?>
<section class="hero" id="<?php echo esc_attr( $s['id'] ); ?>">
	<div class="hero-grid" aria-hidden="true"></div>
	<div class="hero-orb" aria-hidden="true"></div>
	<div class="container">
		<div class="hero-copy">
			<?php if ( 'kmu' !== $args['key'] ) : ?>
				<?php lz_breadcrumbs(); ?>
			<?php endif; ?>
			<span class="eyebrow" data-reveal><?php echo esc_html( $s['eyebrow'] ); ?></span>
			<h1 data-reveal style="--d:1">
				<?php echo esc_html( $s['title'] ); ?>
				<span class="gold typewriter"<?php echo count( $words ) > 1 ? ' data-words="' . esc_attr( wp_json_encode( $words ) ) . '"' : ''; ?>><span class="tw-text"><?php echo esc_html( $words[0] ); ?></span><span class="tw-cursor" aria-hidden="true">_</span></span>
			</h1>
			<p class="lead" data-reveal style="--d:2"><?php echo esc_html( $s['lead'] ); ?></p>
			<div class="hero-actions" data-reveal style="--d:3">
				<a class="btn btn-primary magnetic" href="<?php echo esc_url( lz_booking_url() ); ?>"><?php esc_html_e( 'Kostenloses Erstgespräch', 'lynnzeischke' ); ?> <span class="arrow" aria-hidden="true">→</span></a>
				<a class="btn btn-ghost" href="<?php echo esc_url( lz_link( $s['cta2'][1] ) ); ?>"><?php echo esc_html( $s['cta2'][0] ); ?></a>
			</div>
			<ul class="trust-list" data-reveal style="--d:4">
				<?php foreach ( $s['trust'] as $t ) : ?>
					<li><?php echo esc_html( $t ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="hero-photo" data-reveal="right" style="--d:2">
			<div class="frame tilt">
				<?php if ( lz_opt( 'hero_image' ) ) : ?>
					<?php echo wp_get_attachment_image( lz_opt( 'hero_image' ), 'large', false, array( 'alt' => 'Lynn Zeischke', 'fetchpriority' => 'high', 'loading' => 'eager' ) ); ?>
				<?php else : ?>
					<div class="placeholder">
						<span class="lz-mark" aria-hidden="true">LZ</span>
						<?php esc_html_e( 'Foto hinzufügen unter Design → Customizer → „Lynn Zeischke – Kontakt & Texte“', 'lynnzeischke' ); ?>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( lz_opt( 'hero_badge' ) ) : ?>
				<div class="hero-badge"><?php echo esc_html( lz_opt( 'hero_badge' ) ); ?></div>
			<?php endif; ?>
		</div>
	</div>
	<a class="scroll-hint" href="#<?php echo esc_attr( lz_next_section_id( $args['page'], $s['id'] ) ); ?>" aria-label="<?php esc_attr_e( 'Weiter nach unten', 'lynnzeischke' ); ?>"><span></span></a>
</section>
