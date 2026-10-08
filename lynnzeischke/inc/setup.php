<?php
/**
 * Einrichtung beim Aktivieren des Themes:
 * - Seiten: Start, Handwerk (/handwerk), Gastro (/gastro), Blog (/blog), Impressum (Entwurf)
 * - Startseite und Blogseite festlegen (nur, wenn noch keine statische Startseite gesetzt ist)
 * - sprechende Adressen (/%postname%/), falls noch „einfach“ eingestellt
 * - Blog-Kategorien Handwerk, Gastronomie, KMU & Selbstständige
 * - drei Startartikel als Entwurf
 *
 * Bereits vorhandene Seiten, Kategorien und Artikel werden nicht überschrieben.
 *
 * @package lynnzeischke
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Seite anlegen, falls es unter der Adresse noch keine gibt.
 *
 * @param string $slug    Adresse.
 * @param string $title   Titel.
 * @param string $content Inhalt.
 * @param string $status  Status.
 * @return int Seiten-ID.
 */
function lz_ensure_page( $slug, $title, $content = '', $status = 'publish' ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		return (int) $page->ID;
	}
	return (int) wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_status'  => $status,
			'post_name'    => $slug,
			'post_title'   => $title,
			'post_content' => $content,
		)
	);
}

/**
 * Einfaches HTML in Gutenberg-Blöcke umwandeln (h2/h3, p, ul, ol).
 *
 * @param string $html HTML.
 */
function lz_blockify( $html ) {
	preg_match_all( '#<(h2|h3|p|ul|ol)[^>]*>.*?</\1>#s', $html, $m, PREG_SET_ORDER );
	$out = '';
	foreach ( $m as $el ) {
		switch ( $el[1] ) {
			case 'h2':
				$out .= "<!-- wp:heading -->\n" . str_replace( '<h2>', '<h2 class="wp-block-heading">', $el[0] ) . "\n<!-- /wp:heading -->\n\n";
				break;
			case 'h3':
				$out .= "<!-- wp:heading {\"level\":3} -->\n" . str_replace( '<h3>', '<h3 class="wp-block-heading">', $el[0] ) . "\n<!-- /wp:heading -->\n\n";
				break;
			case 'p':
				$out .= "<!-- wp:paragraph -->\n" . $el[0] . "\n<!-- /wp:paragraph -->\n\n";
				break;
			default:
				$ordered = 'ol' === $el[1];
				$items   = preg_replace( '#<li>(.*?)</li>#s', "<!-- wp:list-item -->\n<li>$1</li>\n<!-- /wp:list-item -->", $el[0] );
				$items   = str_replace( '<' . $el[1] . '>', '<' . $el[1] . ' class="wp-block-list">', $items );
				$out    .= '<!-- wp:list' . ( $ordered ? ' {"ordered":true}' : '' ) . " -->\n" . $items . "\n<!-- /wp:list -->\n\n";
		}
	}
	return $out;
}

/**
 * Kategorie anlegen, falls nicht vorhanden.
 *
 * @param string $slug Adresse.
 * @param string $name Name.
 * @param string $desc Beschreibung (wird auch als Google-Beschreibung genutzt).
 * @return int Term-ID.
 */
function lz_ensure_category( $slug, $name, $desc ) {
	$term = get_category_by_slug( $slug );
	if ( $term ) {
		return (int) $term->term_id;
	}
	$res = wp_insert_term(
		$name,
		'category',
		array(
			'slug'        => $slug,
			'description' => $desc,
		)
	);
	return is_wp_error( $res ) ? 0 : (int) $res['term_id'];
}

/**
 * Alles einrichten.
 */
