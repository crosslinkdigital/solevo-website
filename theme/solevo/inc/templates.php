<?php
/**
 * Page templates as code: one builder per page type, fed by a content file per page.
 *
 *   inc/content/<path with / as -->.php   returns an array of copy for that page
 *   Condition  solevo_build_condition()   /conditions/*
 *   Service    solevo_build_service()     /physio/*        (/physio itself: scaffold-physio.php)
 *   Studio     solevo_build_studio()      /pilates and /pilates/*
 *   General    solevo_build_general()     /book, /contact, /about, /conditions
 *
 * Every section is optional: leave a key out of the content file and the section is skipped.
 * Output is core blocks, so the page is edited normally in WordPress once created.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

/** Content array for a page path, or null if no content file exists yet. */
function solevo_page_content( $path ) {
	$file = SOLEVO_DIR . '/inc/content/' . str_replace( '/', '--', $path ) . '.php';
	return file_exists( $file ) ? include $file : null;
}

/** Built page markup, or '' to fall back to the original scaffold. */
function solevo_build_page( $page ) {
	$d = solevo_page_content( $page['path'] );
	if ( ! is_array( $d ) ) {
		return '';
	}
	switch ( $page['type'] ) {
		case 'condition':
			return solevo_build_condition( $page, $d );
		case 'service':
		case 'campaign':
		case 'hub':
			if ( 'pilates' === strtok( $page['path'], '/' ) ) {
				return solevo_build_studio( $page, $d );
			}
			if ( 'conditions' === $page['path'] ) {
				return solevo_build_general( $page, $d );
			}
			return solevo_build_service( $page, $d );
		default:
			return solevo_build_general( $page, $d );
	}
}

/* ---------------------------------------------------------------------------
 * Shared pieces
 * ------------------------------------------------------------------------ */

/** Hero buttons for a booking path. */
function solevo_hero_buttons( $page, $second = null ) {
	$label = $page['cta'] ?? 'Book Physio';
	switch ( $page['booking'] ) {
		case 'mindbody':
			return array( array( 'Book Studio', '#mindbody' ), $second ?: array( 'View timetable', '#timetable', true ) );
		case 'both':
			return array( array( 'Book Physio', '#cliniko' ), array( 'Book Studio', '#mindbody', true ) );
		default:
			return array( array( $label, '#cliniko' ), $second ?: array( 'Fees and FAQs', '#fees', true ) );
	}
}

function solevo_todos( $d ) {
	$out = '';
	foreach ( (array) ( $d['todo'] ?? array() ) as $t ) {
		$out .= solevo_c_todo( $t );
	}
	return $out;
}

function solevo_physio_fees() {
	return array(
		array( 'Initial physiotherapy appointment', 'Assessment and treatment', '$160' ),
		array( 'Follow-up appointment', 'Treatment and rehab progression', '$110' ),
	);
}

/**
 * Funding questions, confirmed by Steph (29 Oct): private health with HICAPS,
 * Medicare with a GP Chronic Condition Management Plan (gap, not bulk billed),
 * workers compensation where applicable, NDIS self or plan managed. No DVA or CTP.
 * Added to the FAQs on physio service pages; there is no separate funding box.
 */
function solevo_physio_funding_faq() {
	return array(
		array( 'Do I need a GP referral?', 'Not for a private appointment. You only need one to claim a Medicare rebate.' ),
		array( 'Can I claim through private health insurance?', 'Yes. Physiotherapy is claimable on most extras policies, depending on your cover, and you can claim on the spot with HICAPS.' ),
		array( 'Can I claim a Medicare rebate?', 'Yes, with a valid referral from your GP under a Chronic Condition Management Plan. We process the rebate on the spot. Appointments aren’t bulk billed, so there is a gap to pay.' ),
		array( 'Do you see workers compensation and NDIS clients?', 'Yes, workers compensation is accepted where applicable. For NDIS, we see participants whose plans are self managed or plan managed.' ),
	);
}

function solevo_steps_items( $steps ) {
	return array_map( function ( $s ) {
		return array( $s[0], $s[1] );
	}, $steps );
}

/* ---------------------------------------------------------------------------
 * Condition template (reference: /conditions/lower-back-pain)
 * hero, what it is + symptoms, contributing factors, how physio helps (3 steps),
 * related services, red flags, FAQs, locations, booking band
 * ------------------------------------------------------------------------ */
