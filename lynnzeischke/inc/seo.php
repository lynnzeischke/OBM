<?php
/**
 * SEO: Seitentitel, Meta-Beschreibung, Canonical, Open Graph, strukturierte Daten (JSON-LD),
 * robots-Regeln und ein SEO-Feld im Editor.
 *
 * Ist ein SEO-Plugin (Yoast, Rank Math, AIOSEO, SEOPress) aktiv, hält sich das Theme
 * zurück, damit nichts doppelt ausgegeben wird.
 *
 * @package lynnzeischke
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Ist ein SEO-Plugin aktiv?
 */
function lz_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' );
}

/* -------------------------------------------------------------------------
 * SEO-Feld im Editor (Seiten und Beiträge)
 * ---------------------------------------------------------------------- */

/**
 * Felder registrieren.
 */
function lz_register_seo_meta() {
	foreach ( array( 'post', 'page' ) as $type ) {
		foreach ( array( 'lz_seo_title', 'lz_seo_description' ) as $key ) {
			register_post_meta(
				$type,
				$key,
				array(
					'type'              => 'string',
					'single'            => true,
					'show_in_rest'      => true,
					'sanitize_callback' => 'sanitize_text_field',
					'auth_callback'     => function () {
						return current_user_can( 'edit_posts' );
					},
				)
			);
		}
	}
}
add_action( 'init', 'lz_register_seo_meta' );

/**
 * Box im Editor.
 */
function lz_add_seo_box() {
	if ( lz_seo_plugin_active() ) {
		return;
	}
	add_meta_box( 'lz_seo', __( 'SEO (Google-Vorschau)', 'lynnzeischke' ), 'lz_render_seo_box', array( 'post', 'page' ), 'normal', 'low' );
}
add_action( 'add_meta_boxes', 'lz_add_seo_box' );

/**
 * Box-Inhalt.
 *
 * @param WP_Post $post Beitrag.
 */
function lz_render_seo_box( $post ) {
	wp_nonce_field( 'lz_seo_save', 'lz_seo_nonce' );
	$title = get_post_meta( $post->ID, 'lz_seo_title', true );
	$desc  = get_post_meta( $post->ID, 'lz_seo_description', true );
	?>
	<p>
		<label for="lz_seo_title"><strong><?php esc_html_e( 'Titel bei Google', 'lynnzeischke' ); ?></strong> <?php esc_html_e( '(leer = Beitragstitel; ideal 50–60 Zeichen)', 'lynnzeischke' ); ?></label><br>
		<input type="text" id="lz_seo_title" name="lz_seo_title" value="<?php echo esc_attr( $title ); ?>" style="width:100%" maxlength="70">
	</p>
	<p>
		<label for="lz_seo_description"><strong><?php esc_html_e( 'Beschreibung bei Google', 'lynnzeischke' ); ?></strong> <?php esc_html_e( '(leer = Auszug; ideal 140–160 Zeichen)', 'lynnzeischke' ); ?></label><br>
		<textarea id="lz_seo_description" name="lz_seo_description" rows="3" style="width:100%" maxlength="200"><?php echo esc_textarea( $desc ); ?></textarea>
	</p>
	<?php
}

/**
 * Speichern.
 *
 * @param int $post_id Beitrag.
 */
