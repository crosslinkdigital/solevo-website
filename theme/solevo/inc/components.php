<?php
/**
 * Solevo design system: reusable page components.
 *
 * Every component returns plain core block markup (group, heading, paragraph, list,
 * buttons, details, image, shortcode), so once a page is created editors change text,
 * links and images in the normal block editor. Nothing here is a custom block and
 * nothing needs a plugin. The look comes from the class names, styled in style.css
 * under "Design system".
 *
 * The same functions build:
 *   - the page scaffolds in setup.php (Service, Condition, Studio, General templates)
 *   - the inserter patterns in /patterns/c-*.php (Patterns > Solevo components)
 *
 * Booking links use the # placeholders from booking.php:
 *   #cliniko, #cliniko-location1, #cliniko-location2 (Book Physio), #mindbody (Book Studio),
 *   #phone, #email, #tfc (The Foot Company).
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

/* ---------------------------------------------------------------------------
 * Small building blocks
 * ------------------------------------------------------------------------ */

/** Plain group with a class and default (flow) layout. */
function solevo_c_box( $inner, $class, $tag = 'div' ) {
	return solevo_b_group( $inner, array( 'class' => $class, 'layout' => array( 'type' => 'default' ), 'tag' => $tag ) );
}

/** Section heading: eyebrow, H2, optional intro. */
function solevo_c_head( $eyebrow, $title, $intro = '', $class = '' ) {
	$inner = ( $eyebrow ? solevo_b_p( $eyebrow, 'is-style-eyebrow' ) : '' )
		. solevo_b_h( $title, 2 )
		. ( $intro ? solevo_b_p( $intro, 'solevo-intro' ) : '' );
	return solevo_c_box( $inner, trim( 'solevo-sh ' . $class ) );
}

/** Text link styled as a small uppercase arrow link. */
function solevo_c_more( $label, $href ) {
	return solevo_b_p( sprintf( '<a href="%s">%s →</a>', esc_attr( $href ), $label ), 'solevo-more' );
}

/** Page link by path, with an optional label (falls back to the page title in pages.php). */
function solevo_c_link( $path, $label = '' ) {
	if ( '' === $label ) {
		$all   = wp_list_pluck( solevo_site_pages(), 'title', 'path' );
		$label = $all[ $path ] ?? $path;
	}
	return sprintf( '<a href="%s">%s</a>', esc_url( home_url( '/' . $path ) ), esc_html( $label ) );
}

/** Generic core/details block with several inner blocks. */
function solevo_c_details( $summary, $inner, $class = '' ) {
	$a   = $class ? ' ' . wp_json_encode( array( 'className' => $class ) ) : '';
	$cls = trim( 'wp-block-details ' . $class );
	return "<!-- wp:details{$a} -->\n<details class=\"{$cls}\"><summary>{$summary}</summary>" . trim( $inner ) . "</details>\n<!-- /wp:details -->\n\n";
}

/** Editor-only note for facts still to confirm. Invisible to visitors. */
function solevo_c_todo( $text ) {
	return solevo_b_shortcode( '[solevo_todo]' . $text . '[/solevo_todo]' );
}

/* ---------------------------------------------------------------------------
 * Components
 * ------------------------------------------------------------------------ */

/**
 * Hero (service / condition / studio). Text left, photo right, location chips under the buttons.
 * $a: eyebrow, h1, lead, buttons [[label, href, outline]], image (registry key), trust [strings], locations (bool)
 */
function solevo_c_hero( $a ) {
	$text = solevo_b_p( $a['eyebrow'], 'is-style-eyebrow' )
		. solevo_b_h( $a['h1'], 1, 'solevo-hero2__title' )
		. solevo_b_p( $a['lead'], 'solevo-hero2__lead' )
		. solevo_b_buttons( $a['buttons'] )
		. ( ! empty( $a['locations'] ) ? solevo_b_shortcode( '[solevo_location_chips]' ) : '' )
		. ( ! empty( $a['trust'] ) ? solevo_b_list( $a['trust'], 'solevo-trustline' ) : '' )
		. ( ! empty( $a['jump'] ) ? solevo_b_p( implode( ' <span aria-hidden="true">·</span> ', array_map( function ( $j ) {
			return sprintf( '<a href="%s">%s</a>', esc_attr( $j[1] ), $j[0] );
		}, $a['jump'] ) ), 'solevo-jump' ) : '' );
	$media = ! empty( $a['video'] ) ? solevo_video( $a['video'], $a['poster'] ?? '', 'solevo-hero2__media solevo-hero2__video' )
		: ( ! empty( $a['image'] ) ? solevo_img( $a['image'], 'solevo-hero2__media', 'large' ) : '' );
	$grid  = solevo_c_box( solevo_c_box( $text, 'solevo-hero2__text' ) . $media, 'solevo-hero2__grid' );
	return solevo_b_section( $grid, array( 'class' => 'solevo-c solevo-hero2', 'anchor' => $a['anchor'] ?? '' ) );
}

