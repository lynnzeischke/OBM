<?php
/**
 * Abschnitt: Pakete & Preise.
 *
 * @package lynnzeischke
 */

$s    = $args['section'];
$cols = isset( $s['cols'] ) ? (int) $s['cols'] : 3;
?>
<section class="section" id="<?php echo esc_attr( $s['id'] ); ?>">
	<div class="container">
		<?php get_template_part( 'template-parts/section', 'head', array( 'section' => $s, 'center' => true ) ); ?>

		<div class="grid grid-<?php echo esc_attr( $cols ); ?> packages">
			<?php foreach ( $s['items'] as $i => $p ) : ?>
				<div class="card package spotlight<?php echo ! empty( $p['featured'] ) ? ' featured' : ''; ?>" data-reveal style="--d:<?php echo (int) $i; ?>">
					<?php if ( ! empty( $p['badge'] ) ) : ?>
						<span class="badge"><?php echo esc_html( $p['badge'] ); ?></span>
					<?php endif; ?>
					<h3><?php echo esc_html( $p['name'] ); ?></h3>
					<p class="price"><?php if ( ! empty( $p['from'] ) ) : ?><small><?php esc_html_e( 'ab', 'lynnzeischke' ); ?></small> <?php endif; ?><?php echo esc_html( $p['price'] ); ?></p>
					<p class="for"><?php echo esc_html( $p['for'] ); ?></p>
					<ul class="check-list">
						<?php foreach ( $p['features'] as $f ) : ?>
							<li><?php echo esc_html( $f ); ?></li>
						<?php endforeach; ?>
					</ul>
					<?php if ( ! empty( $p['links'] ) ) : ?>
						<div class="package-links">
							<?php foreach ( $p['links'] as $l ) : ?>
								<a class="btn btn-ghost" href="<?php echo esc_url( lz_link( $l[1] ) ); ?>"><?php echo esc_html( $l[0] ); ?> <span class="arrow" aria-hidden="true">→</span></a>
							<?php endforeach; ?>
						</div>
					<?php else : ?>
						<?php $cta = isset( $p['cta'] ) ? $p['cta'] : array( __( 'Anfragen', 'lynnzeischke' ), '#kontakt' ); ?>
						<a class="btn <?php echo ! empty( $p['featured'] ) ? 'btn-primary' : 'btn-ghost'; ?>" href="<?php echo esc_url( lz_link( $cta[1] ) ); ?>" data-package="<?php echo esc_attr( $p['name'] ); ?>"><?php echo esc_html( $cta[0] ); ?></a>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( ! empty( $s['extras'] ) ) : ?>
			<div class="extras" data-reveal>
				<h3><?php esc_html_e( 'Lieber klein anfangen? Einzelne Bausteine', 'lynnzeischke' ); ?></h3>
				<table>
					<tbody>
						<?php foreach ( $s['extras'] as $e ) : ?>
							<tr>
								<td><strong><?php echo esc_html( $e[0] ); ?></strong><br><span><?php echo esc_html( $e[1] ); ?></span></td>
								<td><?php echo esc_html( $e[2] ); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $s['note'] ) ) : ?>
			<p class="price-note"><?php echo esc_html( $s['note'] ); ?></p>
		<?php endif; ?>
	</div>
</section>
