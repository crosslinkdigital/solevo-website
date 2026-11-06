<?php
/**
 * Blog (1.4.13): /blog index, single posts, category archives.
 *
 * - The blog index is the page set as "Posts page" in Settings > Reading (slug: blog).
 *   Posts live at /blog/{post-slug}/ (Settings > Permalinks, custom structure /blog/%postname%/).
 * - Templates: templates/home.html (index), single.html (post), archive.html (categories).
 * - Posts book physio (Cliniko) in the header, the sticky bar and the closing band.
 * - BlogPosting schema, breadcrumbs (Home / Blog / Post), SEO box on posts (seo.php).
 * - Author archives redirect to /blog (they would expose WordPress usernames).
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

/** True on the blog index, a single post or a post archive. */
function solevo_is_blog() {
	return is_home() || is_singular( 'post' ) || is_category() || is_tag() || is_date();
}

/** The blog index page (Settings > Reading > Posts page), or null. */
function solevo_blog_page() {
	$id = (int) get_option( 'page_for_posts' );
	return $id ? get_post( $id ) : null;
}

/** URL of the blog index. */
function solevo_blog_url() {
	$page = solevo_blog_page();
	return $page ? get_permalink( $page ) : home_url( '/blog/' );
}

/** Estimated reading time in minutes (200 words a minute, at least 1). */
function solevo_reading_minutes( $post = null ) {
	$words = str_word_count( wp_strip_all_tags( (string) get_post_field( 'post_content', $post ) ) );
	return max( 1, (int) round( $words / 200 ) );
}

/* ---------------------------------------------------------------------------
 * Shortcodes used by the templates
 * ------------------------------------------------------------------------ */

/** Index hero: eyebrow, H1 and intro. Title and intro come from the Posts page (title + excerpt). */
add_shortcode( 'solevo_blog_hero', function () {
	$page  = solevo_blog_page();
	$h1    = 'Physio tips for staying active';
	$lead  = 'Practical advice from our physiotherapy team on strength, injury and getting back to the activities you love, from Brookvale and Terrey Hills.';
	if ( $page ) {
		$h1   = get_post_meta( $page->ID, '_solevo_h1', true ) ?: $h1;
		$lead = has_excerpt( $page ) ? get_the_excerpt( $page ) : $lead;
	}
	if ( is_category() || is_tag() ) {
		$h1   = single_term_title( '', false );
		$lead = term_description() ? wp_strip_all_tags( term_description() ) : $lead;
	}
	if ( is_paged() ) {
		$h1 .= sprintf( ' (page %d)', (int) get_query_var( 'paged' ) );
	}
	return sprintf(
		'<div class="solevo-bhero"><p class="is-style-eyebrow">Solevo blog</p><h1 class="wp-block-heading">%s</h1><p class="solevo-bhero__lead">%s</p></div>',
		esc_html( $h1 ),
		esc_html( $lead )
	);
} );

/** Post header line: category · date · reading time. */
add_shortcode( 'solevo_post_meta', function () {
	$cats = get_the_category();
	$cat  = $cats ? sprintf( '<a href="%s">%s</a>', esc_url( get_category_link( $cats[0] ) ), esc_html( $cats[0]->name ) ) : '';
	$bits = array_filter( array(
		$cat,
		sprintf( '<time datetime="%s">%s</time>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date( 'j F Y' ) ) ),
		sprintf( '<span>%d min read</span>', solevo_reading_minutes() ),
	) );
	return '<p class="solevo-pmeta">' . implode( '<span aria-hidden="true"> · </span>', $bits ) . '</p>';
} );

/** Post lead: the excerpt, shown under the H1. */
add_shortcode( 'solevo_post_lead', function () {
	return has_excerpt() ? '<p class="solevo-plead">' . esc_html( get_the_excerpt() ) . '</p>' : '';
} );

/** Closing box under the article: who you will see, and the booking button. */
add_shortcode( 'solevo_post_physio', function () {
	$img = solevo_image_id( 'emma-docker' );
	$pic = $img ? wp_get_attachment_image( $img, 'medium', false, array( 'class' => 'solevo-pbox__img', 'alt' => 'Emma Docker, Physiotherapist at Solevo' ) ) : '';
	$html = '<aside class="solevo-pbox">' . $pic . '<div class="solevo-pbox__text">'
		. '<p class="is-style-eyebrow">Your physio</p>'
		. '<p class="solevo-pbox__name">Emma Docker, Physiotherapist</p>'
		. '<p>Emma sees patients in Brookvale and at Terrey Hills Medical Centre on Wednesdays. Book online. No referral required.</p>'
		. '<div class="wp-block-buttons"><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#cliniko">Book Physio</a></div>'
		. sprintf( '<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="%s">See physio services</a></div>', esc_url( home_url( '/physio' ) ) )
		. '</div></div></aside>';
	return solevo_rewrite_links( $html );
} );

/** Up to three more posts: same category first, then the latest. */
add_shortcode( 'solevo_related_posts', function () {
	$id   = get_the_ID();
	$cats = wp_get_post_categories( $id );
	$args = array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 3, 'post__not_in' => array( $id ), 'ignore_sticky_posts' => true, 'no_found_rows' => true );
	$posts = $cats ? get_posts( $args + array( 'category__in' => $cats ) ) : array();
	if ( count( $posts ) < 3 ) {
		$more  = get_posts( array_merge( $args, array( 'posts_per_page' => 3 - count( $posts ), 'post__not_in' => array_merge( array( $id ), wp_list_pluck( $posts, 'ID' ) ) ) ) );
		$posts = array_merge( $posts, $more );
	}
	if ( ! $posts ) {
		return '';
	}
	$cards = '';
	foreach ( $posts as $p ) {
		$cards .= solevo_blog_card( $p, 'h3' );
	}
	return sprintf(
		'<section class="solevo-related-posts"><div class="solevo-related-posts__inner"><h2 class="wp-block-heading">More from the blog</h2><div class="solevo-bcards">%s</div><p class="solevo-more"><a href="%s">All articles →</a></p></div></section>',
		$cards,
		esc_url( solevo_blog_url() )
	);
} );

