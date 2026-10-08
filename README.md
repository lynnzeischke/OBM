# WordPress-Theme für lynnzeischke.de

Eigenes Theme „Lynn Zeischke“: kaufmännische Beratung & operative Umsetzung für KMU, Handwerk und Gastronomie.

## Seiten

| Adresse | Inhalt | Datei |
|---|---|---|
| `/` | Startseite für KMU allgemein, Einstieg zu Handwerk und Gastro | `front-page.php` |
| `/handwerk/` | Landingpage Handwerk (Pakete, E-Rechnung, Übergabe …) | `page-handwerk.php` |
| `/gastro/` | Landingpage Gastronomie (Kasse, Wareneinsatz, Dienstplan …) | `page-gastro.php` |
| `/blog/` | Blog mit Kategorie-Filter und Suche | `home.php` |
| Artikel | Inhaltsverzeichnis, Lesezeit, Teilen, Autorenbox, passender Aufruf, ähnliche Artikel | `single.php` |
| Kategorien, Suche, 404 | | `archive.php`, `search.php`, `404.php` |

**Alle Texte der drei Landingpages stehen in `lynnzeischke/inc/content.php`.** Jede Seite ist eine Liste von Abschnitten (Hero, Laufband, Probleme, Leistungen, Pakete, Ablauf, Über mich, Blog, FAQ, Kontakt). Ausgegeben werden sie über `template-parts/section-*.php`. Text ändern → Datei speichern → fertig.

Inhalte aus dem WordPress-Editor der Seiten „Handwerk“ und „Gastronomie“ erscheinen zusätzlich vor dem Kontaktbereich (optional).

## Automatische Einrichtung beim Aktivieren

- Seiten **Start**, **Handwerk** (`/handwerk`), **Gastronomie** (`/gastro`), **Blog** (`/blog`) und **Impressum** (Entwurf mit Platzhaltern)
- Startseite und Blogseite unter *Einstellungen → Lesen* (nur, wenn noch keine statische Startseite gesetzt ist)
- Sprechende Adressen `/%postname%/` (nur, wenn noch „Einfach“ eingestellt ist)
- Blog-Kategorien **Handwerk**, **Gastronomie**, **KMU & Selbstständige**, jeweils mit SEO-Beschreibung
- Drei Startartikel **als Entwurf**: E-Rechnung im Handwerk, Wareneinsatz in der Gastronomie, Google-Unternehmensprofil

Bereits vorhandene Seiten, Kategorien und Artikel werden nicht überschrieben.

## SEO

- Eigener Seitentitel und eigene Meta-Beschreibung für jede Landingpage, für Blog, Kategorien und Artikel
- Feld **„SEO (Google-Vorschau)“** im Editor jeder Seite und jedes Beitrags für eigenen Titel und eigene Beschreibung
- Canonical-Links, Open Graph und Twitter Cards (Vorschau beim Teilen)
- Strukturierte Daten (schema.org): Unternehmen (ProfessionalService), Person, WebSite mit Suche, Brotkrumen, **Leistung mit Paketpreisen**, **FAQ** und **BlogPosting**
- Sichtbare Brotkrumen, eine H1 pro Seite, Sprungmarken an Zwischenüberschriften
- Suche und 404 auf `noindex`; die XML-Sitemap von WordPress liegt unter `/wp-sitemap.xml`
- Schnell: Schriften lokal und vorgeladen, ein CSS, ein JS (`defer`), keine externen Dienste
- Ist Yoast, Rank Math, AIOSEO oder SEOPress aktiv, gibt das Theme keine eigenen SEO-Tags aus

## Effekte

Text in der Hero-Überschrift, der sich wie auf einer Schreibmaschine abwechselt · Einblenden beim Scrollen · hochzählende Zahlen · Laufband · Lichtschein auf Karten, der der Maus folgt · Raster und Foto, die sich mit der Maus bewegen · „magnetische“ Buttons · Fortschrittsleiste · kompakte Kopfzeile beim Scrollen · Seitenleiste mit Punkten für die Abschnitte · Schalter „Bürolicht an/aus“ (hell/dunkel)

Bei „Bewegung reduzieren“ in den Systemeinstellungen sind alle Animationen aus. Ohne JavaScript ist alles sofort sichtbar.

## Installation

1. ZIP bauen: `zip -r lynnzeischke.zip lynnzeischke` (oder die fertige ZIP-Datei nutzen)
2. **Design → Themes → Theme hinzufügen → Theme hochladen**, dann aktivieren. Die Einrichtung (siehe oben) läuft automatisch.
3. **Impressum** ausfüllen und veröffentlichen, **Datenschutzerklärung** prüfen (Einstellungen → Datenschutz)
4. **Design → Customizer → „Lynn Zeischke – Kontakt & Texte“:** Fotos, Telefon, E-Mail, ggf. Calendly-Link
5. **Startartikel** prüfen, Beitragsbild hinzufügen, veröffentlichen
6. **E-Mail-Versand:** ein SMTP-Plugin (z. B. „WP Mail SMTP“) mit dem eigenen Postfach verbinden
7. Optional: **Design → Menüs**. Ohne eigenes Menü erscheint automatisch: Handwerk · Gastro · Leistungen · Pakete · Über mich · Blog

## Dateien

```
lynnzeischke/
├── style.css, functions.php
├── front-page.php, page-handwerk.php, page-gastro.php
├── home.php, single.php, archive.php, search.php, page.php, index.php, 404.php, searchform.php
├── header.php, footer.php
├── inc/        content.php, seo.php, blog.php, setup.php, customizer.php, contact-form.php
├── template-parts/  section-*.php, post-card.php, blog-*.php
└── assets/     js/main.js, css/editor.css, fonts/ (IBM Plex Mono, Inter – SIL OFL)
```