function lz_setup_site() {
	$done = array();

	// Sprechende Adressen – nur, wenn noch die Standardeinstellung „?p=123“ aktiv ist.
	if ( ! get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
		$done[] = __( 'Permalinks auf „/beitragsname/“ gestellt', 'lynnzeischke' );
	}

	$front = lz_ensure_page( 'start', 'Start' );
	lz_ensure_page( 'handwerk', 'Handwerk' );
	lz_ensure_page( 'gastro', 'Gastronomie' );
	$blog = lz_ensure_page( 'blog', 'Blog' );
	lz_ensure_page(
		'impressum',
		'Impressum',
		lz_blockify( '<h2>Angaben gemäß § 5 DDG</h2><p>Lynn Zeischke<br>[Straße und Hausnummer]<br>[PLZ Ort]</p><h2>Kontakt</h2><p>Telefon: ' . esc_html( lz_opt( 'phone' ) ) . '<br>E-Mail: ' . esc_html( lz_opt( 'email' ) ) . '</p><h2>Umsatzsteuer-ID</h2><p>[Falls vorhanden: Umsatzsteuer-Identifikationsnummer gemäß § 27a UStG]</p><h2>Verantwortlich für den Inhalt</h2><p>Lynn Zeischke, Anschrift wie oben</p>' ),
		'draft'
	);
	$done[] = __( 'Seiten Start, Handwerk, Gastronomie und Blog angelegt (Impressum als Entwurf)', 'lynnzeischke' );

	if ( 'page' !== get_option( 'show_on_front' ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front );
		update_option( 'page_for_posts', $blog );
		$done[] = __( 'Startseite und Blogseite festgelegt', 'lynnzeischke' );
	} elseif ( ! get_option( 'page_for_posts' ) ) {
		update_option( 'page_for_posts', $blog );
	}

	$cats = array(
		'handwerk' => lz_ensure_category( 'handwerk', 'Handwerk', 'Tipps für Handwerksbetriebe: Buchhaltung, E-Rechnung, Homepage, Google-Profil und Betriebsübergabe – praxisnah und ohne Berater-Sprech.' ),
		'gastro'   => lz_ensure_category( 'gastro', 'Gastronomie', 'Tipps für Restaurants, Cafés und Biergärten: Kasse, Wareneinsatz, Dienstplan, Online-Reservierung, Google und Instagram – aus der Gastro für die Gastro.' ),
		'kmu'      => lz_ensure_category( 'kmu', 'KMU & Selbstständige', 'Tipps für kleine Unternehmen und Selbstständige: Büroabläufe, Buchhaltung, Online-Sichtbarkeit und Marketing.' ),
	);
	$done[] = __( 'Blog-Kategorien angelegt', 'lynnzeischke' );

	foreach ( lz_starter_posts() as $post ) {
		if ( get_page_by_path( $post['slug'], OBJECT, 'post' ) ) {
			continue;
		}
		wp_insert_post(
			array(
				'post_type'     => 'post',
				'post_status'   => 'draft',
				'post_name'     => $post['slug'],
				'post_title'    => $post['title'],
				'post_excerpt'  => $post['excerpt'],
				'post_content'  => lz_blockify( $post['content'] ),
				'post_category' => array_filter( array( $cats[ $post['cat'] ] ) ),
				'meta_input'    => array( 'lz_seo_description' => $post['excerpt'] ),
			)
		);
	}
	$done[] = __( 'Drei Startartikel als Entwurf angelegt – bitte prüfen und veröffentlichen', 'lynnzeischke' );

	flush_rewrite_rules();
	update_option( 'lz_setup_version', LZ_VERSION );
	set_transient( 'lz_setup_notice', $done, 10 * MINUTE_IN_SECONDS );
}
add_action( 'after_switch_theme', 'lz_setup_site' );

/**
 * Hinweis im Admin nach der Einrichtung.
 */
