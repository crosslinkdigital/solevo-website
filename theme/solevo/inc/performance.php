<?php
/**
 * 1.4.24 / 1.4.25: plugin stylesheets that only style widgets below the first screen load without
 * blocking the first paint (Google reviews by Trustindex, Instagram Feed by Smash Balloon).
 *
 * They are printed in wp_head by the plugins themselves (Trustindex echoes its own <link>), so
 * wp_head is buffered and only those <link> tags are rewritten: media="print" until loaded, then
 * "all". A <noscript> copy keeps them working without JavaScript. Everything else is untouched.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

function solevo_deferred_css_patterns() {
	return array(
		'trustindex-google-widget.css',
		'/plugins/instagram-feed/css/sbi-styles',
		'/plugins/instagram-feed/assets/tokens/sb-tokens-local.css',
	);
}

function solevo_defer_plugin_css( $html ) {
	/* Trustindex also preloads its stylesheet at high priority in the head, competing with the hero image: drop that hint. */
	$html = preg_replace( '/<link\b[^>]*rel=[\'"]preload[\'"][^>]*trustindex-google-widget\.css[^>]*>\s*/i', '', $html );
	return preg_replace_callback( '/<link\b[^>]*rel=[\'"]stylesheet[\'"][^>]*>/i', function ( $m ) {
		$tag = $m[0];
		$hit = false;
		foreach ( solevo_deferred_css_patterns() as $needle ) {
			if ( false !== strpos( $tag, $needle ) ) {
				$hit = true;
				break;
			}
		}
		if ( ! $hit || false !== strpos( $tag, 'onload=' ) ) {
			return $tag;
		}
		$deferred = preg_replace( '/\smedia=([\'"])[^\'"]*\1/i', '', $tag );
		$deferred = preg_replace( '#\s*/?>$#', ' media="print" onload="this.media=\'all\';this.onload=null">', $deferred );
		return $deferred . '<noscript>' . $tag . '</noscript>';
	}, $html );
}

add_action( 'wp_head', function () {
	if ( ! is_admin() ) {
		ob_start();
	}
}, -1000 );

add_action( 'wp_head', function () {
	if ( ! is_admin() && ob_get_level() > 0 ) {
		echo solevo_defer_plugin_css( ob_get_clean() ); // phpcs:ignore WordPress.Security.EscapeOutput -- rewrites already-printed head markup.
	}
}, PHP_INT_MAX );
