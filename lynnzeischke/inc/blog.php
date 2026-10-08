<?php
/**
 * Blog-Helfer: Lesezeit, Inhaltsverzeichnis, verwandte Artikel, Brotkrumen, Links.
 *
 * @package lynnzeischke
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Interne Links aus inc/content.php auflösen.
 * „/handwerk/“ → https://lynnzeischke.de/handwerk/, „#kontakt“ bleibt auf der Seite.
 *
 * @param string $link Link.
 */
function lz_link( $link ) {
	if ( 0 === strpos( $link, '/' ) ) {
		return home_url( $link );
	}
	return $link;
}

/**
 * ID des Abschnitts nach dem angegebenen (für den Scroll-Pfeil im Hero).
 *
 * @param array  $page Seitendaten.
 * @param string $id   Aktuelle Abschnitts-ID.
 */
function lz_next_section_id( $page, $id ) {
	$found = false;
	foreach ( $page['sections'] as $s ) {
		if ( $found && ! empty( $s['id'] ) ) {
			return $s['id'];
		}
		if ( isset( $s['id'] ) && $s['id'] === $id ) {
			$found = true;
		}
	}
	return 'kontakt';
}

/**
 * Geschätzte Lesezeit.
 *
 * @param int|null $post_id Beitrag.
 */
function lz_reading_time( $post_id = null ) {
	$words   = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ? $post_id : get_the_ID() ) ), 0, 'äöüÄÖÜß' );
	$minutes = max( 1, (int) ceil( $words / 200 ) );
	/* translators: %d: Minuten */
	return sprintf( _n( '%d Min. Lesezeit', '%d Min. Lesezeit', $minutes, 'lynnzeischke' ), $minutes );
}

/**
 * Erste (Haupt-)Kategorie eines Beitrags, „Allgemein“ wird übersprungen.
 *
 * @return WP_Term|null
 */
function lz_primary_category() {
	$cats = get_the_category();
	foreach ( $cats as $cat ) {
		if ( ! in_array( $cat->slug, array( 'uncategorized', 'allgemein' ), true ) ) {
			return $cat;
		}
	}
	return $cats ? $cats[0] : null;
}

/**
 * Überschriften (h2, h3) mit Sprungmarken versehen.
 *
 * @param string $content HTML.
 */
function lz_prepare_content( $content ) {
	$used = array();
	return preg_replace_callback(
		'#<h([23])([^>]*)>(.*?)</h\1>#is',
		function ( $m ) use ( &$used ) {
			if ( false !== stripos( $m[2], 'id=' ) ) {
				return $m[0];
			}
			$base = sanitize_title( wp_strip_all_tags( $m[3] ) );
			$id   = $base ? $base : 'abschnitt';
			$n    = 2;
			while ( isset( $used[ $id ] ) ) {
				$id = $base . '-' . $n++;
			}
			$used[ $id ] = true;
			return sprintf( '<h%1$s id="%2$s"%3$s>%4$s</h%1$s>', $m[1], esc_attr( $id ), $m[2], $m[3] );
		},
		$content
	);
}

/**
 * Inhaltsverzeichnis aus den h2-Überschriften (ab drei Stück).
 *
 * @param string $content HTML mit IDs.
 * @return array
 */
function lz_toc_from_content( $content ) {
	preg_match_all( '#<h2[^>]*id="([^"]+)"[^>]*>(.*?)</h2>#is', $content, $m, PREG_SET_ORDER );
	if ( count( $m ) < 3 ) {
		return array();
	}
	return array_map(
		function ( $h ) {
			return array(
				'id'   => $h[1],
				'text' => wp_strip_all_tags( $h[2] ),
			);
		},
		$m
	);
}

/**
 * Passender Aufruf am Artikelende – je nach Kategorie.
 *
 * @param WP_Term|null $cat Kategorie.
 */