/**
 * Interactive question boxes ("What can we help you with?"). Each box is a core/details
 * block: tap to open, no JavaScript. $items: [icon, title, hint, body_html, links[html], cta [label, href]]
 */
function solevo_c_help_grid( $head, $items, $after = '' ) {
	$boxes = '';
	foreach ( $items as $it ) {
		$inner = solevo_b_p( $it['body'] );
		if ( ! empty( $it['links'] ) ) {
			$inner .= solevo_b_list( $it['links'], 'solevo-qbox__links' );
		}
		$cta    = $it['cta'] ?? array( 'Book Physio', '#cliniko' );
		$inner .= solevo_b_p( sprintf( '<a href="%s">%s</a>', esc_attr( $cta[1] ), $cta[0] ), 'solevo-qbox__cta' );
		$boxes .= solevo_c_details( $it['title'] . '<br><em>' . $it['hint'] . '</em>', $inner, 'solevo-qbox solevo-icon--' . $it['icon'] );
	}
	return solevo_b_section( $head . solevo_c_box( $boxes, 'solevo-qgrid' ) . $after, array( 'class' => 'solevo-c solevo-help', 'anchor' => 'help' ) );
}

/**
 * Service cards. $items: [title, text, links[html] | more [label, href]]
 */
function solevo_c_service_cards( $head, $items, $after = '', $opts = array() ) {
	$cards = '';
	foreach ( $items as $it ) {
		$inner = solevo_b_h( $it['title'], 3 ) . solevo_b_p( $it['text'] );
		if ( ! empty( $it['links'] ) ) {
			$inner .= solevo_b_list( $it['links'], 'solevo-scard__links' );
		}
		if ( ! empty( $it['more'] ) ) {
			$inner .= solevo_c_more( $it['more'][0], $it['more'][1] );
		}
		$cards .= solevo_c_box( $inner, 'solevo-scard' . ( ! empty( $it['featured'] ) ? ' is-featured' : '' ) );
	}
	return solevo_b_section( $head . solevo_c_box( $cards, 'solevo-scards' ) . $after, array( 'class' => 'solevo-c solevo-services2', 'bg' => $opts['bg'] ?? 'surface', 'anchor' => $opts['anchor'] ?? 'services' ) );
}

/**
 * Care pathway: how Physio, Clinical Pilates and Studio classes relate.
 * $items: [label, title, text, booked, button [label, href, outline]]
 */
function solevo_c_pathway( $title, $intro, $items ) {
	$cols = '';
	foreach ( $items as $i => $it ) {
		$inner = solevo_b_p( $it['label'], 'solevo-path__step' )
			. solevo_b_h( $it['title'], 3 )
			. solevo_b_p( $it['text'] )
			. solevo_b_p( $it['booked'], 'solevo-path__booked' )
			. solevo_b_buttons( array( $it['button'] ) );
		$cols .= solevo_c_box( $inner, 'solevo-path__item' . ( 0 === $i ? ' is-current' : '' ) );
	}
	$inner = solevo_b_h( $title, 3, 'solevo-path__title' ) . ( $intro ? solevo_b_p( $intro, 'solevo-path__intro' ) : '' ) . solevo_c_box( $cols, 'solevo-path__grid' );
	return solevo_c_box( $inner, 'solevo-path' );
}

/**
 * Patient journey: three numbered steps, then "your first appointment" facts.
 * $steps: [title, text]; $facts: [title, html]
 */