function lz_save_seo_box( $post_id ) {
	if ( ! isset( $_POST['lz_seo_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['lz_seo_nonce'] ) ), 'lz_seo_save' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( array( 'lz_seo_title', 'lz_seo_description' ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			$value = sanitize_text_field( wp_unslash( $_POST[ $key ] ) );
			if ( '' === $value ) {
				delete_post_meta( $post_id, $key );
			} else {
				update_post_meta( $post_id, $key, $value );
			}
		}
	}
}
add_action( 'save_post', 'lz_save_seo_box' );

/* -------------------------------------------------------------------------
 * Daten für die aktuelle Seite
 * ---------------------------------------------------------------------- */

/**
 * Titel, Beschreibung, URL, Bild und Typ der aktuellen Seite.
 *
 * @return array
 */
function lz_seo_data() {
	static $data = null;
	if ( null !== $data ) {
		return $data;
	}

	$site  = get_bloginfo( 'name' );
	$data  = array(
		'title'       => '',
		'description' => lz_opt( 'meta_description' ),
		'url'         => '',
		'image'       => lz_opt( 'hero_image' ) ? wp_get_attachment_image_url( lz_opt( 'hero_image' ), 'large' ) : '',
		'type'        => 'website',
	);
	$key   = lz_current_landing_key();
	$id    = is_singular() ? get_queried_object_id() : 0;
	$paged = max( 1, (int) get_query_var( 'paged' ) );

	if ( $key ) {
		$seo                 = lz_landing( $key )['seo'];
		$data['title']       = $seo['title'];
		$data['description'] = $seo['description'];
		$data['url']         = 'kmu' === $key ? home_url( '/' ) : get_permalink( $id );
	} elseif ( is_singular() ) {
		$post                = get_post( $id );
		$data['title']       = get_the_title( $id ) . ' | ' . $site;
		$data['description'] = has_excerpt( $id ) ? get_the_excerpt( $id ) : wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 28, ' …' );
		$data['url']         = get_permalink( $id );
		if ( has_post_thumbnail( $id ) ) {
			$data['image'] = get_the_post_thumbnail_url( $id, 'large' );
		}
		if ( is_singular( 'post' ) ) {
			$data['type'] = 'article';
		}
	} elseif ( is_home() ) {
		$data['title']       = 'Blog: Buchhaltung, Marketing & Büro-Tipps für KMU | ' . $site;
		$data['description'] = 'Praktische Tipps zu Buchhaltung, E-Rechnung, Google-Profil, Homepage und Personal – für Handwerk, Gastronomie und kleine Unternehmen. Ohne Berater-Sprech.';
		$blog                = get_option( 'page_for_posts' );
		$data['url']         = $blog ? get_permalink( $blog ) : home_url( '/' );
	} elseif ( is_search() ) {
		$data['title'] = sprintf( 'Suche nach „%s“ | %s', get_search_query( false ), $site );
	} elseif ( is_404() ) {
		$data['title'] = 'Seite nicht gefunden | ' . $site;
	} elseif ( is_category() || is_tag() ) {
		$term                = get_queried_object();
		$data['title']       = $term->name . ' – Artikel & Tipps | ' . $site;
		$data['description'] = $term->description ? wp_strip_all_tags( $term->description ) : sprintf( 'Alle Artikel zum Thema %s: praktische Tipps für Ihren Betrieb von Lynn Zeischke.', $term->name );
		$data['url']         = get_term_link( $term );
	}

	// Eigene Werte aus dem SEO-Feld haben Vorrang.
	if ( $id ) {
		$custom_title = get_post_meta( $id, 'lz_seo_title', true );
		$custom_desc  = get_post_meta( $id, 'lz_seo_description', true );
		if ( $custom_title ) {
			$data['title'] = $custom_title;
		}
		if ( $custom_desc ) {
			$data['description'] = $custom_desc;
		}
	}

	if ( $paged > 1 && $data['url'] && ! is_singular() ) {
		$data['url']    = trailingslashit( $data['url'] ) . user_trailingslashit( 'page/' . $paged, 'paged' );
		$data['title'] .= ' – Seite ' . $paged;
	}

	$data['description'] = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $data['description'] ) ) );
	return $data;
}

/**
 * Seitentitel (<title>).
 *
 * @param string $title Bisheriger Titel.
 */
function lz_document_title( $title ) {
	if ( lz_seo_plugin_active() ) {
		return $title;
	}
	$data = lz_seo_data();
	return $data['title'] ? esc_html( $data['title'] ) : $title;
}
add_filter( 'pre_get_document_title', 'lz_document_title' );

/**
 * Meta-Tags im <head>.
 */
