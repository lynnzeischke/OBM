<?php
/**
 * Inhalte der drei Landingpages: Startseite (KMU allgemein), /handwerk und /gastro.
 *
 * Jede Seite besteht aus einer Liste von Abschnitten („sections“). Jeder Abschnitt
 * wird über template-parts/section-{type}.php ausgegeben. Texte hier ändern –
 * Layout und Effekte bleiben gleich.
 *
 * @package lynnzeischke
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gemeinsame Bausteine, die auf mehreren Seiten vorkommen.
 */
function lz_shared_process() {
	return array(
		'type'    => 'process',
		'id'      => 'ablauf',
		'label'   => 'Ablauf',
		'eyebrow' => 'So läuft es ab',
		'title'   => 'In drei Schritten zu weniger Papierkram',
		'steps'   => array(
			array( 'Erstgespräch', 'Kostenfrei und unverbindlich, per Telefon oder Video. Sie erzählen, wo es hakt. Ich höre zu und stelle die richtigen Fragen.' ),
			array( 'Festpreis-Angebot', 'Sie bekommen schriftlich, was ich mache, bis wann und was es kostet. Kein Kleingedrucktes, keine Überraschungen.' ),
			array( 'Ich kümmere mich', 'Ich setze um, Sie bekommen fertige Ergebnisse. Ihr Aufwand: ein paar kurze Abstimmungen, zu Zeiten, die zu Ihrem Betrieb passen.' ),
		),
	);
}

/**
 * Inhalte einer Landingpage.
 *
 * @param string $key kmu | handwerk | gastro.
 * @return array
 */
