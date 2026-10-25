<?php
/**
 * Appearance > Solevo setup.
 * One click (or `wp solevo setup`) builds the site foundation:
 *   - imports placeholder images into the Media Library
 *   - sets clean permalinks with no trailing slash (/physio, /pilates/mums-and-bubs)
 *   - creates the homepage (published) and the other 29 pages (as drafts) with
 *     the right template, parent, SEO title, meta description and a content scaffold
 *   - builds the Landing and Full site menus
 * Safe to run again: existing pages are never overwritten unless asked.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/blocks.php';
require_once __DIR__ . '/components.php';
require_once __DIR__ . '/scaffold-physio.php';
require_once __DIR__ . '/scaffold-home.php';
require_once __DIR__ . '/templates.php';

/* ---------------------------------------------------------------------------
 * Content scaffolds
 * ------------------------------------------------------------------------ */

function solevo_page_link( $path ) {
	$all = wp_list_pluck( solevo_site_pages(), 'title', 'path' );
	$label = $all[ $path ] ?? $path;
	return sprintf( '<a href="%s">%s</a>', esc_url( home_url( '/' . $path ) ), esc_html( $label ) );
}

function solevo_booking_buttons( $booking, $with_call = true ) {
	$b = array();
	if ( 'cliniko' === $booking || 'both' === $booking ) {
		$b[] = array( 'Book physio', '#cliniko' );
	}
	if ( 'mindbody' === $booking || 'both' === $booking ) {
		$b[] = array( 'cliniko' === $booking ? 'Book physio' : 'Book a class', '#mindbody', 'both' === $booking );
	}
	if ( $with_call ) {
		$b[] = array( 'Call us', '#phone', true );
	}
	return solevo_b_buttons( $b );
}

function solevo_hero( $page, $lead ) {
	$parent = '';
	if ( false !== strpos( $page['path'], '/' ) ) {
		$parent = ucfirst( strtok( $page['path'], '/' ) );
	}
	$eyebrow = $parent ? $parent . ' · Brookvale' : 'Solevo · Brookvale';
	$inner   = solevo_b_p( $eyebrow, 'is-style-eyebrow' )
		. solevo_b_h( esc_html( $page['h1'] ), 1 )
		. solevo_b_p( $lead, 'solevo-lead' )
		. solevo_booking_buttons( $page['booking'] )
		. solevo_b_shortcode( '[solevo_contact show="address,phone"]' );
	return solevo_b_section( $inner, array( 'class' => 'solevo-page-hero', 'inner_class' => 'solevo-page-hero__inner' ) );
}

function solevo_faq( $questions ) {
	$inner = solevo_b_h( 'Frequently asked questions' );
	foreach ( $questions as $q ) {
		$inner .= solevo_b_details( $q, '[Answer in 2 to 4 plain sentences. Name the clinician who reviewed it.]' );
	}
	return solevo_b_section( $inner, array( 'class' => 'solevo-faq', 'inner_class' => 'solevo-narrow' ) );
}

function solevo_related( $page ) {
	if ( empty( $page['related'] ) ) {
		return '';
	}
	$links = array_map( 'solevo_page_link', $page['related'] );
	return solevo_b_section(
		solevo_b_h( 'Related at Solevo', 3 ) . solevo_b_list( $links, 'is-style-pills' ),
		array( 'class' => 'solevo-related', 'inner_class' => 'solevo-narrow' )
	);
}

function solevo_reviewer_line() {
	return solevo_b_section( solevo_b_p( 'Reviewed by [clinician name], [qualification]. Last reviewed [date].', 'solevo-reviewed' ), array( 'class' => 'solevo-reviewed-wrap', 'inner_class' => 'solevo-narrow' ) );
}