function solevo_build_condition( $page, $d ) {
	$c  = solevo_c_hero( array(
		'eyebrow'   => $d['eyebrow'] ?? 'Conditions we treat',
		'h1'        => esc_html( $page['h1'] ),
		'lead'      => $d['lead'],
		'buttons'   => solevo_hero_buttons( $page, array( 'When to see a GP first', '#red-flags', true ) ),
		'locations' => 'mindbody' !== $page['booking'],
		'trust'     => $d['trust'] ?? array( 'No GP referral needed', 'One-on-one with a physiotherapist', 'Assessment before any exercise plan' ),
		'jump'      => array( array( 'How physio helps', '#help-steps' ), array( 'FAQs', '#faq' ), array( 'Locations', '#locations' ) ),
		'image'     => $d['image'] ?? '',
	) );
	$c .= solevo_todos( $d );
	$c .= solevo_c_split( array(
		'eyebrow'    => 'Understanding it',
		'title'      => $d['what_title'],
		'paras'      => $d['what'],
		'list_title' => $d['symptoms_title'] ?? 'Common symptoms',
		'list'       => $d['symptoms'],
		'anchor'     => 'about',
	) );
	if ( ! empty( $d['causes'] ) ) {
		$c .= solevo_c_service_cards(
			solevo_c_head( 'Why it happens', $d['causes_title'] ?? 'What can contribute', $d['causes_intro'] ?? '' ),
			array_map( function ( $x ) {
				return array( 'title' => $x[0], 'text' => $x[1] );
			}, $d['causes'] ),
			'',
			array( 'anchor' => 'causes' )
		);
	}
	$c .= solevo_c_journey(
		solevo_c_head( 'How physiotherapy can help', $d['help_title'] ?? 'How we assess and treat it', $d['help_intro'] ?? '' ),
		solevo_steps_items( $d['steps'] ),
		$d['expect'] ?? array(),
		! empty( $d['note'] ) ? solevo_b_p( $d['note'], 'solevo-help__after' ) : '',
		'What to expect',
		array( 'anchor' => 'help-steps' )
	);
	if ( ! empty( $d['services'] ) ) {
		$c .= solevo_c_link_cards( solevo_c_head( 'Care at Solevo', $d['services_title'] ?? 'Services that can help' ), $d['services'], array( 'bg' => 'surface', 'anchor' => 'services' ) );
	}
	$c .= solevo_c_redflags( $d['flags_title'] ?? 'When to see a GP or get urgent care first', $d['flags'], $d['flags_note'] ?? 'If any of these apply, see your GP before booking. In an emergency call 000.' );
	$c .= solevo_c_faq( 'Common questions', $d['faq'], solevo_c_reviewed() );
	if ( ! empty( $d['related'] ) ) {
		$c .= solevo_c_related( 'Related conditions', $d['related'] );
	}
	$c .= solevo_c_locations( 'Locations', $d['locations_title'] ?? 'Physio in Brookvale and Terrey Hills', 'Choose the clinic that suits you when you book.', 'mindbody' === $page['booking'] ? 'studio' : 'physio' );
	return $c;
}

/* ---------------------------------------------------------------------------
 * Service template (reference: /physio). Physio child pages.
 * hero, who it is for, what we help with, journey, why, practitioner,
 * fees + FAQs, related, locations, booking band
 * ------------------------------------------------------------------------ */
function solevo_build_service( $page, $d ) {
	$c  = solevo_c_hero( array(
		'eyebrow'   => $d['eyebrow'] ?? 'Solevo Physio',
		'h1'        => esc_html( $page['h1'] ),
		'lead'      => $d['lead'],
		'buttons'   => solevo_hero_buttons( $page, array( 'What we help with', '#help', true ) ),
		'locations' => true,
		'trust'     => $d['trust'] ?? array( 'No GP referral needed', 'One-on-one appointments', 'Book online any time' ),
		'jump'      => array( array( 'FAQs', '#faq' ) ),
		'image'     => $d['image'] ?? '',
	) );
	$c .= solevo_todos( $d );
	$c .= solevo_c_split( array(
		'eyebrow'    => 'Who it is for',
		'title'      => $d['who_title'],
		'paras'      => $d['who'],
		'list_title' => $d['who_list_title'] ?? 'This may suit you if',
		'list'       => $d['who_list'],
		'anchor'     => 'who',
	) );
	if ( ! empty( $d['help'] ) ) {
		$c .= solevo_c_help_grid( solevo_c_head( 'What we help with', $d['help_title'] ?? 'What can we help you with?', $d['help_intro'] ?? 'Tap a topic to see what we commonly treat.' ), $d['help'] );
	}
	$c .= solevo_c_journey(
		solevo_c_head( 'What to expect', $d['journey_title'] ?? 'Your physiotherapy journey', $d['journey_intro'] ?? '' ),
		solevo_steps_items( $d['steps'] ),
		$d['first'] ?? array()
	);
	if ( ! empty( $d['why'] ) ) {
		$c .= solevo_c_why( solevo_c_head( 'Why Solevo', $d['why_title'] ?? 'Why choose Solevo?' ), $d['why'], $d['why_extra'] ?? array() );
	}
	if ( ! empty( $d['practitioner'] ) ) {
		$c .= solevo_c_practitioner( $d['practitioner'] );
	}
	// No physio prices anywhere on the site (Steph, 25 Oct). Funding sits in the FAQs, not a separate box (29 Oct).
	$c .= solevo_c_faq(
		$d['faq_title'] ?? 'Physiotherapy FAQs',
		array_merge( $d['faq'], solevo_physio_funding_faq() ),
		solevo_c_reviewed()
	);
	if ( ! empty( $d['related'] ) ) {
		$c .= solevo_c_link_cards( solevo_c_head( 'Related care', 'You may also be interested in' ), $d['related'], array( 'bg' => 'surface' ) );
	}
	// Both clinics are in the footer on every page (26 Oct), so no Locations section here.
	return $c;
}

