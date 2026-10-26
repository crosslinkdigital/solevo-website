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
	document.addEventListener('click', function (e) {
		var link = e.target.closest && e.target.closest('a[data-track], a[href^="tel:"], a[href^="mailto:"]');
		if (!link) return;
		var event = link.getAttribute('data-track') ||
			(link.href.indexOf('tel:') === 0 ? 'click_call' : 'click_email');
		window.dataLayer.push({
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
			window.dataLayer.push({ event: 'form_submit', form_id: form.id || '', page_path: window.location.pathname });
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
		window.dataLayer && window.dataLayer.push({ event: 'video_play', video: 'solevo_intro', page_path: window.location.pathname });
	});
})();