function solevo_practitioner( $booking ) {
	$is_class = 'mindbody' === $booking;
	$img      = solevo_img( $is_class ? 'rikki-xu' : 'emma-docker', 'is-style-rounded solevo-portrait', 'medium_large' );
	$text     = solevo_b_p( 'Your practitioner', 'is-style-eyebrow' )
		. solevo_b_h( $is_class ? 'Rikki Xu' : 'Emma Docker', 3 )
		. solevo_b_p( $is_class ? 'Pilates Instructor · Polestar trained' : 'Physiotherapist · Bachelor of Sport &amp; Exercise Science | Master of Physiotherapy', 'solevo-person__role' )
		. solevo_b_p( '[Two sentences on why this practitioner suits this service. Confirm who delivers it.]' )
		. solevo_b_p( '<a href="' . esc_url( home_url( '/about' ) ) . '">Meet the whole team →</a>', 'solevo-arrow-link' );
	return solevo_b_section( solevo_b_columns( array( $img, $text ), 'solevo-split solevo-practitioner' ), array( 'bg' => 'surface' ) );
}

function solevo_price_note( $path ) {
	$prices = array(
		'pilates/clinical-pilates'          => 'Initial Clinical Pilates Assessment (1:1, 60 min) $180 · Subsequent session (1:1, 45 min) $150 · Clinical Reformer small group (max 6) $80 per person.',
		'pilates/private-pilates'           => 'Private session $140 · Private 5 pack $650 · Private 10 pack $1,200 · Duo session $180 · Duo 5 pack $850 · Duo 10 pack $1,600.',
		'pilates/mat-pilates'               => 'Casual $30 · 5 class pack $140 · 10 pack $260 · 20 pack $480.',
		'pilates/pregnancy-pilates'         => 'Reformer casual $49, packs from $37 per class. Mat casual $30, packs from $24 per class.',
		'pilates/postnatal-pilates'         => 'Reformer casual $49, packs from $37 per class. Mat casual $30, packs from $24 per class.',
		'pilates/over-50s-fitness'          => '[Confirm class format and price.]',
		'pilates/mums-and-bubs'             => 'A$79 per week for the six-week program, including three classes a week and a 1:1 assessment to start.',
		'pilates/seniors'                   => '[Confirm price. Working assumption: same as Mums and Bubs, A$79 per week.]',
	);
	if ( isset( $prices[ $path ] ) ) {
		return $prices[ $path ];
	}
	return 'Initial physiotherapy appointment $160 · Follow-up appointments $110. [Confirm and add health fund rebate details.]';
}

