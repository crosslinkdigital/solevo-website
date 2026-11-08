/* Solevo front end: old one-page anchors -> new pages, and click tracking for GTM/GA4. */
(function () {
	'use strict';
	var cfg = window.solevoSite || {};

	// 1. Old solevo.com.au/#section links -> new pages (only when the section no longer exists here).
	var hash = window.location.hash.replace('#', '');
	var homePath = cfg.home ? new URL(cfg.home).pathname : '/';
	if (hash && window.location.pathname === homePath && cfg.redirects && cfg.redirects[hash] && !document.getElementById(hash)) {
		window.location.replace(cfg.redirects[hash]);
		return;
	}

	// 2. Click events: click_book_physio, click_book_class, click_book, click_call, click_email.
	window.dataLayer = window.dataLayer || [];
	// Every event goes to the dataLayer (GTM) and, when the GA4 Google tag is on the page, to GA4 too.
	function track(data) {
		window.dataLayer.push(data);
		if (typeof window.gtag === 'function') {
			var params = {};
			for (var k in data) { if (k !== 'event') params[k] = data[k]; }
			window.gtag('event', data.event, params);
		}
	}
	window.solevoTrack = track;
	document.addEventListener('click', function (e) {
		if (e.solevoChooser) return; // opened the clinic chooser; the clinic picked is tracked instead
		var link = e.target.closest && e.target.closest('a[data-track], a[href^="tel:"], a[href^="mailto:"]');
		if (!link) return;
		var event = link.getAttribute('data-track') ||
			(link.href.indexOf('tel:') === 0 ? 'click_call' : 'click_email');
		track({
			event: event,
			link_url: link.href,
			link_text: (link.textContent || '').trim().slice(0, 80),
			location: link.getAttribute('data-location') || '',
			page_path: window.location.pathname
		});
	}, { passive: true });

	// 3. Form submissions (contact forms added later).
	document.addEventListener('submit', function (e) {
		var form = e.target;
		if (form && form.matches && form.matches('form:not([role="search"])')) {
			track({ event: 'form_submit', form_id: form.id || '', page_path: window.location.pathname });
		}
	});

	// 4. Mobile sticky booking bar: show once the hero's own buttons have scrolled away.
	var sticky = document.querySelector('.solevo-sticky');
	if (sticky) {
		var heroBtns = document.querySelector('.solevo-hero2 .wp-block-buttons, .solevo-page-hero .wp-block-buttons, .solevo-hero__cta');
		var band = document.querySelector('.solevo-cta2, .solevo-band');
		var state = { hero: !heroBtns, band: false };
		var update = function () { sticky.classList.toggle('is-visible', state.hero && !state.band); };
		if ('IntersectionObserver' in window) {
			if (heroBtns) new IntersectionObserver(function (e) { state.hero = !e[0].isIntersecting && e[0].boundingClientRect.top < 0; update(); }).observe(heroBtns);
			if (band) new IntersectionObserver(function (e) { state.band = e[0].isIntersecting; update(); }).observe(band);
		} else { state.hero = true; }
		update();
	}

	// 5. Header shadow once the page scrolls.
	var header = document.querySelector('.solevo-header');
	if (header) {
		var onScroll = function () { header.classList.toggle('is-scrolled', window.scrollY > 8); };
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();
	}
})();

