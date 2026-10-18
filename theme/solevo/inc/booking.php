<?php
/**
 * Booking links. Editors link any button or text to:
 *   #cliniko   -> physio booking (Cliniko URL from Settings > Solevo)
 *   #mindbody  -> class booking (Mindbody URL)
 *   #phone     -> tap to call
 *   #email     -> email
 * The real URL, tracking class and data attribute are added when the page renders,
 * so booking links change in one place and every click is trackable.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

function solevo_link_targets() {
	$phone = preg_replace( '/[^0-9+]/', '', solevo_opt( 'phone' ) );
	$book  = solevo_published_url( 'book', '/#book' );
	return array(
		'#cliniko'  => array( 'url' => solevo_opt( 'cliniko_url' ) ?: $book, 'class' => 'solevo-book-physio', 'event' => 'click_book_physio', 'external' => (bool) solevo_opt( 'cliniko_url' ) ),
		'#mindbody' => array( 'url' => solevo_opt( 'mindbody_url' ) ?: $book, 'class' => 'solevo-book-class', 'event' => 'click_book_class', 'external' => (bool) solevo_opt( 'mindbody_url' ) ),
		'#phone'    => array( 'url' => $phone ? 'tel:' . $phone : solevo_published_url( 'contact', '/#book' ), 'class' => 'solevo-call', 'event' => 'click_call', 'external' => false ),
		'#email'    => array( 'url' => 'mailto:' . solevo_opt( 'email' ), 'class' => 'solevo-email', 'event' => 'click_email', 'external' => false ),
		// Header button: /book once that page is published, otherwise the booking section on the homepage.
		'#booknow'  => array( 'url' => solevo_published_url( 'book', '/#book' ), 'class' => 'solevo-book', 'event' => 'click_book', 'external' => false ),
	);
}

function solevo_rewrite_links( $html ) {
	if ( false === strpos( $html, 'href="#' ) && false === strpos( $html, 'href="tel:' ) ) {
		return $html;
	}
	$targets = solevo_link_targets();
	$p       = new WP_HTML_Tag_Processor( $html );
	while ( $p->next_tag( 'a' ) ) {
		$href = (string) $p->get_attribute( 'href' );
		if ( isset( $targets[ $href ] ) ) {
			$t = $targets[ $href ];
			$p->set_attribute( 'href', $t['url'] );
			$p->add_class( $t['class'] );
			$p->set_attribute( 'data-track', $t['event'] );
			if ( $t['external'] ) {
				$p->set_attribute( 'rel', 'noopener' );
			}
		} elseif ( 0 === strpos( $href, 'tel:' ) ) {
			$p->add_class( 'solevo-call' );
			$p->set_attribute( 'data-track', 'click_call' );
		}
	}
	return $p->get_updated_html();
}

add_filter( 'render_block', function ( $content, $block ) {
	$names = array( 'core/button', 'core/paragraph', 'core/list-item', 'core/heading', 'core/navigation-link', 'core/html' );
	if ( in_array( $block['blockName'], $names, true ) ) {
		return solevo_rewrite_links( $content );
	}
	return $content;
}, 10, 2 );

/**
 * Old one-page anchors -> new pages. Runs in the browser (the # part of a URL never
 * reaches the server, so a 301 is impossible). Only fires on the homepage and only
 * when no section with that id exists on the page any more.
 */
function solevo_hash_redirects() {
	$map = array(
		'physio'    => '/physio',
		'services'  => '/physio',
		'team'      => '/about',
		'studio'    => '/pilates',
		'pricing'   => '/pilates#pricing',
		'book'      => '/book',
		'timetable' => '/book#timetable',
	);
	// Only redirect to pages that are live.
	$out = array();
	foreach ( $map as $hash => $target ) {
		$path = trim( strtok( $target, '#' ), '/' );
		$page = get_page_by_path( $path );
		if ( $page && 'publish' === $page->post_status ) {
			$out[ $hash ] = $target;
		}
	}
	return $out;
}

/** URL of a page by path if it is published, else a fallback (relative to home). */
function solevo_published_url( $path, $fallback ) {
	static $cache = array();
	if ( ! isset( $cache[ $path ] ) ) {
		$page           = get_page_by_path( $path );
		$cache[ $path ] = ( $page && 'publish' === $page->post_status ) ? get_permalink( $page ) : home_url( $fallback );
	}
	return $cache[ $path ];
}

// Hide the header Call button until a phone number is set.
add_filter( 'render_block_core/button', function ( $content, $block ) {
	if ( ! empty( $block['attrs']['className'] ) && false !== strpos( $block['attrs']['className'], 'solevo-header__call' ) && ! solevo_opt( 'phone' ) ) {
		return '';
	}
	return $content;
}, 5, 2 );
