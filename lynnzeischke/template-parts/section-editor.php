<?php
/**
 * Optionaler Abschnitt: Inhalt aus dem WordPress-Editor der Seite (z. B. /handwerk).
 *
 * @package lynnzeischke
 */

$content = get_post_field( 'post_content', get_queried_object_id() );
if ( ! trim( wp_strip_all_tags( $content ) ) ) {
	return;
}
?>
<section class="section" id="mehr">
	<div class="container prose-wrap">
		<div class="entry-content prose"><?php echo apply_filters( 'the_content', $content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	</div>
</section>
