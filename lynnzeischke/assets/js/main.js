/* Lynn Zeischke – Menü, Bürolicht, Effekte. Ohne Abhängigkeiten. */
(function () {
	'use strict';

	var root = document.documentElement;
	var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

	/* ---------- Mobiles Menü ---------- */
	var toggle = document.querySelector('.nav-toggle');
	var nav = document.getElementById('hauptmenue');
	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			var open = nav.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
		nav.addEventListener('click', function (e) {
			if (e.target.closest('a')) {
				nav.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
			}
		});
	}

	/* ---------- Bürolicht an (hell) / aus (dunkel) ---------- */
	var themeBtn = document.querySelector('.theme-toggle');
	function paintTheme() {
		if (!themeBtn) { return; }
		var dark = root.getAttribute('data-theme') === 'dark';
		themeBtn.querySelector('.label').textContent = dark ? themeBtn.dataset.labelOff : themeBtn.dataset.labelOn;
		themeBtn.setAttribute('aria-pressed', dark ? 'true' : 'false');
	}
	if (themeBtn) {
		paintTheme();
		themeBtn.addEventListener('click', function () {
			var dark = root.getAttribute('data-theme') !== 'dark';
			if (dark) { root.setAttribute('data-theme', 'dark'); } else { root.removeAttribute('data-theme'); }
			try { localStorage.setItem('lz-theme', dark ? 'dark' : 'light'); } catch (e) {}
			paintTheme();
		});
	}

	/* ---------- Einblenden beim Scrollen ---------- */
	var revealEls = document.querySelectorAll('[data-reveal]');
	if (!reduce && 'IntersectionObserver' in window) {
		var revealIO = new IntersectionObserver(function (entries) {
			entries.forEach(function (en) {
				if (en.isIntersecting) {
					en.target.classList.add('is-visible');
					revealIO.unobserve(en.target);
				}
			});
		}, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
		revealEls.forEach(function (el) { revealIO.observe(el); });
	} else {
		revealEls.forEach(function (el) { el.classList.add('is-visible'); });
	}

	/* ---------- Schreibmaschine im Hero ---------- */
	var tw = document.querySelector('.typewriter[data-words]');
	if (tw && !reduce) {
		var words = JSON.parse(tw.getAttribute('data-words'));
		var out = tw.querySelector('.tw-text');
		var wi = 0, ci = words[0].length, deleting = true;
		var tick = function () {
			var word = words[wi];
			if (deleting) {
				ci--;
				out.textContent = word.slice(0, ci);
				if (ci <= 0) { deleting = false; wi = (wi + 1) % words.length; }
				setTimeout(tick, ci <= 0 ? 350 : 35);
			} else {
				ci++;
				out.textContent = words[wi].slice(0, ci);
				if (ci >= words[wi].length) { deleting = true; setTimeout(tick, 2600); return; }
				setTimeout(tick, 70);
			}
		};
		setTimeout(tick, 3200);
	}

	/* ---------- Zähler ---------- */
	var counters = document.querySelectorAll('[data-count]');
	function runCounter(el) {
		var target = parseFloat(el.dataset.count);
		var decimals = parseInt(el.dataset.decimals || '0', 10);
		var suffix = el.dataset.suffix || '';
		var start = null, dur = 1600;
		var fmt = function (v) { return v.toLocaleString('de-DE', { minimumFractionDigits: decimals, maximumFractionDigits: decimals }) + suffix; };
		var step = function (t) {
			if (!start) { start = t; }
			var p = Math.min((t - start) / dur, 1);
			var eased = 1 - Math.pow(1 - p, 3);
			el.textContent = fmt(target * eased);
			if (p < 1) { requestAnimationFrame(step); }
		};
		requestAnimationFrame(step);
	}
	if (counters.length && !reduce && 'IntersectionObserver' in window) {
		var countIO = new IntersectionObserver(function (entries) {
			entries.forEach(function (en) {
				if (en.isIntersecting) { runCounter(en.target); countIO.unobserve(en.target); }
			});
		}, { threshold: 0.6 });
		counters.forEach(function (el) { countIO.observe(el); });
	}

	/* ---------- Scroll: Fortschritt, Kopfzeile ---------- */
	var ticking = false;
	function onScroll() {
		var h = document.documentElement.scrollHeight - window.innerHeight;
		var p = h > 0 ? window.scrollY / h : 0;
		root.style.setProperty('--progress', p.toFixed(4));
		document.body.classList.toggle('is-scrolled', window.scrollY > 40);
		ticking = false;
	}
	window.addEventListener('scroll', function () {
		if (!ticking) { requestAnimationFrame(onScroll); ticking = true; }
	}, { passive: true });
	onScroll();

	/* ---------- Aktiver Abschnitt (Seitenleiste) / aktive Überschrift (Inhaltsverzeichnis) ---------- */
	function spy(links, attr) {
		if (!links.length || !('IntersectionObserver' in window)) { return; }
		var map = {};
		links.forEach(function (a) { map[attr(a)] = a; });
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (en) {
				if (en.isIntersecting && map[en.target.id]) {
					links.forEach(function (a) { a.classList.remove('is-active'); });
					map[en.target.id].classList.add('is-active');
				}
			});
		}, { rootMargin: '-45% 0px -50% 0px' });
		Object.keys(map).forEach(function (id) {
			var el = document.getElementById(id);
			if (el) { io.observe(el); }
		});
	}
	spy(document.querySelectorAll('.rail-dots a[data-section]'), function (a) { return a.dataset.section; });
	spy(document.querySelectorAll('.toc a'), function (a) { return a.getAttribute('href').slice(1); });

	/* ---------- Maus-Effekte (nur Desktop) ---------- */
	if (finePointer && !reduce) {
		// Lichtschein auf Karten
		document.querySelectorAll('.spotlight').forEach(function (card) {
			card.addEventListener('pointermove', function (e) {
				var r = card.getBoundingClientRect();
				card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
				card.style.setProperty('--my', (e.clientY - r.top) + 'px');
			});
		});

		// Raster und Foto im Hero
		var hero = document.querySelector('.hero');
		if (hero) {
			var grid = hero.querySelector('.hero-grid');
			var tilt = hero.querySelector('.tilt');
			hero.addEventListener('pointermove', function (e) {
				var r = hero.getBoundingClientRect();
				var x = (e.clientX - r.left) / r.width - 0.5;
				var y = (e.clientY - r.top) / r.height - 0.5;
				if (grid) {
					grid.style.setProperty('--px', (x * -24) + 'px');
					grid.style.setProperty('--py', (y * -24) + 'px');
				}
				if (tilt) {
					tilt.style.setProperty('--ry', (x * 6) + 'deg');
					tilt.style.setProperty('--rx', (y * -6) + 'deg');
				}
			});
			hero.addEventListener('pointerleave', function () {
				if (tilt) { tilt.style.setProperty('--rx', '0deg'); tilt.style.setProperty('--ry', '0deg'); }
			});
		}

		// Magnetische Buttons
		document.querySelectorAll('.magnetic').forEach(function (btn) {
			btn.addEventListener('pointermove', function (e) {
				var r = btn.getBoundingClientRect();
				btn.style.setProperty('--tx', ((e.clientX - r.left - r.width / 2) * 0.18) + 'px');
				btn.style.setProperty('--ty', ((e.clientY - r.top - r.height / 2) * 0.3) + 'px');
			});
			btn.addEventListener('pointerleave', function () {
				btn.style.setProperty('--tx', '0px');
				btn.style.setProperty('--ty', '0px');
			});
		});
	}

	/* ---------- Paket-Button füllt das Kontaktformular vor ---------- */
	document.querySelectorAll('[data-package]').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var msg = document.getElementById('lz-message');
			if (msg && !msg.value) {
				msg.value = 'Ich interessiere mich für das Paket „' + btn.dataset.package + '“.\n\n';
			}
		});
	});

	/* ---------- Link kopieren (Blog) ---------- */
	var copy = document.querySelector('.copy-link');
	if (copy && navigator.clipboard) {
		copy.addEventListener('click', function () {
			navigator.clipboard.writeText(copy.dataset.url).then(function () {
				var old = copy.textContent;
				copy.textContent = 'Kopiert ✓';
				setTimeout(function () { copy.textContent = old; }, 1800);
			});
		});
	}
})();