function solevo_c_journey( $head, $steps, $facts = array(), $after = '', $facts_title = 'Your first appointment', $opts = array() ) {
	$items = array();
	foreach ( $steps as $s ) {
		$items[] = '<strong>' . $s[0] . '</strong>' . $s[1];
	}
	$inner = $head . solevo_b_list( $items, 'solevo-journey', true );
	if ( $facts ) {
		$f = '';
		foreach ( $facts as $fact ) {
			$f .= solevo_c_box( solevo_b_h( $fact[0], 3 ) . solevo_b_p( $fact[1] ), 'solevo-first__item' );
		}
		$inner .= solevo_c_box( solevo_b_h( $facts_title, 3, 'solevo-first__title' ) . solevo_c_box( $f, 'solevo-first__grid' ), 'solevo-first' );
	}
	return solevo_b_section( $inner . $after, array( 'class' => 'solevo-c solevo-journey-wrap', 'anchor' => $opts['anchor'] ?? 'journey', 'bg' => $opts['bg'] ?? '' ) );
}

/** Four reasons ("Why choose Solevo"). $items: [title, text]; $extra: list of short points. */
function solevo_c_why( $head, $items, $extra = array(), $opts = array() ) {
	$cols = '';
	foreach ( $items as $i => $it ) {
		$cols .= solevo_c_box( solevo_b_p( sprintf( '%02d', $i + 1 ), 'solevo-why4__num' ) . solevo_b_h( $it[0], 3 ) . solevo_b_p( $it[1] ), 'solevo-why4__item' );
	}
	$inner = $head . solevo_c_box( $cols, 'solevo-why4' ) . ( $extra ? solevo_b_list( $extra, 'solevo-why4__extra' ) : '' );
	return solevo_b_section( $inner, array( 'class' => 'solevo-c solevo-why2', 'bg' => $opts['bg'] ?? 'sand', 'anchor' => $opts['anchor'] ?? '' ) );
}

/**
 * Facilities and assessment: photos with a list of what we do and why it matters.
 * $items: [title, text]; $images: registry keys (1 to 3)
 */
function solevo_c_facilities( $eyebrow, $title, $intro, $items, $images, $after = '' ) {
	$list = array();
	foreach ( $items as $it ) {
		$list[] = '<strong>' . $it[0] . '</strong> ' . $it[1];
	}
	$text  = solevo_b_p( $eyebrow, 'is-style-eyebrow' ) . solevo_b_h( $title, 2 ) . solevo_b_p( $intro, 'solevo-intro' ) . solevo_b_list( $list, 'solevo-assess__list' ) . $after;
	$media = '';
	foreach ( $images as $key ) {
		$media .= solevo_img( $key, 'solevo-assess__img', 'large' );
	}
	$grid = solevo_c_box( solevo_c_box( $media, 'solevo-assess__media count-' . count( $images ) ) . solevo_c_box( $text, 'solevo-assess__text' ), 'solevo-assess' );
	return solevo_b_section( $grid, array( 'class' => 'solevo-c solevo-olive solevo-assess-wrap', 'anchor' => 'assessment' ) );
}

/**
 * Practitioner and compliant trust signals (no testimonials).
 * $a: image, eyebrow, name, role, bio (html), points [strings], link [label, href]
 */
function solevo_c_practitioner( $a ) {
	$text = solevo_b_p( $a['eyebrow'], 'is-style-eyebrow' )
		. solevo_b_h( $a['name'], 3, 'solevo-person2__name' )
		. solevo_b_p( $a['role'], 'solevo-person2__role' )
		. solevo_b_p( $a['bio'] )
		. ( ! empty( $a['points'] ) ? solevo_b_list( $a['points'], 'solevo-trust' ) : '' )
		. ( ! empty( $a['link'] ) ? solevo_c_more( $a['link'][0], $a['link'][1] ) : '' );
	$img  = ! empty( $a['image'] ) ? solevo_img( $a['image'], 'solevo-person2__img', 'large' ) : '';
	$grid = solevo_c_box( $img . solevo_c_box( $text, 'solevo-person2__text' ), 'solevo-person2' . ( $img ? '' : ' no-image' ) );
	return solevo_b_section( $grid, array( 'class' => 'solevo-c solevo-person2-wrap', 'bg' => 'surface', 'anchor' => 'team' ) );
}

