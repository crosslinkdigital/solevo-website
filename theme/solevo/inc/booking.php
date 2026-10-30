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
	$cliniko = solevo_opt( 'cliniko_url' );
	return array(
		'#cliniko'  => array( 'url' => $cliniko ?: $book, 'class' => 'solevo-book-physio', 'event' => 'click_book_physio', 'external' => (bool) $cliniko ),
		// Location-specific physio booking (Cliniko business / practitioner deep links). Fall back to the main Cliniko URL.
		'#cliniko-location1' => array( 'url' => solevo_opt( 'cliniko_url_location1' ) ?: ( $cliniko ?: $book ), 'class' => 'solevo-book-physio', 'event' => 'click_book_physio', 'external' => (bool) ( solevo_opt( 'cliniko_url_location1' ) ?: $cliniko ), 'location' => sanitize_title( solevo_opt( 'location1_area' ) ) ),
		'#cliniko-location2' => array( 'url' => solevo_opt( 'cliniko_url_location2' ) ?: ( $cliniko ?: $book ), 'class' => 'solevo-book-physio', 'event' => 'click_book_physio', 'external' => (bool) ( solevo_opt( 'cliniko_url_location2' ) ?: $cliniko ), 'location' => sanitize_title( solevo_opt( 'location2_area' ) ) ),
		'#mindbody' => array( 'url' => solevo_opt( 'mindbody_url' ) ?: $book, 'class' => 'solevo-book-class', 'event' => 'click_book_class', 'external' => (bool) solevo_opt( 'mindbody_url' ) ),
		'#phone'    => array( 'url' => $phone ? 'tel:' . $phone : solevo_published_url( 'contact', '/#book' ), 'class' => 'solevo-call', 'event' => 'click_call', 'external' => false ),
		// The Foot Company (podiatry partner). Until the URL is set in Settings, points to /about.
		'#tfc'      => array( 'url' => solevo_opt( 'tfc_url' ) ?: solevo_published_url( 'about', '/' ), 'class' => 'solevo-tfc', 'event' => 'click_tfc', 'external' => (bool) solevo_opt( 'tfc_url' ) ),
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
			if ( ! empty( $t['location'] ) ) {
				$p->set_attribute( 'data-location', $t['location'] );
			}
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
		'pricing'   => '/pilates',
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

// Header Call button: hidden until a phone number is set, and always shows the current number.
add_filter( 'render_block_core/button', function ( $content, $block ) {
	if ( empty( $block['attrs']['className'] ) || false === strpos( $block['attrs']['className'], 'solevo-header__call' ) ) {
		return $content;
	}
	$phone = solevo_opt( 'phone' );
	if ( ! $phone ) {
		return '';
	}
	$html = sprintf( '<div class="wp-block-button is-style-outline solevo-header__call"><a class="wp-block-button__link wp-element-button" href="#phone" aria-label="Call Solevo on %1$s"><span class="solevo-header__call-num">%1$s</span><span class="solevo-header__call-short">Call</span></a></div>', esc_html( $phone ) );
	return solevo_rewrite_links( $html );
}, 5, 2 );

/**
 * Header "Book Now" follows the page: physio pages say Book Physio (Cliniko), studio pages
 * say Book Studio (Mindbody), everything else goes to /book. Keeps the two journeys apart.
 */
add_filter( 'render_block_core/button', function ( $content, $block ) {
	if ( empty( $block['attrs']['className'] ) || false === strpos( $block['attrs']['className'], 'solevo-header__book' ) || ! is_singular( 'page' ) ) {
		return $content;
	}
	$booking = solevo_page_booking();
	$def     = solevo_page_def();
	if ( 'cliniko' === $booking ) {
		$label = isset( $def['cta'] ) ? 'Book Now' : 'Book Physio'; // keep the header button short on mobile
		$href  = '#cliniko';
	} elseif ( 'mindbody' === $booking ) {
		$label = 'Book Studio';
		$href  = '#mindbody';
	} else {
		return $content;
	}
	$html = sprintf( '<div class="wp-block-button solevo-header__book"><a class="wp-block-button__link wp-element-button" href="%s">%s</a></div>', esc_attr( $href ), esc_html( $label ) );
	return solevo_rewrite_links( $html );
}, 6, 2 );

/** Mobile sticky booking bar on physio and studio pages. */
add_action( 'wp_footer', function () {
	if ( ! is_singular( 'page' ) && ! is_front_page() ) {
		return;
	}
	$def = solevo_page_def();
	if ( ! $def || in_array( $def['type'], array( 'book', 'contact' ), true ) ) {
		return;
	}
	$booking = $def['booking'];
	$links   = array();
	if ( 'cliniko' === $booking ) {
		$links[] = array( $def['cta'] ?? 'Book Physio', '#cliniko', 'is-primary' );
	} elseif ( 'mindbody' === $booking ) {
		$links[] = array( 'Book Studio', '#mindbody', 'is-primary' );
	} else {
		$links[] = array( 'Book Physio', '#cliniko', 'is-primary' );
		$links[] = array( 'Book Studio', '#mindbody', 'is-primary is-alt' );
	}
	if ( solevo_opt( 'phone' ) && count( $links ) < 2 ) {
		$links[] = array( 'Call', '#phone', '' );
	}
	$html = '<nav class="solevo-sticky" aria-label="Book">';
	foreach ( $links as $l ) {
		$html .= sprintf( '<a class="solevo-sticky__btn %s" href="%s">%s</a>', esc_attr( $l[2] ), esc_attr( $l[1] ), esc_html( $l[0] ) );
	}
	echo solevo_rewrite_links( $html . '</nav>' ); // phpcs:ignore WordPress.Security.EscapeOutput
} );

/**
 * Links to pages that are not published yet (drafts) would 404 for visitors. Until a page
 * goes live, hide the pill, text link or button that points to it. Editors still see it.
 */
function solevo_unpublished_target( $html ) {
	if ( ! preg_match( '/href="(' . preg_quote( home_url( '/' ), '/' ) . '[^"#?]+)/', $html, $m ) ) {
		return false;
	}
	$path = trim( wp_parse_url( $m[1], PHP_URL_PATH ), '/' );
	$page = $path ? get_page_by_path( $path ) : null;
	return $page && 'publish' !== $page->post_status;
}
add_filter( 'render_block', function ( $content, $block ) {
	if ( is_admin() || current_user_can( 'edit_pages' ) ) {
		return $content;
	}
	$name  = $block['blockName'];
	$class = $block['attrs']['className'] ?? '';
	$check = 'core/list-item' === $name || 'core/button' === $name || ( 'core/paragraph' === $name && preg_match( '/solevo-more|solevo-qbox__cta/', $class ) );
	if ( $check && solevo_unpublished_target( $content ) ) {
		return '';
	}
	return $content;
}, 20, 2 );