function lz_head_meta() {
	if ( lz_seo_plugin_active() ) {
		return;
	}
	$d     = lz_seo_data();
	$title = $d['title'] ? $d['title'] : wp_get_document_title();

	if ( $d['description'] ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $d['description'] ) );
	}
	// WordPress setzt Canonical nur auf Einzelseiten – für Blog und Archive ergänzen.
	if ( ! is_singular() && $d['url'] ) {
		printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $d['url'] ) );
	}

	$og = array(
		'og:locale'      => 'de_DE',
		'og:site_name'   => get_bloginfo( 'name' ),
		'og:type'        => $d['type'],
		'og:title'       => $title,
		'og:description' => $d['description'],
		'og:url'         => $d['url'],
		'og:image'       => $d['image'],
	);
	foreach ( $og as $property => $content ) {
		if ( $content ) {
			printf( '<meta property="%s" content="%s">' . "\n", esc_attr( $property ), esc_attr( $content ) );
		}
	}
	if ( is_singular( 'post' ) ) {
		printf( '<meta property="article:published_time" content="%s">' . "\n", esc_attr( get_the_date( 'c' ) ) );
		printf( '<meta property="article:modified_time" content="%s">' . "\n", esc_attr( get_the_modified_date( 'c' ) ) );
	}
	printf( '<meta name="twitter:card" content="%s">' . "\n", $d['image'] ? 'summary_large_image' : 'summary' );
}
add_action( 'wp_head', 'lz_head_meta', 1 );

/**
 * Suchergebnisse und 404 nicht indexieren.
 *
 * @param array $robots Robots-Direktiven.
 */
function lz_robots( $robots ) {
	if ( is_search() || is_404() ) {
		$robots['noindex'] = true;
		$robots['follow']  = true;
	}
	return $robots;
}
add_filter( 'wp_robots', 'lz_robots' );

/* -------------------------------------------------------------------------
 * Strukturierte Daten (schema.org, JSON-LD)
 * ---------------------------------------------------------------------- */

/**
 * Preis-Text („ab 2.100 €“) in eine Zahl umwandeln.
 *
 * @param string $price Preis.
 */
function lz_price_number( $price ) {
	$digits = preg_replace( '/[^0-9,]/', '', $price );
	return (float) str_replace( ',', '.', $digits );
}

/**
 * JSON-LD ausgeben.
 */
