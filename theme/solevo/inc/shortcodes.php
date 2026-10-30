<?php
/**
 * Dynamic pieces editors drop in with a Shortcode block.
 *
 *   [solevo_breadcrumbs]  Home > Parent > Page (plus BreadcrumbList schema)
 *   [solevo_contact]      Address, phone, email from Settings (identical everywhere)
 *   [solevo_hours]        Opening hours from Settings
 *   [solevo_suburbs]      Suburbs served from Settings
 *   [solevo_map]          Google map of the address (lazy loaded)
 *   [solevo_timetable]    Mindbody timetable embed, or a booking button until it is pasted in
 *   [solevo_child_pages]  Cards for every published child page (category pages)
 *   [solevo_reviews]      Google reviews (Trustindex plugin) - hidden until connected
 *   [solevo_instagram]    Instagram feed (Smash Balloon plugin) - hidden until connected
 *   [solevo_year]         Current year for the footer
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

add_shortcode( 'solevo_year', function () {
	return esc_html( wp_date( 'Y' ) );
} );

add_shortcode( 'solevo_copyright', function () {
	return '<p class="solevo-copyright">&copy; ' . esc_html( wp_date( 'Y' ) . ' ' . solevo_opt( 'business_name' ) ) . '. Integrated with The Foot Company Podiatry.</p>';
} );

add_shortcode( 'solevo_social', function ( $atts ) {
	$atts = shortcode_atts( array( 'label' => '' ), $atts );
	$icon = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>';
	$out  = '<div class="solevo-social">';
	if ( solevo_opt( 'instagram_url' ) ) {
		$out .= sprintf( '<a href="%s" rel="noopener" aria-label="Solevo on Instagram">%s</a>', esc_url( solevo_opt( 'instagram_url' ) ), $icon );
	}
	if ( $atts['label'] ) {
		$out .= '<span>' . esc_html( $atts['label'] ) . '</span>';
	}
	return $out . '</div>';
} );

add_shortcode( 'solevo_breadcrumbs', function () {
	if ( is_front_page() || ! is_singular() ) {
		return '';
	}
	$post  = get_queried_object();
	$trail = array( array( 'name' => 'Home', 'url' => home_url( '/' ) ) );
	foreach ( array_reverse( get_post_ancestors( $post ) ) as $ancestor ) {
		$trail[] = array( 'name' => get_the_title( $ancestor ), 'url' => get_permalink( $ancestor ) );
	}
	$trail[] = array( 'name' => get_the_title( $post ), 'url' => get_permalink( $post ) );

	$items = array();
	$ld    = array();
	$last  = count( $trail ) - 1;
	foreach ( $trail as $i => $crumb ) {
		$items[] = $i === $last
			? sprintf( '<li aria-current="page">%s</li>', esc_html( $crumb['name'] ) )
			: sprintf( '<li><a href="%s">%s</a></li>', esc_url( $crumb['url'] ), esc_html( $crumb['name'] ) );
		$ld[]    = array( '@type' => 'ListItem', 'position' => $i + 1, 'name' => $crumb['name'], 'item' => $crumb['url'] );
	}
	$schema = array( '@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $ld );
	return '<nav class="solevo-breadcrumbs" aria-label="Breadcrumb"><ol>' . implode( '', $items ) . '</ol></nav>'
		. '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>';
} );

add_shortcode( 'solevo_contact', function ( $atts ) {
	$atts  = shortcode_atts( array( 'show' => 'address,phone,email' ), $atts );
	$show  = array_map( 'trim', explode( ',', $atts['show'] ) );
	$lines = array();
	if ( in_array( 'name', $show, true ) ) {
		$lines[] = '<strong>' . esc_html( solevo_opt( 'business_name' ) ) . '</strong>';
	}
	if ( in_array( 'address', $show, true ) && solevo_opt( 'address' ) ) {
		$maps    = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( solevo_opt( 'business_name' ) . ' ' . solevo_opt( 'address' ) );
		$lines[] = sprintf( '<a href="%s" rel="noopener">%s</a>', esc_url( $maps ), esc_html( solevo_opt( 'address' ) ) );
	}
	if ( in_array( 'phone', $show, true ) && solevo_opt( 'phone' ) ) {
		$tel     = preg_replace( '/[^0-9+]/', '', solevo_opt( 'phone' ) );
		$lines[] = sprintf( '<a class="solevo-call" data-track="click_call" href="tel:%s">%s</a>', esc_attr( $tel ), esc_html( solevo_opt( 'phone' ) ) );
	}
	if ( in_array( 'email', $show, true ) && solevo_opt( 'email' ) ) {
		$lines[] = sprintf( '<a class="solevo-email" data-track="click_email" href="mailto:%1$s">%1$s</a>', esc_html( solevo_opt( 'email' ) ) );
	}
	return '<address class="solevo-nap">' . implode( '<br>', $lines ) . '</address>';
} );

add_shortcode( 'solevo_hours', function () {
	$hours = trim( solevo_opt( 'hours' ) );
	if ( ! $hours ) {
		return current_user_can( 'edit_pages' ) ? solevo_admin_hint( 'Add opening hours in Settings > Solevo.' ) : '';
	}
	$rows = array_filter( array_map( 'trim', explode( "\n", $hours ) ) );
	return '<ul class="solevo-hours">' . implode( '', array_map( function ( $r ) {
		return '<li>' . esc_html( $r ) . '</li>';
	}, $rows ) ) . '</ul>';
} );

add_shortcode( 'solevo_suburbs', function () {
	return '<p class="solevo-suburbs">' . esc_html( solevo_opt( 'suburbs' ) ) . '</p>';
} );

add_shortcode( 'solevo_map', function () {
	$q = rawurlencode( solevo_opt( 'address' ) );
	return sprintf(
		'<div class="solevo-map"><iframe title="Map to %1$s" src="https://www.google.com/maps?q=%2$s&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe></div>',
		esc_attr( solevo_opt( 'business_name' ) ),
		$q
	);
} );

add_shortcode( 'solevo_timetable', function () {
	$embed = solevo_opt( 'mindbody_embed' );
	if ( $embed ) {
		return '<div class="solevo-timetable" id="timetable">' . $embed . '</div>'; // Stored by admins only, see settings.php.
	}
	$out = '<div class="solevo-timetable solevo-timetable--fallback" id="timetable"><div class="wp-block-buttons"><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#mindbody">View timetable and book a class</a></div></div></div>';
	if ( current_user_can( 'edit_pages' ) ) {
		$out .= solevo_admin_hint( 'Paste the Mindbody timetable widget code in Settings > Solevo to show the live timetable here.' );
	}
	return solevo_rewrite_links( $out );
} );

add_shortcode( 'solevo_child_pages', function ( $atts ) {
	$atts     = shortcode_atts( array( 'parent' => 0 ), $atts );
	$parent   = $atts['parent'] ? (int) $atts['parent'] : get_queried_object_id();
	$children = get_pages( array( 'parent' => $parent, 'sort_column' => 'menu_order,post_title', 'post_status' => 'publish' ) );
	if ( ! $children ) {
		return current_user_can( 'edit_pages' ) ? solevo_admin_hint( 'Child pages appear here as cards once they are published.' ) : '';
	}
	$cards = '';
	foreach ( $children as $child ) {
		$excerpt = has_excerpt( $child ) ? get_the_excerpt( $child ) : '';
		$cards  .= sprintf(
			'<li class="solevo-card"><a href="%s"><span class="solevo-card__title">%s</span>%s<span class="solevo-card__more" aria-hidden="true">Learn more &rarr;</span></a></li>',
			esc_url( get_permalink( $child ) ),
			esc_html( get_the_title( $child ) ),
			$excerpt ? '<span class="solevo-card__text">' . esc_html( $excerpt ) . '</span>' : ''
		);
	}
	return '<ul class="solevo-cards">' . $cards . '</ul>';
} );

/**
 * Third-party feeds. Each renders only when its plugin is active, so the section
 * never shows an empty box to visitors. Logged-in editors see setup instructions.
 */
