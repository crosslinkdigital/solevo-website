<?php
/**
 * WP-CLI:
 *   wp solevo setup [--rebuild-home] [--rebuild-all]
 *   wp solevo menu <landing|full>
 *   wp solevo publish <path>...      e.g. wp solevo publish physio pilates/mums-and-bubs
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

WP_CLI::add_command( 'solevo setup', function ( $args, $assoc ) {
	solevo_run_setup( array(
		'rebuild_home' => isset( $assoc['rebuild-home'] ),
		'rebuild_all'  => isset( $assoc['rebuild-all'] ),
		'log'          => function ( $l ) {
			WP_CLI::log( $l );
		},
	) );
	WP_CLI::success( 'Solevo setup complete.' );
} );

WP_CLI::add_command( 'solevo menu', function ( $args ) {
	$mode = ( $args[0] ?? 'landing' ) === 'full' ? 'full' : 'landing';
	update_option( 'solevo_menu_mode', $mode );
	WP_CLI::success( 'Menu mode: ' . $mode );
} );

WP_CLI::add_command( 'solevo publish', function ( $args ) {
	foreach ( $args as $path ) {
		$page = get_page_by_path( trim( $path, '/' ) );
		if ( ! $page ) {
			WP_CLI::warning( 'Not found: ' . $path );
			continue;
		}
		wp_update_post( array( 'ID' => $page->ID, 'post_status' => 'publish' ) );
		WP_CLI::log( 'Published /' . trim( $path, '/' ) );
	}
} );