function lz_schema() {
	if ( lz_seo_plugin_active() ) {
		return;
	}
	$home  = home_url( '/' );
	$d     = lz_seo_data();
	$graph = array();

	$org = array(
		'@type'       => 'ProfessionalService',
		'@id'         => $home . '#organisation',
		'name'        => 'Lynn Zeischke – Kaufmännische Beratung & operative Umsetzung',
		'url'         => $home,
		'description' => lz_opt( 'meta_description' ),
		'areaServed'  => array(
			'@type' => 'Country',
			'name'  => 'Deutschland',
		),
		'founder'     => array( '@id' => $home . '#lynn' ),
		'priceRange'  => '€€',
		'knowsLanguage' => 'de',
	);
	if ( lz_opt( 'email' ) ) {
		$org['email'] = lz_opt( 'email' );
	}
	if ( lz_opt( 'phone' ) ) {
		$org['telephone'] = lz_phone_link( lz_opt( 'phone' ) );
	}
	if ( has_custom_logo() ) {
		$org['logo'] = wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' );
	}
	if ( lz_opt( 'hero_image' ) ) {
		$org['image'] = wp_get_attachment_image_url( lz_opt( 'hero_image' ), 'large' );
	}
	$graph[] = $org;

	$graph[] = array(
		'@type'      => 'Person',
		'@id'        => $home . '#lynn',
		'name'       => 'Lynn Zeischke',
		'url'        => $home,
		'jobTitle'   => 'Kaufmännische Beraterin',
		'worksFor'   => array( '@id' => $home . '#organisation' ),
		'description' => lz_opt( 'hero_badge' ),
		'knowsAbout' => array( 'Vorbereitende Buchhaltung', 'E-Rechnung', 'Digitale Büroabläufe', 'Webdesign', 'Online-Marketing', 'Google Unternehmensprofil', 'Gastronomie', 'Handwerk', 'Personalplanung' ),
	);

	$graph[] = array(
		'@type'      => 'WebSite',
		'@id'        => $home . '#website',
		'url'        => $home,
		'name'       => get_bloginfo( 'name' ),
		'inLanguage' => 'de-DE',
		'publisher'  => array( '@id' => $home . '#organisation' ),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => home_url( '/?s={search_term_string}' ),
			'query-input' => 'required name=search_term_string',
		),
	);

	// Webseite selbst.
	if ( $d['url'] ) {
		$page = array(
			'@type'      => is_singular( 'post' ) ? 'WebPage' : ( is_home() || is_archive() ? 'CollectionPage' : 'WebPage' ),
			'@id'        => $d['url'] . '#webpage',
			'url'        => $d['url'],
			'name'       => $d['title'] ? $d['title'] : wp_get_document_title(),
			'description' => $d['description'],
			'isPartOf'   => array( '@id' => $home . '#website' ),
			'inLanguage' => 'de-DE',
		);
		$crumbs = lz_breadcrumb_items();
		if ( count( $crumbs ) > 1 ) {
			$list = array();
			foreach ( $crumbs as $i => $c ) {
				$el = array(
					'@type'    => 'ListItem',
					'position' => $i + 1,
					'name'     => $c[0],
				);
				if ( $c[1] ) {
					$el['item'] = $c[1];
				}
				$list[] = $el;
			}
			$graph[]            = array(
				'@type'           => 'BreadcrumbList',
				'@id'             => $d['url'] . '#breadcrumb',
				'itemListElement' => $list,
			);
			$page['breadcrumb'] = array( '@id' => $d['url'] . '#breadcrumb' );
		}
		$graph[] = $page;
	}

	// Landingpages: Leistung mit Angeboten + FAQ.
	$key = lz_current_landing_key();
	if ( $key ) {
		$landing = lz_landing( $key );
		$service = array(
			'@type'       => 'Service',
			'@id'         => $d['url'] . '#service',
			'name'        => $landing['seo']['service'],
			'description' => $landing['seo']['description'],
			'provider'    => array( '@id' => $home . '#organisation' ),
			'areaServed'  => array(
				'@type' => 'Country',
				'name'  => 'Deutschland',
			),
			'url'         => $d['url'],
		);
		foreach ( $landing['sections'] as $s ) {
			if ( 'packages' === $s['type'] ) {
				$offers = array();
				foreach ( $s['items'] as $p ) {
					$offer = array(
						'@type'         => 'Offer',
						'name'          => $p['name'],
						'description'   => $p['for'],
						'priceCurrency' => 'EUR',
						'price'         => lz_price_number( $p['price'] ),
					);
					if ( ! empty( $p['from'] ) ) {
						$offer['priceSpecification'] = array(
							'@type'                 => 'PriceSpecification',
							'minPrice'              => lz_price_number( $p['price'] ),
							'priceCurrency'         => 'EUR',
							'valueAddedTaxIncluded' => false,
						);
					}
					$offers[] = $offer;
				}
				$service['hasOfferCatalog'] = array(
					'@type'           => 'OfferCatalog',
					'name'            => $s['title'],
					'itemListElement' => $offers,
				);
			}
			if ( 'faq' === $s['type'] ) {
				$questions = array();
				foreach ( $s['items'] as $q ) {
					$questions[] = array(
						'@type'          => 'Question',
						'name'           => $q[0],
						'acceptedAnswer' => array(
							'@type' => 'Answer',
							'text'  => $q[1],
						),
					);
				}
				$graph[] = array(
					'@type'      => 'FAQPage',
					'@id'        => $d['url'] . '#faq',
					'mainEntity' => $questions,
				);
			}
		}
		$graph[] = $service;
	}

	// Blogartikel.
	if ( is_singular( 'post' ) ) {
		$cat     = lz_primary_category();
		$article = array(
			'@type'            => 'BlogPosting',
			'@id'              => $d['url'] . '#article',
			'headline'         => get_the_title(),
			'description'      => $d['description'],
			'datePublished'    => get_the_date( 'c' ),
			'dateModified'     => get_the_modified_date( 'c' ),
			'author'           => array( '@id' => $home . '#lynn' ),
			'publisher'        => array( '@id' => $home . '#organisation' ),
			'mainEntityOfPage' => array( '@id' => $d['url'] . '#webpage' ),
			'inLanguage'       => 'de-DE',
			'wordCount'        => str_word_count( wp_strip_all_tags( get_post_field( 'post_content', get_the_ID() ) ), 0, 'äöüÄÖÜß' ),
		);
		if ( $cat ) {
			$article['articleSection'] = $cat->name;
		}
		if ( $d['image'] ) {
			$article['image'] = $d['image'];
		}
		$graph[] = $article;
	}

	$json = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'lz_schema', 20 );
