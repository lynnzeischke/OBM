<?php
/**
 * Suchformular.
 *
 * @package lynnzeischke
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="lz-search"><?php esc_html_e( 'Suche nach:', 'lynnzeischke' ); ?></label>
	<input type="search" id="lz-search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Artikel durchsuchen …', 'lynnzeischke' ); ?>">
	<button type="submit" aria-label="<?php esc_attr_e( 'Suchen', 'lynnzeischke' ); ?>"><?php echo lz_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
</form>
