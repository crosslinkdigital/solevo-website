<?php
/**
 * Image registry. Interim images (taken from the current site) ship in /assets/images; setup imports them into the
 * Media Library so Steph can swap each one with "Replace" in the editor, no code.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

/** Key => [file, alt text]. Filenames match the current solevo.com.au assets. */
function solevo_image_registry() {
	return array(
		'logo'               => array( 'solevo-logo.png', 'Solevo Physio, Pilates, Yoga' ),
		'yoga-stretch'       => array( 'yoga-stretch.jpg', 'Yoga practice at Solevo studio' ),
		'emma-docker'        => array( 'team-emma-docker.jpg', 'Emma Docker, Physiotherapist at Solevo' ),
		'rikki-xu'           => array( 'team-rikki-xu.jpg', 'Rikki Xu, Pilates Instructor at Solevo' ),
		'yasmin-mcfadden'    => array( 'team-yasmin-mcfadden.jpg', 'Yasmin McFadden, Yoga Instructor at Solevo' ),
		'running-assessment' => array( 'running-assessment.jpg', 'Running gait analysis at Solevo' ),
		'why-stretch'        => array( 'why-stretch.jpg', 'Athlete stretching' ),
		'why-strength'       => array( 'why-strength.jpg', 'Strength training with barbell' ),
		'studio-stretch'     => array( 'studio-stretch.jpg', 'Movement and flexibility at Solevo Studio' ),
		'clinic-reformer-room' => array( 'clinic-reformer-room.jpg', 'Reformer and rehab room at Solevo Physio & Studio, Brookvale' ),
		'clinic-studio-mats'   => array( 'clinic-studio-mats.jpg', 'Mats and bolsters set up in the Solevo studio, Brookvale' ),
		'solevo-intro-poster'  => array( 'solevo-intro-poster.jpg', 'A clinician assessing a client\'s shoulder at Solevo, Brookvale' ),
		'solevo-intro'         => array( 'solevo-intro.mp4', 'Solevo Physio and Movement: 30-second intro' ),
	);
}

/** Attachment ID for a registry key, or 0 if not yet imported. */
function solevo_image_id( $key ) {
	$map = get_option( 'solevo_image_map', array() );
	$id  = isset( $map[ $key ] ) ? (int) $map[ $key ] : 0;
	return ( $id && get_post( $id ) ) ? $id : 0;
}

/**
 * Core image block markup. Uses the Media Library copy when imported (gives width,
 * height, srcset and lazy loading), otherwise the theme placeholder.
 */
function solevo_img( $key, $class = '', $size = 'large' ) {
	$reg = solevo_image_registry();
	if ( ! isset( $reg[ $key ] ) ) {
		return '';
	}
	list( $file, $alt ) = $reg[ $key ];
	$id      = solevo_image_id( $key );
	$classes = trim( 'wp-block-image size-' . $size . ' ' . $class );
	$attrs   = array( 'sizeSlug' => $size, 'linkDestination' => 'none' );
	if ( $class ) {
		$attrs['className'] = $class;
	}
	if ( $id ) {
		$attrs = array( 'id' => $id ) + $attrs;
		$src   = wp_get_attachment_image_url( $id, $size );
		$alt   = get_post_meta( $id, '_wp_attachment_image_alt', true ) ?: $alt;
		$img   = sprintf( '<img src="%s" alt="%s" class="wp-image-%d"/>', esc_url( $src ), esc_attr( $alt ), $id );
	} else {
		$img = sprintf( '<img src="%s" alt="%s"/>', esc_url( SOLEVO_URI . '/assets/images/' . $file ), esc_attr( $alt ) );
	}
	return sprintf(
		"<!-- wp:image %s -->\n<figure class=\"%s\">%s</figure>\n<!-- /wp:image -->",
		wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES ),
		esc_attr( $classes ),
		$img
	);
}

/**
 * Core video block (muted, looping, inline). Uses the Media Library copy when imported.
 * Playback starts from site.js only on screens where the video is visible, so phones
 * never download it. Editors can swap the file with "Replace" like any video block.
 */
function solevo_video( $key, $poster_key = '', $class = '' ) {
	$reg = solevo_image_registry();
	if ( ! isset( $reg[ $key ] ) ) {
		return '';
	}
	$id     = solevo_image_id( $key );
	$src    = $id ? wp_get_attachment_url( $id ) : SOLEVO_URI . '/assets/images/' . $reg[ $key ][0];
	$poster = '';
	if ( $poster_key && isset( $reg[ $poster_key ] ) ) {
		$pid    = solevo_image_id( $poster_key );
		$poster = $pid ? wp_get_attachment_image_url( $pid, 'large' ) : SOLEVO_URI . '/assets/images/' . $reg[ $poster_key ][0];
	}
	$attrs = array();
	if ( $id ) {
		$attrs['id'] = $id;
	}
	if ( $class ) {
		$attrs['className'] = $class;
	}
	return sprintf(
		"<!-- wp:video %s -->\n<figure class=\"%s\"><video loop muted%s preload=\"none\" src=\"%s\" playsinline aria-label=\"%s\"></video></figure>\n<!-- /wp:video -->",
		wp_json_encode( $attrs ?: new stdClass() ),
		esc_attr( trim( 'wp-block-video ' . $class ) ),
		$poster ? ' poster="' . esc_url( $poster ) . '"' : '',
		esc_url( $src ),
		esc_attr( $reg[ $key ][1] )
	);
}

/** Import placeholders into the Media Library once. Returns the key => ID map. */
function solevo_import_images() {
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$map = get_option( 'solevo_image_map', array() );
	foreach ( solevo_image_registry() as $key => $item ) {
		if ( ! empty( $map[ $key ] ) && get_post( $map[ $key ] ) ) {
			continue;
		}
		list( $file, $alt ) = $item;
		$source = SOLEVO_DIR . '/assets/images/' . $file;
		if ( ! file_exists( $source ) ) {
			continue;
		}
		$upload = wp_upload_bits( $file, null, file_get_contents( $source ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		if ( ! empty( $upload['error'] ) ) {
			continue;
		}
		$type = wp_check_filetype( $upload['file'] );
		$id   = wp_insert_attachment( array(
			'post_mime_type' => $type['type'],
			'post_title'     => $alt,
			'post_status'    => 'inherit',
		), $upload['file'] );
		if ( is_wp_error( $id ) || ! $id ) {
			continue;
		}
		wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $upload['file'] ) );
		update_post_meta( $id, '_wp_attachment_image_alt', $alt );
		update_post_meta( $id, '_solevo_placeholder', $key );
		$map[ $key ] = $id;
	}
	update_option( 'solevo_image_map', $map, false );

	if ( ! empty( $map['logo'] ) && ! get_theme_mod( 'custom_logo' ) ) {
		set_theme_mod( 'custom_logo', (int) $map['logo'] );
	}
	return $map;
}