function lz_landing( $key ) {
	$pages = array();

	/* =====================================================================
	 * STARTSEITE – KMU allgemein, Einstieg zu Handwerk und Gastro
	 * ===================================================================== */
	$pages['kmu'] = array(
		'seo'      => array(
			'title'       => 'Lynn Zeischke – Kaufmännische Beratung für KMU, Handwerk & Gastro',
			'description' => 'Weniger Büro, mehr Zeit fürs Kerngeschäft: Vorbereitende Buchhaltung, digitale Büroabläufe, Homepage & Google-Profil für kleine Betriebe, Handwerk und Gastronomie. Festpreise, ein Ansprechpartner, remote & deutschlandweit.',
			'service'     => 'Kaufmännische Beratung & operative Umsetzung für kleine und mittlere Unternehmen',
		),
		'branche'  => 'Etwas anderes',
		'sections' => array(
			array(
				'type'    => 'hero',
				'id'      => 'start',
				'label'   => 'Start',
				'eyebrow' => 'Kaufmännische Beratung & operative Umsetzung · Remote · Deutschlandweit',
				'title'   => 'Weniger Büro.',
				'gold'    => array( 'Mehr Zeit für Ihre Kunden.', 'Mehr Zeit für Ihre Gäste.', 'Mehr Zeit fürs Handwerk.', 'Mehr Zeit für Feierabend.' ),
				'lead'    => 'Von Website & Marketing über digitale Büroabläufe bis zur vorbereitenden Buchhaltung – alles aus einer Hand. Für kleine Betriebe, die sich lieber um ihr Kerngeschäft kümmern als um Papierkram.',
				'cta2'    => array( 'Für wen ich arbeite', '#branchen' ),
				'trust'   => array( 'Ein fester Ansprechpartner', 'Festpreise', 'Kein Abo, keine Mindestlaufzeit' ),
			),
			array(
				'type'  => 'marquee',
				'items' => array( 'Vorbereitende Buchhaltung', 'E-Rechnung', 'Belege digital', 'Google-Profil', 'Bewertungen', 'Homepage', 'Instagram', 'Dienstplan', 'Kassenabschluss', 'Wareneinsatz', 'Abläufe aufschreiben', 'Betriebsübergabe' ),
			),
			array(
				'type'    => 'audiences',
				'id'      => 'branchen',
				'label'   => 'Branchen',
				'eyebrow' => 'Für wen',
				'title'   => 'Für inhabergeführte Betriebe – nicht für Konzerne.',
				'lead'    => 'Ich arbeite mit kleinen und mittleren Unternehmen. Für Handwerk und Gastronomie gibt es eigene Pakete, weil ich beide Welten von innen kenne.',
				'items'   => array(
					array(
						'icon'  => 'hammer',
						'kicker'=> '01 / Handwerk',
						'title' => 'Handwerksbetriebe',
						'text'  => 'Bau, Ausbau, Maler, Schreinerei, Kfz-Werkstatt, Friseursalon – Betriebe bis 15 Mitarbeitende. Belege, E-Rechnung, Homepage, Google und die Übergabe an die nächste Generation.',
						'link'  => '/handwerk/',
						'cta'   => 'Zur Handwerk-Seite',
					),
					array(
						'icon'  => 'cup',
						'kicker'=> '02 / Gastronomie',
						'title' => 'Gastronomie',
						'text'  => 'Restaurant, Café, Biergarten, Gasthof. Aus der Gastro für die Gastro: Kasse, Wareneinsatz, Dienstplan, Online-Reservierung und Instagram.',
						'link'  => '/gastro/',
						'cta'   => 'Zur Gastro-Seite',
					),
					array(
						'icon'  => 'briefcase',
						'kicker'=> '03 / Weitere KMU',
						'title' => 'Dienstleister & Selbstständige',
						'text'  => 'Praxen, Läden, Agenturen, Dienstleister: Wenn das Büro mehr Zeit frisst als die eigentliche Arbeit, schauen wir gemeinsam, was sich vereinfachen lässt.',
						'link'  => '#kontakt',
						'cta'   => 'Unverbindlich anfragen',
					),
				),
			),
			array(
				'type'    => 'problems',
				'id'      => 'probleme',
				'label'   => 'Kennen Sie das?',
				'eyebrow' => 'Kennen Sie das?',
				'title'   => 'Das Geschäft läuft. Alles drumherum frisst Ihre Abende.',
				'quotes'  => array(
					'Die Belege stapeln sich – und am Wochenende sitz ich wieder am Rechner.',
					'Ich weiß nie genau, ob alles richtig für den Steuerberater vorbereitet ist.',
					'Unsere Homepage ist von vor zehn Jahren. Peinlich, wenn vorher einer googelt.',
					'Auf Google stehen noch die alten Öffnungszeiten.',
					'Die E-Rechnung verunsichert mich – was muss ich eigentlich wann?',
					'Ich hatte schon drei Dienstleister. Keiner hat gesagt, was es am Ende kostet.',
				),
			),
			array(
				'type'    => 'services',
				'id'      => 'leistungen',
				'label'   => 'Leistungen',
				'eyebrow' => 'Leistungen',
				'title'   => 'Ich kümmere mich – Sie bekommen fertige Ergebnisse.',
				'lead'    => 'Statt drei Dienstleistern haben Sie eine Ansprechpartnerin, die Zahlen und Online-Auftritt zusammen denkt.',
				'items'   => array(
					array( 'beleg', 'Vorbereitende Buchhaltung', 'Belege, Rechnungen und Kasse digital und geordnet – sauber vorbereitet für Ihren Steuerberater. E-Rechnung inklusive.' ),
					array( 'flow', 'Digitale Büroabläufe', 'Angebote, Rechnungen, Termine und Ablage mit einfachen Werkzeugen, die Ihr Team wirklich nutzt.' ),
					array( 'web', 'Homepage', 'Eine moderne Seite, die auf dem Handy funktioniert und Anfragen bringt – mit Kontaktformular oder Online-Reservierung.' ),
					array( 'google', 'Google & Social Media', 'Vollständiges Google-Profil, beantwortete Bewertungen und ein Instagram-Auftritt, der zu Ihrem Betrieb passt.' ),
					array( 'team', 'Personal & Abläufe', 'Dienstplan aufs Handy, Zeiterfassung, Einarbeitung – und Abläufe aufgeschrieben, damit der Betrieb auch ohne Sie läuft.' ),
					array( 'key', 'Übergabe & Nachfolge', 'Wissen, Kalkulation, Zugänge und Abläufe in Ruhe ordnen – damit die nächste Generation gut übernehmen kann.' ),
				),
			),
			array(
				'type'    => 'packages',
				'id'      => 'pakete',
				'label'   => 'Einstieg & Preise',
				'eyebrow' => 'Einstieg & Preise',
				'title'   => 'Klein anfangen oder alles auf einmal.',
				'lead'    => 'Sie wissen vorher, was es kostet. Die genauen Pakete für Handwerk und Gastronomie finden Sie auf den Branchenseiten.',
				'cols'    => 3,
				'items'   => array(
					array(
						'name'     => 'Erstgespräch',
						'price'    => '0 €',
						'from'     => false,
						'for'      => 'Für alle, die erst einmal sortieren wollen.',
						'features' => array( 'Telefon oder Video', 'Wir schauen, wo es hakt', 'Ehrliche Einschätzung, ob ich helfen kann', 'Kein Verkaufsdruck' ),
						'cta'      => array( 'Termin anfragen', '#kontakt' ),
					),
					array(
						'name'     => 'Ehrliche Bestandsaufnahme',
						'price'    => '450 €',
						'from'     => false,
						'featured' => true,
						'badge'    => 'Beliebter Einstieg',
						'for'      => 'Für alle, die vor einer Entscheidung Klarheit wollen.',
						'features' => array( 'Büro, Belege und Abläufe angeschaut', 'Homepage und Google-Auftritt geprüft', 'Schriftliche Liste: was sich lohnt, was nicht', 'Danach entscheiden Sie in Ruhe' ),
						'cta'      => array( 'Bestandsaufnahme anfragen', '#kontakt' ),
					),
					array(
						'name'     => 'Pakete zum Festpreis',
						'price'    => '1.490 €',
						'from'     => true,
						'for'      => 'Für Betriebe, die Büro und Auftritt einmal richtig aufstellen wollen.',
						'features' => array( 'Pakete für Gründer, etablierte Betriebe und Übergabe', 'Eigene Pakete für Handwerk und Gastronomie', 'Laufende Begleitung auf Wunsch, monatlich kündbar' ),
						'links'    => array( array( 'Handwerk', '/handwerk/#pakete' ), array( 'Gastro', '/gastro/#pakete' ) ),
					),
				),
				'note'    => 'Alle Preise netto zzgl. gesetzlicher Umsatzsteuer.',
			),
			lz_shared_process(),
			array(
				'type'    => 'about',
				'id'      => 'ueber-mich',
				'label'   => 'Über mich',
				'eyebrow' => 'Über mich',
				'title'   => 'Hallo, ich bin Lynn.',
				'lead'    => 'Ich kenne beide Seiten: die Zahlen im Büro und den vollen Laden davor.',
				'paras'   => array(
					'Ich bin gelernte Steuerfachangestellte und habe einen M.Sc. in Digital Commerce, Marketing & Psychologie. Buchhaltung und Online-Auftritt kommen bei mir also aus einer Hand – und greifen ineinander.',
					'Als Mitgründerin eines Biergartens mit rund 40 Mitarbeitenden war ich für Kasse, Buchhaltung, Dienstplanung, Personal, Kalkulation und Marketing verantwortlich. Ich weiß, wie es ist, wenn das Geschäft brummt und das Büro liegen bleibt.',
					'Heute bringe ich genau diese Erfahrung in kleine Betriebe: praktisch, ohne Berater-Sprech und mit einem Preis, der vorher feststeht.',
				),
				'facts'   => array(
					array( 40, '', 'Mitarbeitende im eigenen Betrieb geführt' ),
					array( 1.5, ' Mio. €', 'Umsatz im ersten Geschäftsjahr' ),
					array( 1, '', 'Ansprechpartnerin für alles' ),
				),
			),
			array(
				'type'  => 'blog',
				'id'    => 'blog',
				'label' => 'Blog',
				'eyebrow' => 'Aus dem Blog',
				'title' => 'Wissen für Ihren Betrieb',
				'category' => '',
			),
			array(
				'type'    => 'faq',
				'id'      => 'faq',
				'label'   => 'FAQ',
				'eyebrow' => 'Häufige Fragen',
				'title'   => 'Gut zu wissen',
				'items'   => array(
					array( 'Ersetzen Sie meinen Steuerberater?', 'Nein. Ich sorge dafür, dass Belege, Rechnungen und Kasse sauber geordnet und vollständig bei Ihrem Steuerberater ankommen. Die Steuerberatung selbst bleibt bei ihm – er wird sich über die Ordnung freuen.' ),
					array( 'Für welche Betriebe arbeiten Sie?', 'Für inhabergeführte kleine und mittlere Unternehmen – besonders Handwerk und Gastronomie, aber auch Dienstleister, Praxen und Läden. Entscheidend ist nicht die Branche, sondern dass das Büro zu viel Zeit frisst.' ),
					array( 'Arbeiten Sie auch, wenn Sie nicht um die Ecke sind?', 'Ja. Ich arbeite remote und deutschlandweit – per Telefon, Video und gemeinsamen Online-Ordnern. Sie müssen dafür nichts Kompliziertes installieren.' ),
					array( 'Wie viel Zeit muss ich selbst investieren?', 'So wenig wie möglich. Meist reichen ein Termin zum Start und ein paar kurze Rückfragen – zu Zeiten, die zu Ihrem Betrieb passen.' ),
					array( 'Muss ich einen langen Vertrag abschließen?', 'Nein. Pakete sind einmalige Festpreise. Die laufende Begleitung ist freiwillig und monatlich kündbar.' ),
				),
			),
			array(
				'type'  => 'contact',
				'id'    => 'kontakt',
				'label' => 'Kontakt',
				'title' => 'Erzählen Sie mir, wo es hakt.',
				'lead'  => 'Online sichtbar werden. Büroarbeit vereinfachen. Zeit fürs Kerngeschäft gewinnen. Das Erstgespräch ist kostenfrei & unverbindlich.',
				'placeholder' => 'z. B. „Die Belege stapeln sich und unsere Homepage ist veraltet.“',
			),
		),
	);

	/* =====================================================================
	 * /handwerk – Hauptpersona Michael (Bauunternehmer, 12 MA)
	 * ===================================================================== */
	$pages['handwerk'] = array(
		'seo'      => array(
			'title'       => 'Büro, Buchhaltung & Homepage für Handwerksbetriebe | Lynn Zeischke',
			'description' => 'Weniger Büro, mehr Zeit fürs Handwerk: Belege & E-Rechnung, Homepage, Google-Profil und Betriebsübergabe für Handwerksbetriebe bis 15 Mitarbeitende. Festpreise ab 1.490 €, ein Ansprechpartner, kostenloses Erstgespräch.',
			'service'     => 'Kaufmännische Beratung & Umsetzung für Handwerksbetriebe',
		),
		'branche'  => 'Handwerk',
		'category' => 'handwerk',
		'sections' => array(
			array(
				'type'    => 'hero',
				'id'      => 'start',
				'label'   => 'Start',
				'eyebrow' => 'Beratung für Handwerksbetriebe · Remote · Deutschlandweit',
				'title'   => 'Weniger Büro.',
				'gold'    => array( 'Mehr Zeit fürs Handwerk.' ),
				'lead'    => 'Ich unterstütze Handwerksbetriebe bei kaufmännischer Organisation, Prozessen und administrativen Aufgaben – unkompliziert, digital und praxisnah. Alles aus einer Hand, persönlich und individuell ausgerichtet.',
				'cta2'    => array( 'Leistungen ansehen', '#leistungen' ),
				'trust'   => array( 'Ein fester Ansprechpartner', 'Festpreise ab 1.490 €', 'Kein Abo, keine Mindestlaufzeit' ),
			),
			array(
				'type'  => 'marquee',
				'items' => array( 'Belege digital', 'E-Rechnung', 'Angebote & Rechnungen', 'Steuerberater-Übergabe', 'Google-Profil', 'Bewertungen', 'Homepage', 'Bewerber finden Sie', 'Abläufe aufschreiben', 'Übergabe an die nächste Generation' ),
			),
			array(
				'type'    => 'problems',
				'id'      => 'probleme',
				'label'   => 'Kennen Sie das?',
				'eyebrow' => 'Kennen Sie das?',
				'title'   => 'Die Auftragslage ist gut. Das Büro kommt nicht hinterher.',
				'quotes'  => array(
					'Die Belege stapeln sich – und am Wochenende sitz ich wieder am Rechner statt bei der Familie.',
					'Unsere Homepage ist noch von meinem Vater. Peinlich, wenn vorher einer googelt.',
					'Ich weiß nie, ob ich alles richtig fürs Finanzamt gemacht hab.',
					'Wir müssten mal was mit Google machen. Die Konkurrenz taucht überall auf, wir nicht.',
					'Die E-Rechnung verunsichert mich. Was muss ich eigentlich ab wann?',
					'Das hab ich alles im Kopf. Wenn ich mal ausfalle, weiß keiner Bescheid.',
				),
			),
			array(
				'type'    => 'services',
				'id'      => 'leistungen',
				'label'   => 'Leistungen',
				'eyebrow' => 'Leistungen',
				'title'   => 'Ich kümmere mich um Ihr Büro. Sie um Ihre Baustellen.',
				'lead'    => 'Statt drei Dienstleistern haben Sie eine Ansprechpartnerin, die Ihren Betrieb kennt.',
				'cols'    => 4,
				'items'   => array(
					array( 'beleg', 'Buchhaltung & Belege', 'Belege und Rechnungen digital und geordnet – sauber vorbereitet für Ihren Steuerberater. E-Rechnungen schreiben und empfangen inklusive.' ),
					array( 'google', 'Google & Bewertungen', 'Vollständiges Google-Profil mit Fotos und Leistungen. Bewertungen werden beantwortet, neue Kunden finden Sie.' ),
					array( 'web', 'Homepage', 'Eine moderne Seite, die zur Qualität Ihrer Arbeit passt, auf dem Handy funktioniert und Anfragen bringt.' ),
					array( 'key', 'Abläufe & Übergabe', 'Kalkulation, Kunden, Zugänge und Abläufe aufgeschrieben – damit der Betrieb auch ohne Sie einen Tag läuft.' ),
				),
			),
			array(
				'type'    => 'benefits',
				'id'      => 'ergebnis',
				'label'   => 'Ergebnis',
				'eyebrow' => 'Was sich ändert',
				'title'   => 'Nach drei Monaten sieht Ihr Büro anders aus.',
				'text'    => 'Für Handwerksbetriebe bis 15 Mitarbeitende: Bau, Ausbau, Maler, Schreinerei, Kfz-Werkstatt, Elektro, SHK, Friseursalon. Ihre Arbeit ist gut. Ihr Auftritt und Ihr Büro sollen es auch sein.',
				'items'   => array(
					'Belege nicht mehr abends und am Wochenende nachholen',
					'E-Rechnungen schreiben und empfangen – ohne Kopfzerbrechen',
					'Ihr Steuerberater bekommt alles vollständig und pünktlich',
					'Eine Homepage, die zur Qualität Ihrer Arbeit passt',
					'Bei Google gefunden werden – mit guten Bewertungen',
					'Ihr Wissen ist aufgeschrieben, bevor die Übergabe ansteht',
				),
			),
			array(
				'type'    => 'packages',
				'id'      => 'pakete',
				'label'   => 'Pakete',
				'eyebrow' => 'Pakete & Preise',
				'title'   => 'Klarer Preis. Keine Überraschungen.',
				'lead'    => 'Im Erstgespräch schauen wir, welches Paket zu Ihnen passt – oder ob ein einzelner Baustein reicht.',
				'cols'    => 3,
				'items'   => array(
					array(
						'name'     => 'Neu am Start',
						'price'    => '1.490 €',
						'from'     => true,
						'for'      => 'Für Gründer:innen und junge Betriebe, die gefunden werden wollen.',
						'features' => array( 'Google-Profil komplett eingerichtet', 'Schlanke Homepage, fürs Handy gemacht', 'Instagram-Grundaufbau', 'Einfaches System für Rechnungen und Belege – von Anfang an' ),
					),
					array(
						'name'     => 'Digital nachrüsten',
						'price'    => '2.100 €',
						'from'     => true,
						'featured' => true,
						'badge'    => 'Am häufigsten gewählt',
						'for'      => 'Für etablierte Betriebe, bei denen das Drumherum nicht mehr hinterherkommt.',
						'features' => array( 'Belege und Rechnungen digital – E-Rechnung inklusive', 'Saubere Übergabe an Ihren Steuerberater', 'Neue Homepage, die auf dem Handy funktioniert', 'Google-Profil vollständig, Bewertungen im Griff', 'Ein fester Ansprechpartner für alles' ),
					),
					array(
						'name'     => 'Fit für die Übergabe',
						'price'    => '2.000 €',
						'from'     => true,
						'for'      => 'Für Inhaber:innen, die den Betrieb in den nächsten Jahren weitergeben.',
						'features' => array( 'Abläufe in Ruhe aufschreiben – Schritt für Schritt', 'Kalkulation, Kunden und Lieferanten dokumentiert', 'Zugänge und Passwörter sicher geordnet', 'Ordnen statt umkrempeln – Ihr Wissen bleibt im Betrieb' ),
					),
				),
				'extras'  => array(
					array( 'Ehrliche Bestandsaufnahme', 'Ich schaue mir Büro, Homepage und Google-Auftritt an und sage Ihnen, was sich lohnt – und was nicht.', '450 €' ),
					array( 'Google-Profil einrichten', 'Öffnungszeiten, Fotos, Leistungen – vollständig und richtig.', 'ab 100 €' ),
					array( 'Laufende Begleitung', 'Auf Wunsch kümmere ich mich dauerhaft – monatlich kündbar.', '150 € / Monat' ),
				),
				'note'    => 'Alle Preise netto zzgl. gesetzlicher Umsatzsteuer. Den genauen Festpreis bekommen Sie nach dem Erstgespräch schriftlich.',
			),
			lz_shared_process(),
			array(
				'type'    => 'about',
				'id'      => 'ueber-mich',
				'label'   => 'Über mich',
				'eyebrow' => 'Über mich',
				'title'   => 'Hallo, ich bin Lynn.',
				'lead'    => 'Ich weiß, wie es ist, wenn die Aufträge laufen und das Büro liegen bleibt.',
				'paras'   => array(
					'Ich bin gelernte Steuerfachangestellte und habe einen M.Sc. in Digital Commerce, Marketing & Psychologie. Ihre Belege und Ihr Auftritt im Netz kommen bei mir aus einer Hand.',
					'Als Mitgründerin eines Betriebs mit rund 40 Mitarbeitenden habe ich selbst erlebt, wie viel Zeit Kasse, Buchhaltung, Personal und Marketing fressen – neben dem eigentlichen Geschäft.',
					'Für Handwerksbetriebe heißt das: Ich rede nicht von Strategien, sondern kümmere mich. Mit einem Preis, der vorher feststeht.',
				),
				'facts'   => array(
					array( 1, '', 'Ansprechpartnerin für Büro, Homepage & Google' ),
					array( 100, ' %', 'Festpreis – vorher schriftlich' ),
					array( 0, ' €', 'für das Erstgespräch' ),
				),
			),
			array(
				'type'     => 'blog',
				'id'       => 'blog',
				'label'    => 'Blog',
				'eyebrow'  => 'Aus dem Blog',
				'title'    => 'Wissen für Handwerksbetriebe',
				'category' => 'handwerk',
			),
			array(
				'type'    => 'faq',
				'id'      => 'faq',
				'label'   => 'FAQ',
				'eyebrow' => 'Häufige Fragen',
				'title'   => 'Gut zu wissen',
				'items'   => array(
					array( 'Ersetzen Sie meinen Steuerberater?', 'Nein. Ich sorge dafür, dass Belege und Rechnungen sauber geordnet und vollständig bei Ihrem Steuerberater ankommen. Die Steuerberatung selbst bleibt bei ihm.' ),
					array( 'Muss ich jetzt schon E-Rechnungen schreiben?', 'Empfangen können müssen Sie E-Rechnungen seit dem 1. Januar 2025. Beim Ausstellen gibt es Übergangsfristen: Ab 2027 sind Betriebe mit mehr als 800.000 € Vorjahresumsatz dran, ab 2028 alle. Ich richte das mit Ihnen so ein, dass es einfach funktioniert.' ),
					array( 'Wie viel Zeit muss ich selbst investieren?', 'So wenig wie möglich. Meist reichen ein Termin zum Start und ein paar kurze Rückfragen – vor der Baustelle, nach Feierabend oder wann es Ihnen passt.' ),
					array( 'Ich hab das schon mal mit einer Agentur versucht – hat nichts gebracht.', 'Das höre ich oft. Deshalb gibt es die ehrliche Bestandsaufnahme für 450 €: Ich schaue mir alles an und sage Ihnen offen, was sich lohnt. Danach entscheiden Sie in Ruhe.' ),
					array( 'Muss das mit der Übergabe jetzt schon sein?', 'Nein, und Druck mache ich nicht. Aber je früher Abläufe und Wissen aufgeschrieben sind, desto entspannter wird es – für Sie und für Ihre Nachfolge. Wir gehen Schritt für Schritt vor.' ),
					array( 'Muss ich einen langen Vertrag abschließen?', 'Nein. Die Pakete sind einmalige Festpreise. Die laufende Begleitung ist freiwillig und monatlich kündbar.' ),
				),
			),
			array(
				'type'  => 'contact',
				'id'    => 'kontakt',
				'label' => 'Kontakt',
				'title' => 'Erzählen Sie mir, wo es hakt.',
				'lead'  => 'Weniger Büro. Mehr Zeit fürs Handwerk. Das Erstgespräch ist kostenfrei & unverbindlich – ich melde mich innerhalb von zwei Werktagen.',
				'placeholder' => 'z. B. „Die Belege stapeln sich und unsere Homepage ist noch von meinem Vater.“',
			),
		),
	);

	/* =====================================================================
	 * /gastro – Hauptpersona Stefan (Restaurant, 14 MA)
	 * Hinweis: Gastro-Paketpreise sind Arbeitsstand (siehe Persona-Datei).
	 * ===================================================================== */
	$pages['gastro'] = array(
		'seo'      => array(
			'title'       => 'Buchhaltung, Personal & Marketing für die Gastronomie | Lynn Zeischke',
			'description' => 'Aus der Gastro für die Gastro: Kasse & Belege, Wareneinsatz, Dienstplan, Online-Reservierung, Google & Instagram für Restaurants, Cafés und Biergärten. Von einer Mitgründerin eines Biergartens mit 40 Mitarbeitenden. Festpreise, kostenloses Erstgespräch.',
			'service'     => 'Kaufmännische Beratung & Umsetzung für Gastronomiebetriebe',
		),
		'branche'  => 'Gastronomie',
		'category' => 'gastro',
		'sections' => array(
			array(
				'type'    => 'hero',
				'id'      => 'start',
				'label'   => 'Start',
				'eyebrow' => 'Aus der Gastro für die Gastro · Remote · Deutschlandweit',
				'title'   => 'Weniger Zettelkram.',
				'gold'    => array( 'Mehr Zeit für Ihre Gäste.' ),
				'lead'    => 'Ich habe selbst einen Biergarten mit 40 Leuten mit aufgebaut – ich kenne Schichtplan, Kassenabschluss und Samstagabend voll besetzt. Jetzt kümmere ich mich um Ihr Büro, Ihren Online-Auftritt und das Personal-Drumherum. Aus einer Hand, zum Festpreis.',
				'cta2'    => array( 'Leistungen ansehen', '#leistungen' ),
				'trust'   => array( 'Selbst hinterm Tresen gestanden', 'Festpreise', 'Termine nie zur Servicezeit' ),
			),
			array(
				'type'  => 'marquee',
				'items' => array( 'Kassenabschluss', 'Z-Bons', 'Lieferantenrechnungen', 'Wareneinsatz', 'Speisekarten-Kalkulation', 'Dienstplan aufs Handy', 'Aushilfen & Minijob', 'Online-Reservierung', 'Mittagstisch online', 'Google-Bewertungen', 'Reels', 'Übergabe' ),
			),
			array(
				'type'    => 'problems',
				'id'      => 'probleme',
				'label'   => 'Kennen Sie das?',
				'eyebrow' => 'Kennen Sie das?',
				'title'   => 'Die Gäste kommen. Aber was bleibt am Ende übrig?',
				'quotes'  => array(
					'Die Zettel mach ich nachts nach dem Service – oder am Ruhetag.',
					'Ich weiß nicht, was am Ende übrig bleibt. Der Wareneinsatz läuft mir davon.',
					'Das Telefon klingelt immer dann, wenn der Laden voll ist.',
					'Freitag hat sich wieder einer krankgemeldet. Der Dienstplan läuft über WhatsApp.',
					'Auf Google stehen noch die alten Öffnungszeiten.',
					'Die Speisekarte auf der Homepage ist ein PDF von vor Corona.',
				),
			),
			array(
				'type'    => 'services',
				'id'      => 'leistungen',
				'label'   => 'Leistungen',
				'eyebrow' => 'Leistungen',
				'title'   => 'Sie kümmern sich um Küche und Gäste. Ich um den Rest.',
				'lead'    => 'Alles, was nach Feierabend liegen bleibt – von einer Ansprechpartnerin, die weiß, wie Gastro läuft.',
				'cols'    => 3,
				'items'   => array(
					array( 'beleg', 'Kasse & Belege', 'Kassenabschlüsse, Z-Bons und Lieferantenrechnungen digital und geordnet. TSE und E-Rechnungs-Empfang im Griff, sauber für den Steuerberater.' ),
					array( 'chart', 'Wareneinsatz & Kalkulation', 'Wissen, was jedes Gericht kostet und was übrig bleibt. Speisekarte kalkuliert, Wareneinsatz und Personalkosten im Blick.' ),
					array( 'team', 'Dienstplan & Personal', 'Dienstplan und Zeiterfassung aufs Handy, Minijob-Grenzen im Blick, neue Leute am ersten Tag einsatzfähig.' ),
					array( 'web', 'Homepage & Reservierung', 'Speisekarte mobil statt PDF, Mittagstisch aktuell, Online-Reservierung – weniger Telefon im Service.' ),
					array( 'google', 'Google & Instagram', 'Richtige Öffnungszeiten, schöne Fotos, beantwortete Bewertungen und Reels, die zu Ihrem Laden passen.' ),
					array( 'key', 'Übergabe', 'Rezepturen, Kalkulation, Lieferanten und Stammgäste-Wissen aufgeschrieben – damit das Haus weiterlebt.' ),
				),
			),
			array(
				'type'    => 'benefits',
				'id'      => 'erfahrung',
				'label'   => 'Erfahrung',
				'eyebrow' => 'Aus der Praxis',
				'title'   => 'Kein Theoretiker. Selbst hinterm Tresen gestanden.',
				'text'    => 'Restaurants, Cafés, Biergärten, Gasthöfe und Bars bis ca. 20 Mitarbeitende inklusive Aushilfen. Ich war Mitgründerin eines Biergartens mit 40 Leuten und habe jahrelang im Service und an der Bar gearbeitet. Ich weiß, was Samstagabend bedeutet.',
				'items'   => array(
					'Wissen, was am Ende übrig bleibt – Wareneinsatz und Personalkosten im Blick',
					'Kassenabschlüsse, Z-Bons und Lieferantenrechnungen geordnet',
					'Online-Reservierung statt Telefon im Service',
					'Speisekarte und Mittagstisch aktuell auf Homepage und Google',
					'Dienstplan aufs Handy – und Aushilfen, die wiederkommen',
					'Ruhetag wieder als Ruhetag',
				),
			),
			array(
				'type'    => 'packages',
				'id'      => 'pakete',
				'label'   => 'Pakete',
				'eyebrow' => 'Pakete & Preise',
				'title'   => 'Klarer Preis, fertig.',
				'lead'    => 'Gastro-Margen sind dünn – deshalb gibt es Festpreise und keine versteckten Monatskosten.',
				'cols'    => 4,
				'items'   => array(
					array(
						'name'     => 'Neu am Start',
						'price'    => '1.490 €',
						'from'     => true,
						'for'      => 'Für neue Läden, die bekannt werden wollen.',
						'features' => array( 'Google-Profil komplett', 'Schlanke Homepage mit Speisekarte', 'Instagram-Grundaufbau & Reels-Plan', 'Ordnung in Kasse und Belegen von Anfang an' ),
					),
					array(
						'name'     => 'Digital nachrüsten',
						'price'    => '2.100 €',
						'from'     => true,
						'featured' => true,
						'badge'    => 'Am häufigsten gewählt',
						'for'      => 'Für etablierte Betriebe mit Stammgästen.',
						'features' => array( 'Kasse, Belege & Lieferantenrechnungen digital', 'Wareneinsatz und Kalkulation im Blick', 'Homepage mit Online-Reservierung', 'Google-Profil & Bewertungen im Griff' ),
					),
					array(
						'name'     => 'Team aufbauen',
						'price'    => '1.600 €',
						'from'     => true,
						'for'      => 'Für Betriebe mit Saison- und Aushilfspersonal.',
						'features' => array( 'Dienstplan und Zeiterfassung aufs Handy', 'Als Arbeitgeber sichtbar werden', 'Einarbeitung neuer Leute geregelt', 'Vor der Saison fertig' ),
					),
					array(
						'name'     => 'Fit für die Übergabe',
						'price'    => '2.000 €',
						'from'     => true,
						'for'      => 'Für Häuser, die in die nächste Generation gehen.',
						'features' => array( 'Rezepturen & Kalkulation aufgeschrieben', 'Lieferanten, Stammgäste, Feier-Abläufe dokumentiert', 'Zugänge sicher geordnet', 'In Ruhe, Schritt für Schritt' ),
					),
				),
				'extras'  => array(
					array( 'Ehrliche Bestandsaufnahme', 'Ich schaue mir Kasse, Büro, Homepage und Google an und sage offen, was sich lohnt.', '450 €' ),
					array( 'Google-Profil einrichten', 'Öffnungszeiten, Fotos, Speisekarte – vollständig und richtig.', 'ab 100 €' ),
					array( 'Foto- & Video-Termin', 'Ein Termin, Bilder und Reels für Wochen.', '350 €' ),
					array( 'Instagram-Coaching 1:1', 'Sie oder Ihr Team lernen, selbst gute Posts und Reels zu machen.', '60 € / Std.' ),
					array( 'Laufende Begleitung', 'Auf Wunsch kümmere ich mich dauerhaft – monatlich kündbar.', '150 € / Monat' ),
				),
				'note'    => 'Alle Preise netto zzgl. gesetzlicher Umsatzsteuer. Den genauen Festpreis bekommen Sie nach dem Erstgespräch schriftlich.',
			),
			lz_shared_process(),
			array(
				'type'    => 'about',
				'id'      => 'ueber-mich',
				'label'   => 'Über mich',
				'eyebrow' => 'Über mich',
				'title'   => 'Hallo, ich bin Lynn.',
				'lead'    => 'Ich kenne Schichtplan, Kassenabschluss und Samstagabend voll besetzt – weil ich es selbst gemacht habe.',
				'paras'   => array(
					'Als Mitgründerin des Biergartens am Kocher in Künzelsau war ich für Kasse, Buchhaltung, Dienstplanung, Personal, Wareneinsatz-Analyse, Speisekarten-Kalkulation, Reservierungen und Marketing verantwortlich. Davor habe ich jahrelang im Service und an der Bar gearbeitet.',
					'Dazu bin ich gelernte Steuerfachangestellte und habe einen M.Sc. in Digital Commerce, Marketing & Psychologie. Zahlen und Gäste-Ansprache kommen bei mir aus einer Hand.',
					'Termine mache ich vormittags oder an Ihrem Ruhetag – nie zur Servicezeit.',
				),
				'facts'   => array(
					array( 40, '', 'Mitarbeitende im eigenen Biergarten geführt' ),
					array( 1.5, ' Mio. €', 'Umsatz im ersten Geschäftsjahr' ),
					array( 1, '', 'Ansprechpartnerin für alles' ),
				),
			),
			array(
				'type'     => 'blog',
				'id'       => 'blog',
				'label'    => 'Blog',
				'eyebrow'  => 'Aus dem Blog',
				'title'    => 'Wissen für die Gastronomie',
				'category' => 'gastro',
			),
			array(
				'type'    => 'faq',
				'id'      => 'faq',
				'label'   => 'FAQ',
				'eyebrow' => 'Häufige Fragen',
				'title'   => 'Gut zu wissen',
				'items'   => array(
					array( 'Haben Sie wirklich Gastro-Erfahrung?', 'Ja. Ich habe einen Biergarten mit rund 40 Mitarbeitenden mitgegründet und dort Kasse, Buchhaltung, Dienstplan, Personal, Kalkulation und Marketing verantwortet. Davor war ich jahrelang im Service und an der Bar.' ),
					array( 'Ersetzen Sie meinen Steuerberater?', 'Nein. Ich sorge dafür, dass Kassenabschlüsse, Z-Bons und Rechnungen sauber und vollständig bei Ihrem Steuerberater ankommen. Die Steuerberatung bleibt bei ihm.' ),
					array( 'Wann erreiche ich Sie – und wann rufen Sie an?', 'Ich rufe nie zur Servicezeit an. Termine mache ich vormittags vor dem Service oder an Ihrem Ruhetag.' ),
					array( 'Wie schnell merke ich etwas?', 'Google-Profil und Online-Reservierung wirken oft schon nach wenigen Wochen. Ordnung in Belegen und Wareneinsatz spüren Sie spätestens beim nächsten Monatsabschluss.' ),
					array( 'Gibt es versteckte monatliche Kosten?', 'Nein. Die Pakete sind einmalige Festpreise. Laufende Begleitung gibt es nur, wenn Sie das möchten – und sie ist monatlich kündbar.' ),
				),
			),
			array(
				'type'  => 'contact',
				'id'    => 'kontakt',
				'label' => 'Kontakt',
				'title' => 'Erzählen Sie mir, wo es hakt.',
				'lead'  => 'Kostenfrei & unverbindlich. Ich melde mich innerhalb von zwei Werktagen – vormittags, nie zur Servicezeit.',
				'placeholder' => 'z. B. „Ich weiß nicht, was am Ende übrig bleibt, und das Telefon klingelt im Service ständig.“',
			),
		),
	);

	return isset( $pages[ $key ] ) ? $pages[ $key ] : array();
}

