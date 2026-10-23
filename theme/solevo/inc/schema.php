<?php
/**
 * Local business schema for both physio locations (local SEO for Brookvale and Terrey Hills).
 * Output on the homepage, /physio and /contact. Data comes from Settings > Solevo, so the
 * schema always matches the address shown on the page.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_head', function () {
	if ( solevo_seo_plugin_active() && ! apply_filters( 'solevo_force_schema', false ) ) {
		return;
	}
	$def = is_front_page() ? array( 'path' => '' ) : solevo_page_def();
	if ( ! $def || ! in_array( $def['path'], array( '', 'physio', 'contact' ), true ) ) {
		return;
	}
	$graph = array();
	foreach ( solevo_locations() as $loc ) {
		$parts   = array_map( 'trim', explode( ',', $loc['address'] ) );
		$street  = count( $parts ) > 1 ? $parts[0] : '';
		$rest    = end( $parts );
		$postcode = preg_match( '/\b(\d{4})\b/', $rest, $m ) ? $m[1] : '';
		$entity  = array(
			'@type'   => 'Physiotherapy',
			'@id'     => home_url( '/#' . $loc['key'] ),
			'name'    => 'location1' === $loc['key'] ? solevo_opt( 'business_name' ) : solevo_opt( 'business_name' ) . ' at ' . $loc['name'],
			'url'     => home_url( '/physio' ),
			'address' => array_filter( array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $street,
				'addressLocality' => $loc['area'],
				'addressRegion'   => 'NSW',
				'postalCode'      => $postcode,
				'addressCountry'  => 'AU',
			) ),
		);
		if ( solevo_opt( 'phone' ) ) {
			$entity['telephone'] = solevo_opt( 'phone' );
		}
		if ( $loc['hours'] ) {
			$entity['description'] = 'Opening hours: ' . implode( '; ', solevo_lines( $loc['hours'] ) );
		}
		if ( 'location1' === $loc['key'] && solevo_opt( 'instagram_url' ) ) {
			$entity['sameAs'] = array( solevo_opt( 'instagram_url' ) );
		}
		$graph[] = $entity;
	}
	printf( '<script type="application/ld+json">%s</script>' . "\n", wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) );
}, 20 );