add_shortcode( 'solevo_reviews', function () {
	if ( shortcode_exists( 'trustindex' ) ) {
		return '<div class="solevo-feed solevo-feed--reviews">' . do_shortcode( '[trustindex no-registration=google]' ) . '</div>';
	}
	// Not connected yet: still show the section, with a link to the real reviews on Google.
	$url = solevo_opt( 'google_reviews_url' );
	if ( ! $url ) {
		$url = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( solevo_opt( 'business_name' ) . ' ' . solevo_opt( 'address' ) );
	}
	$hint = current_user_can( 'activate_plugins' )
		? solevo_admin_hint( 'Google reviews: install the free "Widgets for Google Reviews" plugin by Trustindex and connect the Solevo Google Business Profile to show the live feed here. Until then visitors see this link to Google. Paste the exact reviews link in Settings > Solevo.' )
		: '';
	return sprintf(
		'<div class="solevo-feed solevo-revlink"><p class="solevo-revlink__text">See what our clients say about Solevo on Google.</p><div class="wp-block-buttons"><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="%s" target="_blank" rel="noopener" data-track="click_reviews">Read our Google reviews</a></div></div>%s</div>',
		esc_url( $url ),
		$hint
	);
} );

add_shortcode( 'solevo_instagram', function () {
	if ( shortcode_exists( 'instagram-feed' ) ) {
		return '<div class="solevo-feed solevo-feed--instagram">' . do_shortcode( '[instagram-feed]' ) . '</div>';
	}
	if ( current_user_can( 'activate_plugins' ) ) {
		return '<div class="solevo-feed solevo-feed--placeholder">' . solevo_admin_hint( 'Instagram: install the free "Smash Balloon Social Photo Feed" plugin and connect @solevo.studio (must be a Business or Creator account linked to a Facebook page). The feed then shows here. Until then visitors only see the Follow button.' ) . '</div>';
	}
	return '';
} );