/* ---------------------------------------------------------------------------
 * Studio / class template (reference: /pilates/clinical-pilates)
 * hero, what it is + who it is for, benefits, formats, what to expect,
 * clinical oversight, timetable, pricing, FAQs, related, Instagram, booking band
 * ------------------------------------------------------------------------ */
function solevo_build_studio( $page, $d ) {
	$c  = solevo_c_hero( array(
		'eyebrow'   => $d['eyebrow'] ?? 'Solevo Studio',
		'h1'        => esc_html( $page['h1'] ),
		'lead'      => $d['lead'],
		'buttons'   => solevo_hero_buttons( $page ),
		'locations' => false,
		'trust'     => $d['trust'] ?? array( 'Brookvale studio', 'Small classes', 'Designed with physiotherapists' ),
		'jump'      => array( array( 'FAQs', '#faq' ) ),
		'image'     => $d['image'] ?? 'studio-stretch',
	) );
	$c .= solevo_todos( $d );
	$c .= solevo_c_split( array(
		'eyebrow'    => $d['what_eyebrow'] ?? 'What it is',
		'title'      => $d['what_title'],
		'paras'      => $d['what'],
		'list_title' => $d['who_title'] ?? 'Who it is for',
		'list'       => $d['who'],
		'anchor'     => 'about',
	) );
	if ( ! empty( $d['benefits'] ) ) {
		$c .= solevo_c_why( solevo_c_head( 'Benefits', $d['benefits_title'] ?? 'What you can expect to gain' ), $d['benefits'], array(), array( 'anchor' => 'benefits' ) );
	}
	if ( ! empty( $d['formats'] ) ) {
		$c .= solevo_c_classes( solevo_c_head( $d['formats_eyebrow'] ?? 'Class formats', $d['formats_title'] ?? 'Choose your class', $d['formats_intro'] ?? '' ), $d['formats'], $d['formats_after'] ?? '' );
	}
	if ( ! empty( $d['steps'] ) ) {
		$c .= solevo_c_journey( solevo_c_head( 'What to expect', $d['steps_title'] ?? 'How it works', $d['steps_intro'] ?? '' ), solevo_steps_items( $d['steps'] ), $d['first'] ?? array(), '', $d['first_title'] ?? 'Your first session' );
	}
	if ( ! empty( $d['pathway'] ) ) {
		$c .= solevo_b_section( solevo_c_pathway(
			'Clinical Pilates or a Studio class?',
			'Both use the reformer. The difference is who it is designed for and who runs it.',
			array(
				array( 'label' => 'Rehab', 'title' => 'Clinical Pilates', 'text' => 'Physio-led and individual. Starts with a one-on-one assessment and works around an injury, pain or condition.', 'booked' => 'Booked through Cliniko', 'button' => array( 'Book Clinical Pilates', '#cliniko', true ) ),
				array( 'label' => 'Strength', 'title' => 'Studio classes', 'text' => 'Instructor-led group classes of up to six reformers or 14 mats, for general strength, fitness and mobility.', 'booked' => 'Booked through Mindbody', 'button' => array( 'Book Studio', '#mindbody', true ) ),
				array( 'label' => 'Injured?', 'title' => 'Physiotherapy', 'text' => 'In pain or recovering from an injury or surgery? Start with a physio assessment, then move into Pilates.', 'booked' => 'Booked through Cliniko', 'button' => array( 'Book Physio', '#cliniko', true ) ),
			)
		), array( 'class' => 'solevo-c solevo-pathway-wrap', 'anchor' => 'compare' ) );
	}
	if ( ! empty( $d['oversight'] ) ) {
		$c .= solevo_c_practitioner( $d['oversight'] );
	}
	if ( 'cliniko' !== $page['booking'] && empty( $d['no_timetable'] ) ) {
		$c .= solevo_c_timetable( $d['timetable_title'] ?? 'Timetable', $d['timetable_intro'] ?? 'See live class times and book your spot online.' );
	}
	if ( ! empty( $d['prices'] ) ) {
		$c .= solevo_c_prices( solevo_c_head( 'Pricing', $d['prices_title'] ?? 'Prices', $d['prices_intro'] ?? '' ), $d['prices'], $d['prices_after'] ?? '' );
	}
	$c .= solevo_c_faq( 'Common questions', $d['faq'], ! empty( $d['health'] ) ? solevo_c_reviewed() : '' );
	if ( ! empty( $d['related'] ) ) {
		$c .= solevo_c_link_cards( solevo_c_head( 'Solevo Studio', $d['related_title'] ?? 'Related classes and care' ), $d['related'], array( 'bg' => 'surface' ) );
	}
	if ( ! empty( $d['instagram'] ) ) {
		$c .= solevo_c_instagram( 'Inside the studio', 'Classes, reformer sessions and studio life at Solevo in Brookvale.' );
	}
	if ( 'cliniko' === $page['booking'] ) {
		$c .= solevo_c_locations( 'Location', 'Clinical Pilates in Brookvale', 'Sessions run in our Brookvale studio.', 'clinical' );
	}
	return $c;
}