/**
 * Fees, funding and FAQs side by side.
 * $fees: [[label, sub, price]]; $funding: [html]; $faqs: [[q, a_html]]
 */
function solevo_c_fees_faq( $head, $fees, $funding, $faqs, $fee_after = '', $after = '' ) {
	$rows = '';
	foreach ( $fees as $f ) {
		$rows .= solevo_c_box( solevo_b_p( $f[0] . ( $f[1] ? '<br><span>' . $f[1] . '</span>' : '' ), 'solevo-fee__label' ) . solevo_b_p( $f[2], 'solevo-fee__price' ), 'solevo-fee' );
	}
	$card = solevo_b_h( 'Fees', 3 ) . solevo_c_box( $rows, 'solevo-fees__rows' )
		. ( $funding ? solevo_b_h( 'Funding and referrals', 3 ) . solevo_b_list( $funding, 'solevo-ticks' ) : '' ) . $fee_after;
	$q = '';
	foreach ( $faqs as $f ) {
		$q .= solevo_c_details( $f[0], solevo_b_p( $f[1] ), 'solevo-faq2__item' );
	}
	$faq = solevo_b_h( 'Questions before you book', 3 ) . solevo_c_box( $q, 'solevo-faq2' );
	$grid = solevo_c_box( solevo_c_box( $card, 'solevo-fees' ) . solevo_c_box( $faq, 'solevo-faq2__col' ), 'solevo-feesfaq' );
	return solevo_b_section( $head . $grid . $after, array( 'class' => 'solevo-c solevo-feesfaq-wrap', 'anchor' => 'fees' ) );
}

/** FAQ accordion on its own (condition, studio and info pages). $faqs: [[q, a_html]] */
function solevo_c_faq( $title, $faqs, $after = '' ) {
	$q = '';
	foreach ( $faqs as $f ) {
		$q .= solevo_c_details( $f[0], solevo_b_p( $f[1] ), 'solevo-faq2__item' );
	}
	return solevo_b_section( solevo_b_p( 'FAQs', 'is-style-eyebrow' ) . solevo_b_h( $title, 2 ) . solevo_c_box( $q, 'solevo-faq2' ) . $after, array( 'class' => 'solevo-c solevo-faq-wrap', 'inner_class' => 'solevo-narrow', 'anchor' => 'faq' ) );
}

/** Instagram: heading and Follow button always; the live feed appears once Smash Balloon is connected. */
function solevo_c_instagram( $title = 'Follow us on Instagram', $intro = '' ) {
	$handle = '@' . trim( wp_parse_url( solevo_opt( 'instagram_url' ), PHP_URL_PATH ) ?: 'solevo.studio', '/' );
	$head   = solevo_c_head( 'Instagram', $title, $intro );
	$btn    = solevo_b_buttons( array( array( 'Follow ' . esc_html( $handle ), esc_url( solevo_opt( 'instagram_url' ) ), true ) ) );
	return solevo_b_section( solevo_c_box( $head . $btn, 'solevo-ig__head' ) . solevo_b_shortcode( '[solevo_instagram]' ), array( 'class' => 'solevo-c solevo-ig', 'anchor' => 'instagram' ) );
}

/** Location cards from Settings > Solevo (one source of truth for NAP). */
function solevo_c_locations( $eyebrow, $title, $intro = '', $service = 'physio', $after = '' ) {
	$head = solevo_c_head( $eyebrow, $title, $intro );
	return solevo_b_section( $head . solevo_b_shortcode( '[solevo_locations service="' . esc_attr( $service ) . '"]' ) . $after, array( 'class' => 'solevo-c solevo-locs-wrap', 'bg' => 'sand', 'anchor' => 'locations' ) );
}

/** Related pages as pills. $paths: page paths from pages.php */
function solevo_c_related( $title, $paths ) {
	if ( ! $paths ) {
		return '';
	}
	return solevo_b_section( solevo_b_h( $title, 3 ) . solevo_b_list( array_map( 'solevo_c_link', $paths ), 'is-style-pills' ), array( 'class' => 'solevo-c solevo-related', 'inner_class' => 'solevo-narrow' ) );
}