function solevo_admin_hint( $text ) {
	return '<p class="solevo-admin-hint"><strong>Editor note (only you can see this):</strong> ' . esc_html( $text ) . '</p>';
}

// Shortcode blocks inside patterns and template parts are not run through the_content,
// so expand our own shortcodes when the block renders.
add_filter( 'render_block_core/shortcode', function ( $content ) {
	if ( false === strpos( $content, '[solevo_' ) ) {
		return $content;
	}
	$trimmed = trim( $content );
	if ( preg_match( '#^<p>\s*(\[solevo_[^\]]*\])\s*</p>$#', $trimmed, $m ) ) {
		$trimmed = $m[1]; // Drop the wpautop wrapper so block-level output is not nested in a <p>.
	}
	return do_shortcode( $trimmed );
}, 5 );

/* ---------------------------------------------------------------------------
 * Design system shortcodes
 *   [solevo_location_chips]               Both locations as small chips (hero)
 *   [solevo_locations service="physio"]   Location cards (physio | studio)
 *   [solevo_reviewed by="" role="" date=""]  "Reviewed by" line, hidden until filled in
 *   [solevo_todo]text[/solevo_todo]       Editor-only "to confirm" note, never shown to visitors
 *   [solevo_cta_band]                     Final booking band, matched to the page's booking path
 * ------------------------------------------------------------------------ */

/** Locations from Settings > Solevo. Location 2 is skipped when its name is empty. */
function solevo_locations() {
	$locs   = array();
	$locs[] = array(
		'key'     => 'location1',
		'area'    => solevo_opt( 'location1_area' ),
		'name'    => solevo_opt( 'business_name' ),
		'address' => solevo_opt( 'address' ),
		'hours'   => solevo_opt( 'hours' ),
		'note'    => solevo_opt( 'location1_note' ),
		'studio'  => true,
	);
	if ( solevo_opt( 'location2_name' ) ) {
		$locs[] = array(
			'key'     => 'location2',
			'area'    => solevo_opt( 'location2_area' ),
			'name'    => solevo_opt( 'location2_name' ),
			'address' => solevo_opt( 'location2_address' ),
			'hours'   => solevo_opt( 'location2_hours' ),
			'note'    => solevo_opt( 'location2_note' ),
			'studio'  => false,
		);
	}
	return $locs;
}

/**
 * [solevo_footer_locations] Both clinics side by side: map, address (street, entry note, suburb) and hours.
 * Everything comes from Settings > Solevo, so the footer, location cards and schema never disagree.
 */