function solevo_scaffold( $page ) {
	$path = $page['path'];
	$type = $page['type'];
	$c    = '';

	// Pages with a content file (inc/content/) are built from the design system templates.
	if ( 'home' !== $type && 'physio' !== $path ) {
		$built = solevo_build_page( $page );
		if ( $built ) {
			return $built;
		}
	}

	switch ( $type ) {
		case 'home':
			return solevo_scaffold_home( $page ); // Physio-first homepage, see scaffold-home.php.

		case 'hub':
			if ( 'physio' === $path ) {
				return solevo_scaffold_physio( $page ); // Gold-standard page, see scaffold-physio.php.
			}
			$leads = array(
				'physio'     => 'Physiotherapy built around strength, movement and long term resilience. Hands-on treatment, progressive rehab and the assessment tools to find the cause, not just the pain.',
				'pilates'    => 'Boutique reformer Pilates, mat Pilates and yoga in Brookvale. Classes designed with physiotherapists, capped at six reformers so every session is coached.',
				'conditions' => 'Each page explains what the condition is, the warning signs that need a GP first, and how our team assesses and treats it.',
			);
			$c .= solevo_hero( $page, $leads[ $path ] );
			$c .= solevo_b_section( solevo_b_h( 'physio' === $path ? 'Our physio services' : ( 'pilates' === $path ? 'Classes and programs' : 'Browse by condition' ) ) . solevo_b_shortcode( '[solevo_child_pages]' ), array( 'class' => 'solevo-children' ) );
			if ( 'physio' === $path ) {
				$c .= solevo_pattern_markup( 'home-services' ) . solevo_pattern_markup( 'home-technology' ) . solevo_pattern_markup( 'home-why' );
			} elseif ( 'pilates' === $path ) {
				$c .= solevo_pattern_markup( 'home-studio' ) . solevo_pattern_markup( 'home-pricing' ) . solevo_pattern_markup( 'home-timetable' );
			} else {
				$c .= solevo_pattern_markup( 'home-conditions' );
			}
			$c .= solevo_pattern_markup( 'home-reviews' );
			return $c;

		case 'campaign':
			$is_mums = 'pilates/mums-and-bubs' === $path;
			$c .= solevo_hero( $page, $is_mums
				? 'A six-week program for pregnancy and new mums. Start with a 1:1 assessment, then train in a small group of six with three classes a week.'
				: 'Pilates designed with physiotherapists to build balance, strength and confidence. Small groups, a 1:1 assessment first, and a pace that suits you.' );
			$steps = $is_mums
				? array( '<strong>1:1 assessment.</strong> We check your core, pelvic floor and goals before you join a group.', '<strong>Your group of six.</strong> You train with mums at the same stage, coached by our team.', '<strong>Six weeks, three classes a week.</strong> A clear block with progress you can feel.', '<strong>A$79 per week.</strong> [Confirm what is included and whether babies join classes.]' )
				: array( '<strong>1:1 assessment.</strong> [Who runs it and how long it takes.]', '<strong>Small groups.</strong> [Group size and class length.]', '<strong>Your program.</strong> [Program length and classes per week.]', '<strong>Price.</strong> [Confirm price.]' );
			$c .= solevo_b_section( solevo_b_h( 'How the program works' ) . solevo_b_list( $steps, 'solevo-steps', true ), array( 'bg' => 'surface', 'inner_class' => 'solevo-narrow' ) );
			$c .= solevo_b_section( solevo_b_h( 'Who it is for' ) . solevo_b_p( $is_mums ? '[Pregnancy and postnatal stages accepted, clearance needed after birth, what to bring.]' : '[Age range, fitness levels, conditions we can accommodate, what to bring.]' ), array( 'inner_class' => 'solevo-narrow' ) );
			$c .= solevo_practitioner( 'mindbody' );
			$c .= solevo_b_section( solevo_b_h( 'Timetable' ) . solevo_b_shortcode( '[solevo_timetable]' ), array( 'class' => 'solevo-timetable-wrap', 'anchor' => 'timetable' ) );
			$c .= solevo_b_section( solevo_b_h( 'Need one-on-one care as well?', 3 ) . solevo_b_p( 'Some concerns are best handled in a private physio appointment first.' ) . solevo_b_list( array_map( 'solevo_page_link', $page['related'] ), 'is-style-pills' ), array( 'class' => 'solevo-related', 'inner_class' => 'solevo-narrow' ) );
			$c .= solevo_pattern_markup( 'home-reviews' );
			$c .= solevo_faq( $is_mums
				? array( 'How soon after birth can I start?', 'Can I bring my baby?', 'Do I need a physio check first?', 'What if I miss a class?' )
				: array( 'Is it safe if I have arthritis or osteoporosis?', 'Do I need to be fit to start?', 'How is this different from a normal Pilates class?', 'Can I claim it on my health fund?' ) );
			$c .= solevo_reviewer_line();
			return $c;

		case 'service':
			$parent = strtok( $path, '/' );
			$c .= solevo_hero( $page, '[One sentence of value: who it is for and the result they get, written around "' . esc_html( $page['keyword'] ) . '".]' );
			$c .= solevo_b_section(
				solevo_b_h( 'Who it is for and what we treat' )
				. solevo_b_p( '[Plain-language description of who this service suits.]' )
				. solevo_b_list( array( '[Problem or goal 1]', '[Problem or goal 2]', '[Problem or goal 3]', '[Problem or goal 4]' ), 'is-style-ticks' )
				. solevo_b_p( 'Part of our ' . sprintf( '<a href="%s">%s</a>', esc_url( home_url( '/' . $parent ) ), 'physio' === $parent ? 'physio in Brookvale' : 'reformer Pilates in Brookvale' ) . ' services.', 'solevo-small' ),
				array( 'inner_class' => 'solevo-narrow' )
			);
			$c .= solevo_b_section(
				solevo_b_h( 'mindbody' === $page['booking'] ? 'What happens at your first class' : 'What happens at your first visit' )
				. solevo_b_list( array( '<strong>Before you arrive.</strong> [What to bring and what to wear.]', '<strong>Assessment.</strong> [What we check and how long it takes.]', '<strong>Your plan.</strong> [What you leave with.]', '<strong>Next steps.</strong> [Follow-ups, classes or a home program.]' ), 'solevo-steps', true ),
				array( 'bg' => 'sand', 'inner_class' => 'solevo-narrow' )
			);
			$c .= solevo_practitioner( $page['booking'] );
			$c .= solevo_related( $page );
			$c .= solevo_b_section( solevo_b_h( 'Price' ) . solevo_b_p( solevo_price_note( $path ) ) . solevo_b_p( '<a href="' . esc_url( home_url( '/book' ) ) . '">See all prices and booking options →</a>', 'solevo-arrow-link' ), array( 'inner_class' => 'solevo-narrow' ) );
			$c .= solevo_pattern_markup( 'home-reviews' );
			$c .= solevo_faq( array( '[Question people ask before booking]', '[Question about cost or rebates]', '[Question about how many sessions]', '[Question about suitability]' ) );
			$c .= solevo_reviewer_line();
			return $c;

		case 'condition':
			$service = $page['service'] ?? 'physio';
			$c .= solevo_b_section(
				solevo_b_p( 'Conditions · ' . esc_html( $page['title'] ), 'is-style-eyebrow' )
				. solevo_b_h( esc_html( $page['h1'] ), 1 )
				. solevo_b_p( '[Two-sentence answer: what this is, and that physiotherapy can help.]', 'solevo-lead' )
				. solevo_booking_buttons( $page['booking'] ),
				array( 'class' => 'solevo-page-hero', 'inner_class' => 'solevo-narrow' )
			);
			$c .= solevo_b_section(
				solevo_b_h( 'Symptoms' )
				. solevo_b_list( array( '[Symptom 1]', '[Symptom 2]', '[Symptom 3]' ), 'is-style-ticks' )
				. solevo_b_h( 'How it differs from look-alike problems', 3 )
				. solevo_b_p( '[What else causes similar symptoms and how we tell them apart.]' ),
				array( 'inner_class' => 'solevo-narrow' )
			);
			$c .= solevo_b_section(
				solevo_b_h( 'When to see a GP or get urgent care first', 3 )
				. solevo_b_list( array( '[Red flag 1]', '[Red flag 2]', '[Red flag 3]' ) )
				. solevo_b_p( 'If you have any of these, see your GP before booking. In an emergency call 000.', 'solevo-small' ),
				array( 'class' => 'solevo-redflags', 'inner_class' => 'solevo-narrow' )
			);
			$c .= solevo_b_section(
				solevo_b_h( 'How Solevo assesses and treats it' )
				. solevo_b_p( '[Assessment approach, treatment, and the tools we use such as gait analysis or strength testing.]' )
				. solevo_booking_buttons( $page['booking'], false ),
				array( 'bg' => 'surface', 'inner_class' => 'solevo-narrow' )
			);
			$c .= solevo_b_section(
				solevo_b_h( 'Exercise and Clinical Pilates progression', 3 )
				. solevo_b_p( '[How exercise is progressed.] Many clients move on to ' . solevo_page_link( 'pilates/clinical-pilates' ) . ' to keep building strength.' )
				. solevo_b_h( 'What recovery usually looks like', 3 )
				. solevo_b_p( '[Typical timeframes and milestones, without promising outcomes.]' ),
				array( 'inner_class' => 'solevo-narrow' )
			);
			$c .= solevo_faq( array( '[Common question 1]', '[Common question 2]', '[Common question 3]', '[Common question 4]' ) );
			$page['related'] = array_unique( array_merge( array( $service ), $page['related'] ?? array() ) );
			$c .= solevo_related( $page );
			$c .= solevo_b_section( solevo_b_p( 'Back to ' . solevo_page_link( 'conditions' ) ), array( 'inner_class' => 'solevo-narrow' ) );
			$c .= solevo_reviewer_line();
			return $c;

		case 'book':
			$c .= solevo_b_section( solevo_b_p( 'Book', 'is-style-eyebrow' ) . solevo_b_h( esc_html( $page['h1'] ), 1 ) . solevo_b_p( 'Two ways to book. Physio appointments are booked through Cliniko. Pilates, mat and yoga classes are booked through Mindbody.', 'solevo-lead' ), array( 'class' => 'solevo-page-hero', 'inner_class' => 'solevo-narrow' ) );
			$c .= solevo_pattern_markup( 'home-timetable' );
			$c .= solevo_pattern_markup( 'home-pricing' );
			$c .= solevo_pattern_markup( 'home-find-us' );
			return $c;

		case 'contact':
			$c .= solevo_b_section( solevo_b_p( 'Contact', 'is-style-eyebrow' ) . solevo_b_h( esc_html( $page['h1'] ), 1 ) . solevo_b_p( 'Physio, Pilates and yoga in one space on Mitchell Road, shared with The Foot Company podiatry.', 'solevo-lead' ), array( 'class' => 'solevo-page-hero', 'inner_class' => 'solevo-narrow' ) );
			$c .= solevo_pattern_markup( 'home-find-us' );
			$c .= solevo_b_section(
				solevo_b_h( 'Parking and getting here', 3 ) . solevo_b_p( '[Parking, public transport and accessibility details.]' )
				. solevo_b_h( 'Suburbs we serve', 3 ) . solevo_b_shortcode( '[solevo_suburbs]' ),
				array( 'inner_class' => 'solevo-narrow' )
			);
			return $c;

		case 'about':
			$c .= solevo_b_section( solevo_b_p( 'About', 'is-style-eyebrow' ) . solevo_b_h( esc_html( $page['h1'] ), 1 ) . solevo_b_p( '[The Solevo story: why it started, who it is for, and what makes the integrated model different.]', 'solevo-lead' ), array( 'class' => 'solevo-page-hero', 'inner_class' => 'solevo-narrow' ) );
			$c .= solevo_pattern_markup( 'home-team' );
			$c .= solevo_pattern_markup( 'home-why' );
			$c .= solevo_b_section( solevo_b_h( 'Working with The Foot Company', 3 ) . solevo_b_p( 'Solevo shares its space with The Foot Company podiatry. [One or two sentences on how physio and podiatry work together on a case. Add a descriptive link to The Foot Company site.]' ), array( 'inner_class' => 'solevo-narrow' ) );
			return $c;
	}
	return $c;
}

