<?php
/**
 * Abschnitt: FAQ (wird zusätzlich als FAQPage-Schema ausgegeben, siehe inc/seo.php).
 *
 * @package lynnzeischke
 */

$s = $args['section'];
?>
<section class="section section-alt" id="<?php echo esc_attr( $s['id'] ); ?>">
	<div class="container">
		<?php get_template_part( 'template-parts/section', 'head', array( 'section' => $s, 'center' => true ) ); ?>
		<div class="faq">
			<?php foreach ( $s['items'] as $i => $item ) : ?>
				<details data-reveal style="--d:<?php echo (int) min( $i, 3 ); ?>">
					<summary><?php echo esc_html( $item[0] ); ?></summary>
					<div><?php echo esc_html( $item[1] ); ?></div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