add_shortcode( 'solevo_footer_locations', function () {
	$out = '';
	foreach ( solevo_locations() as $loc ) {
		$parts = array_map( 'trim', explode( ',', (string) $loc['address'], 2 ) );
		$addr  = array();
		if ( 'location2' === $loc['key'] && $loc['name'] ) {
			$addr[] = esc_html( $loc['name'] );
		}
		$addr[] = esc_html( $parts[0] );
		if ( 'location1' === $loc['key'] && solevo_opt( 'location1_access' ) ) {
			$addr[] = '<span class="solevo-floc__access">(' . esc_html( lcfirst( solevo_opt( 'location1_access' ) ) ) . ')</span>';
		}
		if ( ! empty( $parts[1] ) ) {
			$addr[] = esc_html( $parts[1] );
		}
		$book_line = '';
		if ( 'location2' === $loc['key'] && solevo_opt( 'location2_phone' ) ) {
			$th        = solevo_opt( 'location2_phone' );
			$book_line = sprintf( '<p class="solevo-floc__book">Bookings by phone: <a class="solevo-call" data-track="click_call" href="tel:%s">%s</a></p>', esc_attr( preg_replace( '/[^0-9+]/', '', $th ) ), esc_html( $th ) );
		}
		$rows = '';
		foreach ( solevo_lines( $loc['hours'] ) as $line ) {
			$bits  = array_map( 'trim', explode( ':', $line, 2 ) );
			$rows .= isset( $bits[1] )
				? '<li><span class="solevo-floc__day">' . esc_html( $bits[0] ) . '</span> <span>' . esc_html( $bits[1] ) . '</span></li>'
				: '<li>' . esc_html( $line ) . '</li>';
		}
		$out .= sprintf(
			'<div class="solevo-floc"><div class="solevo-floc__map"><iframe title="Map to Solevo %1$s" src="https://www.google.com/maps?q=%2$s&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div><div class="solevo-floc__grid"><div><p class="solevo-floc__label">%1$s</p><address class="solevo-floc__addr"><a href="%3$s" rel="noopener" data-track="click_directions">%4$s</a></address>%6$s</div><div><p class="solevo-floc__label">Hours</p>%5$s</div></div></div>',
			esc_html( $loc['area'] ),
			rawurlencode( $loc['name'] . ' ' . $loc['address'] ),
			esc_url( solevo_directions_url( $loc ) ),
			implode( '<br>', $addr ),
			$rows ? '<ul class="solevo-floc__hours">' . $rows . '</ul>' : ( current_user_can( 'edit_pages' ) ? solevo_admin_hint( 'Add opening hours in Settings > Solevo.' ) : '' ),
			$book_line
		);
	}
	return '<div class="solevo-flocs" id="find-us">' . $out . '</div>';
} );

/** [solevo_footer_contact] Big phone number and booking buttons for the top of the footer. */
add_shortcode( 'solevo_footer_contact', function () {
	$phone = solevo_opt( 'phone' );
	$out   = '<p class="solevo-floc__label">Contact</p>';
	if ( $phone ) {
		$out .= sprintf( '<a class="solevo-footer__phone solevo-call" data-track="click_call" href="tel:%s">%s</a>', esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ), esc_html( $phone ) );
	}
	$th = solevo_opt( 'location2_phone' );
	if ( $th && solevo_opt( 'location2_name' ) ) {
		// Terrey Hills is booked by phone through the medical centre (Steph, 28 Oct).
		$out .= sprintf( '<p class="solevo-footer__th">%s: <a class="solevo-call" data-track="click_call" href="tel:%s">%s</a></p>', esc_html( solevo_opt( 'location2_area' ) ), esc_attr( preg_replace( '/[^0-9+]/', '', $th ) ), esc_html( $th ) );
	}
	$out .= '<div class="wp-block-buttons solevo-footer__btns"><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#cliniko">Book Physio</a></div><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#mindbody">Book Studio</a></div></div>';
	return solevo_rewrite_links( '<div class="solevo-footer__contact">' . $out . '</div>' );
} );

function solevo_directions_url( $loc ) {
	return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $loc['name'] . ' ' . $loc['address'] );
}

function solevo_lines( $text ) {
	return array_values( array_filter( array_map( 'trim', explode( "\n", (string) $text ) ) ) );
}

add_shortcode( 'solevo_location_chips', function () {
	$out = '';
	foreach ( solevo_locations() as $loc ) {
		$hours  = solevo_lines( $loc['hours'] );
		$detail = 'location1' === $loc['key'] ? $loc['address'] : ( $hours[0] ?? $loc['name'] );
		$href   = '#locations';
		$th     = 'location2' === $loc['key'] ? solevo_opt( 'location2_phone' ) : '';
		if ( $th ) {
			// Terrey Hills is booked by phone through the medical centre: the chip calls it.
			$days   = preg_replace( '/:.*$/', 's', $hours[0] ?? '' );
			$detail = trim( ( $days ? $days . ' · ' : '' ) . 'Call ' . $th );
			$href   = 'tel:' . preg_replace( '/[^0-9+]/', '', $th );
		}
		// Terrey Hills shows its street address above the days and phone (Steph, 30 Oct).
		$addr   = $th && ! empty( $loc['address'] ) ? '<span class="solevo-chip__detail">' . esc_html( $loc['address'] ) . '</span>' : '';
		$out   .= sprintf(
			'<li><a href="%s"%s><span class="solevo-chip__area">%s</span>%s<span class="solevo-chip__detail">%s</span></a></li>',
			esc_attr( $href ),
			$th ? ' class="solevo-call" data-track="click_call"' : '',
			esc_html( $loc['area'] ),
			$addr,
			esc_html( $detail )
		);
	}
	return '<ul class="solevo-chips" aria-label="Locations">' . $out . '</ul>';
} );

