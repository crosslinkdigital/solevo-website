<?php
/**
 * Two menus:
 *   Landing   - jumps to sections on the one-page homepage (live now)
 *   Full site - Physio, Studio, Pricing, About, Contact (switch on once pages are published)
 * The header navigation uses whichever is active (Appearance > Solevo setup).
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'render_block_data', function ( $block ) {
	if ( 'core/navigation' === $block['blockName'] && empty( $block['attrs']['ref'] ) && ! empty( $block['attrs']['className'] ) && false !== strpos( $block['attrs']['className'], 'solevo-primary-nav' ) ) {
		$mode = get_option( 'solevo_menu_mode', 'landing' );
		$ids  = get_option( 'solevo_menu_ids', array() );
		if ( ! empty( $ids[ $mode ] ) && get_post( $ids[ $mode ] ) ) {
			$block['attrs']['ref'] = (int) $ids[ $mode ];
		}
	}
	return $block;
} );

function solevo_nav_link( $label, $url, $page_id = 0 ) {
	$attrs = array( 'label' => $label, 'url' => $url );
	if ( $page_id ) {
		$attrs += array( 'type' => 'page', 'id' => $page_id, 'kind' => 'post-type' );
	} else {
		$attrs += array( 'kind' => 'custom' );
	}
	return '<!-- wp:navigation-link ' . wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES ) . ' /-->';
}

function solevo_nav_submenu( $label, $url, $page_id, $children ) {
	$attrs = array( 'label' => $label, 'url' => $url, 'type' => 'page', 'id' => $page_id, 'kind' => 'post-type' );
	return '<!-- wp:navigation-submenu ' . wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES ) . ' -->' . implode( '', $children ) . '<!-- /wp:navigation-submenu -->';
}

/** Build (or rebuild) both menus. $page_ids maps path => ID. */
function solevo_build_menus( $page_ids ) {
	$link = function ( $path, $label = null ) use ( $page_ids ) {
		$id    = $page_ids[ $path ] ?? 0;
		$label = $label ?: ( $id ? get_the_title( $id ) : $path );
		return solevo_nav_link( $label, home_url( '/' . $path ), $id );
	};

	$landing = implode( '', array(
		solevo_nav_link( 'About', '/#physio' ),
		solevo_nav_link( 'Team', '/#team' ),
		solevo_nav_link( 'Services', '/#services' ),
		solevo_nav_link( 'Studio', '/#studio' ),
		solevo_nav_link( 'Pricing', '/#pricing' ),
	) );

	// Full site menu (rebuild brief, section 19): Physio, Studio, Pricing, About, Contact + the header Book button.
	$full = implode( '', array(
		solevo_nav_submenu( 'Physio', home_url( '/physio' ), $page_ids['physio'] ?? 0, array(
			$link( 'physio', 'Physiotherapy' ),
			$link( 'physio/sports-physiotherapy', 'Sports physiotherapy' ),
			$link( 'physio/pregnancy-physiotherapy', 'Pregnancy' ),
			$link( 'physio/postnatal-physiotherapy', 'Postnatal' ),
			$link( 'physio/seniors-physiotherapy', 'Seniors' ),
			$link( 'conditions', 'Conditions we treat' ),
		) ),
		solevo_nav_submenu( 'Studio', home_url( '/pilates' ), $page_ids['pilates'] ?? 0, array(
			$link( 'pilates', 'Reformer Pilates' ),
			$link( 'pilates/clinical-pilates', 'Clinical Pilates' ),
			$link( 'pilates/mat-pilates', 'Mat Pilates' ),
			$link( 'pilates/private-pilates', 'Private Pilates' ),
			$link( 'pilates/mums-and-bubs', 'Mums and Bubs' ),
			$link( 'pilates/seniors', 'Seniors' ),
			$link( 'pilates/pregnancy-pilates', 'Pregnancy' ),
			$link( 'pilates/postnatal-pilates', 'Postnatal' ),
			$link( 'pilates/over-50s-fitness', 'Over 50s fitness' ),
		) ),
		$link( 'about', 'About' ),
		$link( 'contact', 'Contact' ),
	) );

	$ids = get_option( 'solevo_menu_ids', array() );
	foreach ( array( 'landing' => array( 'Landing menu', $landing ), 'full' => array( 'Full site menu', $full ) ) as $key => $menu ) {
		$args = array( 'post_type' => 'wp_navigation', 'post_status' => 'publish', 'post_title' => $menu[0], 'post_content' => $menu[1] );
		if ( ! empty( $ids[ $key ] ) && get_post( $ids[ $key ] ) ) {
			$args['ID'] = $ids[ $key ];
			wp_update_post( wp_slash( $args ) );
		} else {
			$ids[ $key ] = wp_insert_post( wp_slash( $args ) );
		}
	}
	update_option( 'solevo_menu_ids', $ids, false );
	if ( ! get_option( 'solevo_menu_mode' ) ) {
		update_option( 'solevo_menu_mode', 'landing' );
	}
	return $ids;
}