function lz_cta_for_category( $cat ) {
	$slug = $cat ? $cat->slug : '';
	if ( 'handwerk' === $slug ) {
		return array(
			'title' => 'Weniger Büro. Mehr Zeit fürs Handwerk.',
			'text'  => 'Ich kümmere mich um Belege, E-Rechnung, Homepage und Google – aus einer Hand, zum Festpreis.',
			'link'  => '/handwerk/',
			'label' => 'Angebot für Handwerksbetriebe',
		);
	}
	if ( 'gastro' === $slug ) {
		return array(
			'title' => 'Weniger Zettelkram. Mehr Zeit für Ihre Gäste.',
			'text'  => 'Kasse, Wareneinsatz, Dienstplan und Online-Auftritt – von jemandem, der selbst hinterm Tresen stand.',
			'link'  => '/gastro/',
			'label' => 'Angebot für die Gastronomie',
		);
	}
	return array(
		'title' => 'Lieber gleich jemanden, der sich kümmert?',
		'text'  => 'Von Website & Marketing über digitale Büroabläufe bis zur vorbereitenden Buchhaltung – alles aus einer Hand.',
		'link'  => '/',
		'label' => 'Alle Leistungen ansehen',
	);
}

/**
 * Verwandte Artikel (gleiche Kategorie, sonst neueste).
 *
 * @param int $count Anzahl.
 * @return WP_Query
 */
function lz_related_posts( $count = 3 ) {
	$args = array(
		'posts_per_page'      => $count,
		'post__not_in'        => array( get_the_ID() ),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	);
	$cats = wp_get_post_categories( get_the_ID() );
	if ( $cats ) {
		$args['category__in'] = $cats;
	}
	$q = new WP_Query( $args );
	if ( ! $q->have_posts() && $cats ) {
		unset( $args['category__in'] );
		$q = new WP_Query( $args );
	}
	return $q;
}

/**
 * Suche nur in Blogartikeln.
 *
 * @param WP_Query $query Abfrage.
 */
function lz_search_posts_only( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
		$query->set( 'post_type', 'post' );
	}
}
add_action( 'pre_get_posts', 'lz_search_posts_only' );

/**
 * Auszüge: kürzer und ohne „[…]“.
 */
add_filter(
	'excerpt_length',
	function () {
		return 30;
	}
);
add_filter(
	'excerpt_more',
	function () {
		return ' …';
	}
);

/**
 * Brotkrumen-Pfad als Liste von [Titel, URL].
 *
 * @return array
 */
function lz_breadcrumb_items() {
	$items = array( array( 'Start', home_url( '/' ) ) );
	$blog  = get_option( 'page_for_posts' );
	$blog_item = $blog ? array( get_the_title( $blog ), get_permalink( $blog ) ) : null;

	if ( is_front_page() ) {
		return array();
	}
	if ( is_home() ) {
		$items[] = $blog_item ? $blog_item : array( 'Blog', '' );
	} elseif ( is_singular( 'post' ) ) {
		if ( $blog_item ) {
			$items[] = $blog_item;
		}
		$cat = lz_primary_category();
		if ( $cat ) {
			$items[] = array( $cat->name, get_category_link( $cat ) );
		}
		$items[] = array( get_the_title(), get_permalink() );
	} elseif ( is_page() ) {
		foreach ( array_reverse( get_post_ancestors( get_the_ID() ) ) as $ancestor ) {
			$items[] = array( get_the_title( $ancestor ), get_permalink( $ancestor ) );
		}
		$items[] = array( get_the_title(), get_permalink() );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		if ( $blog_item ) {
			$items[] = $blog_item;
		}
		$term    = get_queried_object();
		$items[] = array( $term->name, get_term_link( $term ) );
	} elseif ( is_search() ) {
		$items[] = array( 'Suche', '' );
	} elseif ( is_archive() ) {
		if ( $blog_item ) {
			$items[] = $blog_item;
		}
		$items[] = array( wp_strip_all_tags( get_the_archive_title() ), '' );
	}
	return $items;
}

/**
 * Sichtbare Brotkrumen ausgeben.
 */
function lz_breadcrumbs() {
	$items = lz_breadcrumb_items();
	if ( count( $items ) < 2 ) {
		return;
	}
	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Brotkrumen', 'lynnzeischke' ) . '"><ol>';
	$last = count( $items ) - 1;
	foreach ( $items as $i => $item ) {
		if ( $i === $last || ! $item[1] ) {
			printf( '<li><span aria-current="page">%s</span></li>', esc_html( $item[0] ) );
		} else {
			printf( '<li><a href="%s">%s</a></li>', esc_url( $item[1] ), esc_html( $item[0] ) );
		}
	}
	echo '</ol></nav>';
}