/* ---------------------------------------------------------------------------
 * General / info template (Book, Contact, About, Conditions index).
 * The content file returns 'sections': ready-made markup from components.
 * ------------------------------------------------------------------------ */
function solevo_build_general( $page, $d ) {
	$c = solevo_c_hero( array(
		'eyebrow'   => $d['eyebrow'] ?? 'Solevo',
		'h1'        => esc_html( $page['h1'] ),
		'lead'      => $d['lead'],
		'buttons'   => $d['buttons'] ?? solevo_hero_buttons( $page ),
		'locations' => $d['locations'] ?? true,
		'trust'     => $d['trust'] ?? array(),
		'jump'      => $d['jump'] ?? array(),
		'image'     => $d['image'] ?? '',
	) );
	$c .= solevo_todos( $d );
	return $c . implode( '', $d['sections'] ?? array() );
}

/* ---------------------------------------------------------------------------
 * Studio prices (from the current solevo.com.au price list). One place to update.
 * ------------------------------------------------------------------------ */
function solevo_prices( $keys ) {
	$all = array(
		'reformer' => array( 'title' => 'Reformer Pilates classes', 'meta' => '45 minutes · up to 6 reformers', 'rows' => array(
			array( 'Casual class', '', '$49' ),
			array( '5 class pack', '$45 per class', '$225' ),
			array( '10 class pack', '$42 per class', '$420' ),
			array( '20 class pack', '$39 per class', '$780' ),
			array( '50 class pack', '$37 per class', '$1,850' ),
		) ),
		'mat'      => array( 'title' => 'Mat Pilates and yoga classes', 'meta' => '45 minutes · up to 14 people', 'rows' => array(
			array( 'Casual class', '', '$30' ),
			array( '5 class pack', '$28 per class', '$140' ),
			array( '10 class pack', '$26 per class', '$260' ),
			array( '20 class pack', '$24 per class', '$480' ),
		) ),
		'private'  => array( 'title' => 'Private and duo sessions', 'meta' => 'One-on-one or two people with one instructor', 'rows' => array(
			array( 'Private session', '', '$140' ),
			array( 'Private 5 pack', '', '$650' ),
			array( 'Private 10 pack', '', '$1,200' ),
			array( 'Duo session', '2 people', '$180' ),
			array( 'Duo 5 pack', '', '$850' ),
			array( 'Duo 10 pack', '', '$1,600' ),
		) ),
		'clinical' => array( 'title' => 'Clinical Pilates', 'meta' => 'Physio-led, booked through Cliniko', 'rows' => array(
			array( 'Initial assessment', 'One-on-one, 60 minutes', '$180' ),
			array( 'Follow-up session', 'One-on-one, 45 minutes', '$150' ),
			array( 'Clinical reformer small group', 'Up to 6 people, per person', '$80' ),
		) ),
		'mums'     => array( 'title' => 'Mums and Bubs program', 'meta' => 'Six weeks · groups of six', 'rows' => array(
			array( 'Program fee', 'Includes three classes a week and a one-on-one assessment to start', '$79 per week' ),
		) ),
	);
	return array_values( array_intersect_key( $all, array_flip( $keys ) ) );
}