add_shortcode( 'solevo_locations', function ( $atts ) {
	$atts  = shortcode_atts( array( 'service' => 'physio' ), $atts );
	$cards = '';
	foreach ( solevo_locations() as $loc ) {
		if ( in_array( $atts['service'], array( 'studio', 'clinical' ), true ) && ! $loc['studio'] ) {
			continue;
		}
		$hours = solevo_lines( $loc['hours'] );
		$hours_html = $hours
			? '<ul class="solevo-loc__hours">' . implode( '', array_map( function ( $h ) {
				return '<li>' . esc_html( $h ) . '</li>';
			}, $hours ) ) . '</ul>'
			: ( current_user_can( 'edit_pages' ) ? solevo_admin_hint( 'Add opening hours in Settings > Solevo.' ) : '' );
		$book  = 'studio' === $atts['service']
			? '<a class="wp-block-button__link wp-element-button" href="#mindbody">Book Studio</a>'
			: ( 'clinical' === $atts['service'] ? '<a class="wp-block-button__link wp-element-button" href="#cliniko-location1">Book Clinical Pilates</a>' : '' );
		$th_phone = 'location2' === $loc['key'] ? solevo_opt( 'location2_phone' ) : '';
		if ( ! $book && $th_phone ) {
			// Terrey Hills is booked by phone through the medical centre (Steph, 28 Oct).
			$book = sprintf( '<a class="wp-block-button__link wp-element-button solevo-call" data-track="click_call" href="tel:%s">Call %s</a>', esc_attr( preg_replace( '/[^0-9+]/', '', $th_phone ) ), esc_html( $th_phone ) );
		}
		$book  = $book ?: ( 'studio' === $atts['service']
			? ''
			: sprintf( '<a class="wp-block-button__link wp-element-button" href="#cliniko-%s">Book Physio in %s</a>', esc_attr( $loc['key'] ), esc_html( $loc['area'] ) ) );
		$phone = ( 'location1' === $loc['key'] && solevo_opt( 'phone' ) )
			? sprintf( '<br><a class="solevo-call" data-track="click_call" href="tel:%s">%s</a>', esc_attr( preg_replace( '/[^0-9+]/', '', solevo_opt( 'phone' ) ) ), esc_html( solevo_opt( 'phone' ) ) )
			: '';
		$access = ( 'location1' === $loc['key'] && solevo_opt( 'location1_access' ) )
			? '<br><span class="solevo-loc__access">(' . esc_html( lcfirst( solevo_opt( 'location1_access' ) ) ) . ')</span>'
			: '';
		if ( $th_phone ) {
			$phone = sprintf( '<br><span class="solevo-loc__access">Bookings: %s</span>', esc_html( $loc['name'] ) );
		}
		$phone  = $access . $phone;
		$map = sprintf(
			'<div class="solevo-loc__map"><iframe title="Map to %1$s" src="https://www.google.com/maps?q=%2$s&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>',
			esc_attr( $loc['name'] ),
			rawurlencode( $loc['name'] . ' ' . $loc['address'] )
		);
		$cards .= sprintf(
			'<article class="solevo-loc">%9$s<p class="is-style-eyebrow">%1$s</p><h3 class="solevo-loc__name">%2$s</h3><p class="solevo-loc__note">%3$s</p><address class="solevo-nap"><a href="%4$s" rel="noopener">%5$s</a>%6$s</address>%7$s<div class="wp-block-buttons"><div class="wp-block-button">%8$s</div><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="%4$s" rel="noopener" data-track="click_directions">Directions</a></div></div></article>',
			esc_html( $loc['area'] ),
			esc_html( $loc['name'] ),
			esc_html( $loc['note'] ),
			esc_url( solevo_directions_url( $loc ) ),
			esc_html( $loc['address'] ),
			$phone,
			$hours_html,
			$book,
			$map
		);
	}
	return solevo_rewrite_links( '<div class="solevo-locs">' . $cards . '</div>' );
} );

