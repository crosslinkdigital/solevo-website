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
		if ( preg_match( '#<figure class="[^"]*solevo-hero2__video[^"]*">.*?</figure>#s', $content, $m ) ) {
			$content = str_replace( $m[0], '', $content );
			if ( ! $poster && preg_match( '/poster="([^"]+)"/', $m[0], $p ) ) {
				$poster = html_entity_decode( $p[1] );
			}
		}
		$bg = sprintf(
			'<div class="solevo-hero2__bg" aria-hidden="true"><video class="solevo-hero2__bgvideo" muted loop playsinline preload="none" data-src="%s"%s></video></div>',
			esc_url( $url ),
			$poster ? ' poster="' . esc_url( $poster ) . '"' : ''
		);
		$content = preg_replace( '/^(\s*<section\b[^>]*?class=")/', '$1has-bg-video ', $content, 1 );
		$content = preg_replace( '/^(\s*<section\b[^>]*>)/', '$1' . $bg, $content, 1 );
		return $content;
	}

	return $content;
}, 20, 2 );
