<?php
/**
 * Abschnitt: Zielgruppen-Karten (Startseite).
 *
 * @package lynnzeischke
 */

$s = $args['section'];
?>
<section class="section" id="<?php echo esc_attr( $s['id'] ); ?>">
	<div class="container">
		<?php get_template_part( 'template-parts/section', 'head', array( 'section' => $s ) ); ?>
		<div class="grid grid-3 audiences">
			<?php foreach ( $s['items'] as $i => $item ) : ?>
				<a class="card audience spotlight" href="<?php echo esc_url( lz_link( $item['link'] ) ); ?>" data-reveal style="--d:<?php echo (int) $i; ?>">
					<span class="audience-kicker"><?php echo esc_html( $item['kicker'] ); ?></span>
					<span class="icon"><?php echo lz_icon( $item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<h3><?php echo esc_html( $item['title'] ); ?></h3>
					<p><?php echo esc_html( $item['text'] ); ?></p>
					<span class="audience-cta"><?php echo esc_html( $item['cta'] ); ?> <span class="arrow" aria-hidden="true">→</span></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