function lz_setup_notice() {
	$done = get_transient( 'lz_setup_notice' );
	if ( ! $done || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	delete_transient( 'lz_setup_notice' );
	echo '<div class="notice notice-success is-dismissible"><p><strong>' . esc_html__( 'Theme „Lynn Zeischke“ ist eingerichtet:', 'lynnzeischke' ) . '</strong></p><ul style="list-style:disc;padding-left:20px">';
	foreach ( $done as $line ) {
		echo '<li>' . esc_html( $line ) . '</li>';
	}
	echo '</ul><p>' . esc_html__( 'Nächste Schritte: Impressum ausfüllen und veröffentlichen, Datenschutzerklärung prüfen, Fotos im Customizer hochladen.', 'lynnzeischke' ) . '</p></div>';
}
add_action( 'admin_notices', 'lz_setup_notice' );

/**
 * Drei Startartikel (als Entwurf). Inhalte vor dem Veröffentlichen bitte prüfen.
 *
 * @return array
 */
function lz_starter_posts() {
	return array(
		array(
			'slug'    => 'e-rechnung-handwerk-fristen',
			'cat'     => 'handwerk',
			'title'   => 'E-Rechnung im Handwerk: Was gilt ab wann? Der Überblick bis 2028',
			'excerpt' => 'Seit 2025 müssen Handwerksbetriebe E-Rechnungen empfangen können, ab 2027 bzw. 2028 auch ausstellen. Was das konkret heißt – und was Sie jetzt tun sollten.',
			'content' => '
<p>Die E-Rechnung kommt – und viele Handwerksbetriebe fragen sich: Muss ich jetzt alles umstellen? Die kurze Antwort: Empfangen müssen Sie schon heute können, beim Schreiben haben Sie noch etwas Zeit. Hier ist der Überblick, ohne Fachchinesisch.</p>
<h2>Was ist eine E-Rechnung – und was nicht?</h2>
<p>Eine E-Rechnung ist eine Rechnung in einem strukturierten, maschinenlesbaren Format. In Deutschland sind das vor allem <strong>XRechnung</strong> und <strong>ZUGFeRD</strong> (ab Version 2.0.1). Die Buchhaltungssoftware Ihres Kunden kann die Daten direkt auslesen – ohne Abtippen.</p>
<p>Wichtig: Eine normale PDF-Rechnung per E-Mail ist <strong>keine</strong> E-Rechnung im Sinne des Gesetzes. Auch ein eingescannter Beleg nicht.</p>
<h2>Die Fristen auf einen Blick</h2>
<ul>
<li><strong>Seit 1. Januar 2025:</strong> Alle Unternehmen müssen E-Rechnungen von anderen Unternehmen empfangen und verarbeiten können.</li>
<li><strong>Bis 31. Dezember 2026:</strong> Sie dürfen weiterhin Papier- oder PDF-Rechnungen schreiben.</li>
<li><strong>Ab 1. Januar 2027:</strong> Betriebe mit mehr als 800.000 € Umsatz im Vorjahr müssen E-Rechnungen ausstellen. Kleinere Betriebe dürfen noch ein Jahr lang Papier- und PDF-Rechnungen schicken.</li>
<li><strong>Ab 1. Januar 2028:</strong> Alle Unternehmen stellen an andere Unternehmen nur noch E-Rechnungen aus.</li>
</ul>
<h2>Gilt das auch für Rechnungen an Privatkunden?</h2>
<p>Nein. Die Pflicht betrifft Rechnungen zwischen Unternehmen (B2B). Schreiben Sie dem Ehepaar Müller eine Rechnung für das neue Bad, darf das weiterhin eine PDF- oder Papierrechnung sein. Ebenfalls ausgenommen sind Kleinbetragsrechnungen bis 250 € brutto.</p>
<h2>Was Sie jetzt tun sollten</h2>
<ol>
<li><strong>Eine feste E-Mail-Adresse für Rechnungen</strong> einrichten (z. B. rechnungen@ihr-betrieb.de) und Ihren Lieferanten mitteilen.</li>
<li><strong>Prüfen, ob Ihre Software E-Rechnungen lesen kann.</strong> Eine XRechnung ist im Mailprogramm nur eine unleserliche Datei – Sie brauchen ein Programm, das sie anzeigt.</li>
<li><strong>Richtig ablegen:</strong> E-Rechnungen müssen im Originalformat aufbewahrt werden, nicht nur als Ausdruck.</li>
<li><strong>Mit dem Steuerberater abstimmen,</strong> wie die Rechnungen zu ihm kommen.</li>
<li><strong>Das eigene Rechnungsprogramm prüfen:</strong> Kann es XRechnung oder ZUGFeRD erzeugen? Spätestens 2027 bzw. 2028 brauchen Sie das.</li>
</ol>
<h2>Fazit</h2>
<p>Kein Grund zur Panik – aber auch keiner, es bis Ende 2027 liegen zu lassen. Wer jetzt Empfang und Ablage sauber einrichtet, hat beim Umstieg aufs Ausstellen kaum noch Arbeit.</p>
<p><em>Dieser Artikel gibt einen allgemeinen Überblick und ersetzt keine steuerliche Beratung. Stand: ' . wp_date( 'F Y' ) . '.</em></p>
',
		),
		array(
			'slug'    => 'wareneinsatz-gastronomie-berechnen',
			'cat'     => 'gastro',
			'title'   => 'Wareneinsatz in der Gastronomie berechnen: So wissen Sie, was übrig bleibt',
			'excerpt' => 'Wie Sie Ihren Wareneinsatz und die Wareneinsatzquote richtig berechnen, welche Fehler die Zahl verfälschen und wie Sie jedes Gericht kalkulieren.',
			'content' => '
<p>„Der Laden ist voll, aber am Monatsende bleibt kaum was übrig.“ Diesen Satz habe ich in der Gastro oft gehört – und selbst gedacht. Der erste Schritt raus aus dem Bauchgefühl: den Wareneinsatz kennen.</p>
<h2>Was ist der Wareneinsatz?</h2>
<p>Der Wareneinsatz ist der Wert der Lebensmittel und Getränke, die Sie in einem Zeitraum tatsächlich verbraucht haben. Nicht das, was Sie eingekauft haben – sondern das, was weg ist.</p>
<h2>Die Formel</h2>
<p><strong>Wareneinsatz = Anfangsbestand + Einkäufe − Endbestand</strong></p>
<p>Anfangs- und Endbestand ermitteln Sie per Inventur, Einkäufe stehen auf Ihren Lieferantenrechnungen (netto).</p>
<p><strong>Wareneinsatzquote = Wareneinsatz ÷ Netto-Umsatz × 100</strong></p>
<h3>Ein Beispiel aus der Küche</h3>
<ul>
<li>Anfangsbestand am 1. des Monats: 4.000 €</li>
<li>Einkäufe im Monat: 18.000 €</li>
<li>Endbestand am Monatsende: 3.500 €</li>
<li>Wareneinsatz: 4.000 + 18.000 − 3.500 = <strong>18.500 €</strong></li>
<li>Netto-Umsatz Speisen: 62.000 €</li>
<li>Wareneinsatzquote: 18.500 ÷ 62.000 × 100 = <strong>29,8 %</strong></li>
</ul>
<h2>Speisen und Getränke getrennt rechnen</h2>
<p>Rechnen Sie Küche und Getränke immer getrennt. Getränke haben meist eine ganz andere Quote als Speisen – in einer Gesamtzahl verstecken sich Probleme. Dafür brauchen Sie in der Kasse saubere Warengruppen.</p>
<p>Viele Betriebe orientieren sich grob an 25–35 % in der Küche und 20–30 % bei Getränken. Das hängt aber stark vom Konzept ab. Wichtiger als jeder Branchenwert ist Ihre eigene Entwicklung von Monat zu Monat.</p>
<h2>Fünf typische Gründe für einen zu hohen Wareneinsatz</h2>
<ol>
<li><strong>Portionen sind nicht einheitlich</strong> – jeder in der Küche richtet etwas anders an.</li>
<li><strong>Schwund und Verderb</strong> werden nicht erfasst.</li>
<li><strong>Personalessen und Getränke fürs Team</strong> laufen nirgends mit.</li>
<li><strong>Lieferanten haben die Preise erhöht,</strong> die Karte aber nicht.</li>
<li><strong>Boniert wird ungenau</strong> – etwa Getränke, die raus gehen, aber nicht in der Kasse landen.</li>
</ol>
<h2>Jedes Gericht kalkulieren</h2>
<p>Für jedes Gericht lohnt sich eine kleine Rezeptur-Kalkulation: Was kosten die Zutaten für eine Portion? Daraus ergibt sich, ob der Verkaufspreis passt. Wenn eine Zutat teurer wird, sehen Sie sofort, welche Gerichte betroffen sind.</p>
<h2>So bleiben Sie dran</h2>
<ul>
<li>Inventur immer zum gleichen Stichtag, z. B. am letzten Tag des Monats</li>
<li>Lieferantenrechnungen sofort digital ablegen, nicht erst zum Monatsende</li>
<li>Einmal im Monat die Quote anschauen – 15 Minuten reichen</li>
</ul>
<p>Rechnen Sie dabei immer mit Netto-Beträgen, also ohne Umsatzsteuer. Sonst vergleichen Sie Äpfel mit Birnen.</p>
',
		),
		array(
			'slug'    => 'google-unternehmensprofil-einrichten',
			'cat'     => 'kmu',
			'title'   => 'Google-Unternehmensprofil einrichten: 7 Schritte, damit Kunden Sie finden',
			'excerpt' => 'Wer „in meiner Nähe“ sucht, landet zuerst bei Google Maps. So richten Sie Ihr Google-Unternehmensprofil vollständig ein – Schritt für Schritt.',
			'content' => '
<p>Wenn jemand „Maler in der Nähe“ oder „Restaurant Mittagstisch“ sucht, zeigt Google zuerst eine Karte mit drei Betrieben. Ob Sie dort auftauchen, hängt stark von Ihrem Google-Unternehmensprofil ab. Die gute Nachricht: Es ist kostenlos – und in einem Nachmittag eingerichtet.</p>
<h2>1. Profil beanspruchen und bestätigen</h2>
<p>Suchen Sie Ihren Betrieb bei Google. Gibt es schon einen Eintrag, klicken Sie auf „Inhaber dieses Unternehmens?“. Sonst legen Sie ihn neu an. Google bestätigt anschließend, dass der Betrieb Ihnen gehört – je nach Fall per Video, Telefon, E-Mail oder Postkarte.</p>
<h2>2. Die richtige Kategorie wählen</h2>
<p>Die Hauptkategorie ist einer der wichtigsten Punkte überhaupt. Wählen Sie so genau wie möglich: „Malerbetrieb“ statt „Handwerker“, „Italienisches Restaurant“ statt „Restaurant“. Ergänzen Sie passende Nebenkategorien.</p>
<h2>3. Name, Adresse, Telefon – überall gleich</h2>
<p>Name, Adresse und Telefonnummer sollten auf Google, Ihrer Homepage und in anderen Verzeichnissen exakt gleich geschrieben sein. Arbeiten Sie nur beim Kunden vor Ort, können Sie statt der Adresse ein Einzugsgebiet angeben.</p>
<h2>4. Öffnungszeiten pflegen – auch an Feiertagen</h2>
<p>Falsche Öffnungszeiten sind der schnellste Weg zu einer schlechten Bewertung. Tragen Sie Sonderöffnungszeiten für Feiertage und Betriebsurlaub ein.</p>
<h2>5. Fotos, Fotos, Fotos</h2>
<p>Zeigen Sie Ihre Arbeit, Ihr Team, Ihren Betrieb von außen und innen. Echte Fotos wirken besser als Stockbilder. Laden Sie regelmäßig neue hoch – zum Beispiel nach jedem schönen Auftrag oder einer neuen Karte.</p>
<h2>6. Leistungen oder Speisekarte eintragen</h2>
<p>Beschreiben Sie, was Sie anbieten – mit den Worten, die Ihre Kunden suchen. Gastronomiebetriebe hinterlegen ihre Speisekarte und einen Link zur Reservierung.</p>
<h2>7. Bewertungen sammeln und beantworten</h2>
<p>Bitten Sie zufriedene Kunden aktiv um eine Bewertung, etwa mit einem QR-Code auf der Rechnung. Beantworten Sie jede Bewertung – auch die kritischen, sachlich und freundlich. Gekaufte oder selbst geschriebene Bewertungen sind tabu und können zur Sperrung führen.</p>
<h2>Und danach?</h2>
<p>Ein Profil ist kein Selbstläufer. Schauen Sie einmal im Monat rein: Stimmen die Zeiten? Gibt es neue Bewertungen oder Fragen? Zehn Minuten im Monat reichen oft schon, um vor der Konkurrenz zu bleiben.</p>
',
		),
	);
}