/**
 * The five page types:
 *   Homepage          front page (bespoke)
 *   Service           page-service    /physio and /physio/*
 *   Condition         page-condition  /conditions/*
 *   Studio / class    page-studio     /pilates and /pilates/*
 *   General / info    page-full       /book, /contact, /about
 */
function solevo_template_for( $type, $path = '' ) {
	if ( 'home' === $type ) {
		return '';
	}
	if ( 'condition' === $type ) {
		return 'page-condition';
	}
	if ( in_array( $type, array( 'book', 'contact', 'about' ), true ) ) {
		return 'page-full';
	}
	if ( 'pilates' === strtok( $path, '/' ) ) {
		return 'page-studio';
	}
	return 'page-service';
}

/* ---------------------------------------------------------------------------
 * Runner
 * ------------------------------------------------------------------------ */

/**
 * @param array $args rebuild_home (bool), rebuild_all (bool), log (callable)
 */
function solevo_run_setup( $args = array() ) {
	$args = wp_parse_args( $args, array( 'rebuild_home' => false, 'rebuild_all' => false, 'rebuild' => array(), 'log' => null ) );
	$log  = is_callable( $args['log'] ) ? $args['log'] : function () {};

	$map = solevo_import_images();
	$log( sprintf( 'Images in Media Library: %d', count( $map ) ) );

	global $wp_rewrite;
	if ( '/%postname%' !== get_option( 'permalink_structure' ) ) {
		$wp_rewrite->set_permalink_structure( '/%postname%' );
		$log( 'Permalinks set to /%postname% (no trailing slash)' );
	}
	if ( 'Physiotherapy, Pilates and yoga in Brookvale' !== get_option( 'blogdescription' ) && in_array( get_option( 'blogdescription' ), array( '', 'Just another WordPress site' ), true ) ) {
		update_option( 'blogdescription', 'Physiotherapy, Pilates and yoga in Brookvale' );
	}

	$ids   = array();
	$order = 0;
	foreach ( solevo_site_pages() as $page ) {
		$order++;
		$path   = $page['path'];
		$is_home = 'home' === $page['type'];
		$existing = $is_home ? get_post( (int) get_option( 'page_on_front' ) ) : get_page_by_path( $path, OBJECT, 'page' );
		if ( $existing && 'page' !== $existing->post_type ) {
			$existing = null;
		}

		$parent_id = 0;
		if ( false !== strpos( $path, '/' ) ) {
			$parent_path = substr( $path, 0, strrpos( $path, '/' ) );
			$parent_id   = $ids[ $parent_path ] ?? 0;
		}
		$slug = $is_home ? 'home' : basename( $path );

		$overwrite = $existing && ( $args['rebuild_all'] || ( $is_home && $args['rebuild_home'] ) || in_array( $path, (array) $args['rebuild'], true ) );
		if ( $existing && ! $overwrite ) {
			$ids[ $path ] = $existing->ID;
			$log( sprintf( 'Kept     /%s (%s)', $path, $existing->post_status ) );
			continue;
		}

		$postarr = array(
			'post_type'    => 'page',
			'post_title'   => $page['title'],
			'post_name'    => $slug,
			'post_parent'  => $parent_id,
			'post_status'  => $existing ? $existing->post_status : ( $is_home ? 'publish' : 'draft' ),
			'menu_order'   => $order,
			'post_content' => solevo_scaffold( $page ),
			'post_excerpt' => $page['excerpt'] ?? '',
		);
		if ( $existing ) {
			$postarr['ID'] = $existing->ID;
			$id            = wp_update_post( wp_slash( $postarr ), true );
		} else {
			$id = wp_insert_post( wp_slash( $postarr ), true );
		}
		if ( is_wp_error( $id ) ) {
			$log( 'ERROR    /' . $path . ': ' . $id->get_error_message() );
			continue;
		}
		$ids[ $path ] = $id;

		$template = solevo_template_for( $page['type'], $page['path'] );
		if ( $template ) {
			update_post_meta( $id, '_wp_page_template', $template );
		} else {
			delete_post_meta( $id, '_wp_page_template' );
		}
		update_post_meta( $id, '_solevo_seo_title', $page['seo_title'] );
		update_post_meta( $id, '_solevo_meta_description', $page['meta'] );
		update_post_meta( $id, '_solevo_keyword', $page['keyword'] );
		update_post_meta( $id, '_solevo_page_type', $page['type'] );
		$log( sprintf( '%s /%s', $existing ? 'Rebuilt ' : 'Created ', $path ) );

		if ( $is_home ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $id );
		}
	}
	update_option( 'solevo_page_ids', $ids, false );

	// Move WordPress demo content to the bin (recoverable) so it never gets indexed.
	foreach ( array( array( 'sample-page', 'page' ), array( 'hello-world', 'post' ) ) as $demo ) {
		$p = get_page_by_path( $demo[0], OBJECT, $demo[1] );
		if ( $p && 'trash' !== $p->post_status ) {
			wp_trash_post( $p->ID );
			$log( 'Moved demo ' . $demo[1] . ' "' . $demo[0] . '" to the bin' );
		}
	}

	solevo_build_menus( $ids );
	$log( 'Menus built (Landing menu active)' );

	flush_rewrite_rules( false );
	update_option( 'solevo_setup_done', current_time( 'mysql' ), false );
	return $ids;
}