/** "Reviewed by" line for health pages. Renders only once a clinician is filled in. Placed inside a section. */
function solevo_c_reviewed() {
	return solevo_b_shortcode( '[solevo_reviewed by="" role="" date=""]' );
}

/* ---------------------------------------------------------------------------
 * Components for the Condition, Studio and General templates
 * ------------------------------------------------------------------------ */

/**
 * Two-column text section: copy on the left, a ticked list (or photo) on the right.
 * $a: eyebrow, title, paras [html], list [html], list_title, image, bg, anchor, after
 */
function solevo_c_split( $a ) {
	$text = ( ! empty( $a['eyebrow'] ) ? solevo_b_p( $a['eyebrow'], 'is-style-eyebrow' ) : '' ) . solevo_b_h( $a['title'], 2 );
	foreach ( (array) ( $a['paras'] ?? array() ) as $p ) {
		$text .= solevo_b_p( $p );
	}
	$text .= $a['after_text'] ?? '';
	$side = '';
	if ( ! empty( $a['list'] ) ) {
		$side = solevo_c_box( ( ! empty( $a['list_title'] ) ? solevo_b_h( $a['list_title'], 3 ) : '' ) . solevo_b_list( $a['list'], 'solevo-ticks' ), 'solevo-split2__card' );
	} elseif ( ! empty( $a['image'] ) ) {
		$side = solevo_img( $a['image'], 'solevo-split2__img', 'large' );
	}
	$grid = solevo_c_box( solevo_c_box( $text, 'solevo-split2__text' ) . $side, 'solevo-split2' . ( $side ? '' : ' is-single' ) );
	return solevo_b_section( $grid . ( $a['after'] ?? '' ), array( 'class' => 'solevo-c solevo-split2-wrap', 'bg' => $a['bg'] ?? '', 'anchor' => $a['anchor'] ?? '' ) );
}

/** Red flags: when to see a GP or call 000 first. */
function solevo_c_redflags( $title, $items, $note = 'If any of these apply, see your GP or call your maternity or medical team before booking. In an emergency call 000.' ) {
	$inner = solevo_b_p( 'Safety first', 'is-style-eyebrow' ) . solevo_b_h( $title, 2 ) . solevo_b_list( $items, 'solevo-flags' ) . solevo_b_p( $note, 'solevo-flags__note' );
	return solevo_b_section( solevo_c_box( $inner, 'solevo-flagbox' ), array( 'class' => 'solevo-c solevo-flags-wrap', 'anchor' => 'red-flags' ) );
}

/**
 * Class or program formats. $items: [name, tag, text, best, meta]
 */
function solevo_c_classes( $head, $items, $after = '', $opts = array() ) {
	$cards = '';
	foreach ( $items as $it ) {
		$inner = ( ! empty( $it['meta'] ) ? solevo_b_p( $it['meta'], 'solevo-class2__meta' ) : '' )
			. solevo_b_h( $it['name'], 3 )
			. ( ! empty( $it['tag'] ) ? solevo_b_p( $it['tag'], 'solevo-class2__tag' ) : '' )
			. solevo_b_p( $it['text'] )
			. ( ! empty( $it['best'] ) ? solevo_b_p( '<strong>Best for:</strong> ' . $it['best'], 'solevo-class2__best' ) : '' );
		$cards .= solevo_c_box( $inner, 'solevo-scard solevo-class2' );
	}
	return solevo_b_section( $head . solevo_c_box( $cards, 'solevo-scards' ) . $after, array( 'class' => 'solevo-c solevo-classes-wrap', 'bg' => $opts['bg'] ?? 'surface', 'anchor' => $opts['anchor'] ?? 'classes' ) );
}

/**
 * Price cards. $groups: [title, meta, rows [[label, sub, price]]]
 */
function solevo_c_prices( $head, $groups, $after = '' ) {
	$cards = '';
	foreach ( $groups as $g ) {
		$rows = '';
		foreach ( $g['rows'] as $r ) {
			$rows .= solevo_c_box( solevo_b_p( $r[0] . ( $r[1] ? '<br><span>' . $r[1] . '</span>' : '' ), 'solevo-fee__label' ) . solevo_b_p( $r[2], 'solevo-fee__price' ), 'solevo-fee' );
		}
		$cards .= solevo_c_box( solevo_b_h( $g['title'], 3 ) . ( ! empty( $g['meta'] ) ? solevo_b_p( $g['meta'], 'solevo-price2__meta' ) : '' ) . solevo_c_box( $rows, 'solevo-fees__rows' ), 'solevo-fees solevo-price2' );
	}
	return solevo_b_section( $head . solevo_c_box( $cards, 'solevo-prices2' ) . $after, array( 'class' => 'solevo-c solevo-prices-wrap', 'anchor' => 'pricing' ) );
}

