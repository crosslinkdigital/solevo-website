<?php
/**
 * Permanent redirects for pages that were removed (1.3.11).
 * Only fires when no published page lives at the old address, so a page can be brought back
 * simply by publishing it again. Lives in the theme so it moves to Bluehost with the site.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

function solevo_redirects() {
	return array(
		// Steph, 25 Oct: pelvic floor is no longer offered as a service.
		'physio/pelvic-floor-physiotherapy' => 'physio',
		// Steph's audit, 20 Oct: remove the old Mums & Bubs campaign page.
		'pilates/mums-and-bubs'             => 'physio/pregnancy-physiotherapy',
	);
}

add_action( 'template_redirect', function () {
	if ( ! is_404() && ! ( is_singular( 'page' ) && 'publish' !== get_post_status() ) ) {
		return;
	}
	$path = trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
	$map  = solevo_redirects();
	if ( ! isset( $map[ $path ] ) ) {
		return;
	}
	$page = get_page_by_path( $path, OBJECT, 'page' );
	if ( ! $page || 'publish' !== $page->post_status ) {
		wp_safe_redirect( home_url( '/' . $map[ $path ] ), 301, 'Solevo' );
		exit;
	}
} );
