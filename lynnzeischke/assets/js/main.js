/* Lynn Zeischke – Menü, Bürolicht-Schalter, Tabs, Seitenleisten-Punkte */
(function () {
	'use strict';

	// Mobiles Menü
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

	// Bürolicht an (hell) / aus (dunkel)
	var root = document.documentElement;
	var themeBtn = document.querySelector('.theme-toggle');
	function paint() {
		if (!themeBtn) { return; }
		var dark = root.getAttribute('data-theme') === 'dark';
		themeBtn.querySelector('.label').textContent = dark ? themeBtn.dataset.labelOff : themeBtn.dataset.labelOn;
		themeBtn.setAttribute('aria-pressed', dark ? 'true' : 'false');
	}
	if (themeBtn) {
		paint();
		themeBtn.addEventListener('click', function () {
			var dark = root.getAttribute('data-theme') !== 'dark';
			if (dark) { root.setAttribute('data-theme', 'dark'); } else { root.removeAttribute('data-theme'); }
			try { localStorage.setItem('lz-theme', dark ? 'dark' : 'light'); } catch (e) {}
			paint();
		});
	}

	// Tabs Handwerk / Gastronomie
	var tabs = Array.prototype.slice.call(document.querySelectorAll('.tab-btn'));
	function select(tab) {
		tabs.forEach(function (t) {
			var on = t === tab;
			t.setAttribute('aria-selected', on ? 'true' : 'false');
			t.tabIndex = on ? 0 : -1;
			document.getElementById(t.getAttribute('aria-controls')).hidden = !on;
		});
	}
	tabs.forEach(function (tab, i) {
		tab.addEventListener('click', function () { select(tab); });
		tab.addEventListener('keydown', function (e) {
			if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
				var next = tabs[(i + (e.key === 'ArrowRight' ? 1 : tabs.length - 1)) % tabs.length];
				select(next);
				next.focus();
			}
		});
	});

	// Aktiven Abschnitt in der Seitenleiste markieren
	var dots = document.querySelectorAll('.rail-dots a[data-section]');
	if (dots.length && 'IntersectionObserver' in window) {
		var byId = {};
		dots.forEach(function (d) { byId[d.dataset.section] = d; });
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (en) {
				if (en.isIntersecting && byId[en.target.id]) {
					dots.forEach(function (d) { d.classList.remove('is-active'); });
					byId[en.target.id].classList.add('is-active');
				}
			});
		}, { rootMargin: '-45% 0px -50% 0px' });
		Object.keys(byId).forEach(function (id) {
			var el = document.getElementById(id);
			if (el) { io.observe(el); }
		});
	}
})();