/** Live Mindbody timetable (or a Book Studio button until the widget code is in Settings). */
function solevo_c_timetable( $title = 'Timetable', $intro = 'See live class times and book your spot online.' ) {
	return solevo_b_section( solevo_c_head( 'Book Studio', $title, $intro ) . solevo_c_box( solevo_b_shortcode( '[solevo_timetable]' ), 'solevo-tt' ), array( 'class' => 'solevo-c solevo-tt-wrap', 'bg' => 'sand', 'anchor' => 'timetable' ) );
}

/** Cards linking to other pages in the 30-page map, using their excerpt. $paths: page paths */
function solevo_c_link_cards( $head, $paths, $opts = array() ) {
	$all   = array();
	foreach ( solevo_site_pages() as $p ) {
		$all[ $p['path'] ] = $p;
	}
	$items = array();
	foreach ( $paths as $path ) {
		if ( ! isset( $all[ $path ] ) ) {
			continue;
		}
		$items[] = array( 'title' => esc_html( $all[ $path ]['title'] ), 'text' => esc_html( $all[ $path ]['excerpt'] ?? '' ), 'more' => array( 'Learn more', home_url( '/' . $path ) ) );
	}
	return solevo_c_service_cards( $head, $items, '', array( 'bg' => $opts['bg'] ?? '', 'anchor' => $opts['anchor'] ?? 'related' ) );
}

/** Plain text section, narrow column. $paras: [html] */
function solevo_c_text( $eyebrow, $title, $paras, $opts = array() ) {
	$inner = ( $eyebrow ? solevo_b_p( $eyebrow, 'is-style-eyebrow' ) : '' ) . solevo_b_h( $title, 2 );
	foreach ( $paras as $p ) {
		$inner .= solevo_b_p( $p );
	}
	return solevo_b_section( $inner . ( $opts['after'] ?? '' ), array( 'class' => 'solevo-c solevo-text-wrap', 'inner_class' => 'solevo-narrow', 'bg' => $opts['bg'] ?? '', 'anchor' => $opts['anchor'] ?? '' ) );
}

/** Two booking paths side by side (Book page): physio through Cliniko, studio through Mindbody. */
function solevo_c_booking_paths( $head ) {
	$cols = solevo_c_box(
		solevo_b_p( 'Cliniko', 'solevo-path__step' ) . solevo_b_h( 'Book Physio', 3 )
		. solevo_b_p( 'One-on-one physiotherapy and Clinical Pilates in Brookvale, and physiotherapy at Terrey Hills on Wednesdays.' )
		. solevo_b_list( array( 'Pain, injury or rehab after surgery', 'Pregnancy, postnatal and pelvic floor care', 'Clinical Pilates assessments and sessions' ), 'solevo-ticks' )
		. solevo_b_buttons( array( array( 'Book Physio', '#cliniko' ) ) ),
		'solevo-path__item is-current'
	) . solevo_c_box(
		solevo_b_p( 'Mindbody', 'solevo-path__step' ) . solevo_b_h( 'Book Studio', 3 )
		. solevo_b_p( 'Reformer Pilates, mat Pilates, pregnancy and postnatal classes and yoga at our Brookvale studio.' )
		. solevo_b_list( array( 'Group classes of up to 6 reformers or 14 mats', 'Private and duo sessions', 'Class packs and casual visits' ), 'solevo-ticks' )
		. solevo_b_buttons( array( array( 'Book Studio', '#mindbody' ) ) ),
		'solevo-path__item is-current'
	);
	return solevo_b_section( $head . solevo_c_box( $cols, 'solevo-path__grid solevo-path__grid--two' ), array( 'class' => 'solevo-c solevo-bookpaths', 'anchor' => 'choose' ) );
}