add_shortcode( 'solevo_reviewed', function ( $atts ) {
	$atts = shortcode_atts( array( 'by' => '', 'role' => '', 'date' => '' ), $atts );
	if ( ! $atts['by'] ) {
		return current_user_can( 'edit_pages' ) ? solevo_admin_hint( 'Health page: add the reviewing clinician to the [solevo_reviewed] shortcode (by, role, date) before publishing.' ) : '';
	}
	return sprintf(
		'<p class="solevo-reviewed">Clinically reviewed by %s%s.%s</p>',
		esc_html( $atts['by'] ),
		$atts['role'] ? ', ' . esc_html( $atts['role'] ) : '',
		$atts['date'] ? ' Last reviewed ' . esc_html( $atts['date'] ) . '.' : ''
	);
} );

add_shortcode( 'solevo_todo', function ( $atts, $content = '' ) {
	if ( ! current_user_can( 'edit_pages' ) ) {
		return '';
	}
	return '<p class="solevo-admin-hint solevo-todo"><strong>To confirm (only editors see this):</strong> ' . esc_html( wp_strip_all_tags( $content ) ) . '</p>';
} );

add_shortcode( 'solevo_cta_band', function () {
	$def     = solevo_page_def();
	$booking = $def['booking'] ?? 'both';
	$phys    = $def['cta'] ?? 'Book Physio';
	$locs    = solevo_locations();
	// Clinical Pilates and other studio services run in Brookvale only.
	if ( $def && 'pilates' === strtok( $def['path'], '/' ) ) {
		$locs = array_slice( $locs, 0, 1 );
	}
	$areas   = implode( ' or ', array_filter( wp_list_pluck( $locs, 'area' ) ) );
	$btn     = function ( $label, $href, $style = 'solevo-btn-light' ) {
		return sprintf( '<div class="wp-block-button %s"><a class="wp-block-button__link wp-element-button" href="%s">%s</a></div>', esc_attr( $style ), esc_attr( $href ), esc_html( $label ) );
	};
	// 1.3.20: one plain heading per booking type, no page-specific hooks (Hayo, 28 Oct).
	$th_phone = solevo_opt( 'location2_phone' );
	$th_link  = $th_phone ? sprintf( '<a href="tel:%s">%s</a>', esc_attr( preg_replace( '/[^0-9+]/', '', $th_phone ) ), esc_html( $th_phone ) ) : '';
	$call     = solevo_opt( 'phone' ) ? $btn( 'Call ' . solevo_opt( 'phone' ), '#phone', 'solevo-btn-ghost' ) : '';
	$multi    = $th_link && count( $locs ) > 1;
	if ( 'cliniko' === $booking ) {
		$title = 'Book an appointment';
		$sub   = $multi ? 'Book online for Brookvale, or call Terrey Hills Medical Centre on ' . $th_link . '.' : 'Book online any time.';
		$btns  = $btn( $phys, '#cliniko' ) . $call;
		$alt   = '<p class="solevo-cta2__alt">Want a Pilates class? <a href="#mindbody">Book Studio</a></p>';
	} elseif ( 'mindbody' === $booking ) {
		$title = 'Book a class';
		$sub   = 'See the live timetable and book your spot online.';
		$btns  = $btn( 'Book Studio', '#mindbody' ) . $call;
		$alt   = '<p class="solevo-cta2__alt">In pain or injured? Start with a physio. <a href="#cliniko">Book Physio</a></p>';
	} else {
		$title = 'Book an appointment or a class';
		$sub   = 'Physio appointments and Studio classes are booked separately.' . ( $multi ? ' For Terrey Hills physio, call the medical centre on ' . $th_link . '.' : '' );
		$btns  = $btn( 'Book Physio', '#cliniko' ) . $btn( 'Book Studio', '#mindbody', 'solevo-btn-ghost' );
		$alt   = '';
	}
	$html = sprintf(
		'<section class="solevo-cta2 solevo-olive solevo-wave solevo-wave--olive-band" id="book"><div class="solevo-cta2__inner"><h2 class="wp-block-heading">%s</h2><p class="solevo-cta2__sub">%s</p><div class="wp-block-buttons solevo-cta2__btns">%s</div>%s</div></section>',
		esc_html( $title ),
		$sub,
		$btns,
		$alt
	);
	return solevo_rewrite_links( $html );
} );
