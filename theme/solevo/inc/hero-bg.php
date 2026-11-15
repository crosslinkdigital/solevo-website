<?php
/**
 * Homepage background video (1.3.8).
 *
 * When Settings > Solevo > "Homepage background video" holds a video URL, the homepage hero
 * becomes a full-width video behind the headline (muted loop, dark overlay, poster while it loads).
 * The captioned 4:5 intro video is then left out of the hero (Hayo, 26 Oct: no second video section).
 *
 * Works at render time, so page content is never rewritten: empty the setting and the
 * homepage goes back to the current layout. No homepage reset needed either way.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

/**
 * 1.4.23: the poster is the homepage's largest paint on phones (LCP). As a video poster the
 * browser only finds it after the CSS and scripts, so preload it first with high priority.
 */
add_action( 'wp_head', function () {
	if ( ! is_front_page() || ! solevo_opt( 'hero_bg_video' ) ) {
		return;
	}
	$poster = solevo_opt( 'hero_bg_poster' );
	if ( ! $poster ) {
		/* Same fallback as the hero below: the intro video's poster in the homepage content. */
		$front = get_post( (int) get_option( 'page_on_front' ) );
		if ( $front && preg_match( '#<figure class="[^"]*solevo-hero2__video[^"]*">.*?</figure>#s', $front->post_content, $m )
			&& preg_match( '/poster="([^"]+)"/', $m[0], $p ) ) {
			$poster = html_entity_decode( $p[1] );
		}
	}
	if ( ! $poster ) {
		return;
	}
	/* 1.4.24: phones up to 480px get the narrow crop when one is set; media queries match the <picture> below. */
	$mobile = solevo_opt( 'hero_bg_poster_mobile' );
	if ( $mobile ) {
		printf( '<link rel="preload" href="%s" as="image" fetchpriority="high" media="(max-width: 480px)">' . "\n", esc_url( $mobile ) );
		printf( '<link rel="preload" href="%s" as="image" fetchpriority="high" media="(min-width: 481px)">' . "\n", esc_url( $poster ) );
	} else {
		printf( '<link rel="preload" href="%s" as="image" fetchpriority="high">' . "\n", esc_url( $poster ) );
	}
}, 1 );

function solevo_has_class( $block, $class ) {
	return (bool) preg_match( '/(^|\s)' . preg_quote( $class, '/' ) . '(\s|$)/', $block['attrs']['className'] ?? '' );
}

add_filter( 'render_block', function ( $content, $block ) {
	if ( 'core/group' !== ( $block['blockName'] ?? '' ) || ! is_front_page() ) {
		return $content;
	}
	$url = solevo_opt( 'hero_bg_video' );
	if ( ! $url ) {
		return $content;
	}

	/* Hero: lift the 4:5 intro video out, put the background video behind the text. */
	if ( solevo_has_class( $block, 'solevo-hero2' ) ) {
		$poster = solevo_opt( 'hero_bg_poster' );
		$mobile = solevo_opt( 'hero_bg_video_mobile' );
		if ( preg_match( '#<figure class="[^"]*solevo-hero2__video[^"]*">.*?</figure>#s', $content, $m ) ) {
			$content = str_replace( $m[0], '', $content );
			if ( ! $poster && preg_match( '/poster="([^"]+)"/', $m[0], $p ) ) {
				$poster = html_entity_decode( $p[1] );
			}
		}
		/*
		 * 1.4.24: the still image is a <picture> behind the video instead of the video's poster, so the
		 * browser finds it straight away and phones can get a smaller crop. The video stays transparent
		 * until its first frame, so the still shows while it loads (and for reduced motion or data saver).
		 * 1.4.26: skip-lazy / data-no-lazy keep the Bluehost plugin from adding loading="lazy" to it.
		 */
		$picture = '';
		if ( $poster ) {
			$poster_m = solevo_opt( 'hero_bg_poster_mobile' );
			$picture  = '<picture class="solevo-hero2__poster">'
				. ( $poster_m ? '<source media="(max-width: 480px)" srcset="' . esc_url( $poster_m ) . '">' : '' )
				. '<img class="skip-lazy" data-no-lazy="1" src="' . esc_url( $poster ) . '" alt="" loading="eager" fetchpriority="high" decoding="async"></picture>';
		}
		$bg = sprintf(
			'<div class="solevo-hero2__bg" aria-hidden="true">%s<video class="solevo-hero2__bgvideo" muted loop playsinline preload="none" data-src="%s"%s></video></div>',
			$picture,
			esc_url( $url ),
			$mobile ? ' data-src-mobile="' . esc_url( $mobile ) . '"' : ''
		);
		$content = preg_replace( '/^(\s*<section\b[^>]*?class=")/', '$1has-bg-video ', $content, 1 );
		$content = preg_replace( '/^(\s*<section\b[^>]*>)/', '$1' . $bg, $content, 1 );
		return $content;
	}

	return $content;
}, 20, 2 );
