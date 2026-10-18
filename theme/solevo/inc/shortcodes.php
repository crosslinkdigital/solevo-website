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
	if ( current_user_can( 'activate_plugins' ) ) {
		return '<div class="solevo-feed solevo-feed--placeholder">' . solevo_admin_hint( 'Google reviews: install the free "Widgets for Google Reviews" plugin by Trustindex, connect the Solevo Google Business Profile, and this section fills automatically. Visitors do not see this section until then.' ) . '</div>';
	}
	return '';
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
