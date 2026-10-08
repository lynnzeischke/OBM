# WordPress-Theme für lynnzeischke.de

Eigenes Theme „Lynn Zeischke“ für die Webseite: Buchhaltung, Marketing und Webdesign für Handwerk und Gastronomie.

## Was drin ist

- **Startseite als One-Pager** (`front-page.php`): Startbereich, „Kennen Sie das?“, Leistungen, Umschalter Handwerk/Gastronomie, Pakete & Preise, Über mich, Ablauf, Häufige Fragen, Kontakt
- **Kontaktformular ohne Plugin** mit Spam-Schutz (unsichtbares Feld, Zeitsperre, max. 5 Anfragen pro Stunde) und Häkchen zur Datenschutz-Einwilligung
- **Einstellungen im Customizer** (Design → Customizer → „Lynn Zeischke – Kontakt & Texte“): E-Mail, Telefon/WhatsApp, Unterzeile, Hero-Kasten, Qualifikations-Box, Region, Calendly-Link, Fotos, Google-Beschreibung
- Vorlagen für Seiten (Impressum/Datenschutz), Blog, Suche und 404
- **Design wie lynnzeischke.de:** dunkle Kopfzeile mit „LZ“-Logo, Seitenleiste links (Name, Abschnitts-Punkte, Telefonnummer), Gold `#daa84e`, Überschriften in IBM Plex Mono, Fließtext in Inter, eckige Buttons, Foto mit Goldrahmen und dunkler Qualifikations-Box, WhatsApp-Button
- **Schalter „Bürolicht an/aus“** (hell/dunkel), die Wahl merkt sich der Browser
- **DSGVO-freundlich:** Schriften liegen im Theme (`assets/fonts`, SIL Open Font License), keine Google Fonts, kein CDN, keine Emoji-Skripte von WordPress.org
- schema.org-Daten für Google, für Handys optimiert, per Tastatur bedienbar

## Installation

1. ZIP bauen: `cd lynnzeischke/.. && zip -r lynnzeischke.zip lynnzeischke`
2. In WordPress unter **Design → Themes → Theme hinzufügen → Theme hochladen** die ZIP-Datei hochladen und aktivieren.
3. **Einstellungen → Lesen:** „Eine statische Seite“ wählen und als Startseite eine (leere) Seite „Start“ festlegen.
4. **Seiten anlegen:** „Impressum“ (Titelform/URL `impressum`) und „Datenschutzerklärung“ (unter Einstellungen → Datenschutz als Datenschutzseite festlegen). Beide erscheinen dann automatisch im Footer.
5. **Customizer:** E-Mail, Telefon, Fotos und ggf. Calendly-Link eintragen.
6. **E-Mail-Versand:** Ein SMTP-Plugin (z. B. „WP Mail SMTP“) mit dem eigenen Postfach verbinden, sonst landen Formular-Anfragen leicht im Spam.
7. Optional: Unter **Design → Menüs** eigene Menüs anlegen. Ohne Menü verlinkt der Kopfbereich automatisch die Abschnitte der Startseite.

## Texte anpassen

Alle Texte der Startseite stehen in `lynnzeischke/front-page.php`. Farben stehen oben in `lynnzeischke/style.css` (`--c-gold`, `--c-chrome`, `--c-bg`; dunkle Variante unter `[data-theme="dark"]`).
