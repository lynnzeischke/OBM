<?php
/**
 * Startseite (One-Pager).
 * Wird automatisch genutzt, wenn unter Einstellungen → Lesen eine statische Startseite
 * gewählt ist – oder wenn die neuesten Beiträge auf der Startseite stehen.
 *
 * @package lynnzeischke
 */

get_header();

$booking   = lz_booking_url();
$is_extern = 0 === strpos( $booking, 'http' );
$target    = $is_extern ? ' target="_blank" rel="noopener"' : '';
?>

<!-- ================= HERO ================= -->
<section class="hero">
	<div class="container">
		<div>
			<span class="eyebrow"><?php esc_html_e( 'Für Handwerk & Gastronomie', 'lynnzeischke' ); ?></span>
			<h1><?php esc_html_e( 'Weniger Papierkram. Mehr Zeit für Ihren Betrieb.', 'lynnzeischke' ); ?></h1>
			<p class="lead">
				<?php esc_html_e( 'Ich kümmere mich um Belege, Google-Profil und Homepage – aus einer Hand und zum Festpreis. Damit Sie sich um Ihre Kunden und Gäste kümmern können und Ihr Wochenende wieder Ihnen gehört.', 'lynnzeischke' ); ?>
			</p>
			<div class="hero-actions">
				<a class="btn btn-primary" href="<?php echo esc_url( $booking ); ?>"<?php echo $target; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php esc_html_e( 'Kostenloses Erstgespräch', 'lynnzeischke' ); ?></a>
				<a class="btn btn-ghost" href="#pakete"><?php esc_html_e( 'Pakete & Preise ansehen', 'lynnzeischke' ); ?></a>
			</div>
			<ul class="trust-list">
				<li><?php esc_html_e( 'Ein fester Ansprechpartner', 'lynnzeischke' ); ?></li>
				<li><?php esc_html_e( 'Festpreise ohne Überraschungen', 'lynnzeischke' ); ?></li>
				<li><?php esc_html_e( 'Kein Abo, keine Mindestlaufzeit', 'lynnzeischke' ); ?></li>
			</ul>
		</div>
		<div class="hero-photo">
			<?php if ( lz_opt( 'hero_image' ) ) : ?>
				<?php echo wp_get_attachment_image( lz_opt( 'hero_image' ), 'large', false, array( 'alt' => 'Lynn Zeischke', 'fetchpriority' => 'high' ) ); ?>
			<?php else : ?>
				<div class="placeholder"><?php esc_html_e( 'Foto hinzufügen unter Design → Customizer → „Lynn Zeischke – Kontakt & Texte“', 'lynnzeischke' ); ?></div>
			<?php endif; ?>
			<div class="hero-badge">
				<strong><?php esc_html_e( 'Aus der Praxis, nicht aus dem Lehrbuch', 'lynnzeischke' ); ?></strong>
				<?php esc_html_e( 'Selbst einen Biergarten mit 40 Leuten mit aufgebaut.', 'lynnzeischke' ); ?>
			</div>
		</div>
	</div>
</section>

<!-- ================= KENNEN SIE DAS? ================= -->
<section class="section section-alt">
	<div class="container">
		<div class="section-head center">
			<span class="eyebrow"><?php esc_html_e( 'Kennen Sie das?', 'lynnzeischke' ); ?></span>
			<h2><?php esc_html_e( 'Das Geschäft läuft. Alles drumherum frisst Ihre Abende.', 'lynnzeischke' ); ?></h2>
		</div>
		<div class="grid grid-3">
			<div class="card quote-card"><?php esc_html_e( 'Die Belege stapeln sich – und am Wochenende sitz ich wieder am Rechner statt bei der Familie.', 'lynnzeischke' ); ?></div>
			<div class="card quote-card"><?php esc_html_e( 'Unsere Homepage ist noch von meinem Vater. Peinlich, wenn vorher einer googelt.', 'lynnzeischke' ); ?></div>
			<div class="card quote-card"><?php esc_html_e( 'Ich weiß nie genau, ob ich alles richtig für den Steuerberater vorbereitet hab.', 'lynnzeischke' ); ?></div>
			<div class="card quote-card"><?php esc_html_e( 'Das Telefon klingelt immer dann, wenn der Laden voll ist.', 'lynnzeischke' ); ?></div>
			<div class="card quote-card"><?php esc_html_e( 'Auf Google stehen noch die alten Öffnungszeiten – und die Bewertungen hat keiner beantwortet.', 'lynnzeischke' ); ?></div>
			<div class="card quote-card"><?php esc_html_e( 'Ich hatte schon drei Dienstleister. Keiner hat gesagt, was es am Ende kostet.', 'lynnzeischke' ); ?></div>
		</div>
	</div>