/**
 * Welche Landingpage wird gerade angezeigt? (kmu | handwerk | gastro | '')
 */
function lz_current_landing_key() {
	if ( is_front_page() ) {
		return 'kmu';
	}
	if ( is_page( 'handwerk' ) ) {
		return 'handwerk';
	}
	if ( is_page( 'gastro' ) ) {
		return 'gastro';
	}
	return '';
}

/**
 * Abschnitte der aktuellen Seite für die Punkte in der Seitenleiste.
 *
 * @return array id => label
 */
function lz_sections() {
	$key = lz_current_landing_key();
	if ( ! $key ) {
		return array();
	}
	$out = array();
	foreach ( lz_landing( $key )['sections'] as $section ) {
		if ( ! empty( $section['id'] ) && ! empty( $section['label'] ) ) {
			$out[ $section['id'] ] = $section['label'];
		}
	}
	return $out;
}

/**
 * Landingpage ausgeben.
 *
 * @param string $key kmu | handwerk | gastro.
 */
function lz_render_landing( $key ) {
	$page = lz_landing( $key );
	get_header();
	foreach ( $page['sections'] as $section ) {
		// Seiteninhalt aus dem Editor (falls vorhanden) vor dem Kontakt-Abschnitt einfügen.
		if ( 'contact' === $section['type'] && 'kmu' !== $key ) {
			get_template_part( 'template-parts/section', 'editor' );
		}
		get_template_part(
			'template-parts/section',
			$section['type'],
			array(
				'section' => $section,
				'page'    => $page,
				'key'     => $key,
			)
		);
	}
	get_footer();
}
