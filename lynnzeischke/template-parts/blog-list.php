<?php
/**
 * Artikel-Liste mit Seitennavigation (nutzt die Hauptabfrage).
 *
 * @package lynnzeischke
 */

?>
<section class="section blog-list">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="grid grid-3 post-grid">
				<?php
				$i = 0;
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/post', 'card', array( 'delay' => $i++ ) );
				endwhile;
				?>
			</div>
			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 1,
					'prev_text' => '←<span class="screen-reader-text"> ' . esc_html__( 'Zurück', 'lynnzeischke' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Weiter', 'lynnzeischke' ) . ' </span>→',
				)
			);
			?>
		<?php else : ?>
			<div class="empty-state">
				<span class="lz-mark" aria-hidden="true">LZ</span>
				<h2><?php esc_html_e( 'Hier gibt es noch keine Artikel.', 'lynnzeischke' ); ?></h2>
				<p><?php esc_html_e( 'Die ersten Beiträge sind in Arbeit. Bis dahin: Fragen Sie mich einfach direkt.', 'lynnzeischke' ); ?></p>
				<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/#kontakt' ) ); ?>"><?php esc_html_e( 'Kostenloses Erstgespräch', 'lynnzeischke' ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</section>