/* ---------------------------------------------------------------------------
 * Admin screen
 * ------------------------------------------------------------------------ */

add_action( 'admin_menu', function () {
	add_theme_page( 'Solevo setup', 'Solevo setup', 'manage_options', 'solevo-setup', 'solevo_render_setup_page' );
} );

add_action( 'admin_post_solevo_setup', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Not allowed.' );
	}
	check_admin_referer( 'solevo_setup' );
	$lines = array();
	solevo_run_setup( array(
		'rebuild_home' => ! empty( $_POST['rebuild_home'] ),
		'rebuild'      => isset( $_POST['rebuild'] ) ? array_map( 'sanitize_text_field', wp_unslash( (array) $_POST['rebuild'] ) ) : array(),
		'log'          => function ( $l ) use ( &$lines ) {
			$lines[] = $l;
		},
	) );
	set_transient( 'solevo_setup_log', $lines, 300 );
	wp_safe_redirect( admin_url( 'themes.php?page=solevo-setup&done=1' ) );
	exit;
} );

add_action( 'admin_post_solevo_menu_mode', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Not allowed.' );
	}
	check_admin_referer( 'solevo_menu_mode' );
	$mode = ( isset( $_POST['mode'] ) && 'full' === $_POST['mode'] ) ? 'full' : 'landing';
	update_option( 'solevo_menu_mode', $mode );
	wp_safe_redirect( admin_url( 'themes.php?page=solevo-setup&menu=' . $mode ) );
	exit;
} );

