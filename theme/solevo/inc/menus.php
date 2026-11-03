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

function solevo_nav_submenu( $label, $url, $page_id, $children, $class = '' ) {
	$attrs = array( 'label' => $label, 'url' => $url, 'type' => 'page', 'id' => $page_id, 'kind' => 'post-type' );
	if ( $class ) {
		$attrs['className'] = $class;
	}
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

	// Only link to pages that are live, so a draft (e.g. NDIS before Emma's review) never shows in the menu.
	$live = function ( $path, $label = null ) use ( $page_ids, $link ) {
		$id = $page_ids[ $path ] ?? 0;
		return ( $id && 'publish' === get_post_status( $id ) ) ? $link( $path, $label ) : '';
	};

	// Full site menu, 1.4.0 (Steph, 3 Nov; like Beachlife, PhysioWard and Rebound Health):
	// What we treat / Exercise & programs / Services dropdowns, then About and Contact, plus the phone and Book buttons.
	$full = implode( '', array(
		solevo_nav_submenu( 'What we treat', home_url( '/conditions' ), $page_ids['conditions'] ?? 0, array(
			$link( 'conditions', 'All conditions' ),
			$live( 'conditions/lower-back-pain', 'Lower back pain' ),
			$live( 'conditions/sciatica', 'Sciatica' ),
			$live( 'conditions/herniated-disc', 'Herniated disc' ),
			$live( 'conditions/spinal-stenosis', 'Spinal stenosis' ),
			$live( 'conditions/sports-injuries-rehab', 'Sports injuries' ),
			$live( 'conditions/shin-splints', 'Shin splints' ),
			$live( 'conditions/pregnancy-back-pain', 'Pregnancy back pain' ),
			$live( 'conditions/balance-falls-prevention', 'Balance and falls' ),
			$live( 'conditions/osteoporosis-pilates', 'Osteoporosis' ),
		), 'solevo-mega solevo-mega--2col' ),
		solevo_nav_submenu( 'Exercise &amp; programs', home_url( '/pilates' ), $page_ids['pilates'] ?? 0, array(
			$link( 'pilates', 'Reformer Pilates' ),
			$live( 'pilates/clinical-pilates', 'Clinical Pilates' ),
			$live( 'pilates/mat-pilates', 'Mat Pilates' ),
			solevo_nav_link( 'Yoga', home_url( '/pilates#classes' ) ),
			$live( 'pilates/seniors', 'Seniors Pilates' ),
			$live( 'pilates/postnatal-pilates', 'Postnatal Pilates' ),
		), 'solevo-mega' ),
		solevo_nav_submenu( 'Services', home_url( '/physio' ), $page_ids['physio'] ?? 0, array(
			$live( 'physio/sports-physiotherapy', 'Sports physio' ),
			$link( 'physio', 'General physio' ),
			$live( 'physio/pre-and-post-surgery-rehab', 'Pre and post surgery rehab' ),
			$live( 'physio/seniors-physiotherapy', 'Physio for seniors' ),
			$live( 'physio/shockwave-therapy', 'Shockwave therapy' ),
			$live( 'physio/workers-compensation', 'WorkCover physio' ),
			$live( 'physio/ndis', 'NDIS physio' ),
		), 'solevo-mega' ),
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