// 5. Hero video. Desktop (900px+): muted autoplay loop while visible, with a sound toggle.
//    Phones and tablets: poster with a play button; nothing downloads until tapped.
//    Reduced motion: poster with a play button on every screen.
(function () {
	'use strict';
	var fig = document.querySelector('.solevo-hero2__video');
	var video = fig && fig.querySelector('video');
	if (!video || !window.matchMedia) return;
	var calm = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var desktop = window.matchMedia('(min-width: 900px)').matches;

	function button(cls, text) {
		var b = document.createElement('button');
		b.type = 'button';
		b.className = cls;
		b.textContent = text;
		fig.appendChild(b);
		return b;
	}

	if (desktop && !calm) {
		var sound = button('solevo-hero2__sound', 'Sound on');
		sound.setAttribute('aria-pressed', 'false');
		sound.addEventListener('click', function () {
			video.muted = !video.muted;
			if (!video.muted) { video.play(); }
			sound.textContent = video.muted ? 'Sound on' : 'Sound off';
			sound.setAttribute('aria-pressed', video.muted ? 'false' : 'true');
		});
		if ('IntersectionObserver' in window) {
			new IntersectionObserver(function (entries) {
				entries.forEach(function (e) {
					if (e.isIntersecting) { var p = video.play(); if (p && p.catch) p.catch(function () {}); }
					else { video.pause(); }
				});
			}, { threshold: 0.25 }).observe(video);
		} else {
			video.play();
		}
		return;
	}

	// Tap to play (with sound, since the visitor chose to start it).
	fig.classList.add('is-tap');
	var play = button('solevo-hero2__play', 'Play video');
	play.setAttribute('aria-label', 'Play the Solevo intro video');
	play.addEventListener('click', function () {
		video.muted = false;
		video.controls = true;
		video.loop = false;
		var p = video.play();
		if (p && p.catch) p.catch(function () {});
		play.remove();
		fig.classList.remove('is-tap');
		(window.solevoTrack || function (d) { (window.dataLayer = window.dataLayer || []).push(d); })({ event: 'video_play', video: 'solevo_intro', page_path: window.location.pathname });
	});
})();

// 6. Homepage background video (only when set in Settings). Starts after the page has loaded,
//    so it never delays the first paint. Skipped for reduced motion and data saver: poster only.
(function () {
	'use strict';
	var v = document.querySelector('.solevo-hero2__bgvideo');
	if (!v || !v.dataset.src) return;
	var calm = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var saver = navigator.connection && navigator.connection.saveData;
	if (calm || saver) return;
	function start() { v.src = v.dataset.src; var p = v.play(); if (p && p.catch) p.catch(function () {}); }
	if (document.readyState === 'complete') start(); else window.addEventListener('load', start);
})();

// 7. Location chips and other #locations links: when a page has no Locations section,
//    send them to both clinics in the footer instead.
(function () {
	'use strict';
	if (document.getElementById('locations') || !document.getElementById('find-us')) return;
	document.querySelectorAll('a[href="#locations"]').forEach(function (a) { a.setAttribute('href', '#find-us'); });
})();

// 8. Clinic chooser (1.4.19). Book Physio buttons open a pop-up: Brookvale (Cliniko) or
//    Terrey Hills (its own booking link). The pick is tracked as click_book_physio with
//    location brookvale / terrey-hills; opening the pop-up is booking_chooser_open.
//    No pop-up on the page (link not set, Pilates page) or an old browser: buttons go straight to Cliniko.
(function () {
	'use strict';
	var dlg = document.getElementById('solevo-chooser');
	if (!dlg || typeof dlg.showModal !== 'function') return;
	var cfg = window.solevoSite || {};
	var cliniko = '';
	try { cliniko = cfg.cliniko ? new URL(cfg.cliniko, window.location.href).href : ''; } catch (err) { cliniko = ''; }
	var opener = null;

	function opensChooser(a) {
		if (!a || dlg.contains(a)) return false;
		if (a.hasAttribute('data-choose')) return true;
		// Plain Cliniko links typed into text (e.g. "Book online" in blog posts). Book Studio uses the same link: skip it.
		return !!cliniko && a.href === cliniko && !a.hasAttribute('data-location') && !a.classList.contains('solevo-book-class');
	}

	document.addEventListener('click', function (e) {
		if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
		var a = e.target.closest && e.target.closest('a[href]');
		if (!opensChooser(a)) return;
		e.preventDefault();
		e.solevoChooser = true;
		opener = a;
		dlg.showModal();
		(window.solevoTrack || function (d) { (window.dataLayer = window.dataLayer || []).push(d); })({
			event: 'booking_chooser_open',
			link_text: (a.textContent || '').trim().slice(0, 80),
			page_path: window.location.pathname
		});
	}, true);

	// Close: the X, a click outside the box, or Esc (built into <dialog>).
	dlg.addEventListener('click', function (e) {
		if (e.target === dlg || (e.target.closest && e.target.closest('.solevo-chooser__close'))) dlg.close();
	});
	dlg.addEventListener('close', function () {
		if (opener && opener.focus) opener.focus();
		opener = null;
	});
	// Coming back with the browser's Back button: don't leave the pop-up open.
	window.addEventListener('pageshow', function () { if (dlg.open) dlg.close(); });
})();