</section>

<!-- ================= LEISTUNGEN ================= -->
<section class="section" id="leistungen">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow"><?php esc_html_e( 'Leistungen', 'lynnzeischke' ); ?></span>
			<h2><?php esc_html_e( 'Ich kümmere mich – Sie bekommen fertige Ergebnisse.', 'lynnzeischke' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'Statt drei Dienstleistern haben Sie eine Ansprechpartnerin, die Ihren Betrieb kennt.', 'lynnzeischke' ); ?></p>
		</div>
		<div class="grid grid-4">
			<div class="card">
				<div class="icon"><?php echo lz_icon( 'beleg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				<h3><?php esc_html_e( 'Buchhaltung & Belege', 'lynnzeischke' ); ?></h3>
				<p><?php esc_html_e( 'Belege und Rechnungen digital und geordnet – sauber vorbereitet für Ihren Steuerberater. Inklusive E-Rechnung.', 'lynnzeischke' ); ?></p>
			</div>
			<div class="card">
				<div class="icon"><?php echo lz_icon( 'google' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				<h3><?php esc_html_e( 'Google & Social Media', 'lynnzeischke' ); ?></h3>
				<p><?php esc_html_e( 'Vollständiges Google-Profil, beantwortete Bewertungen und ein Instagram-Auftritt, der zu Ihrer Arbeit passt.', 'lynnzeischke' ); ?></p>
			</div>
			<div class="card">
				<div class="icon"><?php echo lz_icon( 'web' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				<h3><?php esc_html_e( 'Homepage', 'lynnzeischke' ); ?></h3>
				<p><?php esc_html_e( 'Eine moderne Seite, die auf dem Handy funktioniert und Anfragen bringt – mit Online-Reservierung oder Kontaktformular.', 'lynnzeischke' ); ?></p>
			</div>
			<div class="card">
				<div class="icon"><?php echo lz_icon( 'team' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				<h3><?php esc_html_e( 'Personal & Abläufe', 'lynnzeischke' ); ?></h3>
				<p><?php esc_html_e( 'Dienstplan aufs Handy, Zeiterfassung, Einarbeitung neuer Leute – und Abläufe aufgeschrieben, damit der Betrieb auch ohne Sie läuft.', 'lynnzeischke' ); ?></p>
			</div>
		</div>
	</div>
</section>

<!-- ================= FÜR WEN ================= -->
<section class="section section-alt" id="fuer-wen">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow"><?php esc_html_e( 'Für wen', 'lynnzeischke' ); ?></span>
			<h2><?php esc_html_e( 'Für inhabergeführte Betriebe – nicht für Konzerne.', 'lynnzeischke' ); ?></h2>
		</div>

		<div class="tabs" role="tablist">
			<button class="tab-btn" role="tab" id="tab-handwerk" aria-controls="panel-handwerk" aria-selected="true"><?php esc_html_e( 'Handwerk', 'lynnzeischke' ); ?></button>
			<button class="tab-btn" role="tab" id="tab-gastro" aria-controls="panel-gastro" aria-selected="false" tabindex="-1"><?php esc_html_e( 'Gastronomie', 'lynnzeischke' ); ?></button>
		</div>

		<div class="tab-panel grid grid-2" id="panel-handwerk" role="tabpanel" aria-labelledby="tab-handwerk">
			<div>
				<h3><?php esc_html_e( 'Handwerksbetriebe bis 15 Mitarbeitende', 'lynnzeischke' ); ?></h3>
				<p><?php esc_html_e( 'Bau, Ausbau, Maler, Schreinerei, Kfz-Werkstatt, Friseursalon: Ihre Arbeit ist gut. Ihr Auftritt und Ihr Büro sollen es auch sein.', 'lynnzeischke' ); ?></p>
			</div>
			<ul class="check-list">
				<li><?php esc_html_e( 'Belege nicht mehr abends und am Wochenende nachholen', 'lynnzeischke' ); ?></li>
				<li><?php esc_html_e( 'E-Rechnungen schreiben und empfangen – ohne Kopfzerbrechen', 'lynnzeischke' ); ?></li>
				<li><?php esc_html_e( 'Eine Homepage, die zur Qualität Ihrer Arbeit passt', 'lynnzeischke' ); ?></li>
				<li><?php esc_html_e( 'Bei Google gefunden werden – mit guten Bewertungen', 'lynnzeischke' ); ?></li>
				<li><?php esc_html_e( 'Ihr Wissen aufschreiben, bevor die Übergabe ansteht', 'lynnzeischke' ); ?></li>
			</ul>
		</div>

		<div class="tab-panel grid grid-2" id="panel-gastro" role="tabpanel" aria-labelledby="tab-gastro" hidden>
			<div>
				<h3><?php esc_html_e( 'Restaurants, Cafés, Biergärten, Gasthöfe', 'lynnzeischke' ); ?></h3>
				<p><?php esc_html_e( 'Aus der Gastro für die Gastro: Ich habe selbst hinterm Tresen gestanden und einen Biergarten mit aufgebaut. Ich kenne Schichtplan, Kassenabschluss und Samstagabend voll besetzt.', 'lynnzeischke' ); ?></p>
			</div>
			<ul class="check-list">
				<li><?php esc_html_e( 'Wissen, was am Ende übrig bleibt – Wareneinsatz und Personalkosten im Blick', 'lynnzeischke' ); ?></li>
				<li><?php esc_html_e( 'Kassenabschlüsse, Z-Bons und Lieferantenrechnungen geordnet', 'lynnzeischke' ); ?></li>
				<li><?php esc_html_e( 'Online-Reservierung statt Telefon im Service', 'lynnzeischke' ); ?></li>
				<li><?php esc_html_e( 'Speisekarte und Mittagstisch aktuell auf Homepage und Google', 'lynnzeischke' ); ?></li>
				<li><?php esc_html_e( 'Dienstplan aufs Handy – und Aushilfen, die wiederkommen', 'lynnzeischke' ); ?></li>
			</ul>
		</div>
	</div>
</section>

<!-- ================= PAKETE ================= -->
<section class="section" id="pakete">
	<div class="container">
		<div class="section-head center">
			<span class="eyebrow"><?php esc_html_e( 'Pakete & Preise', 'lynnzeischke' ); ?></span>
			<h2><?php esc_html_e( 'Klarer Preis. Keine Überraschungen.', 'lynnzeischke' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'Sie wissen vorher, was es kostet. Im Erstgespräch schauen wir, welches Paket zu Ihnen passt – oder ob ein einzelner Baustein reicht.', 'lynnzeischke' ); ?></p>
		</div>

		<div class="grid grid-3">
			<div class="card package">
				<h3><?php esc_html_e( 'Neu am Start', 'lynnzeischke' ); ?></h3>
				<p class="price"><small><?php esc_html_e( 'ab', 'lynnzeischke' ); ?></small> 1.490 €</p>
				<p class="for"><?php esc_html_e( 'Für Gründer:innen und junge Betriebe, die gefunden werden wollen.', 'lynnzeischke' ); ?></p>
				<ul class="check-list">
					<li><?php esc_html_e( 'Google-Profil komplett eingerichtet', 'lynnzeischke' ); ?></li>
					<li><?php esc_html_e( 'Schlanke Homepage, fürs Handy gemacht', 'lynnzeischke' ); ?></li>
					<li><?php esc_html_e( 'Instagram-Grundaufbau', 'lynnzeischke' ); ?></li>
					<li><?php esc_html_e( 'Einfaches System für Rechnungen und Belege – von Anfang an', 'lynnzeischke' ); ?></li>
				</ul>
				<a class="btn btn-ghost" href="#kontakt"><?php esc_html_e( 'Anfragen', 'lynnzeischke' ); ?></a>
			</div>

			<div class="card package featured">
				<span class="badge"><?php esc_html_e( 'Am häufigsten gewählt', 'lynnzeischke' ); ?></span>
				<h3><?php esc_html_e( 'Digital nachrüsten', 'lynnzeischke' ); ?></h3>
				<p class="price"><small><?php esc_html_e( 'ab', 'lynnzeischke' ); ?></small> 2.100 €</p>
				<p class="for"><?php esc_html_e( 'Für etablierte Betriebe, bei denen das Drumherum nicht mehr hinterherkommt.', 'lynnzeischke' ); ?></p>
				<ul class="check-list">
					<li><?php esc_html_e( 'Belege und Rechnungen digital – E-Rechnung inklusive', 'lynnzeischke' ); ?></li>
					<li><?php esc_html_e( 'Saubere Übergabe an Ihren Steuerberater', 'lynnzeischke' ); ?></li>
					<li><?php esc_html_e( 'Neue Homepage, die auf dem Handy funktioniert', 'lynnzeischke' ); ?></li>
					<li><?php esc_html_e( 'Google-Profil vollständig, Bewertungen im Griff', 'lynnzeischke' ); ?></li>
					<li><?php esc_html_e( 'Ein fester Ansprechpartner für alles', 'lynnzeischke' ); ?></li>
				</ul>
				<a class="btn btn-primary" href="#kontakt"><?php esc_html_e( 'Anfragen', 'lynnzeischke' ); ?></a>
			</div>

			<div class="card package">
				<h3><?php esc_html_e( 'Fit für die Übergabe', 'lynnzeischke' ); ?></h3>
				<p class="price"><small><?php esc_html_e( 'ab', 'lynnzeischke' ); ?></small> 2.000 €</p>
				<p class="for"><?php esc_html_e( 'Für Inhaber:innen, die den Betrieb in den nächsten Jahren weitergeben.', 'lynnzeischke' ); ?></p>
				<ul class="check-list">
					<li><?php esc_html_e( 'Abläufe in Ruhe aufschreiben – Schritt für Schritt', 'lynnzeischke' ); ?></li>
					<li><?php esc_html_e( 'Kalkulation, Kunden und Lieferanten dokumentiert', 'lynnzeischke' ); ?></li>
					<li><?php esc_html_e( 'Zugänge und Passwörter sicher geordnet', 'lynnzeischke' ); ?></li>
					<li><?php esc_html_e( 'Ordnen statt umkrempeln – Ihr Wissen bleibt im Betrieb', 'lynnzeischke' ); ?></li>
				</ul>
				<a class="btn btn-ghost" href="#kontakt"><?php esc_html_e( 'Anfragen', 'lynnzeischke' ); ?></a>
			</div>
		</div>

		<div class="extras">
			<h3><?php esc_html_e( 'Lieber klein anfangen? Einzelne Bausteine', 'lynnzeischke' ); ?></h3>
			<table>
				<tbody>
					<tr>
						<td><strong><?php esc_html_e( 'Ehrliche Bestandsaufnahme', 'lynnzeischke' ); ?></strong><br><?php esc_html_e( 'Ich schaue mir Büro, Homepage und Google-Auftritt an und sage Ihnen, was sich lohnt – und was nicht.', 'lynnzeischke' ); ?></td>
						<td>450 €</td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'Google-Profil einrichten', 'lynnzeischke' ); ?></strong><br><?php esc_html_e( 'Öffnungszeiten, Fotos, Leistungen – vollständig und richtig.', 'lynnzeischke' ); ?></td>
						<td><?php esc_html_e( 'ab', 'lynnzeischke' ); ?> 100 €</td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'Foto- und Video-Termin vor Ort', 'lynnzeischke' ); ?></strong><br><?php esc_html_e( 'Ein Termin, Bilder und Reels für Wochen.', 'lynnzeischke' ); ?></td>
						<td>350 €</td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'Laufende Begleitung', 'lynnzeischke' ); ?></strong><br><?php esc_html_e( 'Auf Wunsch kümmere ich mich dauerhaft – monatlich kündbar.', 'lynnzeischke' ); ?></td>
						<td>150 € / <?php esc_html_e( 'Monat', 'lynnzeischke' ); ?></td>
					</tr>
				</tbody>
			</table>
			<p class="price-note"><?php esc_html_e( 'Alle Preise netto zzgl. gesetzlicher Umsatzsteuer. Den genauen Festpreis bekommen Sie nach dem Erstgespräch schriftlich.', 'lynnzeischke' ); ?></p>
		</div>
	</div>
</section>

<!-- ================= ÜBER MICH ================= -->
<section class="section section-dark" id="ueber-mich">
	<div class="container about">
		<div class="about-photo">
			<?php
			if ( lz_opt( 'about_image' ) ) {
				echo wp_get_attachment_image( lz_opt( 'about_image' ), 'large', false, array( 'alt' => 'Lynn Zeischke', 'loading' => 'lazy' ) );
			}
			?>
		</div>
		<div>
			<span class="eyebrow"><?php esc_html_e( 'Über mich', 'lynnzeischke' ); ?></span>
			<h2><?php esc_html_e( 'Hallo, ich bin Lynn.', 'lynnzeischke' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'Ich weiß, wie es ist, wenn der Laden brummt und das Büro liegen bleibt – weil ich es selbst erlebt habe.', 'lynnzeischke' ); ?></p>
			<p><?php esc_html_e( 'Als Mitgründerin des Biergartens am Kocher in Künzelsau war ich für Kasse, Buchhaltung, Dienstplanung, Personal, Speisekarten-Kalkulation und Marketing verantwortlich. Davor habe ich jahrelang im Service und an der Bar gearbeitet.', 'lynnzeischke' ); ?></p>
			<p><?php esc_html_e( 'Heute bringe ich genau diese Erfahrung in Handwerksbetriebe und Gastronomie: praktisch, ohne Berater-Sprech und mit einem Preis, der vorher feststeht.', 'lynnzeischke' ); ?></p>
			<div class="facts">
				<div class="fact"><strong>40</strong><span><?php esc_html_e( 'Mitarbeitende im eigenen Biergarten geführt', 'lynnzeischke' ); ?></span></div>
				<div class="fact"><strong>1,5 Mio. €</strong><span><?php esc_html_e( 'Umsatz im ersten Geschäftsjahr', 'lynnzeischke' ); ?></span></div>
				<div class="fact"><strong>1</strong><span><?php esc_html_e( 'Ansprechpartnerin für alles', 'lynnzeischke' ); ?></span></div>
			</div>
			<a class="btn btn-primary" href="<?php echo esc_url( $booking ); ?>"<?php echo $target; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php esc_html_e( 'Lernen wir uns kennen', 'lynnzeischke' ); ?></a>
		</div>
	</div>
</section>

<!-- ================= ABLAUF ================= -->
<section class="section" id="ablauf">
	<div class="container">
		<div class="section-head center">
			<span class="eyebrow"><?php esc_html_e( 'So läuft es ab', 'lynnzeischke' ); ?></span>
			<h2><?php esc_html_e( 'In drei Schritten zu weniger Papierkram', 'lynnzeischke' ); ?></h2>
		</div>
		<div class="grid grid-3 steps">
			<div class="card step">
				<h3><?php esc_html_e( 'Erstgespräch', 'lynnzeischke' ); ?></h3>
				<p><?php esc_html_e( 'Kostenfrei und unverbindlich – bei Ihnen vor Ort oder am Telefon. Sie erzählen, wo es hakt. Ich höre zu.', 'lynnzeischke' ); ?></p>
			</div>
			<div class="card step">
				<h3><?php esc_html_e( 'Festpreis-Angebot', 'lynnzeischke' ); ?></h3>
				<p><?php esc_html_e( 'Sie bekommen schriftlich, was ich mache, bis wann und was es kostet. Kein Kleingedrucktes.', 'lynnzeischke' ); ?></p>
			</div>
			<div class="card step">
				<h3><?php esc_html_e( 'Ich kümmere mich', 'lynnzeischke' ); ?></h3>
				<p><?php esc_html_e( 'Ich setze um, Sie bekommen fertige Ergebnisse. Ihr Aufwand: ein paar kurze Abstimmungen – zu Zeiten, die zu Ihrem Betrieb passen.', 'lynnzeischke' ); ?></p>
			</div>
		</div>
	</div>
</section>

<!-- ================= FAQ ================= -->
<section class="section section-alt" id="faq">
	<div class="container">
		<div class="section-head center">
			<span class="eyebrow"><?php esc_html_e( 'Häufige Fragen', 'lynnzeischke' ); ?></span>
			<h2><?php esc_html_e( 'Gut zu wissen', 'lynnzeischke' ); ?></h2>
		</div>
		<div class="faq">
			<details>
				<summary><?php esc_html_e( 'Ersetzen Sie meinen Steuerberater?', 'lynnzeischke' ); ?></summary>
				<div><?php esc_html_e( 'Nein. Ich sorge dafür, dass Belege, Rechnungen und Kasse sauber geordnet und vollständig bei Ihrem Steuerberater ankommen. Die Steuerberatung selbst bleibt bei ihm – er wird sich über die Ordnung freuen.', 'lynnzeischke' ); ?></div>
			</details>
			<details>
				<summary><?php esc_html_e( 'Wie viel Zeit muss ich selbst investieren?', 'lynnzeischke' ); ?></summary>
				<div><?php esc_html_e( 'So wenig wie möglich. Meist reichen ein Termin zum Start und ein paar kurze Rückfragen. Termine lege ich so, dass sie zu Ihrem Betrieb passen – vor der Schicht, nach der Baustelle oder am Ruhetag.', 'lynnzeischke' ); ?></div>
			</details>
			<details>
				<summary><?php esc_html_e( 'Muss ich einen langen Vertrag abschließen?', 'lynnzeischke' ); ?></summary>
				<div><?php esc_html_e( 'Nein. Die Pakete sind einmalige Festpreise. Die laufende Begleitung ist freiwillig und monatlich kündbar.', 'lynnzeischke' ); ?></div>
			</details>
			<details>
				<summary><?php esc_html_e( 'Ich hab das schon mal mit einer Agentur versucht – hat nichts gebracht.', 'lynnzeischke' ); ?></summary>
				<div><?php esc_html_e( 'Das höre ich oft. Deshalb gibt es die ehrliche Bestandsaufnahme für 450 €: Ich schaue mir alles an und sage Ihnen offen, was sich lohnt. Danach entscheiden Sie in Ruhe.', 'lynnzeischke' ); ?></div>
			</details>
			<details>
				<summary><?php esc_html_e( 'Arbeiten Sie auch außerhalb Ihrer Region?', 'lynnzeischke' ); ?></summary>
				<div><?php echo esc_html( sprintf( /* translators: %s: Region */ __( 'Vor Ort bin ich in %s. Vieles lässt sich aber auch gut per Telefon und Video erledigen – sprechen Sie mich einfach an.', 'lynnzeischke' ), lz_opt( 'region' ) ) ); ?></div>
			</details>
		</div>
	</div>
</section>

<!-- ================= KONTAKT ================= -->
<section class="section section-dark" id="kontakt">
	<div class="container contact">
		<div class="contact-info">
			<span class="eyebrow"><?php esc_html_e( 'Kontakt', 'lynnzeischke' ); ?></span>
			<h2><?php esc_html_e( 'Erzählen Sie mir, wo es hakt.', 'lynnzeischke' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'Das Erstgespräch ist kostenfrei und unverbindlich. Ich melde mich innerhalb von zwei Werktagen.', 'lynnzeischke' ); ?></p>
			<ul class="check-list">
				<?php if ( lz_opt( 'phone' ) ) : ?>
					<li><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', lz_opt( 'phone' ) ) ); ?>"><?php echo esc_html( lz_opt( 'phone' ) ); ?></a></li>
				<?php endif; ?>
				<?php if ( lz_opt( 'email' ) ) : ?>
					<li><a href="mailto:<?php echo esc_attr( antispambot( lz_opt( 'email' ) ) ); ?>"><?php echo esc_html( antispambot( lz_opt( 'email' ) ) ); ?></a></li>
				<?php endif; ?>
				<li><?php echo esc_html( lz_opt( 'region' ) ); ?></li>
				<li><?php echo esc_html( lz_opt( 'call_times' ) ); ?></li>
			</ul>
			<?php if ( $is_extern ) : ?>
				<p><a class="btn btn-primary" href="<?php echo esc_url( $booking ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Termin direkt online buchen', 'lynnzeischke' ); ?></a></p>
			<?php endif; ?>
		</div>

		<form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php lz_contact_notice(); ?>
			<input type="hidden" name="action" value="lz_contact">
			<input type="hidden" name="lz_ts" value="<?php echo esc_attr( time() ); ?>">
			<?php wp_nonce_field( 'lz_contact', 'lz_nonce' ); ?>
			<div class="hp" aria-hidden="true">
				<label for="lz-website">Website</label>
				<input type="text" id="lz-website" name="website" tabindex="-1" autocomplete="off">
			</div>

			<div class="row">
				<div>
					<label for="lz-name"><?php esc_html_e( 'Name *', 'lynnzeischke' ); ?></label>
					<input type="text" id="lz-name" name="lz_name" required autocomplete="name">
				</div>
				<div>
					<label for="lz-company"><?php esc_html_e( 'Betrieb', 'lynnzeischke' ); ?></label>
					<input type="text" id="lz-company" name="lz_company" autocomplete="organization">
				</div>
			</div>
			<div class="row">
				<div>
					<label for="lz-email"><?php esc_html_e( 'E-Mail *', 'lynnzeischke' ); ?></label>
					<input type="email" id="lz-email" name="lz_email" required autocomplete="email">
				</div>
				<div>
					<label for="lz-phone"><?php esc_html_e( 'Telefon', 'lynnzeischke' ); ?></label>
					<input type="tel" id="lz-phone" name="lz_phone" autocomplete="tel">
				</div>
			</div>
			<label for="lz-branche"><?php esc_html_e( 'Branche', 'lynnzeischke' ); ?></label>
			<select id="lz-branche" name="lz_branche">
				<option><?php esc_html_e( 'Handwerk', 'lynnzeischke' ); ?></option>
				<option><?php esc_html_e( 'Gastronomie', 'lynnzeischke' ); ?></option>
				<option><?php esc_html_e( 'Etwas anderes', 'lynnzeischke' ); ?></option>
			</select>
			<label for="lz-message"><?php esc_html_e( 'Wobei kann ich helfen? *', 'lynnzeischke' ); ?></label>
			<textarea id="lz-message" name="lz_message" required placeholder="<?php esc_attr_e( 'z. B. „Die Belege stapeln sich und unsere Homepage ist veraltet.“', 'lynnzeischke' ); ?>"></textarea>
			<label class="consent">
				<input type="checkbox" name="lz_consent" value="1" required>
				<span>
					<?php
					$privacy = get_privacy_policy_url();
					if ( $privacy ) {
						printf(
							/* translators: %s: Link zur Datenschutzerklärung */
							esc_html__( 'Ich bin einverstanden, dass meine Angaben zur Bearbeitung meiner Anfrage verwendet werden. Mehr dazu in der %s.', 'lynnzeischke' ),
							'<a href="' . esc_url( $privacy ) . '" target="_blank">' . esc_html__( 'Datenschutzerklärung', 'lynnzeischke' ) . '</a>'
						);
					} else {
						esc_html_e( 'Ich bin einverstanden, dass meine Angaben zur Bearbeitung meiner Anfrage verwendet werden.', 'lynnzeischke' );
					}
					?>
				</span>
			</label>
			<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Anfrage senden', 'lynnzeischke' ); ?></button>
		</form>
	</div>
</section>

<?php
get_footer();
