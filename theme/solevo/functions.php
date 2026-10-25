<?php
/**
 * Solevo theme bootstrap.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

define( 'SOLEVO_VERSION', '1.3.2' );
define( 'SOLEVO_DIR', get_template_directory() );
define( 'SOLEVO_URI', get_template_directory_uri() );

require SOLEVO_DIR . '/inc/settings.php';
require SOLEVO_DIR . '/inc/images.php';
require SOLEVO_DIR . '/inc/booking.php';
require SOLEVO_DIR . '/inc/shortcodes.php';
require SOLEVO_DIR . '/inc/seo.php';
require SOLEVO_DIR . '/inc/tracking.php';
require SOLEVO_DIR . '/inc/pages.php';
require SOLEVO_DIR . '/inc/blocks.php';
require SOLEVO_DIR . '/inc/components.php';
require SOLEVO_DIR . '/inc/schema.php';
require SOLEVO_DIR . '/inc/menus.php';
require SOLEVO_DIR . '/inc/setup.php';

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require SOLEVO_DIR . '/inc/cli.php';
}

add_action( 'after_setup_theme', function () {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
	add_theme_support( 'custom-logo', array( 'height' => 120, 'width' => 400, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'responsive-embeds' );
	remove_theme_support( 'core-block-patterns' );
	// Excerpts on pages power the child-page cards on /physio, /pilates and /conditions.
	add_post_type_support( 'page', 'excerpt' );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'solevo', get_stylesheet_uri(), array(), SOLEVO_VERSION );
	wp_enqueue_script( 'solevo', SOLEVO_URI . '/assets/js/site.js', array(), SOLEVO_VERSION, array( 'strategy' => 'defer', 'in_footer' => true ) );
	wp_localize_script( 'solevo', 'solevoSite', array(
		'home'      => home_url( '/' ),
		'redirects' => solevo_hash_redirects(),
	) );
} );

// Preload the hero fonts so the H1 paints in the right face (LCP).
add_action( 'wp_head', function () {
	foreach ( array( 'cormorant-garamond.woff', 'jost.woff' ) as $font ) {
		printf( '<link rel="preload" href="%s" as="font" type="font/woff" crossorigin>' . "\n", esc_url( SOLEVO_URI . '/assets/fonts/' . $font ) );
	}
}, 1 );

// Pattern category for the inserter.
add_action( 'init', function () {
	register_block_pattern_category( 'solevo', array( 'label' => __( 'Solevo', 'solevo' ) ) );
	register_block_pattern_category( 'solevo-home', array( 'label' => __( 'Solevo homepage sections', 'solevo' ) ) );
	register_block_pattern_category( 'solevo-components', array( 'label' => __( 'Solevo components', 'solevo' ) ) );
} );

// Serve resized images as WebP (originals are kept).
add_filter( 'image_editor_output_format', function ( $formats ) {
	$formats['image/jpeg'] = 'image/webp';
	$formats['image/png']  = 'image/webp';
	return $formats;
} );

// Block styles editors can pick in the sidebar.
add_action( 'init', function () {
	register_block_style( 'core/group', array( 'name' => 'card', 'label' => __( 'Card', 'solevo' ) ) );
	register_block_style( 'core/list', array( 'name' => 'pills', 'label' => __( 'Pills', 'solevo' ) ) );
	register_block_style( 'core/list', array( 'name' => 'ticks', 'label' => __( 'Ticks', 'solevo' ) ) );
	register_block_style( 'core/paragraph', array( 'name' => 'eyebrow', 'label' => __( 'Eyebrow', 'solevo' ) ) );
	register_block_style( 'core/image', array( 'name' => 'rounded', 'label' => __( 'Rounded', 'solevo' ) ) );
} );