function solevo_render_setup_page() {
	$ids  = get_option( 'solevo_page_ids', array() );
	$mode = get_option( 'solevo_menu_mode', 'landing' );
	$log  = get_transient( 'solevo_setup_log' );
	?>
	<div class="wrap">
		<h1>Solevo setup</h1>
		<?php if ( $log ) : delete_transient( 'solevo_setup_log' ); ?>
			<div class="notice notice-success"><p><strong>Setup finished.</strong></p><pre style="max-height:220px;overflow:auto"><?php echo esc_html( implode( "\n", $log ) ); ?></pre></div>
		<?php endif; ?>

		<h2>1. Build the site foundation</h2>
		<p>Creates the homepage and the 29 other agreed pages with their URL, template, SEO title, meta description and a content scaffold. New pages are saved as drafts. Existing pages are kept as they are.</p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'solevo_setup' ); ?>
			<input type="hidden" name="action" value="solevo_setup">
			<p><label><input type="checkbox" name="rebuild_home" value="1"> Reset the homepage to the theme design (overwrites homepage edits)</label></p>
			<details style="margin:1em 0"><summary><strong>Rebuild pages from the design system</strong> (replaces their content; the previous version stays under Revisions)</summary>
				<p style="margin:.5em 0">Only tick pages nobody has written in yet, or whose copy you want replaced.</p>
				<p><label><input type="checkbox" id="solevo-all"> Select all</label></p>
				<?php foreach ( solevo_site_pages() as $p ) : if ( '' === $p['path'] ) { continue; } ?>
					<label style="display:inline-block;min-width:22em;margin:.15em 0"><input type="checkbox" class="solevo-rb" name="rebuild[]" value="<?php echo esc_attr( $p['path'] ); ?>"> <code>/<?php echo esc_html( $p['path'] ); ?></code></label>
				<?php endforeach; ?>
				<script>document.getElementById('solevo-all').addEventListener('change',function(e){document.querySelectorAll('.solevo-rb').forEach(function(c){c.checked=e.target.checked;});});</script>
			</details>
			<?php submit_button( get_option( 'solevo_setup_done' ) ? 'Run setup again' : 'Run setup', 'primary', 'submit', false ); ?>
		</form>

		<h2 style="margin-top:2em">2. Menu</h2>
		<p>Active: <strong><?php echo 'full' === $mode ? 'Full site menu' : 'Landing menu (homepage sections)'; ?></strong>. Switch to the full site menu once the Physio, Pilates and Conditions pages are published.</p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'solevo_menu_mode' ); ?>
			<input type="hidden" name="action" value="solevo_menu_mode">
			<input type="hidden" name="mode" value="<?php echo 'full' === $mode ? 'landing' : 'full'; ?>">
			<?php submit_button( 'full' === $mode ? 'Switch back to Landing menu' : 'Switch to Full site menu', 'secondary', 'submit', false ); ?>
		</form>

		<h2 style="margin-top:2em">3. The 30 pages</h2>
		<table class="widefat striped" style="max-width:1100px">
			<thead><tr><th>URL</th><th>Type</th><th>Status</th><th>Primary keyword</th><th></th></tr></thead>
			<tbody>
			<?php foreach ( solevo_site_pages() as $p ) :
				$id = $ids[ $p['path'] ] ?? 0;
				$post = $id ? get_post( $id ) : null;
				?>
				<tr>
					<td><code>/<?php echo esc_html( $p['path'] ); ?></code></td>
					<td><?php echo esc_html( $p['type'] ); ?></td>
					<td><?php echo $post ? esc_html( $post->post_status ) : '<em>not created</em>'; ?></td>
					<td><?php echo esc_html( $p['keyword'] ); ?></td>
					<td><?php if ( $post ) : ?><a href="<?php echo esc_url( get_edit_post_link( $id ) ); ?>">Edit</a> · <a href="<?php echo esc_url( get_permalink( $id ) ); ?>">View</a><?php endif; ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<h2 style="margin-top:2em">4. Integrations</h2>
		<ul style="list-style:disc;padding-left:1.5em">
			<li><strong>Booking links, phone, hours, Tag Manager:</strong> <a href="<?php echo esc_url( admin_url( 'options-general.php?page=solevo-settings' ) ); ?>">Settings &gt; Solevo</a></li>
			<li><strong>Google reviews:</strong> <?php echo shortcode_exists( 'trustindex' ) ? 'connected' : 'install "Widgets for Google Reviews" (Trustindex, free)'; ?></li>
			<li><strong>Instagram feed:</strong> <?php echo shortcode_exists( 'instagram-feed' ) ? 'connected' : 'install "Smash Balloon Social Photo Feed" (free)'; ?></li>
			<li><strong>Images:</strong> placeholders are in the Media Library, marked "placeholder". Open a page, select the image and use Replace.</li>
		</ul>
	</div>
	<?php
}

// Flag placeholder images in the Media Library list.
add_filter( 'attachment_fields_to_edit', function ( $fields, $post ) {
	if ( get_post_meta( $post->ID, '_solevo_placeholder', true ) ) {
		$fields['solevo_placeholder'] = array( 'label' => 'Placeholder', 'input' => 'html', 'html' => '<strong>Replace this image with the real photo.</strong>' );
	}
	return $fields;
}, 10, 2 );