/** One article card (used by related posts; the index uses the core Query Loop with the same classes). */
function solevo_blog_card( $p, $tag = 'h2' ) {
	$img = get_the_post_thumbnail( $p, 'medium_large', array( 'loading' => 'lazy' ) );
	return sprintf(
		'<article class="solevo-bcard">%s<div class="solevo-bcard__body"><p class="solevo-bcard__date">%s</p><%s class="solevo-bcard__title"><a href="%s">%s</a></%s><p class="solevo-bcard__excerpt">%s</p></div></article>',
		$img ? '<a class="solevo-bcard__img" href="' . esc_url( get_permalink( $p ) ) . '" tabindex="-1" aria-hidden="true">' . $img . '</a>' : '',
		esc_html( get_the_date( 'j F Y', $p ) ),
		$tag,
		esc_url( get_permalink( $p ) ),
		esc_html( get_the_title( $p ) ),
		$tag,
		esc_html( get_the_excerpt( $p ) )
	);
}

/* ---------------------------------------------------------------------------
 * Schema: BlogPosting on posts, Blog on the index
 * ------------------------------------------------------------------------ */

add_action( 'wp_head', function () {
	if ( solevo_seo_plugin_active() ) {
		return;
	}
	$publisher = array(
		'@type' => 'Organization',
		'name'  => 'Solevo Physio & Studio',
		'url'   => home_url( '/' ),
		'logo'  => array( '@type' => 'ImageObject', 'url' => get_theme_file_uri( 'assets/images/solevo-logo.png' ) ),
	);
	if ( is_singular( 'post' ) ) {
		$id   = get_queried_object_id();
		$desc = get_post_meta( $id, '_solevo_meta_description', true ) ?: get_the_excerpt( $id );
		$data = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'BlogPosting',
			'headline'         => get_the_title( $id ),
			'description'      => $desc,
			'datePublished'    => get_the_date( 'c', $id ),
			'dateModified'     => get_the_modified_date( 'c', $id ),
			'mainEntityOfPage' => get_permalink( $id ),
			'author'           => $publisher,
			'publisher'        => $publisher,
			'inLanguage'       => 'en-AU',
		);
		$img = get_post_thumbnail_id( $id ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' ) : null;
		if ( $img ) {
			$data['image'] = $img[0];
		}
	} elseif ( is_home() && ! is_paged() ) {
		$data = array(
			'@context'  => 'https://schema.org',
			'@type'     => 'Blog',
			'name'      => 'Solevo blog',
			'url'       => solevo_blog_url(),
			'publisher' => $publisher,
		);
	} else {
		return;
	}
	printf( '<script type="application/ld+json">%s</script>' . "\n", wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) );
}, 21 );

/* ---------------------------------------------------------------------------
 * Housekeeping
 * ------------------------------------------------------------------------ */

// Author archives would show WordPress usernames; send them to the blog instead.
add_action( 'template_redirect', function () {
	if ( is_author() ) {
		wp_safe_redirect( solevo_blog_url(), 301 );
		exit;
	}
} );

// No "[...]" after card excerpts; a full sentence reads better.
add_filter( 'excerpt_more', function () {
	return '…';
} );
add_filter( 'excerpt_length', function () {
	return 32;
} );

// Canonical on the blog index (core prints canonicals for single posts and pages only).
add_action( 'wp_head', function () {
	if ( is_home() && ! solevo_seo_plugin_active() ) {
		$paged = (int) get_query_var( 'paged' );
		$url   = $paged > 1 ? get_pagenum_link( $paged ) : solevo_blog_url();
		printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $url ) );
	}
}, 3 );

// Featured images on posts (card and header photos).
add_action( 'after_setup_theme', function () {
	add_theme_support( 'post-thumbnails' );
} );
